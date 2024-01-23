<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RptInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'prev_receipt_id',
        'report_date',
        'client_type_id',
        'series_id',
        'serial_number',
        'municipality_id',
        'barangay_id',
        'lsat_name',
        'first_name',
        'middle_name',
        'sex',
        'spouse',
        'company',
        'transaction_type',
        'bank_name',
        'bank_number',
        'bank_date',
        'tax_type',
        'bank_remarks',
        'amount',
        'nature',
        'amount',
    ];
}
