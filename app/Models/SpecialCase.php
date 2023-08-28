<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialCase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'source_barangay',
        'source_percentage',
        'barangay_sharing',
        'percentage_sharing',
        'remarks',
        'effectivity_date',
        'effectivity_end_date'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
