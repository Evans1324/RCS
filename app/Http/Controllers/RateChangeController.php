<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CollectionRate;
use App\Models\RateChange;
use App\Models\RateSchedule;

class RateChangeController extends Controller
{
    public function submitRateChange(Request $request) {
        $rateChange = RateChange::where('date_of_change', $request->dateOfChangeRate)->first();
        if($rateChange == null) {
            $id = RateChange::insert([
                'date_of_change'=>$request->dateOfChangeRate,
                'updated_at'=>now(),
                'created_at'=>now()
            ]);
            $rateChange = RateChange::where('date_of_change', $request->dateOfChangeRate)->first();
        }

        $id = $rateChange->id;
        // $col = CollectionRate::firstOrCreate(
        //     ['acc_titles_id'=> $request->accountTitleID, 'acc_subtitles_id'=> $request->subtitleId, 'rate_change_id'=> $id],
        //     ['shared_status'=> $request->sharedMunBar, 'provincial_share'=> $request->provincialShare, 'municipal_share'=> $request->municipalShare, 'barangay_share'=> $request->barangayShare, 'rate_type'=> $request->rateType, 'fixed_rate'=> $request->fixedRate, 'percent_value'=> $request->percentValue, 'percent_of'=> $request->percentOf, 'deadline_status'=> $request->deadline, 'rate_after_deadline'=> $request->rateAfterDeadline, 'deadline_date'=> $request->deadlineDate]
        // );
        $col = CollectionRate::updateOrCreate(
            ['acc_titles_id'=> $request->accountTitleID, 'acc_subtitles_id'=> $request->subtitleId, 'rate_change_id'=> $id],
            ['shared_status'=> $request->sharedMunBar, 'provincial_share'=> $request->provincialShare, 'municipal_share'=> $request->municipalShare, 'barangay_share'=> $request->barangayShare, 'rate_type'=> $request->rateType, 'fixed_rate'=> $request->fixedRate, 'percent_value'=> $request->percentValue, 'percent_of'=> $request->percentOf, 'deadline_status'=> $request->deadline, 'rate_after_deadline'=> $request->rateAfterDeadline, 'deadline_date'=> $request->deadlineDate]
        );

        $idsArray = [];
        foreach($request->collectionLabel as $key=>$label) {
            if ($label != null) {
                $schedLabel = RateSchedule::where([['col_rate_id', $col->id], ['shared_label', $label]])->first();
                if ($schedLabel == null) {
                    $schedLabel = RateSchedule::create(['col_rate_id' => $col->id, 'shared_label' => $label, 'shared_value' => $request->collectionValue[$key], 'shared_per_unit' => $request->collectionPerUnit[$key], 'shared_unit' => $request->collectionUnit[$key]]);
                } else {
                    $rateSched = RateSchedule::find($schedLabel->id);
                    $rateSched->shared_label = $request->collectionLabel[$key];
                    $rateSched->shared_value = $request->collectionValue[$key];
                    $rateSched->shared_per_unit = $request->collectionPerUnit[$key];
                    $rateSched->shared_unit = $request->collectionUnit[$key];
                    $rateSched->save();
                }
                
                array_push($idsArray, $schedLabel->id);
            } else {

            }
        }
        
        $colReset = RateSchedule::where('col_rate_id', $col->id)->whereNotIn('id', $idsArray)->delete();

        // for ($i=0; $i<count($request->collectionLabel); $i++) {
        //     $collectionRate = new RateSchedule;
        //     $collectionRate->col_rate_id = $col->id;
        //     $collectionRate->shared_label = $request->collectionLabel[$i];
        //     $collectionRate->shared_value = $request->collectionValue[$i];
        //     $collectionRate->shared_per_unit = $request->collectionPerUnit[$i];
        //     $collectionRate->shared_unit = $request->collectionUnit[$i];
        //     $collectionRate->save();

        //     $rateSched = RateSchedule::upsert(
        //         ['col_rate_id'=>$col->id,'shared_label'=>$request->collectionLabel[$i], 'shared_value'=>$request->collectionValue[$i], 'shared_per_unit'=>$request->collectionPerUnit[$i], 'shared_unit'=>$request->collectionUnit[$i]], 
        //         ['id', 'col_rate_id'],
        //         ['shared_label', 'shared_value', 'shared_per_unit', 'shared_per_unit']
        //     );
        // }
        $message = 'Rate Updated Successfully';
        return back()->withInput()->with('Message', $message);
    }
}
