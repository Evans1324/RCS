<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CutOffs;

class CutOffsController extends Controller
{
    public function saveReportCutoff(Request $request) {
        $insertCutoff = new CutOffs;
        $cutOffs = $insertCutoff::upsert(
            ['id'=>$request->cutOffID, 'collection_cutoff'=>$request->reportCutOff],
            ['id'],
            ['collection_cutoff']
        );
        
        $message = 'Data Saved Succesfuly';
        return back()->withInput()->with('Message', $message);
    }

    public function deleteReportCutoffForm(Request $request) {
        $delCutOffs = new CutOffs;
        $deletedData = $delCutOffs::where('id',$request->cutOffID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }
}
