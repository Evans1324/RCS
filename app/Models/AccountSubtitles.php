<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountSubtitles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title_id',
        'subtitle'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
