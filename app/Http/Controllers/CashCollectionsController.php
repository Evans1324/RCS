<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PvetCollections;
use App\Models\LandTaxInfo;
use App\Models\Serial;
use App\Models\LandTaxAccount;
use App\Models\AccountGroup;
use App\Models\AccountTitles;
use App\Models\AccountSubtitles;
use App\Models\DistrictHospitalsCollections;

class CashCollectionsController extends Controller
{
    function submitCashCollections(Request $request) {
        $landTaxData = new LandTaxInfo;
        $cmp = false;
        
        if ($request->taxColRole == 2) {
            if ($day == 'Sat') {
                $current_date = Date('Y-m-d H:i', strtotime($acDate. '+ 2 day'));
            } else if ($day == 'Sun') {
                $current_date = Date('Y-m-d H:i', strtotime($acDate. '+ 1 day'));
            } else {
                $current_date = $acDate;
            }
            $roleDate = Date('Y-m-d H:i', strtotime($today));
        } else if ($request->taxColRole == 1) {
            if ($day == 'Sat') {
                $roleDate = Date('Y-m-d H:i', strtotime($acDate. '+ 2 day'));
            } else if ($day == 'Sun') {
                $roleDate = Date('Y-m-d H:i', strtotime($acDate. '+ 1 day'));
            } else {
                $roleDate = $acDate;
            }
        } else {
            $roleDate = null;
        }

        if($request->taxColSeries===null){
            $existing_data=$landTaxData::find($request->taxColID);
            if ($existing_data == null) {
                $taxColSeries=$request->recoveredSeries;
            } else {
                $taxColSeries=$existing_data->series_id;
            }
            
            $accessPc = DB::table('access_p_c_s')->where('serial_id', $request->taxColSeries)->first();
            if ($accessPc != null) {
                $user_ip = $accessPc->id;
            } else {
                $user_ip = null;
            }
        } else {
            $taxColSeries=$request->taxColSeries;
            $accessPc = DB::table('access_p_c_s')->where('serial_id', $request->taxColSeries)->first();
            if ($accessPc == null) {
                $ip_address = null;
            } else {
                $ip_address = $accessPc->id;
            }
            $user_ip = $ip_address;
        }

        $cashColTotal = 0.00;
        if($request->submitType == 'Cash Collection') {
            if ($request->editDate == null) {
                $reportDate = date('Y-m-d', strtotime($request->taxColSelectDateCash));
            } else {
                $reportDate = date('Y-m-d', strtotime($request->editDate));
            }
            $reportNumber = null;
            $accOfficer = null;
            $clientType = $request->taxColClientType;
            $receiptType = $request->taxColReceiptType;
            $series = $taxColSeries;
            $serialNumber = $request->serialNumber;
            $clientTypeRadio = $request->clientTypeRadio;
            $cashColTotal = $request->taxColTotal;
        } else if ($request->submitType == 'OPAG Collection') {
            if ($request->editDateOPAG == null) {
                $reportDate = date('Y-m-d', strtotime($request->taxColSelectDateOPAG));
            } else {
                $reportDate = date('Y-m-d', strtotime($request->editDateOPAG));
            }
            $reportNumber = $request->taxColReportNoOPAG;
            $accOfficer = $request->taxColAccountableOfficerOPAG;
            $clientType = null;
            $receiptType = $request->taxColReceiptType;
            $series = $taxColSeries;
            $serialNumber = null;
            $clientTypeRadio = null;
            $cashColTotal = $request->taxColTotalOPAG;
        } else if ($request->submitType == 'PVET Collection') {
            if ($request->editDatePVET == null) {
                $reportDate = date('Y-m-d', strtotime($request->taxColSelectDatePVET));
            } else {
                $reportDate = date('Y-m-d', strtotime($request->editDatePVET));
            }
            $reportNumber = $request->taxColReportNoPVET;
            $accOfficer = $request->taxColAccountableOfficerPVET;
            $clientType = null;
            $receiptType = $request->taxColReceiptType;
            $series = $taxColSeries;
            $serialNumber = null;
            $clientTypeRadio = null;
            $cashColTotal = $request->taxColTotalPVET;
        } else if ($request->submitType == 'PHO Collection') {
            if ($request->editDatePHO == null) {
                $reportDate = date('Y-m-d', strtotime($request->taxColSelectDatePHO));
            } else {
                $reportDate = date('Y-m-d', strtotime($request->editDatePHO));
            }
            
            $reportNumber = $request->taxColReportNoPHO;
            $accOfficer = $request->taxColAccountableOfficerPHO;
            $clientType = null;
            $receiptType = $request->taxColReceiptType;
            $series = $taxColSeries;
            $serialNumber = null;
            $clientTypeRadio = null;
            $cashColTotal = $request->taxColTotalPHO;
        }
        
        if ($serialNumber == null) {
            $check = LandTaxInfo::where('id', $request->taxColID)->first();
        } else {
            $check = LandTaxInfo::where('serial_number', $serialNumber)->first();
        }

        if ($request->editDate == null) {
            $editedDate = null;
        } else {
            $editedDate = Date('Y-m-d H:i', strtotime($request->editDate));
        }
        
        $landTaxInfo = '';
        if ($check) {
            $landTaxInfo = LandTaxInfo::find($check->id);
            $landTaxInfo->report_date = $reportDate;
            $landTaxInfo->report_number = $reportNumber;
            $landTaxInfo->receipt_type = $receiptType;
            $landTaxInfo->series_id = $series;
            $landTaxInfo->serial_number = $serialNumber;
            $landTaxInfo->dr_number = $request->endSG;
            $landTaxInfo->municipality_id = $request->taxColMunicipality;
            $landTaxInfo->barangay_id = $request->taxColBarangay;
            $landTaxInfo->client_type_radio = $clientTypeRadio;
            $landTaxInfo->accountable_officer = $accOfficer;
            $landTaxInfo->last_name = $request->taxColLastName;
            $landTaxInfo->first_name = $request->taxColFirstName;
            $landTaxInfo->middle_initial = $request->taxColMI;
            $landTaxInfo->business_name = $request->taxColBusinessName;
            $landTaxInfo->owner = $request->taxColOwner;
            $landTaxInfo->address = $request->taxColAddress;
            $landTaxInfo->client_type_id = $clientType;
            $landTaxInfo->lot_rental_id = $request->taxColRentalAutoID;
            $landTaxInfo->spouses = $request->taxColSpouses;
            $landTaxInfo->company = $request->taxColCompany;
            $landTaxInfo->trade_name_permittees = $request->taxColPermitteeTradeName;
            $landTaxInfo->permittee = $request->taxColPermittee;
            $landTaxInfo->trade_name_permit_fees = $request->taxColPermitFeesTradeName;
            $landTaxInfo->proprietor = $request->taxColProprietor;
            $landTaxInfo->bidders_business_name = $request->taxColBiddersBusinessName;
            $landTaxInfo->owner_representative = $request->taxColBiddersOwner;
            $landTaxInfo->sex = $request->taxColSex;
            $landTaxInfo->transact_type = $request->taxColTransaction;
            $landTaxInfo->bank_name = $request->taxColBank;
            $landTaxInfo->number = $request->taxColNumber;
            $landTaxInfo->transact_date = $request->taxColTransactDate;
            $landTaxInfo->bank_remarks = $request->taxColBankRemarksCash;
            $landTaxInfo->receipt_remarks = $request->receiptRemarksCash;
            $landTaxInfo->certificate = $request->taxColCert;
            $landTaxInfo->total_amount = $cashColTotal;
            $landTaxInfo->status = "Saved";
            $landTaxInfo->submission_type = $request->submitType;
            $landTaxInfo->sharing_status = $request->taxColPermitteeSharing;
            $landTaxInfo->date_edited = $editedDate;
            $landTaxInfo->role = $request->taxColRole;
            $landTaxInfo->role_created = $roleDate;
            $landTaxInfo->save();
        } else {
            $landTaxInfo = new LandTaxInfo;
            $landTaxInfo->report_date = $reportDate;
            $landTaxInfo->report_number = $reportNumber;
            $landTaxInfo->user_ip = $user_ip;
            $landTaxInfo->receipt_type = $receiptType;
            $landTaxInfo->series_id = $series;
            $landTaxInfo->serial_number = $serialNumber;
            $landTaxInfo->dr_number = $request->endSG;
            $landTaxInfo->municipality_id = $request->taxColMunicipality;
            $landTaxInfo->barangay_id = $request->taxColBarangay;
            $landTaxInfo->client_type_radio = $clientTypeRadio;
            $landTaxInfo->accountable_officer = $accOfficer;
            $landTaxInfo->last_name = $request->taxColLastName;
            $landTaxInfo->first_name = $request->taxColFirstName;
            $landTaxInfo->middle_initial = $request->taxColMI;
            $landTaxInfo->business_name = $request->taxColBusinessName;
            $landTaxInfo->owner = $request->taxColOwner;
            $landTaxInfo->address = $request->taxColAddress;
            $landTaxInfo->client_type_id = $clientType;
            $landTaxInfo->lot_rental_id = $request->taxColRentalAutoID;
            $landTaxInfo->spouses = $request->taxColSpouses;
            $landTaxInfo->company = $request->taxColCompany;
            $landTaxInfo->trade_name_permittees = $request->taxColPermitteeTradeName;
            $landTaxInfo->permittee = $request->taxColPermittee;
            $landTaxInfo->trade_name_permit_fees = $request->taxColPermitFeesTradeName;
            $landTaxInfo->proprietor = $request->taxColProprietor;
            $landTaxInfo->bidders_business_name = $request->taxColBiddersBusinessName;
            $landTaxInfo->owner_representative = $request->taxColBiddersOwner;
            $landTaxInfo->sex = $request->taxColSex;
            $landTaxInfo->transact_type = $request->taxColTransaction;
            $landTaxInfo->bank_name = $request->taxColBank;
            $landTaxInfo->number = $request->taxColNumber;
            $landTaxInfo->transact_date = $request->taxColTransactDate;
            $landTaxInfo->bank_remarks = $request->taxColBankRemarksCash;
            $landTaxInfo->receipt_remarks = $request->receiptRemarksCash;
            $landTaxInfo->certificate = $request->taxColCert;
            $landTaxInfo->total_amount = $cashColTotal;
            $landTaxInfo->status = "Saved";
            $landTaxInfo->submission_type = $request->submitType;
            $landTaxInfo->sharing_status = $request->taxColPermitteeSharing;
            $landTaxInfo->date_edited = $editedDate;
            $landTaxInfo->role = $request->taxColRole;
            $landTaxInfo->role_created = $roleDate;
            $landTaxInfo->save();
        }

        $info = $landTaxData::where('serial_number', $serialNumber)->first();
        $cashInfo = $landTaxData::where('report_number', $reportNumber)->first();
        $cashReset = new LandTaxAccount;
        $cashReset::where('info_id', $cashInfo->id)->delete();
        $land_tax_reset = new LandTaxAccount;
        $land_tax_reset::where('info_id', $info->id)->delete();
        
        $request->taxColAccount = array_filter($request->taxColAccount, function($value) {
            return $value != null;
        });

        foreach ($request->taxColAccount as $key=>$acc) {
            $i = $key;
            $subtitle = AccountSubtitles::where('subtitle', $request->taxColAccount[$i])->first();
            if ($subtitle != null) {
                $acc_title = AccountTitles::find($subtitle->title_id);
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = $subtitle->id;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            } else {
                $acc_title = AccountTitles::where('title_name', $request->taxColAccount[$i])->first();
                if ($acc_title == null) {
                }
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = null;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            }
            
            if ($info->serial_number != null) {
                $accountID = $info->id;
            } else {
                $accountID = $cashInfo->id;
            }
            
            $landTaxAccount = new LandTaxAccount;
            $landTaxAccount->info_id = $accountID;
            $landTaxAccount->quantity = str_replace(',', '', $request->taxColQuantity[$i]);
            $landTaxAccount->rate_type = $request->taxColTypeRate[$i];
            $landTaxAccount->account = $request->taxColAccount[$i];
            if ($request->taxColNature[0] != null || $request->taxColNature[1] != null || $request->taxColNature[2] != null || $request->taxColNature[3] != null) {
                $landTaxAccount->nature = $request->taxColNature[$i];
            }
            $landTaxAccount->acc_category_id = $acc_category_id;
            $landTaxAccount->acc_title_id = $acc_title_id;
            $landTaxAccount->sub_title_id = $acc_subtitle_id;
            $landTaxAccount->amount = str_replace(',', '', $request->taxColAmount[$i]);
            $landTaxAccount->save();
        }
        
        if ($request->taxColSeries == null) {
            $taxSeries = $request->taxColSeries;
        } else {
            $taxSeries = $request->taxColSeries;
        }
        
        $latestSerial = LandTaxInfo::select('series_id', 'serial_number')->where('series_id', $taxSeries)->latest('serial_number')->first();
        if ($latestSerial != null) {
            if ( $latestSerial->series_id != null) {
                $endSerial = Serial::select('id', 'start_serial', 'end_serial')->where('id', $latestSerial->series_id)->first();
                return ['latestSerial'=>$latestSerial->serial_number+1, 'currentSerial'=>$latestSerial->serial_number, 'startSerial'=>$endSerial->start_serial, 'endSerial'=>$endSerial->end_serial, 'seriesID'=>$endSerial->id];
            }  
        }
        
    }

