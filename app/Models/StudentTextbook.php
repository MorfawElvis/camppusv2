<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentTextbook extends Model
{
    protected $fillable = ['student_id', 'textbook_id', 'collected_at'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function textbook(): BelongsTo
    {
        return $this->belongsTo(Textbook::class);
    }
}
