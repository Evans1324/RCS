<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'mun_id',
        'barangay_name',
    ];

    public function barangayTaxInfo() {
        return $this->hasMany(LandTaxInfo::class, 'barangay_id', 'id');
    }
}
