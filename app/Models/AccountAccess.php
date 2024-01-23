<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'acc_id',
        'acc_sub_id',
        'acc_sub_sub_id',
    ];
}
