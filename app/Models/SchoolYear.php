<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SchoolYear
 *
 * @property int $id
 * @property string $year_name
 * @property string $year_status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SchoolTerm[] $school_term
 * @property-read int|null $school_term_count
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear newQuery()
 * @method static \Illuminate\Database\Query\Builder|SchoolYear onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolYear query()
 * @method static \Illuminate\Database\Query\Builder|SchoolYear withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SchoolYear withoutTrashed()
 * @mixin \Eloquent
 */
class SchoolYear extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'year_name', 'year_status'
    ];
    
    public function class_rooms()
    {
        return $this->hasMany(ClassRoom::class);
    }
    public function school_term():Relation
    {
        return $this->hasMany(SchoolTerm::class);
    }
}
