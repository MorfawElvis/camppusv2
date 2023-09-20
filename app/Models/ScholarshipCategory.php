<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperScholarshipCategory
 */
class ScholarshipCategory extends Model
{
    use HasFactory, SoftDeletes;

    public const SCHOLARSHIP_CATEGORIES = [
        'need based' => 'Need Based',
        'merit based' => 'Merit Based',
    ];

    public const SCHOLARSHIP_COVERAGE = [
        'partial' => 'Partial',
        'full' => 'Full',
    ];

    protected $fillable = [
        'scholarship_name', 'scholarship_category', 'discount', 'scholarship_coverage',
    ];

    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }

    public function getScholarshipNameAttribute($value)
    {
        return $this->attributes['scholarship_name'] = ucwords($value);
    }

    public function getScholarshipCategoryAttribute($value)
    {
        return $this->attributes['scholarship_category'] = ucwords($value);
    }

    public function getScholarshipCoverageAttribute($value)
    {
        return $this->attributes['scholarship_coverage'] = ucwords($value);
    }

    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = str_replace(',', '', $value);
    }
}
