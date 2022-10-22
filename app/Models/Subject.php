<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $subject_name
 * @property string|null $subject_code
 * @property int|null $department_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Department|null $department
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Query\Builder|Subject onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Query\Builder|Subject withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subject withoutTrashed()
 * @mixin \Eloquent
 */
class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject_name',
        'subject_code',
        'department_id'
    ];
    public function getSubjectNameAttribute($value)
    {
        return Str::upper($value);
    }
    public function setSubjectCodeAttribute($value)
    {
        $this->attributes['subject_code'] = Str::upper($value);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