    public function deleteCashData(Request $request) {
        // $seriesUpdate = Serial::find($request->tcSeries);
        // $seriesUpdate->status = 'Active';
        // $seriesUpdate->save();
        // $accessPC = new LandTaxInfo;
        $deletedData = LandTaxInfo::where('id',$request->id)->update([
            'deleted_at' => now()
        ]);

        // $returnSeries = Serial::select()->where()->get();

        $returnData = [
            'serial' => $request->serialNum,
            'seriesId' => $request->tcSeries
        ];
        return $returnData;
    }

    public function deleteHospitalData(Request $request) {
        $deletedData = DistrictHospitalsCollections::where('id',$request->id)->forceDelete();
    }

    public function updateReceiptStatusCash(Request $request) {
        $landTaxInfo = LandTaxInfo::find($request->id);
        $hospital = DistrictHospitalsCollections::find($request->id);
        if ($request->status != null) {
            if ($landTaxInfo->status == 'Saved') {
                $landTaxInfo->status = 'Cancelled';
            } else {
                $landTaxInfo->status = 'Saved';
            }
            $landTaxInfo->save();
        }
        if ($request->hos_status != null) {
            if ($request->hos_status == 'Saved') {
                $hospital->cash_status = "Cancelled";
                $hospital->save();
            } else {
                $hospital->cash_status = "Saved";
                $hospital->save();
            }
            
        }
        
        $message = 'Status Updated';
        return $message;
    }

