<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandTaxCol;
use Illuminate\Support\Facades\DB;
use App\Models\LandTaxInfo;
use App\Models\LandTaxAccount;
use App\Models\AccountGroup;
use App\Models\AccountTitles;
use App\Models\AccountSubtitles;
use App\Models\Serial;
use App\Models\SerialSG;
use App\Models\SpecialCase;
use App\Models\SandGravelPermittees;
use App\Models\SpecialPermittees;
use App\Models\Barangay;
use App\Models\Holidays;

class LandTaxColController extends Controller
{
    public function insertLandTax(Request $request) 
    {
        if ($request->startSG == null) {
            $serialID = null;
        } else {
            $serialID = SerialSG::select('id')->where('start_serial_sg', '=', $request->startSG)->first()->id;
        }
        
        $landTaxData = new LandTaxInfo;
        $cmp = false;
        
        for($i=0; $i<count($request->taxColAccount); $i++){
            if ($request->taxColAccount[$i] == null) {
                return back()->with('Message', 'Missing Value in "Account" input field');
            }

            if ($request->taxColNature[$i] == null) {
                return back()->with('Message', 'Missing Value in "Nature" input field');
            }
        }
        date_default_timezone_set("Asia/Hong_Kong");

        $cutoff = DB::table('cut_offs')->orderBy('id', 'desc')->first();
        $today = Date('Y-m-d');
        $day = Date('D');
        $selectedYear = Date('Y', strtotime('+1 year', strtotime($request->editDate)));
        $oneYear= Date('Y', strtotime('+1 year'));
        $dateEdited = Date('Y-m-d', strtotime($request->editDate));
        $daySelected = Date('D', strtotime($request->editDate));
        $acDate = Date('Y-m-d H:i', strtotime($oneYear."-01-03 8:00:00"));
        $editAcDate = Date('Y-m-d H:i', strtotime($selectedYear."-01-05 8:00:00"));

        if ($request->taxColID == null) {
            $now = now();
            if (strtotime(now()) >= strtotime($today.' '.$cutoff->collection_cutoff)) {
                $current_date = Date('Y-m-d H:i', strtotime($today. '+ 1 day'));
            } else {
                $current_date = Date('Y-m-d H:i', strtotime($today));
            }

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
        } else {
            if ($daySelected == 'Fri') {
                if (strtotime($request->editDate) >= strtotime($today.' '.$cutoff->collection_cutoff)) {
                    $current_date = Date('Y-m-d H:i', strtotime($request->editDate. '+ 3 days'));
                } else if (strtotime($request->editDate) >= strtotime($dateEdited.' '.$cutoff->collection_cutoff)) {
                    $current_date = Date('Y-m-d H:i', strtotime($request->editDate. '+ 3 day'));
                } else {
                    $current_date = Date('Y-m-d H:i', strtotime($request->editDate));
                }
            } else {
                if (strtotime($request->editDate) >= strtotime($today.' '.$cutoff->collection_cutoff)) {
                    $current_date = Date('Y-m-d H:i', strtotime($request->editDate. '+ 1 day'));
                } else if (strtotime($request->editDate) >= strtotime($dateEdited.' '.$cutoff->collection_cutoff)) {
                    $current_date = Date('Y-m-d H:i', strtotime($request->editDate. '+ 1 day'));
                } else {
                    $current_date = Date('Y-m-d H:i', strtotime($request->editDate));
                }
            }

            if ($request->taxColRole == 2) {
                if ($day == 'Sat') {
                    $current_date = Date('Y-m-d H:i', strtotime($editAcDate. '+ 2 day'));
                } else if ($day == 'Sun') {
                    $current_date = Date('Y-m-d H:i', strtotime($editAcDate. '+ 1 day'));
                } else {
                    $current_date = $editAcDate;
                }
                $roleDate = Date('Y-m-d H:i', strtotime($today));
            } else if ($request->taxColRole == 1) {
                if ($day == 'Sat') {
                    $roleDate = Date('Y-m-d H:i', strtotime($editAcDate. '+ 2 day'));
                } else if ($day == 'Sun') {
                    $roleDate = Date('Y-m-d H:i', strtotime($editAcDate. '+ 1 day'));
                } else {
                    $roleDate = $editAcDate;
                }
            } else {
                // $roleDate = Date('Y-m-d H:i', strtotime($editAcDate));
                $roleDate = null;
            }
        }

        if ($request->editDate == null) {
            $editedDate = null;
        } else {
            $editedDate = Date('Y-m-d H:i', strtotime($request->editDate));
        }
        
        if($request->taxColSeries===null){
            $existing_data=$landTaxData::find($request->taxColID);
            if ($request->taxColRole != 2) {
                $taxColSeries=$existing_data->series_id;
                $serialNumber=$request->serialNumber;
            } else {
                if ($existing_data == null) {
                    $taxColSeries=null;
                    $serialNumber=0;
                } else {
                    $taxColSeries=$existing_data->series_id;
                    $serialNumber=$request->serialNumber;
                }
            }
            $accessPc = DB::table('access_p_c_s')->where('serial_id', $request->taxColSeries)->first();
            if ($accessPc != null) {
                $user_ip = $accessPc->id;
            } else {
                $user_ip = null;
            }
        } else {
            $taxColSeries=$request->taxColSeries;
            $serialNumber=$request->serialNumber;
            $accessPc = DB::table('access_p_c_s')->where('serial_id', $request->taxColSeries)->first();
            if ($accessPc == null) {
                $ip_address = null;
            } else {
                $ip_address = $accessPc->id;
            }
            $user_ip = $ip_address;
        }
        
        if($request->submitType == 'Revenue Collection') {
            $submissionType = 'Revenue Collection';
        } else {
            $submissionType = 'Cash Collection';
        }
        
        $dayToday = date('D');
        $timeToday = date('H');
        
        if ($request->taxColRole != 2) {
            $check = LandTaxInfo::where('serial_number', $request->serialNumber)->first();
        } else {
            $check = LandTaxInfo::where('id', $request->taxColID)->first();
        }
        $landTaxInfo = '';
        DB::beginTransaction();

        $yearOfHoliday = date('Y');
        $holidays = Holidays::select('date_of_holiday', 'holiday_name')->whereYear('date_of_holiday', $yearOfHoliday)->get();
        foreach ($holidays as $hol) {
            if (date('Y-m-d', strtotime($current_date)) == $hol->date_of_holiday) {
                if (date('D', strtotime($hol->date_of_holiday)) == 'Fri') {
                    $current_date = date('Y-m-d', strtotime($current_date. '+ 3 day'));
                } else if (date('D', strtotime($hol->date_of_holiday)) == 'Mon') {
                    $current_date = date('Y-m-d', strtotime($current_date. '+ 1 day'));
                } else {
                    $current_date = date('Y-m-d', strtotime($current_date. '+ 1 day'));
                }
            }
        }

        if ($check) {
            $landTaxInfo = LandTaxInfo::find($check->id);
            if ($dayToday == 'Fri') {
                if ($timeToday >= 12) {
                    if ($request->editDate == null) {
                        $addToDate = Date('Y-m-d', strtotime($dayToday. "+3 days"));
                        $landTaxInfo->report_date = $addToDate;
                    } else {
                        $landTaxInfo->report_date = $current_date;
                    }
                    // $landTaxInfo->user_ip = $user_ip;
                    $landTaxInfo->receipt_type = $request->taxColReceiptType;
                    $landTaxInfo->series_id = $taxColSeries;
                    $landTaxInfo->serial_number = $serialNumber;
                    $landTaxInfo->dr_id = $serialID;
                    $landTaxInfo->dr_number = $request->endSG;
                    $landTaxInfo->municipality_id = $request->taxColMunicipality;
                    $landTaxInfo->barangay_id = $request->taxColBarangay;
                    $landTaxInfo->client_type_radio = $request->clientTypeRadio;
                    $landTaxInfo->last_name = $request->taxColLastName;
                    $landTaxInfo->first_name = $request->taxColFirstName;
                    $landTaxInfo->middle_initial = $request->taxColMI;
                    $landTaxInfo->business_name = $request->taxColBusinessName;
                    $landTaxInfo->owner = $request->taxColOwner;
                    $landTaxInfo->address = $request->taxColAddress;
                    $landTaxInfo->client_type_id = $request->taxColClientType;
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
                    $landTaxInfo->bank_remarks = $request->bankRemarksRevenue;
                    $landTaxInfo->receipt_remarks = $request->receiptRemarksRevenue;
                    $landTaxInfo->certificate = $request->taxColCert;
                    $landTaxInfo->total_amount = $request->taxColTotal;
                    $landTaxInfo->status = $request->printStatus;
                    $landTaxInfo->role = $request->taxColRole;
                    $landTaxInfo->submission_type = $submissionType;
                    $landTaxInfo->sharing_status = $request->taxColPermitteeSharing;
                    $landTaxInfo->date_edited = $editedDate;
                    $landTaxInfo->role_created = $roleDate;
                    $landTaxInfo->save();
                } else {
                    $landTaxInfo->report_date = $current_date;
                    // $landTaxInfo->user_ip = $user_ip;
                    $landTaxInfo->receipt_type = $request->taxColReceiptType;
                    $landTaxInfo->series_id = $taxColSeries;
                    $landTaxInfo->serial_number = $serialNumber;
                    $landTaxInfo->dr_id = $serialID;
                    $landTaxInfo->dr_number = $request->endSG;
                    $landTaxInfo->municipality_id = $request->taxColMunicipality;
                    $landTaxInfo->barangay_id = $request->taxColBarangay;
                    $landTaxInfo->client_type_radio = $request->clientTypeRadio;
                    $landTaxInfo->last_name = $request->taxColLastName;
                    $landTaxInfo->first_name = $request->taxColFirstName;
                    $landTaxInfo->middle_initial = $request->taxColMI;
                    $landTaxInfo->business_name = $request->taxColBusinessName;
                    $landTaxInfo->owner = $request->taxColOwner;
                    $landTaxInfo->address = $request->taxColAddress;
                    $landTaxInfo->client_type_id = $request->taxColClientType;
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
                    $landTaxInfo->bank_remarks = $request->bankRemarksRevenue;
                    $landTaxInfo->receipt_remarks = $request->receiptRemarksRevenue;
                    $landTaxInfo->certificate = $request->taxColCert;
                    $landTaxInfo->total_amount = $request->taxColTotal;
                    $landTaxInfo->status = $request->printStatus;
                    $landTaxInfo->role = $request->taxColRole;
                    $landTaxInfo->submission_type = $submissionType;
                    $landTaxInfo->sharing_status = $request->taxColPermitteeSharing;
                    $landTaxInfo->date_edited = $editedDate;
                    $landTaxInfo->role_created = $roleDate;
                    $landTaxInfo->save();
                }
            } else {
                $landTaxInfo->report_date = $current_date;
                // $landTaxInfo->user_ip = $user_ip;
                $landTaxInfo->receipt_type = $request->taxColReceiptType;
                $landTaxInfo->series_id = $taxColSeries;
                $landTaxInfo->serial_number = $serialNumber;
                $landTaxInfo->dr_id = $serialID;
                $landTaxInfo->dr_number = $request->endSG;
                $landTaxInfo->municipality_id = $request->taxColMunicipality;
                $landTaxInfo->barangay_id = $request->taxColBarangay;
                $landTaxInfo->client_type_radio = $request->clientTypeRadio;
                $landTaxInfo->last_name = $request->taxColLastName;
                $landTaxInfo->first_name = $request->taxColFirstName;
                $landTaxInfo->middle_initial = $request->taxColMI;
                $landTaxInfo->business_name = $request->taxColBusinessName;
                $landTaxInfo->owner = $request->taxColOwner;
                $landTaxInfo->address = $request->taxColAddress;
                $landTaxInfo->client_type_id = $request->taxColClientType;
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
                $landTaxInfo->bank_remarks = $request->bankRemarksRevenue;
                $landTaxInfo->receipt_remarks = $request->receiptRemarksRevenue;
                $landTaxInfo->certificate = $request->taxColCert;
                $landTaxInfo->total_amount = $request->taxColTotal;
                $landTaxInfo->status = $request->printStatus;
                $landTaxInfo->role = $request->taxColRole;
                $landTaxInfo->submission_type = $submissionType;
                $landTaxInfo->sharing_status = $request->taxColPermitteeSharing;
                $landTaxInfo->date_edited = $editedDate;
                $landTaxInfo->role_created = $roleDate;
                $landTaxInfo->save();
            }
            
            if ($request->taxColPermitteeSharing != null) {
                $municipalityBarangay = Barangay::selectRaw('CONCAT(municipality, "-", barangay_name) AS name')->where('barangays.id', $request->taxColBarangay)->join('municipalities', 'municipalities.id', 'barangays.mun_id')->first();
                $specialBarangay = SpecialCase::where('source_barangay', $municipalityBarangay->name)->first();
                
                if ($specialBarangay != null) {
                    $sandGravelPermittee = SandGravelPermittees::where('permittee', $request->taxColPermittee)->first();
                    $specialPermittee = SpecialPermittees::where('permitee_id', $sandGravelPermittee->id)->exists();
                    if ($specialPermittee == false) {
                        SpecialPermittees::create([
                            'special_case_id' => $specialBarangay->id,
                            'permitee_id' => $sandGravelPermittee->id
                        ]);
                    }
                }
            }
        } else {
            $landTaxInfo = new LandTaxInfo;
            if ($dayToday == 'Fri') {
                if ($timeToday >= 12) {
                    $addToDate = Date('Y-m-d', strtotime($dayToday. "+3 days"));
                    $landTaxInfo->report_date = $addToDate;
                    $landTaxInfo->user_ip = $user_ip;
                    $landTaxInfo->receipt_type = $request->taxColReceiptType;
                    $landTaxInfo->series_id = $taxColSeries;
                    $landTaxInfo->serial_number = $serialNumber;
                    $landTaxInfo->dr_id = $serialID;
                    $landTaxInfo->dr_number = $request->endSG;
                    $landTaxInfo->municipality_id = $request->taxColMunicipality;
                    $landTaxInfo->barangay_id = $request->taxColBarangay;
                    $landTaxInfo->client_type_radio = $request->clientTypeRadio;
                    $landTaxInfo->last_name = $request->taxColLastName;
                    $landTaxInfo->first_name = $request->taxColFirstName;
                    $landTaxInfo->middle_initial = $request->taxColMI;
                    $landTaxInfo->business_name = $request->taxColBusinessName;
                    $landTaxInfo->owner = $request->taxColOwner;
                    $landTaxInfo->address = $request->taxColAddress;
                    $landTaxInfo->client_type_id = $request->taxColClientType;
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
                    $landTaxInfo->bank_remarks = $request->bankRemarksRevenue;
                    $landTaxInfo->receipt_remarks = $request->receiptRemarksRevenue;
                    $landTaxInfo->certificate = $request->taxColCert;
                    $landTaxInfo->total_amount = $request->taxColTotal;
                    $landTaxInfo->status = $request->printStatus;
                    $landTaxInfo->role = $request->taxColRole;
                    $landTaxInfo->submission_type = $submissionType;
                    $landTaxInfo->sharing_status = $request->taxColPermitteeSharing;
                    $landTaxInfo->date_edited = $editedDate;
                    $landTaxInfo->role_created = $roleDate;
                    $landTaxInfo->save();
                } else {
                    $landTaxInfo->report_date = $current_date;
                    $landTaxInfo->user_ip = $user_ip;
                    $landTaxInfo->receipt_type = $request->taxColReceiptType;
                    $landTaxInfo->series_id = $taxColSeries;
                    $landTaxInfo->serial_number = $serialNumber;
                    $landTaxInfo->dr_id = $serialID;
                    $landTaxInfo->dr_number = $request->endSG;
                    $landTaxInfo->municipality_id = $request->taxColMunicipality;
                    $landTaxInfo->barangay_id = $request->taxColBarangay;
                    $landTaxInfo->client_type_radio = $request->clientTypeRadio;
                    $landTaxInfo->last_name = $request->taxColLastName;
                    $landTaxInfo->first_name = $request->taxColFirstName;
                    $landTaxInfo->middle_initial = $request->taxColMI;
                    $landTaxInfo->business_name = $request->taxColBusinessName;
                    $landTaxInfo->owner = $request->taxColOwner;
                    $landTaxInfo->address = $request->taxColAddress;
                    $landTaxInfo->client_type_id = $request->taxColClientType;
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
                    $landTaxInfo->bank_remarks = $request->bankRemarksRevenue;
                    $landTaxInfo->receipt_remarks = $request->receiptRemarksRevenue;
                    $landTaxInfo->certificate = $request->taxColCert;
                    $landTaxInfo->total_amount = $request->taxColTotal;
                    $landTaxInfo->status = $request->printStatus;
                    $landTaxInfo->role = $request->taxColRole;
                    $landTaxInfo->submission_type = $submissionType;
                    $landTaxInfo->sharing_status = $request->taxColPermitteeSharing;
                    $landTaxInfo->date_edited = $editedDate;
                    $landTaxInfo->role_created = $roleDate;
                    $landTaxInfo->save();
                }
            } else {
                $landTaxInfo->report_date = $current_date;
                $landTaxInfo->user_ip = $user_ip;
                $landTaxInfo->receipt_type = $request->taxColReceiptType;
                $landTaxInfo->series_id = $taxColSeries;
                $landTaxInfo->serial_number = $serialNumber;
                $landTaxInfo->dr_id = $serialID;
                $landTaxInfo->dr_number = $request->endSG;
                $landTaxInfo->municipality_id = $request->taxColMunicipality;
                $landTaxInfo->barangay_id = $request->taxColBarangay;
                $landTaxInfo->client_type_radio = $request->clientTypeRadio;
                $landTaxInfo->last_name = $request->taxColLastName;
                $landTaxInfo->first_name = $request->taxColFirstName;
                $landTaxInfo->middle_initial = $request->taxColMI;
                $landTaxInfo->business_name = $request->taxColBusinessName;
                $landTaxInfo->owner = $request->taxColOwner;
                $landTaxInfo->address = $request->taxColAddress;
                $landTaxInfo->client_type_id = $request->taxColClientType;
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
                $landTaxInfo->bank_remarks = $request->bankRemarksRevenue;
                $landTaxInfo->receipt_remarks = $request->receiptRemarksRevenue;
                $landTaxInfo->certificate = $request->taxColCert;
                $landTaxInfo->total_amount = $request->taxColTotal;
                $landTaxInfo->status = $request->printStatus;
                $landTaxInfo->role = $request->taxColRole;
                $landTaxInfo->submission_type = $submissionType;
                $landTaxInfo->sharing_status = $request->taxColPermitteeSharing;
                $landTaxInfo->date_edited = $editedDate;
                $landTaxInfo->role_created = $roleDate;
                $landTaxInfo->save();
            }
            
            if ($request->taxColPermitteeSharing != null) {
                $municipalityBarangay = Barangay::selectRaw('CONCAT(municipality, "-", barangay_name) AS name')->where('barangays.id', $request->taxColBarangay)->join('municipalities', 'municipalities.id', 'barangays.mun_id')->first();
                $specialBarangay = SpecialCase::where('source_barangay', $municipalityBarangay->name)->first();
                
                if ($specialBarangay != null) {
                    $sandGravelPermittee = SandGravelPermittees::where('permittee', $request->taxColPermittee)->first();
                    $specialPermittee = SpecialPermittees::where('permitee_id', $sandGravelPermittee->id)->exists();
                    if ($specialPermittee == false) {
                        SpecialPermittees::create([
                            'special_case_id' => $specialBarangay->id,
                            'permitee_id' => $sandGravelPermittee->id
                        ]);
                    }
                }
            }
        }

        if ($landTaxInfo->report_date == '1970-01-01') {
            DB::rollback();
            return 'Something went wrong';
        }

        $info = $landTaxData::where('serial_number', $serialNumber)->first();
        $land_tax_reset = new LandTaxAccount;
        $land_tax_reset::where('info_id', $info->id)->delete();
        
        for($i=0; $i<count($request->taxColAccount); $i++) {
            if ($request->taxColNature[$i] == null) {
                $cmp = true;
            }
            $subtitle = AccountSubtitles::where('subtitle', $request->taxColAccount[$i])->first();
            if ($subtitle != null) {
                $acc_title = AccountTitles::find($subtitle->title_id);
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = $subtitle->id;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            } else {
                $acc_title = AccountTitles::where('title_name', $request->taxColAccount[$i])->first();
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = null;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            }
            $landTaxAccount = new LandTaxAccount;
            $landTaxAccount->info_id = $info->id;
            $landTaxAccount->quantity = str_replace(',', '', $request->taxColQuantity[$i]);
            $landTaxAccount->rate_type = $request->taxColTypeRate[$i];
            $landTaxAccount->account = $request->taxColAccount[$i];
            $landTaxAccount->acc_category_id = $acc_category_id;
            $landTaxAccount->acc_title_id = $acc_title_id;
            $landTaxAccount->sub_title_id = $acc_subtitle_id;
            $landTaxAccount->nature = $request->taxColNature[$i];
            $landTaxAccount->amount = str_replace(',', '', $request->taxColAmount[$i]);
            $landTaxAccount->save();
        }
        DB::commit();
        return $landTaxInfo->id;
    }

