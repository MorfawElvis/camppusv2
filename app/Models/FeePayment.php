<?php

namespace App\Models;

use App\Http\Livewire\Settings\AcademicYears;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperFeePayment
 */
class FeePayment extends Model
{
    use  SoftDeletes;

    protected $fillable = [
        'amount',
        'transaction_date',
        'student_id',
        'user_id',
        'receipt_number',
        'payment_mode',
        'school_year_id'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->receipt_number = IdGenerator::generate(['table' => 'fee_payments', 'field' => 'receipt_number', 'length' => 9, 'prefix' => date('ym')]);
        });
    }

    public function student() : BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function academic_year() : BelongsTo
    {
       return $this->belongsTo(SchoolYear::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '', $value);
    }

    public function getTransactionDateAttribute($value): string
    {
        return Carbon::parse($value)->format('d M, Y');
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
                      : static::where('transaction_date', 'like', '%'.$search.'%')
                          ->orWhere('receipt_number', 'like', '%'.$search.'%');
    }
}
