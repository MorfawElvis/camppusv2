<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static updateOrCreate(array $array, array|string[] $array1)
 * @method static whereDate(string $string, $date)
 * @method static where(string $string, mixed $id)
 */
class StudentAttendance extends Model
{
    protected $fillable = [
        'student_id',
        'date',
        'status',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
