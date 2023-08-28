<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serial extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'start_serial',
        'end_serial',
        'form',
        'assigned_office',
        'unit',
        'fund',
        'municipality',
        'officers',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function childSerial()
    {
        return $this->hasMany('App\Models\LandTaxInfo', 'series_id', 'id');
    }
}
