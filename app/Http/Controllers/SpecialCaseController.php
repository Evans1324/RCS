<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialCase;
use Illuminate\Support\Facades\DB;

class SpecialCaseController extends Controller
{

    public function specialCaseSharing(Request $request)
    {
        $specialCaseData = new SpecialCase;

        $specialCaseData::upsert(
            ['id'=>$request->specialCaseID, 'source_barangay'=>$request->barangaySource, 'source_percentage'=>$request->percentageSource, 'barangay_sharing'=>$request->barangaySharing, 'percentage_sharing'=>$request->percentageShare, 'remarks'=>$request->spRemarks, 'effectivity_date'=>$request->spStartEffectivity, 'effectivity_end_date'=>$request->spEndEffectivity],
            ['id'],
            ['source_barangay', 'source_percentage', 'barangay_sharing', 'percentage_sharing', 'remarks', 'effectivity_date', 'effectivity_end_date']
        );
        

        $message = 'Data Saved Succesfuly';
        return back()->withInput()->with('Message', $message);
    }

    public function deleteSharing(Request $request)
    {
        $delete = new SpecialCase;
        $deletedData = $delete::where('id', $request->specialCaseID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }
    
}
