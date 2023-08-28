<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSubSubtitles extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtitle_id',
        'sub_subtitles'
    ];
}
