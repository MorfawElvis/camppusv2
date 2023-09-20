<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperScholarship
 */
class Scholarship extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id', 'school_year_id', 'scholarship_category_id', 'renewable', 'is_approved',
    ];

    public function scholarship_category()
    {
        return $this->belongsTo(ScholarshipCategory::class);
    }

    public function school_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
