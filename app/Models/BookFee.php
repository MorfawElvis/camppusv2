<?php

// app/Models/BookFee.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookFee extends Model
{
    protected $fillable = ['student_id', 'book_id', 'quantity'];

    public $timestamps = false;

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}

