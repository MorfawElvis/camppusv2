<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraFee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'fee_type', 'amount'];

    public const EXTRA_FEE_TYPE = [
        'book fee'         => 'book fee',
        'destruction fee'  => 'destruction fee',
        'medical fee'      => 'medical fee'
    ];

    public const IS_MASS_ASSIGNABLE = [
        'yes'     => 'yes',
        'no'      => 'no',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '', $value);
    }

    protected function getFeeTypeAttribute($value)
    {
        return $this->attributes['fee_type'] = strtoupper($value);
    }
   

}
