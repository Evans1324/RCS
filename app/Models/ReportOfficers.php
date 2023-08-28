<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportOfficers extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'officer_name',
        'officer_position'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
