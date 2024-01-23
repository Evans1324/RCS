<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealPropertyTax extends Model
{
    use HasFactory;

    protected $fillable=[
        'report_date
        report_date',
        'report_number',
        'series_id',
        'serial_number',
        'client_type_id',
        'municipality_id',
        'barangay_id',
        'last_name',
        'first_name',
        'middle_name',
        'spouse',
        'company',
        'submission_type',
    ];
}
