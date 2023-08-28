<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetEstimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'acc_titles_id',
        'sub_titles_id',
        'sub_subtitles_id',
        'amount',
        'year'
    ];
}
