<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AccountSubSubtitles;
use App\Models\AccountSubtitles;

class AccountSubSubtitlesController extends Controller
{
    public function submitNestedSubtitles(Request $request)
    {
        $check = DB::table('account_sub_subtitles')->select('*')->where('id', $request->nestedSubtitleID)->first();
        if ($check) {
            $nestedSub = AccountSubSubtitles::find($check->id);
            $nestedSub->subtitle_id = $request->subTitleName;
            $nestedSub->sub_subtitles = $request->nestedSubtitle;
            $nestedSub->save();
            $message = 'Sucessfully Updated';
        } else {
            $nestedSub = new AccountSubSubtitles;
            $nestedSub->subtitle_id = $request->subTitleName;
            $nestedSub->sub_subtitles = $request->nestedSubtitle;
            $nestedSub->save();
            $message = 'Sucessfully Added';
        }
        return back()->withInput()->with('Message', $message);
    }

    public function accountNestedSubtitlesDelete (Request $request) 
    {
        $nestedSub = new AccountSubSubtitles;
        $deletedData = $nestedSub::where('id',$request->nestedSubtitleID)->forceDelete();
        return back()->with('Message', 'Successfully Deleted');
    }
}
