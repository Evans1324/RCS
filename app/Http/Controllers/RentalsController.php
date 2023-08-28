<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rentals;

class RentalsController extends Controller
{
    public function insertRentalsInfo(Request $request) {
        $rentalsInfo = new Rentals;

        $insertRentalsInfo = $rentalsInfo::upsert(
            ['id'=>$request->taxColRentalID, 'name'=>$request->rentalName, 'location'=>$request->rentalLocation, 'lease_of_contact'=>$request->rentalLease],
            ['id'],
            ['name', 'location', 'lease_of_contact']
        );

        $message = 'Data Saved Succesfuly';
        return back()->withInput()->with('Message', $message);
    }

    public function rentalsAutoComplete(Request $request) {
        $rentalsQuery = Rentals::select('name AS value', 'location', 'lease_of_contact', 'id')
        ->where('name', 'like', '%'.$request->term.'%')
        ->orderBy('id', 'asc')
        ->get();
        return $rentalsQuery;
    }
}
