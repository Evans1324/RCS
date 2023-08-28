<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipalReceipts extends Model
{
    use HasFactory;

    protected $fillable = [
        'mun_receipt_date',
        'mun_receipt_no',
        'mun_client_type_id',
        'mun_municipality_id',
        'mun_barangay_id',
        'mun_client_type_radio',
        'mun_last_name',
        'mun_first_name',
        'mun_middle_initial',
        'mun_business_name',
        'mun_owner',
        'mun_address',
        'mun_trade_name_permittees',
        'mun_permittee',
        'mun_trade_name_permit_fees',
        'mun_bidders_business_name',
        'mun_owner_representative',
        'mun_proprietor',
        'mun_spouses',
        'mun_company',
        'mun_sex',
        'mun_transact_type',
        'mun_bank_name',
        'mun_number',
        'mun_transact_date',
        'mun_bank_remarks',
        'mun_receipt_remarks',
        'mun_certificate',
        'mun_total_amount',
    ];
}
