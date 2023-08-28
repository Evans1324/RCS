<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractors extends Model
{
    use HasFactory;

    protected $fillable = [
        //'contractor_id',
        'business_name',
        'owner',
        'position',
        'address',
        'contact_number',
        'status'
    ];
}
