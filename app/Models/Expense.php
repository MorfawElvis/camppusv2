<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Relation;

class Expense extends Model
{
    use HasFactory, SoftDeletes;
    
    public const EXPENSE_APPROVED_STATUS = [
           'yes' => 'yes',
           'no'  => 'no'
    ];
    protected $fillable = [
        'expense_category_id', 'expense_amount', 'entry_date',
        'expense_description', 'enteredBy_id', 'approvedBy_id', 'is_approved'
    ];
    
    public function expense_category() : Relation
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
  
    public function setExpenseAmountAttribute($value)
    {
        $this->attributes['expense_amount'] = str_replace(',', '', $value);
    }

} 