<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DistrictHospitalsCollections;

class DistrictHospitalController extends Controller
{
    
    public function submitDistrictHospitals(Request $request) {
        $check = DistrictHospitalsCollections::where('id', $request->districtID)->first();
        
        if ($check) {
            $hospital = DistrictHospitalsCollections::find($check->id);
            if ($request->editDateHos == null) {
                $hospital->r_date = date('Y-m-d H:i', strtotime($request->taxColSelectDateHos));
            } else {
                $hospital->r_date = date('Y-m-d H:i', strtotime($request->editDateHos));
            }
            $hospital->r_no = $request->taxColReportNoHos;
            $hospital->district_hospital = $request->taxColDistrictHos;
            $hospital->acc_officer = $request->taxColAccountableOfficerHos;
            $hospital->cost_price = str_replace(',', '', $request->taxColCostPriceHos);
            $hospital->gain_from_sale = str_replace(',', '', $request->taxColGainsHos);
            $hospital->selling_price = str_replace(',', '', $request->taxColSellingPriceHos);
            $hospital->med_supplies = str_replace(',', '', $request->taxColMedicalHos);
            $hospital->hospital_fees = str_replace(',', '', $request->taxColChargesHos);
            $hospital->ambulance = str_replace(',', '', $request->taxColAmublanceHos);
            $hospital->prof_fees = str_replace(',', '', $request->taxColPHICHos);
            $hospital->cash = str_replace(',', '', $request->taxColCashHos);
            $hospital->check = str_replace(',', '', $request->taxColCheckHos);
            $hospital->bank_branch = $request->taxColBankBranch;
            $hospital->bank_deposit = str_replace(',', '', $request->taxColDepositHos);
            $hospital->ada_hc = str_replace(',', '', $request->taxColHCHos);
            $hospital->ada_pc = str_replace(',', '', $request->taxColPCHos);
            $hospital->left_total = str_replace(',', '', $request->taxColAccountTotalHos);
            $hospital->right_total = str_replace(',', '', $request->taxColSummaryTotalHos);
            $hospital->cash_status = 'Saved';
            $hospital->save();
        } else {
            $hospital = new DistrictHospitalsCollections;
            if ($request->editDateHos == null) {
                $hospital->r_date = date('Y-m-d H:i', strtotime($request->taxColSelectDateHos));
            } else {
                $hospital->r_date = date('Y-m-d H:i', strtotime($request->editDateHos));
            }
            $hospital->r_no = str_replace(',', '', $request->taxColHCHos); 
            $hospital->r_no = $request->taxColReportNoHos;
            $hospital->district_hospital = $request->taxColDistrictHos;
            $hospital->acc_officer = $request->taxColAccountableOfficerHos;
            $hospital->cost_price = str_replace(',', '', $request->taxColCostPriceHos);
            $hospital->gain_from_sale = str_replace(',', '', $request->taxColGainsHos);
            $hospital->selling_price = str_replace(',', '', $request->taxColSellingPriceHos);
            $hospital->med_supplies = str_replace(',', '', $request->taxColMedicalHos);
            $hospital->hospital_fees = str_replace(',', '', $request->taxColChargesHos);
            $hospital->ambulance = str_replace(',', '', $request->taxColAmublanceHos);
            $hospital->prof_fees = str_replace(',', '', $request->taxColPHICHos);
            $hospital->cash = str_replace(',', '', $request->taxColCashHos);
            $hospital->check = str_replace(',', '', $request->taxColCheckHos);
            $hospital->bank_branch = $request->taxColBankBranch;
            $hospital->bank_deposit = str_replace(',', '', $request->taxColDepositHos);
            $hospital->ada_hc = str_replace(',', '', $request->taxColHCHos);
            $hospital->ada_pc = str_replace(',', '', $request->taxColPCHos);
            $hospital->left_total = str_replace(',', '', $request->taxColAccountTotalHos);
            $hospital->right_total = str_replace(',', '', $request->taxColSummaryTotalHos);
            $hospital->cash_status = 'Saved';
            $hospital->save();
        }
    }
}
