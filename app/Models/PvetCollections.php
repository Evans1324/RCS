<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PvetCollections extends Model
{
    use HasFactory;
    protected $fillable = [
        'series_id',
        'series',
        'serial_number',
        'clientTypeRadio',
        'last_name',
        'first_name',
        'middle_initial',
        'business_name', 
        'owner',
        'address',
        'trade_name_permittees',
        'permittee',
        'trade_name_permit_fees',
        'bidders_business_name',
        'owner_representative',
        'proprietor',
        'lot_rental_id',
        'client_type_id',
        'lot_rental_id',
        'spouses', 
        'company',
        'sex',
        'transact_type',
        'bank_name',
        'number',
        'transact_date',
        'bank_remarks',
        'receipt_remarks',
        'certificate',
        'total_amount',
        'status',
        'deleted_at'
    ];
}
