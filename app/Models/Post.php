<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;    

    protected $fillable = [
        'acc_category_settings'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
