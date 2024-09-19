<?php

namespace App\Http\Controllers\Timetable;

use App\Http\Controllers\Controller;
use App\Models\TeachingPeriod;
use App\Models\TimetableSetting;
use App\Models\Weekday;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ClassRoom;
use App\Models\Timetable;


class TimetableController extends Controller
{
    public function show($classRoomId)
    {
        $classRoom = ClassRoom::findOrFail($classRoomId);
        $timetables = Timetable::with(['subject', 'employee'])
            ->where('class_room_id', $classRoomId)
            ->get();
        $periods = TeachingPeriod::all();

        // Fetch timetable settings
        $timetableSettings = TimetableSetting::first();
        if (!$timetableSettings) {
            return redirect()->back()->with('error', 'Timetable settings are not defined.');
        }

        // Filter weekdays based on timetable settings
        $weekdays = Weekday::whereBetween('id', [$timetableSettings->start_day_id, $timetableSettings->end_day_id])
            ->orderBy('order')
            ->get();

        return view('timetable.show', compact('classRoom', 'timetables', 'periods', 'weekdays'));
    }

    public function download($classRoomId)
    {
        $classRoom = ClassRoom::findOrFail($classRoomId);
        $timetables = Timetable::with(['subject', 'employee'])
            ->where('class_room_id', $classRoomId)
            ->orderBy('day_of_week')
            ->orderBy('period_number')
            ->get();

        $pdf = pdf::loadView('timetable.pdf', compact('classRoom', 'timetables'));
        return $pdf->download("timetable_{$classRoom->class_name}.pdf");
    }
}
