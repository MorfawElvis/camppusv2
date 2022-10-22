<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\ClassRoom
 *
 * @property int $id
 * @property string $class_name
 * @property int $level_id
 * @property int $academic_year_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Level|null $level
 * @method static \Illuminate\Database\Eloquent\Builder|ClassRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassRoom newQuery()
 * @method static \Illuminate\Database\Query\Builder|ClassRoom onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassRoom query()
 * @method static \Illuminate\Database\Query\Builder|ClassRoom withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ClassRoom withoutTrashed()
 * @mixin \Eloquent
 */
class ClassRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'class_name', 'level_id', 'academic_year_id', 'section_id'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function setClassNameAttribute($value)
    {
        $this->attributes['class_name'] = Str::upper($value);
    }

}
