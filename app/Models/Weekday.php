<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string)
 * @method static inRandomOrder()
 * @method static whereBetween(string $string, array $array)
 */
class Weekday extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_name', 'order'];

    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'day_of_week');
    }
}
