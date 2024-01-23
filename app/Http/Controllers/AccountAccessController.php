<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountAccess;

class AccountAccessController extends Controller
{
    function accountAccessForm (Request $request) {
        $checkAcc = AccountAccess::where('acc_id', $request->accTitlesAccessLandTax)->first();
        // if ($checkAcc) {
        //     $accAccess = AccountAccess::find($check->id);
        //     $accAccess->acc_id = $request->accTitlesAccessLandTax;
        //     $accAccess->save();
        // }else {
        //     $accAccess = new AccountAccess;
        //     $accAccess->acc_id = $request->accTitlesAccessLandTax;
        //     $accAccess->save();
        // }
        // dd(count($request->accTitlesAccessLandTax));
        
        dd(count($request->accTitlesAccessLandTax));
        for($i=0; $i<count($request->accTitlesAccessLandTax); $i++) {
            $accTitles = new AccountAccess;
            $accTitles->acc_id = $request->accTitlesAccessLandTax[$i];
            // 0 = inactive 1 = active
            if ($request->accTitlesAccessLandTax[$i] == null) {
                $accTitles->acc_status = 0;
            } else {
                $accTitles->acc_status = 1;
            }
            
            $accTitles->save();
        }

    }
}
