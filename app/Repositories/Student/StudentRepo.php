<?php

Namespace App\Repositories\Student;

use App\Models\Student;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StudentRepo {

    public function get_current_school_year_students($search, $class_id) : LengthAwarePaginator
    {
        return  Student::search($search)
            ->with('user', 'class_room.section', 'class_room')
            ->whereHas('user', function ($query) {
                $query->where('user_status', '=', '1');
            })
            ->whereHas('class_room', function ($query) {
                $query->where('academic_year_id', current_school_year()->id);
            })
            ->where('class_room_id', '=', $class_id)
            ->orderBy('full_name', 'asc')
            ->paginate(10);
    }

}
