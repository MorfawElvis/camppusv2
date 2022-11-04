<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Psy\Command\WhereamiCommand;

class FeePayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
          'amount',
          'transaction_date',
          'student_id',
          'user_id',
          'receipt_number',
          'payment_mode'
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
           $model->receipt_number =  IdGenerator::generate(['table' => 'fee_payments', 'field' => 'receipt_number', 'length' => 9, 'prefix' => date('ym')]);
        });
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '', $value);
    }

    public function getTransactionDateAttribute($value):string
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
