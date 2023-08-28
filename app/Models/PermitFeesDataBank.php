<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitFeesDataBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_type',
        'trade_name',
        'proprietor',
    ];


    protected $dates = [
        'deleted_at'
    ];
}
