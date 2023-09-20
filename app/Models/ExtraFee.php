<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperExtraFee
 */
class ExtraFee extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function students() : BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_extra_fee')->using(StudentExtraFee::class)
            ->withPivot('amount');
    }
    protected function Name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
        );
    }
}
