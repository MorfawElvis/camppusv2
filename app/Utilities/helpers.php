<?php

use App\Models\ClassRoom;
use App\Models\FeePayment;
use App\Models\Student;
use App\Models\SchoolTerm;
use App\Models\SchoolYear;
use App\Models\Subject;

if(!function_exists('current_school_year'))
{
    function current_school_year()
    {
        return SchoolYear::where('year_status', 'opened')->first();
    }

}

if(!function_exists('current_school_term'))
{
    function current_school_term()
    {
        return SchoolTerm::where('term_status', 'opened')->first();
    }

}

if(!function_exists('get_total_students'))
{
    function get_total_students()
    {
        return Student::where('is_dismissed', false)->where('is_graduated', false)->count();
    }

}

if(!function_exists('get_total_subjects'))
{
    function get_total_subjects()
    {
        return Subject::count();
    }

}

if(!function_exists('get_total_classes'))
{
    function get_total_classes()
    {  
        $current_school_year = SchoolYear::where('year_status', 'opened')->pluck('id')->first();
        return ClassRoom::where('academic_year_id', $current_school_year)->count();
    }

}

if(!function_exists('get_total_fees_paid'))
{
    function get_total_fees_paid()
    {
         $total_fee = FeePayment::sum('amount');
         return number_format($total_fee);
    }
}

if(!function_exists('total_fees_expected'))
{
    function total_fees_expected()
    {
        $total_expected = 0;
        $class_rooms = ClassRoom::withCount('students')->get();
        foreach($class_rooms as $class_room){
            $total_expected += $class_room->students_count*$class_room->payable_fee;
        }
        return number_format($total_expected);
    }
}

