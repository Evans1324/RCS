<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipalities extends Model
{
    use HasFactory;

    protected $fillable = [
        'Atok',
        'Bakun',
        'Bokod',
        'Buguias',
        'Itogon',
        'Kabayan',
        'Kibungan',
        'Kibungan',
        'La Trinidad',
        'Mankayan',
        'Sablan',
        'Tuba',
        'Tublay',
        'Other',
    ];
}
