<?php

namespace App\Http\Controllers;

use App\Charts\EnrollmentStatistics;
use App\Charts\GenderAnalyses;
use App\Models\ClassRoom;
use App\Models\Student;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
            $enrollment_boys = Student::where('gender', 'M')->count();
            $enrollment_girls = Student::where('gender', 'F')->count();
            
            $class_rooms = ClassRoom::withCount('students')->get()->toArray();
            $array_size = count($class_rooms);

            for($i=0; $i < $array_size; $i++){
                $class[]      =  $class_rooms[$i]['class_name']; 
                $enrollment[] =  $class_rooms[$i]['students_count']; 
            }
            //Enrollment analyses chart
            $enrollment_chart = new EnrollmentStatistics;
            $enrollment_chart->labels($class);
            $enrollment_chart->dataset('Enrollment analyses by class', 'bar', $enrollment)->backgroundColor(['maroon', 'orange','navy','purple', 'blue',
            'maroon', 'orange','navy','purple', 'blue','maroon', 'orange','navy','purple', 'blue','maroon', 'orange','navy','purple', 'blue']);

            //Gender analyses chart
            $gender_chart = new GenderAnalyses;
            $gender_chart->labels(['Males','Females']);
            $gender_chart->dataset('Gender analyses', 'doughnut', [$enrollment_boys, $enrollment_girls])->backgroundColor(['blue','pink']);
           
        return view('dashboard', compact('enrollment_chart','gender_chart'));
    }
    public function showConfirmForm()
    {
        return view('auth.passwords.reset');
    }
}