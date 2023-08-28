<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidders extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'owner_representative'
    ];
}
