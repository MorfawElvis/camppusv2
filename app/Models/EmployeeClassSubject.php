<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class EmployeeClassSubject extends Model
{
    protected $table = 'employee_class_subject';

    public $timestamps = true;

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function classSubject(): BelongsTo
    {
        return $this->belongsTo(ClassSubject::class);
    }
}
