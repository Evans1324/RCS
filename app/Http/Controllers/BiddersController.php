<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bidders;

class BiddersController extends Controller
{
    public function insertBiidersInfo(Request $request) {
        $rentalsInfo = new Bidders;

        $insertRentalsInfo = $rentalsInfo::upsert(
            ['id'=>$request->taxColBiddersID, 'business_name'=>$request->biddersBusinessName, 'owner_representative'=>$request->biddersOwner],
            ['id'],
            ['business_name', 'owner_representative']
        );

        $message = 'Data Saved Succesfuly';
        return back()->withInput()->with('Message', $message);
    }

    public function biddersAutoComplete(Request $request) {
        $bidddersQuery = Bidders::select('business_name AS value', 'owner_representative')
        ->where('business_name', 'like', '%'.$request->term.'%')
        ->orderBy('id', 'asc')
        ->get();
        return $bidddersQuery;
    }
}
