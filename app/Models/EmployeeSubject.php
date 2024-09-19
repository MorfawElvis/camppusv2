<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @method static where(string $string, $subjectId)
 * @method static whereIn(string $string, mixed $pluck)
 */
class EmployeeSubject extends Model
{

    protected $fillable = ['employee_id', 'subject_id'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function classSubjects(): HasMany
    {
        return $this->hasMany(ClassSubjectAssignment::class, 'subject_id', 'subject_id');
    }
}
