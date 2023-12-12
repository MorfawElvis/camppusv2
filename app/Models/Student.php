<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Void_;

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
 * @mixin IdeHelperStudent
 * @method ClassRooms
 */
class Student extends Model
{
    use  SoftDeletes;

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
        'is_graduated',
        'profile_image',
    ];

    protected $casts = [
        'is_dismissed' => 'boolean',
        'is_graduated' => 'boolean',
    ];

    public function user(): Relation
    {
        return $this->belongsTo(User::class);
    }

    public function class_room() : Relation
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function payments() : Relation
    {
        return $this->hasMany(FeePayment::class);
    }

    public function scholarship() : Relation
    {
        return $this->hasOne(Scholarship::class);
    }

    public function class_enrollment() : Relation
    {
        return $this->belongsTo(ClassEnrollment::class);

    }
    public function student_category() : Relation
    {
        return $this->belongsTo(StudentCategory::class);
    }

    public function extra_fees() : BelongsToMany
    {
        return $this->belongsToMany(ExtraFee::class, 'student_extra_fee')->using(StudentExtraFee::class)
            ->withPivot('amount');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->matriculation = IdGenerator::generate(['table' => 'students', 'field' => 'matriculation', 'length' => 14, 'prefix' => Carbon::now()->year.'-'.date('m').'-']);
        });
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => ucfirst($value),
        );
    }

    protected function placeOfBirth(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
        );
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value == 'F' ? 'Female' : 'Male';
            }
        );
    }

    public function scopeClassRooms($query, $academicYearId, $classId,)
    {
        return $query->select(['full_name', 'matriculation', 'gender', 'class_room_id', 'id', 'is_boarding'])
            ->withSum('payments', 'amount')
            ->with(['class_room.feeItems' => function ($query) {
                $query->select('class_room_id', DB::raw('sum(amount) as payable_fee'))->groupBy('class_room_id');
            }])
            ->with(['class_room.section', 'scholarship.scholarship_category', 'extra_fees'])
            ->whereHas('class_room', function ($query) use ($academicYearId, $classId) {
                $query->where('academic_year_id', $academicYearId);
                $query->where('id', $classId);
            });
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('full_name', 'like', '%' . $search . '%')
                ->orWhere('matriculation', 'like', '%'.$search.'%');
        }
    }
}
