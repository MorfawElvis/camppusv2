<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $string1)
 */
class TeachingPeriod extends Model
{
    protected $fillable = ['name', 'start_time', 'end_time', 'type'];

    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'period_number');
    }
}
