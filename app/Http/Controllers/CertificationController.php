<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\ProvincialPermit;
use App\Models\ProvinvialPermitArray;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    public function insertCertData(Request $request) {
        if ($request->certType == 'Sand & Gravel') {
            $request->validate([
                'certAddress' => 'required'
            ]);
        }

        $check = Certification::where('land_tax_info_id', $request->land_tax_info_id)->first();
        if ($check) {
            $certInfo = Certification::find($check->id);
            $certInfo->land_tax_info_id = $request->land_tax_info_id;
            $certInfo->cert_type = $request->certType;
            $certInfo->cert_date = $request->certDate;
            $certInfo->cert_prepared_by = $request->certPreparedBy;
            $certInfo->cert_signee = $request->certSignee;
            $certInfo->second_signee = $request->secondSignee;
            $certInfo->prov_governor = $request->provGovernor;
            $certInfo->cert_recipient = $request->certReipient;
            $certInfo->cert_address = $request->certAddress;
            $certInfo->cert_entries_from = $request->certEntriesFrom;
            $certInfo->cert_entries_to = $request->certEntriesTo;
            $certInfo->cert_details = $request->certDetailsFinal;
            $certInfo->notary_public = $request->certNotaryFinal;
            $certInfo->ptr_number = $request->ptrNumber;
            $certInfo->doc_number = $request->docNumber;
            $certInfo->page_number = $request->pageNumber;
            $certInfo->book_number = $request->bookNumber;
            $certInfo->cert_series = $request->certSeries;
            $certInfo->ref_num = $request->refNumber;
            // $certInfo->sg_processed = $request->sgProcessed;
            $certInfo->sg_crushed_sand = $request->sgCrushedSand;
            $certInfo->sg_crushed_gravel = $request->sgCrushedGravel;
            $certInfo->agg_basecourse = $request->aggBaseCourse;
            $certInfo->less_sandandgravel = $request->lessSandAndGravel;
            $certInfo->less_boulders = $request->lessBoulders;
            $certInfo->prov_certclearance = $request->provCertClearance;
            $certInfo->prov_certtype = $request->provCertType;
            $certInfo->prov_certbidding = $request->provCertBidding;
            $certInfo->save();
        } else {
            $certInfo = new Certification;
            $certInfo->land_tax_info_id = $request->land_tax_info_id;
            $certInfo->cert_type = $request->certType;
            $certInfo->cert_date = $request->certDate;
            $certInfo->cert_prepared_by = $request->certPreparedBy;
            $certInfo->cert_signee = $request->certSignee;
            $certInfo->second_signee = $request->secondSignee;
            $certInfo->prov_governor = $request->provGovernor;
            $certInfo->cert_recipient = $request->certReipient;
            $certInfo->cert_address = $request->certAddress;
            $certInfo->cert_entries_from = $request->certEntriesFrom;
            $certInfo->cert_entries_to = $request->certEntriesTo;
            $certInfo->cert_details = $request->certDetailsFinal;
            $certInfo->notary_public = $request->certNotaryFinal;
            $certInfo->ptr_number = $request->ptrNumber;
            $certInfo->doc_number = $request->docNumber;
            $certInfo->page_number = $request->pageNumber;
            $certInfo->book_number = $request->bookNumber;
            $certInfo->cert_series = $request->certSeries;
            $certInfo->ref_num = $request->refNumber;
            // $certInfo->sg_processed = $request->sgProcessed;
            $certInfo->sg_crushed_sand = $request->sgCrushedSand;
            $certInfo->sg_crushed_gravel = $request->sgCrushedGravel;
            $certInfo->agg_basecourse = $request->aggBaseCourse;
            $certInfo->less_sandandgravel = $request->lessSandAndGravel;
            $certInfo->less_boulders = $request->lessBoulders;
            $certInfo->prov_certclearance = $request->provCertClearance;
            $certInfo->prov_certtype = $request->provCertType;
            $certInfo->prov_certbidding = $request->provCertBidding;
            $certInfo->save();
        }

        $getCert = $certInfo::where('certifications.id', $request->certID)->first();
        $permitInfoArray = new ProvinvialPermitArray;
        $permitReset = $permitInfoArray::where('prov_cert_id', $request->certID)->delete();
        // dd($request->provFeeCharge);
        if ($request->provFeeCharge == null) {
            
        } else {
            for($i=0; $i<count($request->provFeeCharge); $i++){
                if ($request->provFeeCharge[$i] != null) {
                    $provPermit = new ProvinvialPermitArray;
                    $provPermit->prov_cert_id = $request->certID;
                    $provPermit->prov_feecharge = $request->provFeeCharge[$i];
                    $provPermit->prov_amount = $request->provAmount[$i];
                    $provPermit->prov_ornumber = $request->provORNumber[$i];
                    $provPermit->prov_date = $request->provDate[$i];
                    $provPermit->prov_initials = $request->provInitials[$i];
                    $provPermit->save();
                }
            }
        }
        return $certInfo->id;
    }    

    public function getCertificateDetails(Request $request) {
        $displayCert = DB::table('certifications')
        ->select('certifications.*', 'provincial_permit_arrays.*')
        ->where('land_tax_info_id', $request->id)
        ->leftJoin('provincial_permit_arrays', 'provincial_permit_arrays.prov_cert_id', 'certifications.id')
        ->get();
        return ($displayCert);
    }
}
