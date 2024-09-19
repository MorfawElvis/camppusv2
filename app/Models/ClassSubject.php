<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassSubject extends Model
{
    protected $table = 'class_subjects';

    protected $fillable = [
        'class_id',
        'teacher_id',
        'subject_id',
    ];

    public function class_room() : BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function subject() : BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
