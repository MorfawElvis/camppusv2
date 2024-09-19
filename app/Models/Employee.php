<?php

namespace App\Models;

use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @mixin IdeHelperEmployee
 */
class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'user_id',
        'date_of_birth',
        'place_of_birth',
        'matriculation',
        'gender',
        'highest_qualification',
        'position',
        'marital_status',
        'nationality',
        'denomination',
        'date_of_employment',
        'basic_salary',
        'insurance_number',
        'phone_number',
        'address',
        'is_dismissed',
        'is_retired',
        'is_on_leave',
        'profile_image',
    ];

    protected $casts = [
        'is_dismissed' => 'boolean',
        'is_on_leave' => 'boolean',
        'is_retired' => 'boolean'
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => ucfirst($value),
        );
    }

    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }

    public function allowances():Relation
    {
       return $this->belongsToMany(Allowance::class, 'employee_allowance', 'employee_id', 'allowance_id')
           ->withPivot(['amount','percentage'])
           ->withTimestamps();
    }
    public function deductions():Relation
    {
       return $this->belongsToMany(Deduction::class, 'employee_deduction', 'employee_id', 'deduction_id')
           ->withPivot(['amount','percentage'])
           ->withTimestamps();
    }
    public function payrolls():Relation
    {
        return $this->belongsToMany(Payroll::class)
            ->withPivot('status')
            ->withTimestamps();
    }

    public function subjects():BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'employee_subjects');
    }

    public function classSubjects(): BelongsToMany
    {
        return $this->belongsToMany(ClassSubjectAssignment::class, 'employee_class_subject', 'employee_id', 'class_subject_assignment_id');
    }
    public function employeeSubjects() : HasMany
    {
        return $this->hasMany(EmployeeSubject::class);
    }
    public function classMaster(): HasOne
    {
        return $this->hasOne(ClassMaster::class);
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'employee_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->matriculation = IdGenerator::generate(['table' => 'employees', 'field' => 'matriculation', 'length' => 8, 'prefix' => 'EMP-']);
        });
    }

    public function getDateOfEmploymentAttribute($value): string
    {
        return Carbon::parse($value)->format('d M, Y');
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value === 'M') {
                    return 'Male';
                } elseif ($value === 'F') {
                    return 'Female';
                }
                return $value;
            }
        );
    }
}
