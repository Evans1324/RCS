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
        $message = 'Rate Updated Successfully';
        return back()->withInput()->with('Message', $message);
    }

    function accountAccessForm (Request $request) {
        $n = 1;
        $typeArrayLand = $request->uncheckedLand;
        $splitArrayLand = explode(',', $typeArrayLand);
        $splitArrayLand = array_reverse($splitArrayLand);
        $latestEntryLand = array_slice($splitArrayLand, 0, $n);
        $latestEntryLand = array_reverse($latestEntryLand);

        $typeArrayField = $request->uncheckedField;
        $splitArrayField = explode(',', $typeArrayField);
        $splitArrayField = array_reverse($splitArrayField);
        $latestEntryField = array_slice($splitArrayField, 0, $n);
        $latestEntryField = array_reverse($latestEntryField);
        
        $typeArrayCash = $request->uncheckedCash;
        $splitArrayCash = explode(',', $typeArrayCash);
        $splitArrayCash = array_reverse($splitArrayCash);
        $latestEntryCash = array_slice($splitArrayCash, 0, $n);
        $latestEntryCash = array_reverse($latestEntryCash);
        // dd($latestEntryLand, $latestEntryField, $latestEntryCash);
        if ($request->has('accTitlesAccessLandTax')) {
            for($i=0; $i<count($request->accTitlesAccessLandTax); $i++) {
                if ($request->accTitlesAccessLandTax[$i]){
                    $acc_status = CollectionRate::where('acc_titles_id',$request->accTitlesAccessLandTax[$i])->update([ 'status_land' => 1 ]);
                }
                //check for subtitles and subsubtitles
            }
        }

        if ($request->has('accTitlesAccessFieldTax')) {
            // dd(2);
            for($i=0; $i<count($request->accTitlesAccessFieldTax); $i++) {
                if ($request->accTitlesAccessFieldTax[$i]){
                    $acc_status = CollectionRate::where('acc_titles_id',$request->accTitlesAccessFieldTax[$i])->update([ 'status_field' => 1 ]);
                }
                //check for subtitles and subsubtitles
            }
        }
        
        if ($request->has('accTitlesAccessCash')) {
            for($i=0; $i<count($request->accTitlesAccessCash); $i++) {
                if ($request->accTitlesAccessCash[$i]){
                    $acc_status = CollectionRate::where('acc_titles_id',$request->accTitlesAccessCash[$i])->update([ 'status_cash' => 1 ]);
                }
                //check for subtitles and subsubtitles
            }
        }
        
        
        $getAccLand = CollectionRate::where('acc_titles_id', $latestEntryLand)->update(['status_land' => 0]);
        $getAccField = CollectionRate::where('acc_titles_id', $latestEntryField)->update(['status_field' => 0]);
        $getAccCash = CollectionRate::where('acc_titles_id', $latestEntryCash)->update(['status_cash' => 0]);

        

    }

    function getActiveAccounts(Request $request) {
        $getRateChangeYear = RateChange::select('date_of_change')->latest()->first();
        $getActiveLand = CollectionRate::select('acc_titles_id', 'acc_subtitles_id', 'status_land')->where([['status_land', 1], ['date_of_change', $getRateChangeYear->date_of_change]])->leftJoin('rate_changes', 'collection_rates.rate_change_id', 'rate_changes.id')->get();
        $getActiveField = CollectionRate::select('acc_titles_id', 'acc_subtitles_id', 'status_field')->where([['status_field', 1], ['date_of_change', $getRateChangeYear->date_of_change]])->leftJoin('rate_changes', 'collection_rates.rate_change_id', 'rate_changes.id')->get();
        $getActiveCash = CollectionRate::select('acc_titles_id', 'acc_subtitles_id', 'status_cash')->where([['status_cash', 1], ['date_of_change', $getRateChangeYear->date_of_change]])->leftJoin('rate_changes', 'collection_rates.rate_change_id', 'rate_changes.id')->get();
        return [$getActiveLand, $getActiveField, $getActiveCash];
    }
}