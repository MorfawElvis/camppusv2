<?php

use App\Models\ClassRoom;
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

