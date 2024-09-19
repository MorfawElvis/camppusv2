<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static insert(array $timetable)
 * @method static where(string $string, $id)
 */
class Timetable extends Model
{

    protected $fillable = [
        'level_id', 'class_room_id', 'subject_id', 'employee_id', 'day_of_week', 'period_number', 'start_time', 'end_time'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(TeachingPeriod::class);
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Weekday::class, 'week_day');
    }
}
