<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandTaxAccount;
use App\Models\BankDetails;
use Illuminate\Support\Facades\DB;

class BankDetailsController extends Controller
{
    public function insertCheck (Request $request) {
        $check = BankDetails::where('bank_number', $request->taxColRowNumber)->first();
        if ($check) {
            $bank = BankDetails::find($check->id);
            $bank->bank_id = $request->bankRowId;
            $bank->bank_name = $request->taxColRowBank; 
            $bank->bank_number = $request->taxColRowNumber;
            $bank->bank_date = date('Y-m-d', strtotime($request->taxColRowTransactDate));
            $bank->bank_remarks = $request->taxColRowBankRemarks;
            $bank->serial_ref = $request->serailNumReference;
            $bank->save();
        } else {
            $bank = new BankDetails;
            $bank->bank_name = $request->taxColRowBank; 
            $bank->bank_number = $request->taxColRowNumber;
            $bank->bank_date = date('Y-m-d', strtotime($request->taxColRowTransactDate));
            $bank->bank_remarks = $request->taxColRowBankRemarks;
            $bank->serial_ref = $request->serailNumReference;
            $bank->save();
        }
    }
    
    function viewCheckDetailsFirstRow(Request $request) {
        $checkRow = BankDetails::where('serial_ref', $request->serial)
        ->orWhere('info_id', $request->row1)
        ->leftJoin('land_tax_accounts', 'bank_details.bank_id', 'land_tax_accounts.info_id')
        ->groupBy('bank_details.id')
        ->get();
        
        return $checkRow;
    }

    function viewCheckDetails(Request $request) {
        // dd($request);
        if ($request->checkStat == 'Check') {
            // dd(1);
            if ($request->dRowID == 0) {
                // dd(2);
                $checkRow = BankDetails::where('info_id', $request->row1)
                ->orWhere('serial_ref', $request->serial)
                ->leftJoin('land_tax_accounts', 'bank_details.bank_id', 'land_tax_accounts.info_id')
                ->groupBy('bank_details.id')
                ->first();
            } else {
                // dd(3);
                $checkRow = BankDetails::where('info_id', $request->dRow)
                ->orWhere('serial_ref', $request->serial)
                ->leftJoin('land_tax_accounts', 'bank_details.bank_id', 'land_tax_accounts.info_id')
                ->groupBy('bank_details.id')
                ->get()
                ->skip(1);
            }
        } else {
            // dd(4);
            $checkRow = BankDetails::where('info_id', $request->dRow)
            ->orWhere('serial_ref', $request->serial)
            ->leftJoin('land_tax_accounts', 'bank_details.bank_id', 'land_tax_accounts.info_id')
            ->groupBy('bank_details.id')
            ->get();
        }
        
        return [$checkRow, $request->dRowID, $request->serial];
    }
}
