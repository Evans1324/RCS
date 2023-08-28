<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerialSG extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'start_serial_sg',
        'end_serial_sg',
        'serial_sg_type',
        'status'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function childSerialSG()
    {
        return $this->hasMany('App\Models\LandTaxInfo', 'dr_id', 'id');
    }
}
