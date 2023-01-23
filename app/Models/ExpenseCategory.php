<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_name'
    ];
     
    public function getCategoryNameAttribute($value)
    {
       return  $this->attributes['category_name'] =  ucfirst($value);
    }
    
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
