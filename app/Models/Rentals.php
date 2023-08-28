<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'lease_of_contact'
    ];

    public function childRentals()
    {
        return $this->hasMany('App\Models\LandTaxInfo', 'lot_rental_id', 'id');
    }
}
