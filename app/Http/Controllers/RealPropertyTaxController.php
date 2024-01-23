<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\RealPropertyTax;
use App\Models\LandTaxInfo;
use App\Models\LandTaxAccount;
use Illuminate\Http\Request;
use App\Models\setRateYear;
use App\Models\AccountGroup;
use App\Models\AccountTitles;
use App\Models\AccountSubtitles;
use App\Models\RptInfo;
use App\Models\RptTdrp;
use App\Models\Barangay;
use App\Models\RptMenu;
use App\Models\RptPreviousReceipt;
use App\Models\Serial;

class RealPropertyTaxController extends Controller
{
    function rptSumbmitForm(Request $request) {
        $checkRPTForm = RptInfo::where('id', $request->rptID)->first();
        
        if ($checkRPTForm) {
            $rpt = RptInfo::find($checkRPTForm->id);
            $rpt->report_date = Date('Y-m-d', strtotime($request->rptReceiptDate));
            $rpt->client_type_radio = $request->clientTypeRadio;
            $rpt->client_type_id = $request->rptReceiptClientType;
            $rpt->series_id = $request->rptReceiptNo;
            $rpt->serial_number = $request->serialNumber;
            $rpt->municipality_id = $request->rptReceiptMunicipality;
            $rpt->last_name = $request->rptReceiptLastName;
            $rpt->first_name = $request->rptReceiptFirstName;
            $rpt->middle_name = $request->rptReceiptMI;
            $rpt->sex = $request->rptReceiptSex;
            $rpt->spouse = $request->rptReceiptSpouses;
            $rpt->company = $request->rptReceiptCompany;
            $rpt->transaction_type = $request->rptReceiptTransaction;
            $rpt->bank_name = $request->rptReceiptBank;
            $rpt->bank_number = $request->rptReceiptNumber;
            $rpt->bank_date = $request->rptReceiptTransactDate;
            $rpt->tax_type = $request->form56TaxType;
            $rpt->bank_remarks = $request->rptBankRemarks;
            $rpt->account = $request->rptReceiptAccount;
            $rpt->nature = $request->rptReceiptNature;
            $rpt->amount = $request->rptReceiptAmount;
            $rpt->save();
        } else {
            $rpt = new RptInfo;
            $rpt->report_date = Date('Y-m-d', strtotime($request->rptReceiptDate));
            $rpt->client_type_radio = $request->clientTypeRadio;
            $rpt->client_type_id = $request->rptReceiptClientType;
            $rpt->series_id = $request->rptReceiptNo;
            $rpt->serial_number = $request->serialNumber;
            $rpt->municipality_id = $request->rptReceiptMunicipality;
            $rpt->last_name = $request->rptReceiptLastName;
            $rpt->first_name = $request->rptReceiptFirstName;
            $rpt->middle_name = $request->rptReceiptMI;
            $rpt->sex = $request->rptReceiptSex;
            $rpt->spouse = $request->rptReceiptSpouses;
            $rpt->company = $request->rptReceiptCompany;
            $rpt->transaction_type = $request->rptReceiptTransaction;
            $rpt->bank_name = $request->rptReceiptBank;
            $rpt->bank_number = $request->rptReceiptNumber;
            $rpt->bank_date = $request->rptReceiptTransactDate;
            $rpt->tax_type = $request->form56TaxType;
            $rpt->bank_remarks = $request->rptBankRemarks;
            $rpt->account = $request->rptReceiptAccount;
            $rpt->nature = $request->rptReceiptNature;
            $rpt->amount = $request->rptReceiptAmount;
            $rpt->save();
        }
        
        $rptInfo = RptInfo::where('serial_number', $request->serialNumber)->first();
        $rptPrevReceipts = new RptPreviousReceipt;
        $rptPrevReceipts->prev_rpt_id = $rptInfo->id;
        $rptPrevReceipts->prev_receipt_no = $request->rptPrevReceipt;
        $rptPrevReceipts->prev_date = $request->rptPrevDate;
        $rptPrevReceipts->for_the_year = $request->rptPrevForYear;
        $rptPrevReceipts->tax_dec_no = $request->rptPrevTaxDecNo;
        $rptPrevReceipts->prev_receipt_remarks = $request->rptPrevReceiptRemarks;
        $rptPrevReceipts->save();
        
        $land_tax_reset = new RptTdrp;
        $land_tax_reset::where('rpt_id', $rptInfo->id)->delete();
        for($i=0; $i<count($request->rptDeclaredOwner); $i++) {
            $tdrp = new RptTdrp;
            $tdrp->rpt_id = $rptInfo->id;
            $tdrp->declared_owner = $request->rptDeclaredOwner[$i];
            $tdrp->td_arp_no = $request->rptTdarpNo[$i];
            $tdrp->barangay_id = $request->rptBarangay[$i];
            $tdrp->classification = $request->rptClassification[$i];
            $tdrp->assessment_value = $request->rptAssessValue[$i];
            $tdrp->period_covered = $request->rptPeriodCovered[$i];
            $tdrp->full_partial = $request->rptFullPartial[$i];
            $tdrp->gross_amount = str_replace(',', '', $request->rptGrossAmount[$i]);
            $tdrp->discount = str_replace(',', '', $request->rptDiscount[$i]);
            $tdrp->previous_year = str_replace(',', '', $request->rptPrevYears[$i]);
            $tdrp->penalty_curr_year = str_replace(',', '', $request->rptPenaltyCurrYear[$i]);
            $tdrp->penalty_prev_year = str_replace(',', '', $request->rptPenaltyPrevYear[$i]);
            $tdrp->save();
        }
    }

