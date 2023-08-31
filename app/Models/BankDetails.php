<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bank_id',
        'bank_name',
        'bank_number',
        'bank_date',
    ];
}