    public function openReceiptAction(Request $request) {
        $check = LandTaxInfo::where('serial_number', $request->serialNumber)->first();
        $landTaxInfo = LandTaxInfo::find($check->id);
        return $landTaxInfo->id;
    }


    public function updateReceiptStatus(Request $request) {
        $landTaxInfo = LandTaxInfo::find($request->id);
        if ($request->status == 'Printed' || $request->status == 'Not Printed') {
            $landTaxInfo->status = 'Cancelled';
        } else {
            $landTaxInfo->status = 'Printed';
        }
        $landTaxInfo->save();

        $message = 'Status updated';
        return $message;
    }

    public function updateToPrintedStatus(Request $request) {
        $landTaxInfo = LandTaxInfo::find($request->id);
        if ($request->status == 'Not Printed') {
            $landTaxInfo->status = 'Printed';
        }
        $landTaxInfo->save();
        
        return $landTaxInfo->status;
    }

    public function deleteLandTaxData(Request $request) {
        // $accessPC = new LandTaxInfo;
        $deletedData = LandTaxInfo::where('id',$request->taxColID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }

    public function getAccountsData(Request $request) {
        $acc_data = LandTaxAccount::where('info_id', $request->id)->get();
        return $acc_data;
    }

    public function updateSeriesStatus(Request $request) {
        $previousSerial = LandTaxInfo::select('start_serial', 'serial_number')
        ->where([['unit', 'Pad'], ['serials.status', 'Active']])
        ->whereNull('serials.assigned_office')
        ->orderBy('land_tax_infos.id', 'desc')
        ->leftJoin('serials', 'land_tax_infos.series_id', 'serials.id')
        ->first();
        
        $finishedSeries = Serial::where('end_serial', $request->serial)
        ->first();
        dd($request->serial);
        if ($finishedSeries != null) {
            $updateSeries = Serial::find($finishedSeries->id);
            $updateSeries->status = "Completed";
            $updateSeries->save();
        }
    }

    public function getSeries(Request $request) {
        $ip = request()->ip();
        if ($request->id == 'Land Tax Collection') {
            $serials = DB::table('access_p_c_s')
            ->select('serials.*', 'land_tax_infos.serial_number', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
            ->where([['assigned_ip', $ip], ['process_type', 'Land Tax Collection'], ['serials.status', 'Active'], ['unit', 'Continuous']])
            ->join('serials', 'access_p_c_s.serial_id', 'serials.id')
            ->join('posts', 'serials.fund_id', 'posts.id')
            ->leftJoin('land_tax_infos', 'land_tax_infos.user_ip', 'access_p_c_s.id')
            ->orderBy('serial_id', 'desc')
            ->get();
        } else {
            $serials = DB::table('serials')
            ->select('serials.*', 'land_tax_infos.serial_number', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
            ->where([['unit', 'Pad'], ['serials.status', 'Active']])
            ->whereNull('serials.assigned_office')
            ->join('posts', 'serials.fund_id', 'posts.id')
            ->leftJoin('land_tax_infos', 'land_tax_infos.series_id', 'serials.id')
            ->orderBy('serials.id', 'desc')
            ->groupBy('serials.start_serial')
            ->limit(70)
            ->get();
        }
        
        if (count($serials) == 0) {
            return 'No series found.';
        } else {
            $currentSerial = LandTaxInfo::where([['serial_number', '>=', $serials[0]->start_serial], ['serial_number', '<=', $serials[0]->end_serial]])
            ->orderBy('serial_number', 'desc')
            ->limit(1)
            ->first();

            $previousSerial = LandTaxInfo::select('start_serial', 'serial_number')
            ->where([['unit', 'Pad'], ['serials.status', 'Active']])
            ->whereNull('serials.assigned_office')
            ->orderBy('land_tax_infos.id', 'desc')
            ->leftJoin('serials', 'land_tax_infos.series_id', 'serials.id')
            ->first();
            
            if ($currentSerial != null) {
                if ($currentSerial->serial_number == $serials[0]->end_serial) {
                    $currentSerial = 'Serial Error';
                } else {
                    $currentSerial = $currentSerial->serial_number+1;
                }
            } else {
                $currentSerial = $serials[0]->start_serial;
            }

            return [$serials, $currentSerial, $previousSerial];
        }
    }
    
    public function getSeriesCash(Request $request) {
        $ip = request()->ip();
        if ($request->id == 'Field Land Tax Collection Cash') {
            $serials = DB::table('serials')
            ->select('serials.*', 'land_tax_infos.serial_number', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
            ->where([['unit', 'Pad'], ['serials.assigned_office', 'Cash'], ['serials.status', 'Active']])
            ->leftJoin('posts', 'serials.fund_id', 'posts.id')
            ->leftJoin('land_tax_infos', 'land_tax_infos.series_id', 'serials.id')
            ->orderBy('serials.id', 'desc')
            ->groupBy('serials.start_serial')
            ->limit(70)
            ->get();
        }
        
        $currentSerial = LandTaxInfo::where([['serial_number', '>=', $serials[0]->start_serial], ['serial_number', '<=', $serials[0]->end_serial]])
        ->orderBy('serial_number', 'desc')
        ->limit(1)
        ->first();
        
        $previousSerial = LandTaxInfo::select('start_serial', 'serial_number', 'assigned_office')
        ->where('assigned_office', 'Cash')   
        ->orderBy('land_tax_infos.id', 'desc')
        ->leftJoin('serials', 'land_tax_infos.series_id', 'serials.id')
        ->first();
        
        if ($currentSerial != null) {
            if ($currentSerial->serial_number == $serials[0]->end_serial) {
                $currentSerial = 'Serial Error';
            } else {
                $currentSerial = $currentSerial->serial_number+1;
            }
        } else {
            $currentSerial = $serials[0]->start_serial;
        }
        
        return [$serials, $currentSerial, $previousSerial];
    }

    public function getSeriesSG(Request $request) {
        $serialSG = DB::table('serial_s_g_s')
        ->select('*', DB::raw('CONCAT(start_serial_sg," - ", end_serial_sg ," (",serial_sg_type,")") AS delReceipt'))
        ->where('serial_s_g_s.status', 'Active')
        ->get();
        
        $currentOnDeckSG = LandTaxInfo::where([['dr_number', '>=', $serialSG[0]->start_serial_sg], ['dr_number', '<=', $serialSG[0]->end_serial_sg]])
        ->orderBy('dr_number', 'desc')
        ->limit(1)
        ->first();

        if ($currentOnDeckSG != null) {
            if ($currentOnDeckSG->dr_number == $serialSG[0]->end_serial_sg) {
                $currentOnDeckSG = 'Serial Error';
            } else {
                $currentOnDeckSG = $currentOnDeckSG->dr_number+1;
            }
        } else {
            $currentOnDeckSG = $serialSG[0]->start_serial_sg;
        }
        
        return [$serialSG, $currentOnDeckSG];
    }

    public function getIndividualsLastName(Request $request) {
        $individuals = DB::table('land_tax_infos')->select('last_name AS value', 'first_name AS firstName', 'middle_initial AS middleInitial', 'sex', DB::raw('CONCAT(last_name, ", ", first_name, " ", middle_initial) AS preview'))->where('last_name', 'like', '%'.$request->term.'%')->limit(10)->get();

        return $individuals;
    }

    public function getIndividualsFirsttName(Request $request) {
        $individuals = DB::table('land_tax_infos')->select('last_name AS lastName', 'first_name AS value', 'middle_initial AS middleInitial', 'sex', DB::raw('CONCAT(last_name, ", ", first_name, " ", middle_initial) AS preview'))->where('first_name', 'like', '%'.$request->term.'%')->limit(10)->get();

        return $individuals;
    }

    public function getReceiptData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table('land_tax_infos')
        ->select('land_tax_infos.id AS main_id', 'rentals.*', 'serials.*', 'access_p_c_s.*', 'access_p_c_s.id AS user_name', 'serial_s_g_s.*', 'municipalities.municipality AS mun_name', 'barangays.barangay_name AS bar_name', 'customer_types.*', 'customer_types.description_type AS client_types', 'land_tax_infos.*', 'land_tax_infos.status', 'land_tax_infos.created_at AS order')
        ->where('land_tax_infos.submission_type', 'Revenue Collection')
        ->join('serials', 'land_tax_infos.series_id', 'serials.id')
        ->leftJoin('access_p_c_s', 'land_tax_infos.user_ip', 'access_p_c_s.id')
        ->leftJoin('municipalities', 'land_tax_infos.municipality_id', 'municipalities.id')
        ->leftJoin('barangays', 'land_tax_infos.barangay_id', 'barangays.id')
        ->leftJoin('customer_types', 'land_tax_infos.client_type_id', 'customer_types.id')
        ->leftJoin('serial_s_g_s', 'land_tax_infos.dr_id', 'serial_s_g_s.id')
        ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id');

        if($search!=null){
            $query=$query
            ->where([['land_tax_infos.deleted_at', null],['pc_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['assigned_ip','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['receipt_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['start_serial','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['serial_number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['owner','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['transact_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['certificate','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['municipalities.municipality','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['barangays.barangay_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['last_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['first_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['middle_initial','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['business_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['customer_types.description_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['sex','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['transact_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['bank_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['number','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['transact_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['bank_remarks','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['receipt_remarks','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['owner','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['spouses','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['company','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['client_type_radio','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.status','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['municipality_id','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['barangay_id','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['series_id','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['receipt_type','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['trade_name_permittees','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['permittee','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['trade_name_permit_fees','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['proprietor','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['bidders_business_name','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['owner_representative','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.created_at','like','%'.$search.'%'], ['land_tax_infos.submission_type', 'Revenue Collection']]);

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
