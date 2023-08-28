<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialPermittees extends Model
{
    use HasFactory;

    protected $table = 'special_permitees';
    protected $fillable = [
        'special_case_id',
        'permitee_id'
    ];
}
