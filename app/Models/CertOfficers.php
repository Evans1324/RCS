<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CertOfficers extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'officer_id',
        'position_id',
        'department_id'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
