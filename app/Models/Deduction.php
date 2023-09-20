<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @method static paginate(int $int)
 * @method static findOrFail($deleted_allowance)
 * @method static create(array $array)
 * @mixin IdeHelperDeduction
 */
class Deduction extends Model
{
    protected $fillable = ['deduction_name', 'deduction_type', 'percentage'];

    public const DEDUCTION_TYPE = [
        'fixed' => 'Fixed',
        'percentage' => 'Percentage',
    ];

    public function employees():Relation
    {
        return $this->belongsToMany(Employee::class, 'employee_deduction', 'deduction_id', 'employee_id')
            ->withPivot(['amount' ,'payroll_id'])
            ->withTimestamps();
    }
    public function getDeductionNameAttribute($value) : String
    {
        return ucwords($value);
    }
}
