<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'land_tax_info_id',
        'cert_type',
        'cert_date',
        'cert_prepared_by',
        'cert_signee',
        'cert_recipient',
        'cert_address',
        'cert_entries_from',
        'cert_entries_to',
        'cert_details',
        'notary_public',
        'ptr_number',
        'doc_number',
        'page_number',
        'book_number',
        'cert_series',
        'ref_num',
        'prov_certclearance', 
        'prov_certtype',
        'prov_certbidding'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
