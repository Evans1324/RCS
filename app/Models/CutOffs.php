<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutOffs extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_cutoff'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
