<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScholarshipCategory extends Model
{
    use HasFactory, SoftDeletes;

    public const SCHOLARSHIP_CATEGORIES = [
        'need based'   => 'need based',
        'merit based'  => 'merit based'
    ];

    public const SCHOLARSHIP_COVERAGE = [
        'partial'      => 'partial',
        'full'         => 'full'
    ];

    protected $fillable = [
       'scholarship_name', 'scholarship_category', 'discount', 'scholarship_coverage'
    ];

    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }

    public function getScholarshipNameAttribute($value)
    {
        return $this->attributes['scholarship_name'] =  ucwords($value);
    }
    
    public function getScholarshipCategoryAttribute($value)
    {
        return $this->attributes['scholarship_category'] =  ucwords($value);
    }

    public function getScholarshipCoverageAttribute($value)
    {
        return $this->attributes['scholarship_coverage'] =  ucwords($value);
    }

    public function setScholarshipAmountAttribute($value)
    {
        $this->attributes['scholarship_amount'] = str_replace(',', '', $value);
    }
}
