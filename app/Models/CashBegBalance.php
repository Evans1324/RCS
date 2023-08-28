<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBegBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash_date',
        'beg_balance',
        'beg_month'
    ];
}
