<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CollectionRate;
use App\Models\RateSchedule;
use App\Models\LandTaxInfo;
use App\Models\setRateYear;

class CollectionRatesController extends Controller
{
    function getTitleRate(Request $request) {
        $collectionRate = CollectionRate::where([['acc_titles_id', $request->id], ['date_of_change', $request->date_of_change]])->join('rate_changes', 'collection_rates.rate_change_id', 'rate_changes.id')->first();
        $rateSchedules = CollectionRate::select('rate_schedules.*')->where([['acc_titles_id', $request->id], ['date_of_change', $request->date_of_change]])->join('rate_changes', 'collection_rates.rate_change_id', 'rate_changes.id')->leftJoin('rate_schedules', 'rate_schedules.col_rate_id', 'collection_rates.id')->orderBy('collection_rates.created_at')->get();
        return ['collectionRate'=>$collectionRate, 'rateSchedules'=>$rateSchedules];
    }


    function getSubtitleRate(Request $request) {
        $subCollectionRate = CollectionRate::where([['acc_subtitles_id', $request->id], ['date_of_change', $request->date_of_change]])->join('rate_changes', 'collection_rates.rate_change_id', 'rate_changes.id')->first();
        $subRateSchedules = CollectionRate::select('rate_schedules.*')->where([['acc_subtitles_id', $request->id], ['date_of_change', $request->date_of_change]])->join('rate_changes', 'collection_rates.rate_change_id', 'rate_changes.id')->leftJoin('rate_schedules', 'rate_schedules.col_rate_id', 'collection_rates.id')->orderBy('collection_rates.created_at')->get();
        return ['subCollectionRate'=>$subCollectionRate, 'subRateSchedules'=>$subRateSchedules];
    }

    function getAccountTitles(Request $request) {
        $rateSelected = setRateYear::first();
        $rateChange = DB::table('rate_changes')->select('rate_changes.id')
        ->where('rate_changes.date_of_change', $rateSelected->year)
        ->leftJoin('collection_rates', 'rate_changes.id', 'collection_rates.rate_change_id')
        ->first();

        $accData = DB::table('account_titles')->select('title_name AS title', 'title_name AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->join('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        ->where([['title_name', 'like', '%'.$request->term.'%'],['deleted_at', null], ['rate_change_id', $rateChange->id]])
        ->limit(10)->get();

        $accSubData = DB::table('account_subtitles')->select('subtitle AS title', 'subtitle AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->join('collection_rates', 'collection_rates.acc_subtitles_id', 'account_subtitles.id')
        ->where([['subtitle', 'like', '%'.$request->term.'%'], ['rate_change_id', $rateChange->id]])
        ->orderBy('subtitle')->limit(10)->get();

        $displayArray = array_merge($accData->toArray(), $accSubData->toArray());
        return ($displayArray);
    }

    function getSchedules(Request $request) {
        $sched = RateSchedule::select('*', DB::raw('IF( ISNULL(shared_unit), shared_label, CONCAT(shared_label, " ", shared_value, " ")) AS label'), DB::raw('IF( ISNULL(shared_unit), shared_label, CONCAT(shared_label, " (", shared_unit, " @ ", shared_value,")")) AS label'))
        ->where([['shared_label', 'like', "%".$request->term."%"], ['col_rate_id', $request->id]])
        ->orderBy('shared_label')
        ->get();
        return $sched;
    }

    function getPermitFeesTradeName(Request $request) {
        $displayPermitFees = DB::table('permit_fees_data_banks')
        ->select('account_type', 'trade_name AS value', 'proprietor')
        ->where('trade_name', 'like', '%'.$request->term.'%')
        ->limit(10)
        ->get();
        return $displayPermitFees;
    }

    function getPermitteesTradeName(Request $request) {
        $displatPermittees = DB::table('sand_gravel_permittees')
        ->select('type', 'trade_name', 'permittee AS value')
        ->where('trade_name', 'like', '%'.$request->term.'%')
        ->limit(10)
        ->get();
        return $displatPermittees;
    }

    function getCollData(Request $request) {
        $displayCollData = LandTaxInfo::with('parentSerial', 'getNature', 'parentAccessPc', 'parentMunicipality', 'parentBarangay')
        ->where([['land_tax_infos.deleted_at', null], ['land_tax_infos.id', $request->id]])
        ->first();
        // dd($displayCollData);
        // $displayCollData = DB::table('land_tax_infos')
        // ->select('land_tax_infos.id AS main_id', 'land_tax_infos.*', 'serials.*', 'access_p_c_s.*', 'access_p_c_s.id AS user_name', 'land_tax_accounts.*')
        // ->where([['land_tax_infos.deleted_at', null], ['land_tax_infos.id', $request->id]])
        // ->join('serials', 'land_tax_infos.series_id', 'serials.id')
        // ->join('access_p_c_s', 'land_tax_infos.user_ip', 'access_p_c_s.id')
        // ->join('land_tax_accounts', 'land_tax_infos.id', 'land_tax_accounts.info_id')
        // ->first();
        return $displayCollData;
    }

    function saveYearSelected(Request $request) {
        $check = setRateYear::first();
        $rate = setRateYear::find($check->id);
        $rate->year = $request->date_of_change;
        $rate->save();
    }
    
    
}