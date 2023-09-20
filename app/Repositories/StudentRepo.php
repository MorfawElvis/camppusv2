<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;


class StudentRepo
{
    public function get_students($class_id) : Collection
    {
        return Student::where('class_room_id', '=', $class_id)->with('class_room', 'user')
            ->whereHas('class_room', function ($query) {
                $query->select('class_name');
            })
            ->get();
    }
}
