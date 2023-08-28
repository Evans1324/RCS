<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessPC extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'pc_name',
        'assigned_ip',
        'process_type',
        'process_form',
        'assigned_receipt'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function childAccessPc()
    {
        return $this->hasMany('App\Models\LandTaxInfo', 'user_ip', 'id');
    }
}
