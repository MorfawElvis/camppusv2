<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static orderBy(string $string)
 * @method static first()
 * @method static updateOrCreate(int[] $array, array $array1)
 * @method static firstOrFail()
 */
class TimetableSetting extends Model
{
    protected $fillable = ['start_day_id', 'end_day_id'];

    public function startDay() : BelongsTo
    {
        return $this->belongsTo(Weekday::class, 'start_day_id');
    }

    public function endDay() : BelongsTo
    {
        return $this->belongsTo(Weekday::class, 'end_day_id');
    }
}
