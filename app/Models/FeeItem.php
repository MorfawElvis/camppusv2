<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, $id)
 * @method static findOrFail($itemId)
 * @method static create(array $array)
 */
class FeeItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['class_room_id', 'name', 'amount'];

    public $timestamps = false;

    public function class_room() : BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function fee_payments() : HasMany
    {
        return $this->hasMany(FeePayment::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '', $value);
    }
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
        );
    }
}
