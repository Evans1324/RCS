<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'col_rate_id',
        'shared_label',
        'shared_value',
        'shared_per_unit',
        'shared_unit'
    ];
}
