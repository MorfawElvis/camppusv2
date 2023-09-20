<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\SchoolTerm
 *
 * @property int $id
 * @property int $school_year_id
 * @property string $term_name
 * @property string $term_status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SchoolYear|null $school_year
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTerm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTerm newQuery()
 * @method static \Illuminate\Database\Query\Builder|SchoolTerm onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTerm query()
 * @method static \Illuminate\Database\Query\Builder|SchoolTerm withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SchoolTerm withoutTrashed()
 * @mixin \Eloquent
 * @mixin IdeHelperSchoolTerm
 */
class SchoolTerm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'term_name',
        'term_status',
        'school_year_id',
    ];

    public function school_year(): Relation
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function getTermNameAttribute($value)
    {
        return Str::upper($value);
    }
}