    function deleteDataRPT(Request $request) {
        $deletedDataRPT = RptInfo::where('id',$request->id)->update([
            'deleted_at' => now()
        ]);
    }

    function cancelDataRPT(Request $request) {
        $deletedDataRPT = RptInfo::find($request->id);
        $deletedDataRPT->status = 'Cancelled';
        $deletedDataRPT->save();
        
        $message = 'Transaction Cancelled';
        return $message;
    }

    function restoreDataRPT(Request $request) {
        $rpt = RptInfo::find($request->id);
        $rpt->status = null;
        $rpt->save();
        
        $message = 'Transaction Restored';
        return $message;
    }

    public function openRPTReceipt(Request $request) {
        $check = RptInfo::where('serial_number', $request->serialNumber)->first();
        $rptInfo = RptInfo::find($check->id);
        return $rptInfo->id;
    }

    ///////////////////////////////////////////////// RPT SEF SECTION //////////////////////////////////////////////////

    function getRPTData(Request $request) {
        $rpt_data = RptTdrp::where('rpt_id', $request->id)->get();
        return $rpt_data;
    }

    function getBarangaysOnly(Request $request) {
        $barangaysOnly = Barangay::all();
        return $barangaysOnly;
    }
    
    function getClassification(Request $request) {
        $getClassificationType = RptMenu::select('id', 'classification_menu')->where('classification_menu', '<>', '')->get();
        return $getClassificationType;
    }

    function getFullPartial(Request $request) {
        $getFullPartial = RptMenu::select('id', 'full_partial_menu')->where('full_partial_menu', '!=', 'Full')->where('full_partial_menu', '<>', '')->get();
        return $getFullPartial;
    }

