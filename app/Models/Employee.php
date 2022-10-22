<?php

namespace App\Models;

use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\Employee
 *
 * @property int $id
 * @property string $full_name
 * @property int $user_id
 * @property string|null $matriculation
 * @property string $date_of_birth
 * @property string $place_of_birth
 * @property string $gender
 * @property string $highest_qualification
 * @property string|null $position
 * @property string|null $nationality
 * @property string|null $marital_status
 * @property string|null $denomination
 * @property string|null $date_of_employment
 * @property string|null $insurance_number
 * @property string|null $phone_number
 * @property string|null $address
 * @property bool $is_dismissed
 * @property int $is_retired
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee newQuery()
 * @method static \Illuminate\Database\Query\Builder|Employee onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Employee query()
 * @method static \Illuminate\Database\Query\Builder|Employee withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Employee withoutTrashed()
 * @mixin \Eloquent
 */
class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'user_id',
        'date_of_birth',
        'place_of_birth',
        'gender',
        'highest_qualification',
        'position',
        'marital_status',
        'nationality',
        'denomination',
        'date_of_employment',
        'insurance_number',
        'phone_number',
        'address',
        'is_dismissed',
        'is_on_leave'
    ];

    protected $casts = [
        'is_dismissed' => 'boolean',
        'is_on_leave' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'length' => 3, 'prefix' => 'EMP']);
        });
    }
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => ucfirst($value),
        );
    }
    protected function gender():Attribute {
         return Attribute::make(
            get: function ($value) {
                if ($value === 'M') {
                    return 'Male';
                }elseif ($value === 'F'){
                    return 'Female';
                }
                return $value;
            }
        );
     }

}
