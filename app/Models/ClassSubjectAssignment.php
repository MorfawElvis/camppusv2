<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $array)
 * @method static where(string $string, $classRoomId)
 * @method static find($assignmentId)
 * @method static whereIn(string $string, mixed $selected_class_rooms)
 */
class ClassSubjectAssignment extends Model
{
    protected $fillable = [
        'class_room_id',
        'subject_id',
        'teaching_periods_per_week'
    ];

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_class_subject', 'class_subject_assignment_id', 'employee_id');
    }
}
