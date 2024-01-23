<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RptMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type_menu',
        'classification_menu',
        'full_partial_menu',
        'tax_type_menu'
    ];
}
