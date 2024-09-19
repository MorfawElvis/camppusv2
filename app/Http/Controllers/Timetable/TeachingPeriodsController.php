<?php

namespace App\Http\Controllers\Timetable;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\SchoolYear;
use App\Models\TeachingPeriod;
use App\Models\TimetableSetting;
use App\Models\Weekday;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class TeachingPeriodsController extends Controller
{
    public function generatePDF()
    {
        //Fetch data from the database
        $schoolName = GeneralSetting::first()->school_name;
        $academicYear = SchoolYear::where('year_status', 'opened')->first()->year_name;

        $timetableSetting = TimetableSetting::first();
        $weekdays = Weekday::whereBetween('id', [$timetableSetting->start_day_id, $timetableSetting->end_day_id])
            ->orderBy('order')
            ->get()
            ->toArray();

        $periods = TeachingPeriod::all()->toArray();

        // Configure Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Instantiate Dompdf
        $dompdf = new Dompdf($options);

        // Load view with data
        $view = View::make('prints.teaching_periods', [
            'schoolName' => $schoolName,
            'academicYear' => $academicYear,
            'weekdays' => $weekdays,
            'periods' => $periods
        ]);
        $dompdf->loadHtml($view->render());

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Return PDF as download
        return response()->streamDownload(
            fn() => print($dompdf->output()),
            'teaching_periods_schedule.pdf'
        );
    }
}
