<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperPayroll
 */
class Payroll extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'month', 'year', 'status', 'payroll_ref'
    ];

    public function employees():Relation
    {
        return $this->belongsToMany(Employee::class)
            ->withPivot('status')
            ->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->payroll_ref = IdGenerator::generate(['table' => 'payrolls', 'field' => 'payroll_ref', 'length' => 8, 'prefix' => 'PR-']);
        });
    }
}
