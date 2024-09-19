<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static find($selectedDormitoryId)
 * @method static findOrFail($id)
 */
class Dormitory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'capacity',
        'employee_id',
    ];


    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'dormitory_student')
            ->withPivot('is_captain')
            ->withTimestamps();
    }

    public function captains()
    {
        return $this->students()->wherePivot('is_captain', true);
    }
}
