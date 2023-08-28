<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountGroup;
use Illuminate\Support\Facades\DB;
use Validator;

class AccountGroupController extends Controller
{
    public function index()
    {
        return view('account_group_settings');
    }
    
    public function accountGroup(Request $request)
    {
        $request->validate ([
            'inputType' => 'required',
            'inputCategoryType' => 'required'
        ]);

        $check = DB::table('account_groups')->select('*')->where('id', $request->groupID)->first();
        if ($check) {
            $accGroup = AccountGroup::find($check->id);
            $accGroup->type = $request->inputType;
            $accGroup->category_id = $request->inputCategoryType;
            $accGroup->save();
            $message = 'Sucessfully Updated';
        } else {
            $accGroup = new AccountGroup;
            $accGroup->type = $request->inputType;
            $accGroup->category_id = $request->inputCategoryType;
            $accGroup->save();
            $message = 'Sucessfully Added';
        }
        return back()->withInput()->with('Message', $message);
    }

    public function getGroupDelData(Request $request) 
    {
        $accGroup = new AccountGroup;
        $deletedData = $accGroup::where('id',$request->groupID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }
}
