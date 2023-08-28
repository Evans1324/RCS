<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form56 extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'effectivity_year',
        'tax_precentage',
        'aid_in_full',
        'paid_in_full',
        'penalty_per_month'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