    function rptSubmitFormSEF(Request $request) {
        if($request->sefORNo===null){
            $existing_data=LandTaxInfo::find($request->sefID);
            if ($existing_data == null) {
                $taxColSeries=null;
                $serialNumber=0;
            } else {
                $taxColSeries=$existing_data->series_id;
                $serialNumber=$request->serialNumber;
            }
        } else {
            $taxColSeries=$request->sefORNo;
            $serialNumber=$request->serialNumber;
        }
        
        $checkSEFForm = LandTaxInfo::where('id', $request->sefID)->first();
        if($checkSEFForm) {
            $sef = LandTaxInfo::find($checkSEFForm->id);
            $sef->month = $request->rptMonth;
            $sef->year = $request->rptYear;
            $sef->report_date = date('Y-m-d', strtotime($request->sefSelectDate));
            $sef->report_number = $request->sefReportNo;
            $sef->series_id = $taxColSeries;
            $sef->serial_number = $serialNumber;
            $sef->client_type_id = $request->rptReceiptClientType;
            $sef->municipality_id = $request->sefMunicipality;
            $sef->barangay_id = $request->taxColBarangay;
            $sef->last_name = $request->rptReceiptLastName;
            $sef->first_name = $request->rptReceiptFirstName;
            $sef->middle_initial = $request->rptReceiptMI;
            $sef->sex = $request->rptReceiptSex;
            $sef->spouses = $request->rptReceiptSpouses;
            $sef->company = $request->rptReceiptCompany;
            $sef->submission_type = $request->rptSubmission;
            $sef->save();
        } else {
            $sef = new LandTaxInfo;
            $sef->month = $request->rptMonth;
            $sef->year = $request->rptYear;
            $sef->report_date = date('Y-m-d', strtotime($request->sefSelectDate));
            $sef->report_number = $request->sefReportNo;
            $sef->series_id = $taxColSeries;
            $sef->serial_number = $serialNumber;
            $sef->client_type_id = $request->rptReceiptClientType;
            $sef->municipality_id = $request->sefMunicipality;
            $sef->barangay_id = $request->taxColBarangay;
            $sef->last_name = $request->rptReceiptLastName;
            $sef->first_name = $request->rptReceiptFirstName;
            $sef->middle_initial = $request->rptReceiptMI;
            $sef->sex = $request->rptReceiptSex;
            $sef->spouses = $request->rptReceiptSpouses;
            $sef->company = $request->rptReceiptCompany;
            $sef->submission_type = $request->rptSubmission;
            $sef->save();
        }
        
        $info = LandTaxInfo::where('serial_number', $serialNumber)->first();
        if ($info) {
            $land_tax_reset = new LandTaxAccount;
            $land_tax_reset::where('info_id', $info->id)->delete();
        }
        
        for($i=0; $i<count($request->sefAccount); $i++) {
            if ($request->sefNature[$i] == null) {
                $cmp = true;
            }
            $subtitle = AccountSubtitles::where('subtitle', $request->sefAccount[$i])->first();
            if ($subtitle != null) {
                $acc_title = AccountTitles::find($subtitle->title_id);
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = $subtitle->id;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            } else {
                $acc_title = AccountTitles::where('title_name', $request->sefAccount[$i])->first();
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = null;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            }
            $landTaxAccount = new LandTaxAccount;
            $landTaxAccount->info_id = $info->id;
            $landTaxAccount->quantity = str_replace(',', '', $request->sefQuantity[$i]);
            $landTaxAccount->rate_type = $request->sefTypeRate[$i];
            $landTaxAccount->account = $request->sefAccount[$i];
            $landTaxAccount->acc_category_id = $acc_category_id;
            $landTaxAccount->acc_title_id = $acc_title_id;
            $landTaxAccount->sub_title_id = $acc_subtitle_id;
            $landTaxAccount->nature = $request->sefNature[$i];
            $landTaxAccount->amount = str_replace(',', '', $request->sefAmount[$i]);
            $landTaxAccount->save();
        }
    }

    function deleteDataSEF(Request $request) {
        $deletedDataSEF = LandTaxInfo::where('id',$request->id)->update([
            'deleted_at' => now()
        ]);
    }

    function cancelDataSEF(Request $request) {
        $deletedDataSEF = LandTaxInfo::find($request->id);
        $deletedDataSEF->status = 'Cancelled';
        $deletedDataSEF->save();
        
        $message = 'Transaction Cancelled';
        return $message;
    }

