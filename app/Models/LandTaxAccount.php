<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LandTaxInfo;

class LandTaxAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'info_id',
        'rate_type',
        'acc_category_id',
        'acc_title_id',	
        'sub_title_id',
        'account',
        'nature',
        'amount'
    ];

    public function getNature() {
        return $this->belongsTo(LandTaxInfo::class);
    }
}