    public function getIndividualsLastNameCash(Request $request) {
        $individuals = DB::table('land_tax_infos')->select('last_name AS value', 'first_name AS firstName', 'middle_initial AS middleInitial', 'sex', DB::raw('CONCAT(last_name, ", ", first_name, " ", middle_initial) AS preview'))
        ->where([['last_name', 'like', '%'.$request->term.'%'], ['submission_type', 'Cash Collection']])
        ->limit(10)
        ->get();

        return $individuals;
    }

    public function getIndividualsFirsttNameCash(Request $request) {
        $individuals = DB::table('land_tax_infos')->select('last_name AS lastName', 'first_name AS value', 'middle_initial AS middleInitial', 'sex', DB::raw('CONCAT(last_name, ", ", first_name, " ", middle_initial) AS preview'))
        ->where([['first_name', 'like', '%'.$request->term.'%'], ['submission_type', 'Cash Collection']])
        ->limit(10)
        ->get();

        return $individuals;
    }

    function getAccountTitlesCash(Request $request) {
        if ($request->municipality == null || $request->municipality == '' || $request->municipality != '') {
            $accData = DB::table('account_titles')->select('title_name AS title', 'title_name AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
            ->where('title_name', 'Other Service Income (General Fund-Proper)')
            ->orWhere('title_name', 'Other Business Income (General Fund-Proper)')
            ->orWhere('title_name', 'Tax on Sand, Gravel & Other Quarry Prod.')
            ->orWhere('title_name', 'Non-Income Collection (GF-LA)')
            ->orWhere('title_name', 'Non-Income Collection')
            ->orWhere('title_name', 'Professional Tax')
            ->orWhere('title_name', 'Permit Fees')
            ->orWhere('title_name', 'Real Property Tax-Basic (Net of Discount)')
            ->orWhereRaw('title_name = "Tax on Sand, Gravel & Other Quarry Prod."')
            ->orWhereRaw('title_name = "Tax Revenue - Fines & Penalties - on Individual (PTR)"')
            ->orWhereRaw('title_name = "Tax Revenue - Fines & Penalties - Real Property Tax (SEF)"')
            ->orWhereRaw('title_name = "Tax Revenue - Fines & Penalties - Goods & Services"')
            ->orWhereRaw('title_name = "Gain on Sale of Property, Plant & Equipment"')
            ->orWhereRaw('title_name = "Other Taxes (Mining Claims)"')
            ->orWhereRaw('title_name = "Miscellaneous Income (SEF)"')
            ->orWhereRaw('title_name = "Miscellaneous Income (General Fund-Proper)"')
            ->orWhereRaw('title_name = "Interest Income (SEF)"')
            ->orWhereRaw('title_name = "Interest Income (General Fund-Proper)"')
            ->orWhereRaw('title_name = "Special Education Fund"')
            ->leftJoin('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
            ->get();
        }
        //  else {
        //     $accData = DB::table('account_titles')->select('title_name AS title', 'title_name AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        //     ->leftJoin('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        //     ->whereRaw('title_name = "Professional Tax" AND '.$request->municipality.' IS NOT NULL')
        //     ->orWhereRaw('title_name = "Permit Fees" AND '.$request->municipality.' IS NOT NULL')
        //     ->orWhereRaw('title_name = "Real Property Tax-Basic (Net of Discount)" AND '.$request->municipality.' IS NOT NULL')
        //     ->orWhereRaw('title_name = "Tax on Sand, Gravel & Other Quarry Prod." AND '.$request->municipality.' IS NOT NULL')
        //     ->orWhereRaw('title_name = "Tax Revenue - Fines & Penalties - Real Property Taxes" AND '.$request->municipality.' IS NOT NULL')
        //     ->orWhereRaw('title_name = "Tax Revenue - Fines & Penalties - Goods & Services" AND '.$request->municipality.' IS NOT NULL')
        //     ->orWhereRaw('title_name = "Gain on Sale of Property, Plant & Equipment" AND '.$request->municipality.' IS NOT NULL')
        //     ->limit(10)
        //     ->get();
        // }
        

        $accSubData = DB::table('account_subtitles')->select('subtitle AS title', 'subtitle AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->leftJoin('collection_rates', 'collection_rates.acc_subtitles_id', 'account_subtitles.id')
        ->where('office_code', 'CASH')
        ->orderBy('subtitle')
        ->limit(5)
        ->get();
        
        $displayArray = array_merge($accData->toArray(), $accSubData->toArray());
        return ($displayArray);
    }

    function getAccountTitlesOpag(Request $request) {
        $accData = DB::table('account_titles')->select('title_name AS title', 'title_name AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->join('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        ->where('title_name', 'Other Business Income (General Fund-Proper)')
        ->orWhere('title_name', 'Gain on Sale of Biological Assets')
        ->limit(10)
        ->get();

        $accSubData = DB::table('account_subtitles')
        ->select('subtitle AS title', 'subtitle AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->leftJoin('collection_rates', 'collection_rates.acc_subtitles_id', 'account_subtitles.id')
        ->where('office_code', 'OPAG')
        ->orderBy('subtitle', 'desc')
        ->limit(5)
        ->get();
        
        $displayArray = array_merge($accData->toArray(), $accSubData->toArray());

        return ($displayArray);
    }

    function getAccountTitlesPvet(Request $request) {
        $accData = DB::table('account_titles')->select('title_name AS title', 'title_name AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->leftJoin('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        ->where('title_name', 'Sup & Reg. Enf Fees (Animal Quarantine Fees)')
        ->orWhere('title_name', 'like', 'Clearance & Certification Fees (General Fund-Proper)')
        ->orWhere('title_name', 'like', 'Fines & Penalties - Service Income (General Fund-Proper)')
        ->limit(10)
        ->get();

        $accSubData = DB::table('account_subtitles')
        ->select('subtitle AS title', 'subtitle AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->leftJoin('collection_rates', 'collection_rates.acc_subtitles_id', 'account_subtitles.id')
        ->where('subtitle', 'Sales on Veterinary Products')
        ->orderBy('subtitle', 'desc')
        ->limit(5)
        ->get();

        $displayArray = array_merge($accData->toArray(), $accSubData->toArray());

        return ($displayArray);
    }

    function getAccountTitlesPho(Request $request) {
        $accData = DB::table('account_titles')->select('title_name AS title', 'title_name AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->join('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        ->where('title_name', 'Clearance & Certification Fees (General Fund-Proper)')
        ->limit(10)
        ->get();
        
        $accSubData = DB::table('account_subtitles')
        ->select('subtitle AS title', 'subtitle AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->leftJoin('collection_rates', 'collection_rates.acc_subtitles_id', 'account_subtitles.id')
        ->where('office_code', 'PHO')
        ->orderBy('subtitle', 'desc')
        ->limit(5)
        ->get();
        
        $displayArray = array_merge($accData->toArray(), $accSubData->toArray());

        return ($displayArray);
    }

    public function getCashReceiptData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table('land_tax_infos')
        ->select('land_tax_infos.id AS main_id', 'rentals.*', 'serials.*', 'access_p_c_s.*', 'access_p_c_s.id AS user_name', 'serial_s_g_s.*', 'municipalities.municipality AS mun_name', 'barangays.barangay_name AS bar_name', 'customer_types.*', 'customer_types.description_type AS client_types', 'land_tax_infos.*', 'land_tax_infos.created_at AS order')
        ->where('land_tax_infos.submission_type', 'Cash Collection')
        ->join('serials', 'land_tax_infos.series_id', 'serials.id')
        ->leftJoin('access_p_c_s', 'land_tax_infos.user_ip', 'access_p_c_s.id')
        ->leftJoin('municipalities', 'land_tax_infos.municipality_id', 'municipalities.id')
        ->leftJoin('barangays', 'land_tax_infos.barangay_id', 'barangays.id')
        ->join('customer_types', 'land_tax_infos.client_type_id', 'customer_types.id')
        ->leftJoin('serial_s_g_s', 'land_tax_infos.dr_id', 'serial_s_g_s.id')
        ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id');

        if($search!=null){
            $query=$query
            ->where([['land_tax_infos.deleted_at', null],['pc_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['assigned_ip','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['receipt_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['start_serial','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['serial_number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['owner','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['transact_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['certificate','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['municipalities.municipality','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['barangays.barangay_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['last_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['first_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['middle_initial','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['business_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['customer_types.description_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['sex','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['transact_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['bank_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['transact_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['bank_remarks','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['receipt_remarks','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['owner','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['spouses','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['company','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['client_type_radio','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.status','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['municipality_id','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['barangay_id','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['series_id','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['receipt_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['trade_name_permittees','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['permittee','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['trade_name_permit_fees','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['proprietor','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['bidders_business_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['owner_representative','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.created_at','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'CASH Collection']]);

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

    public function getOPAGReceiptData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table('land_tax_infos')
        ->select( 'land_tax_infos.*', 'land_tax_infos.id AS main_id', 'officers.name AS officer', 'land_tax_infos.created_at AS order')
        ->where('land_tax_infos.submission_type', 'OPAG Collection')
        ->leftJoin('officers', 'officers.id', 'land_tax_infos.accountable_officer');

        if($search!=null){
            $query=$query
            ->where([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'OPAG Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'OPAG Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'OPAG Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['total_amount','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'OPAG Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.created_at','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'OPAG Collection']]);

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

    public function getPVETReceiptData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table('land_tax_infos')
        ->select('land_tax_infos.id AS main_id', 'officers.name AS officer', 'land_tax_infos.*', 'land_tax_infos.created_at AS order')
        ->where('land_tax_infos.submission_type', 'PVET Collection')
        ->leftJoin('officers', 'officers.id', 'land_tax_infos.accountable_officer');

        if($search!=null){
            $query=$query
            ->where([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PVET Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PVET Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PVET Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['total_amount','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PVET Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.created_at','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PVET Collection']]);

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

    public function getPHOReceiptData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table('land_tax_infos')
        ->select('land_tax_infos.id AS main_id', 'officers.name AS officer', 'land_tax_infos.*', 'land_tax_infos.created_at AS order')
        ->where('land_tax_infos.submission_type', 'PHO Collection')
        ->leftJoin('officers', 'officers.id', 'land_tax_infos.accountable_officer');

        if($search!=null){
            $query=$query
            ->where([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PHO Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PHO Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PHO Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['total_amount','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PHO Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.created_at','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'PHO Collection']]);

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

    public function getHospitalReceiptData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table('district_hospitals_collections')
        ->select('*', 'district_hospitals_collections.id AS main_id', DB::raw('left_total AS total_amount'), 'district_hospitals_collections.created_at AS order', 'officers.name AS officer')
        ->leftJoin('officers', 'officers.id', 'district_hospitals_collections.acc_officer');

        if($search!=null){
            $query=$query
            ->where([['district_hospitals_collections.deleted_at', null],['r_date','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['r_no','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['district_hospital','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['acc_officer','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['cost_price','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['gain_from_sale','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['selling_price','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['med_supplies','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['hospital_fees','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['ambulance','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['prof_fees','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['cash','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['check','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['bank_deposit','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['ada_hc','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['ada_pc','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['left_total','like','%'.$search.'%']])
            ->orWhere([['district_hospitals_collections.deleted_at', null],['right_total','like','%'.$search.'%']]);

        } else {
            $query=$query->where('district_hospitals_collections.deleted_at', null);
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
            ->orderBy('district_hospitals_collections.created_at','desc');
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
