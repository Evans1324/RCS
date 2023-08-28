<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateChange extends Model
{
    use HasFactory;

    protected $table = 'rate_changes';

    protected $fillable = [
        'date_of_change'
    ];
}
