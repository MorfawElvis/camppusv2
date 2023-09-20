<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @method static create(array $validatedInput)
 * @method static paginate(int $int)
 * @method static find($deleted_allowance)
 * @method static findOrFail($deleted_allowance)
 * @mixin IdeHelperAllowance
 */
class Allowance extends Model
{
    protected $fillable = ['allowance_name', 'percentage', 'allowance_type'];

    public const ALLOWANCE_TYPE = [
        'fixed' => 'Fixed',
        'percentage' => 'Percentage',
    ];

    public function employees():Relation
    {
        return $this->belongsToMany(Employee::class, 'employee_allowance', 'allowance_id', 'employee_id')
            ->withPivot(['amount','payroll_id'])
            ->withTimestamps();
    }
    public function getAllowanceNameAttribute($value) : String
    {
        return ucwords($value);
    }
}
