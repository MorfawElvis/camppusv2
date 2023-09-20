<?php

use App\Models\ClassRoom;
use App\Models\FeePayment;
use App\Models\GeneralSetting;
use App\Models\SchoolTerm;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

if (! function_exists('current_school_year')) {
    function current_school_year(): ?Model
    {
        return SchoolYear::where('year_status', 'opened')->first();
    }
}

if (! function_exists('current_school_term')) {
    function current_school_term() : ?Model
    {
        return  SchoolTerm::where('term_status', 'opened')->first();
    }

}

if (! function_exists('get_total_students')) {
    function get_total_students() : int
    {
        $current_school_year = SchoolYear::where('year_status', 'opened')->pluck('id')->first();
        return Student::whereHas('class_room', function ($query) use ($current_school_year) {
            $query->where('class_rooms.academic_year_id',  $current_school_year );
        })
        ->where('is_dismissed', false)->where('is_graduated', false)->count();
    }

}

if (! function_exists('get_total_subjects')) {
    function get_total_subjects() : int
    {
        return Subject::count();
    }

}

if (! function_exists('get_total_classes')) {
    function get_total_classes() : int
    {
        $current_school_year = SchoolYear::where('year_status', 'opened')->pluck('id')->first();

        return ClassRoom::where('academic_year_id', $current_school_year)->count();
    }

}

if (! function_exists('get_total_fees_paid')) {
    function get_total_fees_paid() : int
    {
        $total_fee = FeePayment::sum('amount');

        return number_format($total_fee);
    }
}

if (! function_exists('get_total_fees_paid_today')) {
    function get_total_fees_paid_today() : int
    {
        $total_fee_paid_today = FeePayment::whereDate('transaction_date', '=', Carbon::today())->sum('amount');

        return number_format($total_fee_paid_today);
    }
}

if (! function_exists('total_fees_expected')) {
    function total_fees_expected() : int
    {
        $total_expected = 0;
        $total_boarding_students = Student::where('is_boarding', 1)->count();
        $boarding_fee = GeneralSetting::select('boarding_fee')->first();
        $total_expected_boarding_fee = $total_boarding_students * ($boarding_fee->boarding_fee ?? 0);
        $class_rooms = ClassRoom::withCount('students')->get();
        foreach ($class_rooms as $class_room) {
            $total_expected += $class_room->students_count * $class_room->payable_fee;
        }

        return number_format($total_expected + $total_expected_boarding_fee);
    }
}

if (! function_exists('get_online_users')) {
    function get_online_users() : \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }
}

if (! function_exists('get_boarding_fee')) {
    function get_boarding_fee() : ?Model
    {
        return GeneralSetting::select('boarding_fee')->first();
    }
}
