<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipalities;
use App\Models\Barangay;
use Illuminate\Support\Facades\DB;

class MunicipalityController extends Controller
{
    function getMunicipality(Request $request) {
        $displayMun = Municipalities::all();
        return $displayMun;    
    }

    function getBarangays(Request $request) {
        $data = Barangay::where('mun_id', $request->id)->get();
        return $data;
    }

    function getMunBar(Request $request) {
        $data = DB::table('municipalities')
        ->select('municipalities.id', 'municipalities.municipality', 'barangays.id', 'barangays.barangay_name', DB::raw('CONCAT(municipalities.municipality,"-",barangays.barangay_name) AS value'))
        ->where('municipalities.municipality', 'like', '%'.$request->term.'%')
        ->orWhere('barangays.barangay_name', 'like', '%'.$request->term.'%')
        ->leftJoin('barangays', 'barangays.mun_id', 'municipalities.id')
        ->limit(10)
        ->get();
        return $data;
    }
}
