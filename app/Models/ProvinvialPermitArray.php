<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinvialPermitArray extends Model
{
    use HasFactory;
    protected $table = 'provincial_permit_arrays';

    protected $fillable = [
        'prov_feecharge',
        'prov_amount',
        'prov_ornumber',
        'prov_date',
        'prov_initials'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
