<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictHospitalsCollections extends Model
{
    use HasFactory;

    protected $fillable = [
        'r_date',
        'r_no',
        'district_hospital',
        'acc_officer',
        'cost_price',
        'gain_from_sale',
        'selling_price',
        'med_supplies',
        'hospital_fees',
        'ambulance',
        'prof_fees',
        'cash',
        'check',
        'bank_branch',
        'bank_deposit',
        'ada_hc',
        'ada_pc',
        'left_total',
        'right_total'
    ];
}
