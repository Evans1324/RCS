<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionRate extends Model
{
    use HasFactory;

    protected $table = 'collection_rates';

    protected $fillable = [
        'acc_titles_id',
        'acc_subtitles_id',	
        'rate_change_id',	
        'shared_status',	
        'provincial_share',	
        'municipal_share',	
        'barangay_share',
        'rate_type',	
        'fixed_rate',	
        'percent_value',	
        'percent_of',
        'deadline_status',	
        'rate_after_deadline',	
        'deadline_date',
    ];
}
