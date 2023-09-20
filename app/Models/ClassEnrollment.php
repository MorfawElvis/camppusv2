<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassEnrollment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'class_room_id', 'student_id', 'school_year_id'
    ];

    public $timestamps = false;

    public function students() : Relation
    {
        return $this->hasMany(Student::class);
    }

    public function class_rooms() : Relation
    {
        return $this->hasMany(ClassRoom::class);
    }

}
