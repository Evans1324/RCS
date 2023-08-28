<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AccountSubtitles;


class AccountSubtitlesController extends Controller
{
    public function index()
    {
        return view('account_titles');
    }

    public function acountSubtitlesInsert (Request $request)
    {
        $request->validate([
            'titleName' => 'required',
            'subTitle' => 'required|string|min:5|max:60'
        ]);

        $check = DB::table('account_subtitles')->select('*')->where('id', $request->subTitleID)->first();
        if ($check) {
            $accSub = AccountSubtitles::find($check->id);
            $accSub->title_id = $request->titleName;
            $accSub->subtitle = $request->subTitle;
            $accSub->save();
            $message = 'Sucessfully Updated';
        } else {
            $accSub = new AccountSubtitles;
            $accSub->title_id = $request->titleName;
            $accSub->subtitle = $request->subTitle;
            $accSub->save();
            $message = 'Sucessfully Added';
        }
        
        return back()->withInput()->with('Message', $message);

    }

    public function accountSubtitlesDelete (Request $request) 
    {
        $accSub = new AccountSubtitles;
        $deletedData = $accSub::where('id',$request->subTitleID)->forceDelete();
        return back()->with('Message', 'Successfully Deleted');
    }
}
