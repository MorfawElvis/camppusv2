<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\GeneralSetting;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\StudentAttendance;
use Carbon\CarbonPeriod;
use Dompdf\Dompdf;
use Dompdf\Options;

class StudentAttendanceController extends Controller
{
    public function printReport($classId, $startDate, $endDate)
    {
        $class = ClassRoom::findOrFail($classId);
        $students = Student::where('class_room_id', $classId)->get();

        $dates = CarbonPeriod::create($startDate, $endDate)->toArray();
        $dateChunks = array_chunk($dates, 7);

        $attendanceData = [];
        foreach ($students as $student) {
            $studentAttendance = [];
            $totalAbsences = 0;
            foreach ($dates as $date) {
                $attendance = StudentAttendance::where('student_id', $student->id)
                    ->whereDate('date', $date->format('Y-m-d'))
                    ->first();

                $status = $attendance ? $attendance->status : 'N/A';
                $studentAttendance[$date->format('d-m-Y')] = $status;

                if (strtolower($status) === 'absent') {
                    $totalAbsences++;
                }
            }
            $attendanceData[] = [
                'student' => $student,
                'attendance' => $studentAttendance,
                'totalAbsences' => $totalAbsences,
            ];
        }

        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);

        $html = '';
        foreach ($dateChunks as $index => $datesChunk) {
            $html .= view('reports.attendance.student_attendance', [
                'class' => $class,
                'attendanceData' => $attendanceData,
                'dates' => $datesChunk,
                'schoolName' => GeneralSetting::first()->school_name,
                'academicYear' => SchoolYear::where('year_status', 'opened')->first()->year_name,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ])->render();

//            // Add a page break only if there are more chunks after this one
//            if ($index < count($dateChunks) - 1) {
//                $html .= '<div style="page-break-after: always;"></div>';
//            }
        }

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream('student_attendance_report.pdf');
    }

}
