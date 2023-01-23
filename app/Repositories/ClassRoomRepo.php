<?php

namespace App\Repositories;

use App\Models\ClassRoom;
use App\Models\Section;

class ClassRoomRepo {
   public function get_school_sections()
   {
      return Section::select(['id','section_name'])->get();
   }
   public function get_class_rooms($class_id)
   {
      return ClassRoom::with('students')
                        ->whereHas('students', function($query) use ($class_id){
                           $query->where('class_room_id', '=', $class_id);
                          })
                        ->get();
   }

   public function get_all_class_rooms()
   {
      return ClassRoom::select('id', 'class_name')->get();
   }
}