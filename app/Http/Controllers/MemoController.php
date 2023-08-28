<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use App\Models\AccountGroup;
use App\Models\AccountTitles;
use App\Models\AccountSubtitles;
use App\Models\LandTaxInfo;
use App\Models\LandTaxAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemoController extends Controller
{
    public function generateAccTitles() {
        $accData = DB::table('account_titles')->select('title_name AS title', 'title_name AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->where('title_name', 'Share from National Wealth-Hydro')
        ->orWhere('title_name', 'Share from National Wealth-Mining')
        ->orWhere('title_name', 'National Tax Allocation')
        ->orWhere('title_name', 'Interest Income (General Fund-Proper)')
        ->orWhere('title_name', 'Interest Income (SEF)')
        ->leftJoin('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        ->get();

        return $accData;
    }

    public function saveMemoTransaction(Request $request) {

        $checkLandTax = LandTaxInfo::where('id', $request->memoID)->first();
        if ($checkLandTax) {
            $landTax = LandTaxInfo::find($checkLandTax->id);
            $landTax->report_date = date('Y-m-d', strtotime($request->memoSelectDate));
            $landTax->receipt_type = 'Land Tax Collection';
            $landTax->total_amount = $request->memoTotal;
            $landTax->submission_type = 'Memo Collection';
            $landTax->role = 0;
            $landTax->save();
        } else {
            $landTax = new LandTaxInfo;
            $landTax->report_date = date('Y-m-d', strtotime($request->memoSelectDate));
            $landTax->receipt_type = 'Land Tax Collection';
            $landTax->total_amount = $request->memoTotal;
            $landTax->submission_type = 'Memo Collection';
            $landTax->role = 0;
            $landTax->save();
        }

        
        $checkMemo = Memo::where('memo_id', $request->memoID)->first();
        $getLatestMemo = LandTaxInfo::where([['id', $request->memoID], ['submission_type', 'Memo Collection']])->orderBy('id', 'desc')->first();
        if ($checkMemo) {
            $memo = Memo::find($checkMemo->id);
            $memo->memo_id = $request->memoID;
            $memo->memo_date = date('Y-m-d', strtotime($request->memoSelectDate));
            $memo->entry_type = $request->memoEntryType;
            $memo->control_number = $request->memoControlNum;
            $memo->save();
            $message = 'Updated Successfully';
        } else {
            $memo = new Memo;
            $memo->memo_id = $getLatestMemo->id;
            $memo->memo_date = date('Y-m-d', strtotime($request->memoSelectDate));
            $memo->entry_type = $request->memoEntryType;
            $memo->control_number = $request->memoControlNum;
            $memo->save();
            $message = 'Saved Successfully';
            $memoID = Memo::select('id')->orderBy('id', 'desc')->first();
        }

        $land_tax_reset = new LandTaxAccount;
        $land_tax_reset::where('info_id', $getLatestMemo->id)->delete();
        
        for($i=0; $i<count($request->memoAccount); $i++) {
            if ($request->memoNature[$i] == null) {
                $cmp = true;
            }
            $subtitle = AccountSubtitles::where('subtitle', $request->memoAccount[$i])->first();
            if ($subtitle != null) {
                $acc_title = AccountTitles::find($subtitle->title_id);
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = $subtitle->id;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            } else {
                $acc_title = AccountTitles::where('title_name', $request->memoAccount[$i])->first();
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = null;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            }
            $landTaxAccount = new LandTaxAccount;
            $landTaxAccount->info_id = $getLatestMemo->id;
            $landTaxAccount->quantity = str_replace(',', '', $request->memoQuantity[$i]);
            $landTaxAccount->rate_type = $request->memoTypeRate[$i];
            $landTaxAccount->account = $request->memoAccount[$i];
            $landTaxAccount->acc_category_id = $acc_category_id;
            $landTaxAccount->acc_title_id = $acc_title_id;
            $landTaxAccount->sub_title_id = $acc_subtitle_id;
            $landTaxAccount->nature = $request->memoNature[$i];
            $landTaxAccount->amount = str_replace(',', '', $request->memoAmount[$i]);
            $landTaxAccount->save();
        }
        return $message;
    }

    public function deleteMemoData(Request $request) {
        $deletedData = LandTaxInfo::where('id',$request->id)->update([
            'deleted_at' => now()
        ]);
    }

    public function cancelMemoData(Request $request) {
        $landTaxInfo = LandTaxInfo::find($request->id);
        $landTaxInfo->status = 'Cancelled';
        $landTaxInfo->save();
        
        $message = 'Transaction Cancelled';
        return $message;
    }

    public function restoreMemoData(Request $request) {
        $landTaxInfo = LandTaxInfo::find($request->id);
        $landTaxInfo->status = null;
        $landTaxInfo->save();
        
        $message = 'Transaction Restored';
        return $message;
    }

    public function getMemoTransactionData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table('land_tax_infos')
        ->select('land_tax_infos.id AS main_id', 'memos.*', 'land_tax_infos.*', 'land_tax_infos.created_at AS order')
        ->where('land_tax_infos.submission_type', 'Memo Collection')
        ->leftJoin('memos', 'memos.memo_id', 'land_tax_infos.id');

        if($search!=null){
            $query=$query
            ->where([['land_tax_infos.deleted_at', null],['memo_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Memo Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['entry_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Memo Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['control_number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Memo Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.total_amount','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Memo Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.created_at','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Memo Collection']]);

        } else {
            $query=$query->where('land_tax_infos.deleted_at', null);
        }
        
        if(count($order)!=null){

            $column=$order[0]['column'];
            $dir=$order[0]['dir'];
            $column_name=$columns[intval($column)]['data'];
            $query=$query
            ->orderBy($column_name,$dir);
          }
          else{
            $query=$query
            ->orderBy('land_tax_infos.created_at','desc');
          }

        $count=count($query->get());
        $displayTaxData = $query->skip($start)->limit($length)->get();

        $data=[
            "draw"=>$draw,
            "recordsTotal"=> $count,
            "recordsFiltered"=> $count,
            "data"=>$displayTaxData
        ];
        return $data;
    }
}
