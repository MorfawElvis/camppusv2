<?php

namespace App\Http\Controllers;

use App\Charts\EnrollmentStatistics;
use App\Charts\GenderAnalyses;
use App\Models\ClassRoom;
use App\Models\Student;

class HomeController extends Controller
{
    private  array $class_room = [];

    private array $enrollment = [];

    public function index()
    {
        $class_rooms = ClassRoom::withCount('students')
            ->where('academic_year_id', current_school_year()->id)
            ->get()->toArray();
        $array_size = count($class_rooms);

        for ($i = 0; $i < $array_size; $i++) {
            $this->class_room[] = $class_rooms[$i]['class_name'];
            $this->enrollment[] = $class_rooms[$i]['students_count'];
        }
        //Enrollment analyses chart
        $enrollment_chart = new EnrollmentStatistics;
        if ($array_size > 0) {
            $enrollment_chart->labels($this->class_room);
            $enrollment_chart->dataset('Enrollment analyses by class', 'bar', $this->enrollment)->backgroundColor(['maroon', 'orange', 'navy', 'purple', 'blue',
                'maroon', 'orange', 'navy', 'purple', 'blue', 'maroon', 'orange', 'navy', 'purple', 'blue', 'maroon', 'orange', 'navy', 'purple', 'blue']);
        } elseif ($array_size == 0) {
            $enrollment_chart->labels(['No Classes']);
            $enrollment_chart->dataset('Enrollment analyses by class', 'bar', [1])->backgroundColor(['maroon', 'orange', 'navy', 'purple', 'blue',
                'maroon', 'orange', 'navy', 'purple', 'blue', 'maroon', 'orange', 'navy', 'purple', 'blue', 'maroon', 'orange', 'navy', 'purple', 'blue']);
        }
        //Gender analyses chart
        $gender_chart = new GenderAnalyses;
        $gender_chart->labels(['Boys', 'Girls']);
        $gender_chart->dataset('Gender analyses', 'doughnut', [get_total_boys(), get_total_girls()])->backgroundColor(['blue', 'pink']);

        return view('dashboard', compact('enrollment_chart', 'gender_chart'));
    }

    public function showConfirmForm()
    {
        return view('auth.passwords.reset');
    }
}
