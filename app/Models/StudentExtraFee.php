<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentExtraFee extends Pivot
{
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '', $value);
    }
}
