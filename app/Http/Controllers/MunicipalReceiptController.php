<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\MunicipalReceipts;
use App\Models\AccountGroup;
use App\Models\LandTaxAccount;
use App\Models\AccountTitles;
use App\Models\AccountSubtitles;

class MunicipalReceiptController extends Controller
{
    public function setMunicipalReceipts(Request $request) 
    {
        $municipalReceipts = new MunicipalReceipts;
        $cmp = false;

        date_default_timezone_set("Asia/Hong_Kong");
        $current_date = date('Y-m-d', strtotime($request->munReceiptDate));
        //find clicked id on edit for updating that specific data
        $createMunReceipts = MunicipalReceipts::create([
            'id'=>$request->munReceiptsID, 'mun_receipt_date'=>$current_date, 'mun_receipt_no'=>$request->munReceiptNo, 'mun_client_type_id'=>$request->munReceiptClientType, 'mun_municipality_id'=>$request->munReceiptMunicipality, 'mun_barangay_id'=>$request->munReceiptBarangay, 'mun_client_type_radio'=>$request->clientTypeRadio, 'mun_last_name'=>$request->munReceiptLastName,  'mun_first_name'=>$request->munReceiptFirstName, 'mun_middle_initial'=>$request->munReceiptMI, 'mun_business_name'=>$request->munReceiptBusinessName, 'mun_owner'=>$request->munReceiptOwner, 'mun_address'=>$request->munReceiptAddress, 'mun_trade_name_permittees'=>$request->munReceiptPermitteeTradeName, 'mun_permittee'=>$request->munReceiptPermittee, 'mun_trade_name_permit_fees'=>$request->munReceiptPermitFeesTradeName, 'mun_proprietor'=>$request->munReceiptProprietor, 'mun_bidders_business_name'=>$request->munReceiptBiddersBusinessName, 'mun_owner_representative'=>$request->munReceiptBiddersOwner, 'mun_spouses'=>$request->munReceiptSpouses, 'mun_company'=>$request->munReceiptCompany, 'mun_sex'=>$request->munReceiptSex, 'mun_transact_type'=>$request->munReceiptTransaction, 'mun_bank_name'=>$request->munReceiptBank, 'mun_number'=>$request->munReceiptNumber, 'mun_transact_date'=>$request->munReceiptTransactDate, 'mun_bank_remarks'=>$request->bankRemarks, 'mun_receipt_remarks'=>$request->munReceiptRemarks, 'mun_certificate'=>$request->munReceiptCert, 'mun_total_amount'=>$request->munReceiptTotal
        ]);
        
        $info = $municipalReceipts::where('id', $createMunReceipts->id)->first();
        $land_tax_reset = new LandTaxAccount;
        $land_tax_reset::where('mun_receipts_id', $info->id)->delete();
        
        for($i=0; $i<count($request->munReceiptAccount); $i++) {
            if ($request->munReceiptNature[$i] == null) {
                $cmp = true;
            }
            $subtitle = AccountSubtitles::where('subtitle', $request->munReceiptAccount[$i])->first();
            if ($subtitle != null) {
                $acc_title = AccountTitles::find($subtitle->title_id);
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = $subtitle->id;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            } else {
                $acc_title = AccountTitles::where('title_name', $request->munReceiptAccount[$i])->first();
                $acc_group = AccountGroup::find($acc_title->title_category_id);
                $acc_subtitle_id = null;
                $acc_title_id = $acc_title->id;
                $acc_category_id = $acc_group->category_id;
            }
            $landTaxAccount = new LandTaxAccount;
            $landTaxAccount->mun_receipts_id = $info->id;
            $landTaxAccount->quantity = $request->munReceiptQuantity[$i];
            $landTaxAccount->rate_type = $request->munReceiptTypeRate[$i];
            $landTaxAccount->account = $request->munReceiptAccount[$i];
            $landTaxAccount->acc_category_id = $acc_category_id;
            $landTaxAccount->acc_title_id = $acc_title_id;
            $landTaxAccount->sub_title_id = $acc_subtitle_id;
            $landTaxAccount->nature = $request->munReceiptNature[$i];
            $landTaxAccount->amount = str_replace(',', '', $request->munReceiptAmount[$i]);
            $landTaxAccount->save();
        }

        $message = 'Data Saved Succesfuly';
        return back()->withInput()->with('Message', $message);
    }

    public function updateMunicipalReceipts(Request $request)
    {
        dd($request);
        $municipalReceipts = new MunicipalReceipts;
        $getMunicipalReceipts = $municipalReceipts::find($request->munReceiptsID);
        dd($getMunicipalReceipts);
    }

    public function deleteMunicipalReceipts(Request $request)
    {
        $deleteData = MunicipalReceipts::where('id',$request->munReceiptsID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }
}
