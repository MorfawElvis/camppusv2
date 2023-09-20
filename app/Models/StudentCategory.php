<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperStudentCategory
 */
class StudentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_type', 'category_fee'];

    public const STUDENT_CATEGORY_TYPE = [
        'boarding' => 'boarding',
        'regular' => 'regular',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function setCategoryFeeAttribute($value)
    {
        $this->attributes['category_fee'] = str_replace(',', '', $value);
    }

    protected function getCategoryTypeAttribute($value)
    {
        return $this->attributes['category_type'] = strtoupper($value);
    }
}
