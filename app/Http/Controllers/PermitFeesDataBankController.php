<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PermitFeesDataBank;

class PermitFeesDataBankController extends Controller
{
    public function addNewPermitteesOthers(Request $request) {
        $insertPermittees = new PermitFeesDataBank;
        $insertInfo = $insertPermittees::create(
            ['account_type'=>$request->type, 'trade_name'=>$request->tradeName, 'proprietor'=>$request->proprietor]
        );

        $message = 'Data Saved Succesfuly';
        return back()->withInput()->with('Message', $message);
    }

    public function saveNewPermitteesOthers(Request $request) {
        $insertPermittees = new PermitFeesDataBank;
        $insertInfo = $insertPermittees::upsert(
            ['id'=>$request->permitteesOthersID, 'account_type'=>$request->permitteesOthersType, 'trade_name'=>$request->permitteesOthersTradeName, 'proprietor'=>$request->permitteesOthers],
            ['id'],
            ['account_type', 'trade_name', 'proprietor']
        );

        $message = 'Data Saved Succesfuly. Redirectiong to Revenue Collection';
        return \Redirect::route('pages.land_tax_collection');
    }

    public function deletePermitteesOthers(Request $request) {
        $delPermitteesOthers = new PermitFeesDataBank;
        $deletedData = $delPermitteesOthers::where('id',$request->permitteesOthersID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }
}
