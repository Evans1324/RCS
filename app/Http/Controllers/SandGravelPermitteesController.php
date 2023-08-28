<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SandGravelPermitteesController extends Controller
{
    public function generateReportSG(Request $request)
    {   //change file name to S&G report
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('storage/ReportsTemplate/CollectionsDeposits.xlsx'));
        // Report A
        $worksheet = $spreadsheet->getSheetByName('A');

        
    }
}
