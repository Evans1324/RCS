<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerType;

class CustomerTypeController extends Controller
{
    public function customerTypeInsert (Request $request)
    {
        $request->validate ([
            'typeDescription' => 'required'
        ]);

        $customerType = new CustomerType;
        $duplicateEntry = DB::table('customer_types')->where('description_type', $request->typeDescription)->count();
        if($duplicateEntry > 0) {
            $message = "This data already exists";
        } else {
            $customerType::upsert(
                ['id'=>$request->typeID, 'description_type'=>$request->typeDescription, 'created_at'=>now(), 'updated_at'=>now()],
                ['id'], ['description_type']
            );
            $message = 'Sucessfully Added';
        }
        return back()->withInput()->with('Message', $message);
    }

    public function customerTypeDelete (Request $request)
    {
        $customerType = new CustomerType;
        $deletedData = $customerType::where('id', $request->typeID)->forceDelete();
        return back()->with('Message', 'Successfully Deleted');
    }
}
