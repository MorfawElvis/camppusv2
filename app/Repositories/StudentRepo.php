<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepo{
  public function get_students($class_id)
  {
    return Student::where('class_room_id', '=', $class_id)->with('class_room', 'user')
    ->whereHas('class_room', function($query){
      $query->select('class_name');
     })
    ->get();
  }

}