<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\Level
 *
 * @property int $id
 * @property string $level_name
 * @property int $level_rank
 * @property int $section_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClassRoom[] $class_rooms
 * @property-read int|null $class_rooms_count
 * @property-read \App\Models\Section|null $section
 * @method static \Illuminate\Database\Eloquent\Builder|Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Level newQuery()
 * @method static \Illuminate\Database\Query\Builder|Level onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Level query()
 * @method static \Illuminate\Database\Query\Builder|Level withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Level withoutTrashed()
 * @mixin \Eloquent
 */
class Level extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'level_name', 'level_rank'
    ];
    public function setLevelNameAttribute($value)
    {
        $this->attributes['level_name'] = Str::upper($value);
    }
    public function class_rooms():HasMany
    {
        return $this->hasMany(ClassRoom::class);
    }
}
