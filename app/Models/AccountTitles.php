<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountTitles extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title_pos',
        'title_code',
        'title_name',
        'title_category_id'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
