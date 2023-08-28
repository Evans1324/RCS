<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTitles;

class AccountTitlesController extends Controller
{
    public function index()
    {
        return view('account_titles');
    }

    public function acountTitlesInsert (Request $request)
    {
        $check = DB::table('account_titles')->select('*')->where('id', $request->titleID)->first();
        if ($check) {
            $accTitles = AccountTitles::find($check->id);
            $accTitles->title_code = $request->titleCode;
            $accTitles->title_name = $request->titleName;
            $accTitles->title_category_id =$request->titleCategory;
            $accTitles->save();
            $message = 'Sucessfully Updated';
        } else {
            $accTitles = new AccountTitles;
            $accTitles->title_code = $request->titleCode;
            $accTitles->title_name = $request->titleName;
            $accTitles->title_category_id =$request->titleCategory;
            $accTitles->save();
            $message = 'Sucessfully Added';
        }
        return back()->withInput()->with('Message', $message);
    }

    public function deleteTitles(Request $request) 
    {
        $accTitles = new AccountTitles;
        $deletedData = $accTitles::where('id',$request->titleID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }
}