    function restoreDataSEF(Request $request) {
        $sef = LandTaxInfo::find($request->id);
        $sef->status = null;
        $sef->save();
        
        $message = 'Transaction Restored';
        return $message;
    }

    function getAccountTitlesSEF(Request $request) {
        $rateSelected = setRateYear::first();
        $rateChange = DB::table('rate_changes')->select('rate_changes.id')
        ->where('rate_changes.date_of_change', $rateSelected->year)
        ->leftJoin('collection_rates', 'rate_changes.id', 'collection_rates.rate_change_id')
        ->first();

        $accData = DB::table('account_titles')->select('title_name AS title', 'title_name AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->join('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        ->where([['title_name', 'like', '%'.$request->term.'%'], ['title_category_id', 6], ['deleted_at', null], ['rate_change_id', $rateChange->id]])
        ->limit(10)->get();

        $displayArray = $accData;
        return ($displayArray);
    }

    function updateSeriesStatusSEF(Request $request) {
        $previousSerial = LandTaxInfo::select('start_serial', 'serial_number')
        ->where([['unit', 'Pad'], ['serials.status', 'Active']])
        ->whereNull('serials.assigned_office')
        ->orderBy('land_tax_infos.id', 'desc')
        ->leftJoin('serials', 'land_tax_infos.series_id', 'serials.id')
        ->first();
        
        $finishedSeries = Serial::where('end_serial', $request->serial)
        ->first();
        
        if ($finishedSeries != null) {
            $updateSeries = Serial::find($finishedSeries->id);
            $updateSeries->status = "Completed";
            $updateSeries->save();
        }
    }

    public function getSEFTransactionData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table('land_tax_infos')
        ->select('land_tax_infos.id AS main_id', 'land_tax_infos.*', 'land_tax_infos.created_at AS order', 'municipalities.municipality AS mun_name')
        ->where('land_tax_infos.submission_type', 'SEF Collection')
        ->leftJoin('municipalities', 'land_tax_infos.municipality_id', 'municipalities.id');

        if($search!=null){
            $query=$query
            ->where([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'SEF Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'SEF Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['serial_number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'SEF Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['municipalities.municipality','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'SEF Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['barangays.barangay_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'SEF Collection']]);

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
    
    function getReceiptRPTData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table( 'rpt_infos')
        ->select('rpt_infos.id AS main_id', 'rpt_infos.*', 'rpt_previous_receipts.*', 'rpt_tdrps.*', 'transaction_type_menu', 'municipalities.municipality AS mun_name', 'barangays.barangay_name AS bar_name',)
        ->leftJoin('municipalities', 'rpt_infos.municipality_id', 'municipalities.id')
        ->leftJoin('barangays', 'rpt_infos.barangay_id', 'barangays.id')
        ->leftJoin('rpt_menus', 'rpt_infos.transaction_type', 'rpt_menus.id')
        ->leftJoin('rpt_tdrps', 'rpt_infos.id', 'rpt_tdrps.rpt_id')
        ->leftJoin('rpt_previous_receipts', 'rpt_infos.id', 'rpt_previous_receipts.prev_rpt_id')
        ->groupBy('rpt_infos.id');

        if($search!=null){
            $query=$query
            ->where([['rpt_infos.deleted_at', null],['report_date','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['client_type_radio','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['serial_number','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['municipalities.municipality','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['barangays.barangay_name','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['last_name','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['first_name','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['middle_name','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['sex','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['spouse','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['company','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['transaction_type','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['bank_name','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['bank_number','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['bank_date','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['tax_type','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['bank_remarks','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['account','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['nature','like','%'.$search.'%']])
            ->where([['rpt_infos.deleted_at', null],['amount','like','%'.$search.'%']]);

        } else {
            $query=$query->where('rpt_infos.deleted_at', null);
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
            ->orderBy('rpt_infos.created_at','desc');
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
