<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $full_name
 * @property int $user_id
 * @property string|null $matriculation
 * @property int $class_room_id
 * @property string $date_of_birth
 * @property string $place_of_birth
 * @property string $gender
 * @property string|null $nationality
 * @property string|null $denomination
 * @property string|null $date_of_admission
 * @property string|null $phone_number
 * @property string|null $address
 * @property bool $is_dismissed
 * @property bool $is_graduated
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Query\Builder|Student onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Query\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Student withoutTrashed()
 * @mixin \Eloquent
 */
class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'user_id',
        'class_room_id',
        'date_of_birth',
        'place_of_birth',
        'gender',
        'nationality',
        'denomination',
        'date_of_admission',
        'phone_number',
        'address',
        'is_dismissed',
        'is_graduated'
        ];
    protected $casts = [
        'is_dismissed' => 'boolean',
        'is_graduated' => 'boolean'
    ];

    public function user():Relation
    {
        return $this->belongsTo(User::class);
    }
    
    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
           $model->matriculation =  IdGenerator::generate(['table' => 'students', 'field' => 'matriculation', 'length' => 8, 'prefix' => Carbon::now()->year]);
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
                return  $value == 'F' ? 'Female' : 'Male';
            }
        );
    }
}
