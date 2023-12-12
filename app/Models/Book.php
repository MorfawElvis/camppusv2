<?php

// app/Models/Book.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $classId)
 */
class Book extends Model
{
    protected $fillable = ['title', 'author', 'price', 'class_room_id'];

    public $timestamps = false;

    public function bookClass() : BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

}
