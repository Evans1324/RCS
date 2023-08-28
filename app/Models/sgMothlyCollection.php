<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sgMothlyCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'monitoring_total',
        'provincial_total',
        'dpwh_total',
        'industrial_total',
        'commercial_total',
        'mun_bar_total',
        'collection_month',
        'collection_year'
    ];
}
