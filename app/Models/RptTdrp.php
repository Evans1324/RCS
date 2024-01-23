<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RptTdrp extends Model
{
    use HasFactory;

    protected $fillable = [
        'rpt_id',
        'declared_owner',
        'td_arp_no',
        'barangay_id',
        'classification',
        'assessment_value',
        'period_covered',
        'full_partial',
        'gross_amount',
        'discount',
        'previous_year',
        'penalty_curr_year',
        'penalty_prev_year',
        'sef',
        'basic',
        'grand_total_net'
    ];
}
