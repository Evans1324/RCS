<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RptPreviousReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'prev_rpt_id',
        'prev_receipt_no',
        'prev_date',
        'for_the_year',
        'tax_dec_no',
        'prev_receipt_remarks'
    ];
}
