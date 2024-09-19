<?php

namespace App\Http\Controllers\Dormitory;

use App\Http\Controllers\Controller;
use App\Models\Dormitory;
use App\Models\GeneralSetting;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DormitoryController extends Controller
{
    public function downloadDormitory($dormitoryId)
    {
        $dormitory = Dormitory::with(['students', 'students.class_room', 'employee'])->findOrFail($dormitoryId);

        $schoolName = GeneralSetting::first()->school_name;
        $academicYear = SchoolYear::where('year_status', 'closed')->first()->year_name;
        $dormitoryMasterName = $dormitory->employee->full_name ?? 'N/A';

        // Group students by class
        $studentsByClass = $dormitory->students->groupBy('class_room.class_name');
        $captains = $dormitory->students->where('pivot.is_captain', true);

        $pdf = Pdf::loadView('dormitory.list', compact('schoolName', 'academicYear', 'dormitory', 'dormitoryMasterName', 'studentsByClass', 'captains'))
            ->setPaper('A4', 'portrait')
            ->setOption('margin-top', '10mm')
            ->setOption('margin-bottom', '10mm')
            ->setOption('margin-left', '10mm')
            ->setOption('margin-right', '10mm');

        return $pdf->download('dormitory_list.pdf');
    }
}
