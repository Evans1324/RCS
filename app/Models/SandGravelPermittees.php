<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SandGravelPermittees extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'trade_name',
        'permittee',
        'permitted_area_municipality',
        'permitted_area_barangay'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
