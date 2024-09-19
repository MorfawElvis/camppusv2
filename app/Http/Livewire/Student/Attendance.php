<?php

namespace App\Http\Livewire\Student;

use App\Models\StudentAttendance;
use App\Services\Attendance\SkySmsService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Dompdf\Dompdf;
use Dompdf\Options;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Section;

/**
 * @method static updateOrCreate(array $array, array|string[] $array1)
 * @method static whereDate(string $string, $selectedDate)
 */
class Attendance extends Component
{
    use LivewireAlert;

    public $selectedTab = 'take-attendance';
    // Properties for generating reports
    public $selectedClassForReport;
    public $selectedClassesForReport = [];
    public $selectedSectionForReport;
    public $reportStartDate;
    public $reportEndDate;
    public $studentsForReport = [];
    public $reportData = [];

    // Properties for managing attendance
    public $selectedDate;
    public $selectedSection;
    public $selectedClass;
    public $sections;
    public $classes = [];
    public $students = [];
    public $attendances = [];
    public $attendanceLoaded = false; // Track if attendance has been initially loaded
    public $attendanceReport = [];

    private $smsService;

    protected $rules = [
        'selectedDate' => 'required|date',
        'selectedSection' => 'required',
        'selectedClass' => 'required',
        'attendances.*.status' => 'required|in:present,absent,late',
        'selectedSectionForReport' => 'required',
        'selectedClassForReport' => 'required',
        'reportStartDate' => 'required|date',
        'reportEndDate' => 'required|date|after_or_equal:reportStartDate',
    ];
    public function mount(SkySmsService $smsService)
    {
        $this->selectedClassForReport = Section::all();
        $this->smsService = $smsService;
        $this->sections = Section::all();
        $this->selectedDate = Carbon::today()->format('Y-m-d');
    }

    public function switchTab($tab)
    {
        $this->selectedTab = $tab;
        $this->attendanceLoaded = false;

        if ($tab === 'attendance-report') {
            $this->generateAttendanceReport();
        }
    }

    public function generateAttendanceReport()
    {
        $this->validate([
            'selectedSectionForReport' => 'required',
            'selectedClassForReport' => 'required',
            'reportStartDate' => 'required|date',
            'reportEndDate' => 'required|date|after_or_equal:reportStartDate',
        ]);

        return redirect()->route('attendance.report', [
            'classId' => $this->selectedClassForReport,
            'startDate' => $this->reportStartDate,
            'endDate' => $this->reportEndDate,
        ]);
    }

    public function updatedSelectedSection($sectionId)
    {
        $this->classes = ClassRoom::where('section_id', $sectionId)->get();
        $this->students = [];
        $this->attendances = [];
        $this->attendanceLoaded = false; // Reset the flag when section changes
    }

    public function updatedSelectedSectionForReport($sectionId)
    {
        $this->selectedClassesForReport = ClassRoom::where('section_id', $sectionId)->get();
    }

    public function updatedSelectedDate()
    {
        // Re-initialize attendance if it has been loaded
        if ($this->attendanceLoaded) {
            $this->loadAttendance();
        }
    }

    public function updatedSelectedClass($classId)
    {
        // Reset the attendance flag when class changes
        $this->attendanceLoaded = false;
        $this->students = [];
        $this->attendances = [];
    }

    public function loadAttendance()
    {
        $formattedDate = Carbon::createFromFormat('Y-m-d', $this->selectedDate)->format('Y-m-d');

        if ($this->selectedClass) {
            $this->students = Student::where('class_room_id', $this->selectedClass)->get();
            $attendanceRecords = StudentAttendance::whereDate('date', $formattedDate)
                ->whereIn('student_id', $this->students->pluck('id'))
                ->get()
                ->keyBy('student_id');

            $this->attendances = $this->students->mapWithKeys(function ($student) use ($attendanceRecords) {
                $attendance = $attendanceRecords->get($student->id);
                return [
                    $student->id => [
                        'status' => $attendance ? $attendance->status : null, // Initialize status here
                    ]
                ];
            })->toArray();

            foreach ($this->students as $student) {
                if (!isset($this->attendances[$student->id])) {
                    $this->attendances[$student->id] = ['status' => null];
                }
            }
            $this->attendanceLoaded = true; // Set the flag to true after loading attendance
        }
    }

    public function markAll($status)
    {
        foreach ($this->students as $student) {
            $this->attendances[$student->id]['status'] = $status;
        }
    }

    public function saveAttendance()
    {
        $formattedDate = Carbon::createFromFormat('Y-m-d', $this->selectedDate)->format('Y-m-d');
        $currentDate = Carbon::today()->format('Y-m-d');

        $absentStudents = [];
        $missingStatuses = [];

        foreach ($this->students as $student) {
            $status = $this->attendances[$student->id]['status'] ?? null;

            if ($status === 'absent' && $formattedDate === $currentDate) {
                $absentStudents[] = $student; // Collect absent students for SMS
            }
            // Collect students missing a status
            if (is_null($status) || !in_array($status, ['present', 'absent', 'late'])) {
                $missingStatuses[] = $student->id;
            }
        }

        // Check if there are students missing a status
        if (!empty($missingStatuses)) {
            $this->alert('error', __('attendance.attendance_error'));
            return;
        }

        // Save or update attendance records
        foreach ($this->students as $student) {
            $status = $this->attendances[$student->id]['status'] ?? '';

            StudentAttendance::updateOrCreate(
                ['student_id' => $student->id, 'date' => $formattedDate],
                ['status' => $status]
            );
        }

        // Send SMS notifications to parents of absent students
        if ($formattedDate === $currentDate) {
            $this->sendAbsentNotifications($absentStudents);
        }
        $this->alert('success', __('attendance.attendance_saved'));
    }

    public function render()
    {
        return view('livewire.student.attendance');
    }

    private function sendAbsentNotifications(array $absentStudents)
    {
        foreach ($absentStudents as $student) {
            $parentPhone = $student->phone_number;
            $smsService = $this->smsService;
            $absent_message = "Dear Parent, your child {$student->full_name} was marked absent today.";

            if ($parentPhone && $smsService) {
                try {
                    $phone = $parentPhone;
                    $message = $absent_message;
                    $sender = 'CUIB-EHS';

                    $response = $smsService->sendSms($phone, $message, $sender);
                } catch (\Exception $e) {
                    \Log::error("Failed to send SMS to {$parentPhone}: {$e->getMessage()}");
                }
            }
        }
    }
}

