<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{LandTaxAccount, Serial, SerialSG, AccessPC, Barangay, Municipalities, Rentals};

class LandTaxInfo extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $fillable = [
        'af_type',
        'series_id',
        'series',
        'serial_number',
        'user_ip',
        'dr_id',
        'dr_number',
        'municipality_id',
        'barangay_id',
        'clientTypeRadio',
        'last_name',
        'first_name',
        'middle_initial',
        'business_name', 
        'owner',
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
        'role',
        'date_edited',
        'deleted_at'
    ];

    public function getNature()
    {
        return $this->hasMany('App\Models\LandTaxAccount', 'info_id', 'id');
    }

    public function parentSerial() {
        return $this->belongsTo(Serial::class, 'series_id', 'id');
    }

    public function parentAccessPc() {
        return $this->belongsTo(AccessPC::class, 'user_ip', 'id');
    }

    public function parentMunicipality() {
        return $this->belongsTo(Municipalities::class, 'municipality_id', 'id');
    }

    public function parentBarangay() {
        return $this->belongsTo(Barangay::class, 'barangay_id', 'id');
    }

    public function parentSerialSG() {
        return $this->belongsTo(SerialSG::class, 'dr_id', 'id');
    }

    public function parentRentals() {
        return $this->belongsTo(Rentals::class, 'lot_rental_id', 'id');
    }

}
