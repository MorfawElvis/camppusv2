<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static updateOrCreate(array $array, array $array1)
 * @method static where(string $string, $selectedTeacherId)
 */
class ClassMaster extends Model
{

    protected $fillable = ['class_room_id', 'employee_id'];

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
