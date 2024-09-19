<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Textbook extends Model
{
    protected $fillable = [
        'subject_category',
        'title',
        'author',
        'publisher',
        'price',
        'academic_year_id',
        'class_room_id'
    ];

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class, 'academic_year_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_textbooks')->withTimestamps();
    }
}
