<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Positions;
use App\Models\CertOfficers;
use App\Models\LandTaxInfo;
use App\Models\LandTaxAccount;
use App\Models\CollectionRate;
use App\Models\Serial;
use App\Models\SpecialCase;
use App\Models\Holidays;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CollectionsDeposits extends Controller 
{

    public function submitCollectionDepositReport(Request $request) 
    {
        $request->validate ([
            "cdType" => 'required',
            "reportNumber" => 'required',
            "reportDate" => 'required',
            "startDate" => 'required',
            "endDate" => 'required',
            "reportOfficerCol" => 'required',
            "reportOfficerColB" => 'required',
            "reportOfficerColD" => 'required',
            "reportOfficerColV" => 'required',
        ]);
        
        $startDate = Date('Y-m-d',strtotime('-1 day', strtotime($request->startDate)));
        $endDate = Date('Y-m-d',strtotime($request->endDate));
        $dayBefore = Date('Y-m-d',strtotime('-2 day', strtotime($request->endDate)));
        
        $dateFormat = Date('F d, Y', strtotime($request->reportDate));
        // Check here if range here if selected date range is out of range. Prompt a 403 page 
        $allColumns = [];
        $allRows = [];
        $allSum = [];
        $grandTotal = '=';

        $endDateTS = Date('Y-m-d',strtotime('+1 day', strtotime($request->startDate)));
        $beforeDateTS = Date('Y-m-d',strtotime('-1 day', strtotime($request->startDate)));

        $day = Date('D', strtotime($beforeDateTS));
        $isHoliday = true;
        if ($day == 'Sun') {
            $beforeDateTS = Date('Y-m-d',strtotime('-3 day', strtotime($request->startDate)));
        }
        if ($day == 'Sat') {
            $beforeDateTS = Date('Y-m-d',strtotime('-2 day', strtotime($request->startDate)));
        }
        while ($isHoliday == true) {
            $fomrattedDate = Date('m/d/Y', strtotime($beforeDateTS));
            $isHoliday = Holidays::where('date_of_holiday', $fomrattedDate)->exists();
            if ($isHoliday == true) {
                $beforeDateTS = Date('Y-m-d',strtotime('-1 day', strtotime($beforeDateTS)));
                if ($day == 'Sun') {
                    $beforeDateTS = Date('Y-m-d',strtotime('-3 day', strtotime($beforeDateTS)));
                }
                if ($day == 'Sat') {
                    $beforeDateTS = Date('Y-m-d',strtotime('-2 day', strtotime($beforeDateTS)));
                }
            }
        }
        
        $beginningSerials = Serial::select('land_tax_infos.report_date', 'serial_number', 'start_serial', 'serials.created_at', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'))
        ->whereRaw('land_tax_infos.serial_number < serials.end_serial AND serials.created_at <"'.$beforeDateTS.' 12:01:00" AND land_tax_infos.report_date <= "'.$endDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
        ->orWhereRaw('land_tax_infos.serial_number <= serials.end_serial AND land_tax_infos.report_date <"'.$endDate.'" AND serials.created_at <"'.$beforeDateTS.' 12:01:00" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
        // ->orWhereRaw('land_tax_infos.serial_number <= serials.end_serial AND land_tax_infos.report_date <= "'.$endDate.'" AND land_tax_infos.report_date > '.$dayBefore.' AND serials.created_at <"'.$endDate.'"')
        ->orWhereRaw('ISNULL(land_tax_infos.report_date) AND serials.created_at <="'.$beforeDateTS.' 12:01:00" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
        ->orWhereRaw('land_tax_infos.report_date IS NOT NULL AND serials.created_at <="'.$beforeDateTS.' 12:01:00" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
        ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
        ->orderBy('serials.unit', 'asc')
        ->orderBy('start_serial', 'asc')
        ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
        ->get();

        $startDate = Date('Y-m-d',strtotime($request->endDate));
        $newReceipts = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'))
        ->whereRaw('serials.created_at >= "'.$endDate.' 12:01:00" AND serials.created_at < "'.$endDateTS.' 12:01:00" AND land_tax_infos.report_date ="'.$startDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
        ->orWhereRaw('serials.created_at >= "'.$endDate.' 12:01:00" AND serials.created_at < "'.$endDateTS.' 12:01:00" AND ISNULL(land_tax_infos.report_date) AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
        ->orWhereRaw('serials.created_at <= "'.$endDate.' 12:01:00" AND serials.created_at > "'.$beforeDateTS.' 12:01:00" AND land_tax_infos.report_date ="'.$startDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
        ->orWhereRaw('serials.created_at <= "'.$endDate.' 12:01:00" AND serials.created_at > "'.$beforeDateTS.' 12:01:00" AND ISNULL(land_tax_infos.report_date) AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
        ->orWhereRaw('serials.created_at <= "'.$endDate.' 12:01:00" AND serials.created_at > "'.$beforeDateTS.' 12:01:00" AND land_tax_infos.report_date > "'.$startDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
        ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
        ->orderBy('serials.unit', 'asc')
        ->orderBy('start_serial', 'asc')
        ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
        ->get();

        foreach($newReceipts as $new) {
            if ($new->report_date != $endDate) {
                $validateReceipt = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'))
                ->whereRaw('serials.id = '.$new->id.' AND serials.created_at >= "'.$endDate.' 12:01:00" AND serials.created_at < "'.$endDateTS.' 12:01:00" AND land_tax_infos.report_date ="'.$startDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
                ->orWhereRaw('serials.id = '.$new->id.' AND serials.created_at >= "'.$endDate.' 12:01:00" AND serials.created_at < "'.$endDateTS.' 12:01:00" AND ISNULL(land_tax_infos.report_date) AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
                ->orWhereRaw('serials.id = '.$new->id.' AND serials.created_at <= "'.$endDate.' 12:01:00" AND serials.created_at > "'.$beforeDateTS.' 12:01:00" AND land_tax_infos.report_date ="'.$startDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
                ->orWhereRaw('serials.id = '.$new->id.' AND serials.created_at <= "'.$endDate.' 12:01:00" AND serials.created_at > "'.$beforeDateTS.' 12:01:00" AND ISNULL(land_tax_infos.report_date) AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
                ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
                ->orderBy('serials.unit', 'asc')
                ->orderBy('start_serial', 'asc')
                ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
                ->first();
                if ($validateReceipt == null) {
                    $new->latest = null;
                } else {
                    $new = $validateReceipt;
                }
            }
        }
        
        $beginningSerialsArray = [];
        foreach($beginningSerials as $new) {
            $validateReceipt = Serial::select('serial_number', 'start_serial', 'serials.created_at', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'), 'land_tax_infos.report_date')
            ->whereRaw('serials.id = '.$new->id.' AND land_tax_infos.serial_number < serials.end_serial AND serials.created_at <"'.$endDate.' 12:01:00" AND land_tax_infos.report_date < "'.$endDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();
            // if($validateReceipt->serial_number == '7691805'){

            //     dd($validateReceipt->serial_number);
            // }
            $validateSeries = Serial::select('serial_number', 'start_serial', 'serials.created_at', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'), 'land_tax_infos.report_date')
            ->whereRaw('serials.id = '.$new->id.' AND land_tax_infos.serial_number < serials.end_serial AND serials.created_at <"'.$endDate.' 12:01:00" AND land_tax_infos.report_date < "'.$endDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();
            
            $lastSerial = Serial::select('serial_number', DB::raw('max(land_tax_infos.serial_number) AS start_serial'), 'serials.created_at', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'), 'land_tax_infos.report_date')
            ->where([['serials.end_serial', $new->latest], ['report_date', $startDate], ['serials.status', 'Completed']])
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();

            if ($new->end_serial != $new->latest) {
                if ($validateReceipt == null) {
                    $beginningSerialsArray[] = $new;
                } else {
                    if ($validateReceipt->latest != $new->end_serial) {
                        if ($validateReceipt == null) {
                            $new->latest = null;
                        } else {
                            $new->start_serial = $validateReceipt->latest;
                        }
                        $beginningSerialsArray[] = $new;
                    }
                }
            } else {
                if ($validateSeries == null) {
                    $beginningSerialsArray[] = $new;
                } else {
                    
                    if ($validateSeries->latest+1 != $new->latest) {
                        if ($validateSeries == null) {
                            $new->latest = null;
                        } else {
                            $new->start_serial = $validateSeries->latest;
                        }
                        
                        $beginningSerialsArray[] = $new;
                    }
                    // if series ended and still shows up in sheet C
                    // if ($new->latest == $new->end_serial) {
                    //     if ($lastSerial->latest != null) {
                    //         $beginningSerialsArray[] = $lastSerial;
                    //     }
                    // }
                }
            }
        }
        
        $beginningSerials = $beginningSerialsArray;
        
        $allCollections = LandTaxInfo::select('report_date', 'transact_type', 'total_amount')
        ->where([['land_tax_infos.status', '<>' ,'Cancelled'], ['land_tax_infos.submission_type', 'Revenue Collection'], ['land_tax_infos.deleted_at', null]])
        ->whereRaw('land_tax_infos.report_date ="'.$startDate.'"')
        ->get();

        $getCheckOrMoneyOrder = LandTaxInfo::select('bank_name', 'number', DB::raw("SUM(CAST(REPLACE(total_amount, ',', '') AS DECIMAL(10,2))) AS total_amount"))
        ->whereRaw('land_tax_infos.report_date ="'.$startDate.'"  AND land_tax_infos.receipt_type != "Field Land Tax Collection Cash" AND land_tax_infos.status != "Cancelled"')
        // ->whereRaw('REPLACE("total_amount", ",", "")')
        ->whereIn('transact_type', ['Check', 'Money Order'])
        ->orderBy('transact_type', 'asc')
        ->orderBy('bank_name', 'asc')
        ->groupBy('number')
        ->get();
        
        $landTaxInfo = LandTaxInfo::select('rentals.*', 'rentals.name AS rental_name', 'barangays.*', 'municipalities.*', 'land_tax_infos.*')
        ->where([['land_tax_accounts.acc_category_id', $request->cdType], ['land_tax_infos.submission_type', 'Revenue Collection']])
        //->orWhere() role = 2 
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        //->orWherBetween() role_created jan 1 - jan 31
        ->orderBy('serial_number', 'asc')
        ->join('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id')
        ->leftJoin('barangays', 'barangays.id', 'land_tax_infos.barangay_id')
        ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id')
        ->distinct()
        ->get();
        
        if (count($landTaxInfo) === 0) {
            return abort(403, 'No Transactions');
        }

        $accTitlesColumns = [];
        $accTitleRows = [];

        $getMunicipalities = LandTaxInfo::where('land_tax_accounts.acc_category_id', $request->cdType)
        ->select('municipalities.*')
        ->whereRaw('ISNULL(land_tax_accounts.sub_title_id) AND collection_rates.municipal_share > 0 AND land_tax_infos.report_date BETWEEN "'.$startDate.'" AND "'.$endDate.'"')
        ->orWhereRaw('land_tax_accounts.sub_title_id IS NOT NULL AND collection_rates.municipal_share > 0 AND land_tax_infos.report_date BETWEEN "'.$startDate.'" AND "'.$endDate.'"')
        ->join('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->join('account_titles', 'land_tax_accounts.acc_title_id', 'account_titles.id')
        ->join('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id') 
        ->join('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        ->distinct()
        ->orderBy('municipalities.id', 'asc')
        ->get();

        $getBarangays = LandTaxInfo::where('land_tax_accounts.acc_category_id', $request->cdType)
        ->select('barangays.*')
        // ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        // ->where([['land_tax_accounts.sub_title_id', '<>', null], ['collection_rates.provincial_share', '<>', null]])
        ->whereRaw('ISNULL(land_tax_accounts.sub_title_id) AND collection_rates.barangay_share > 0 AND land_tax_infos.report_date BETWEEN "'.$startDate.'" AND "'.$endDate.'"')
        ->orWhereRaw('land_tax_accounts.sub_title_id IS NOT NULL AND collection_rates.barangay_share > 0 AND land_tax_infos.report_date BETWEEN "'.$startDate.'" AND "'.$endDate.'"')
        ->join('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->join('account_titles', 'land_tax_accounts.acc_title_id', 'account_titles.id')
        ->join('barangays', 'barangays.id', 'land_tax_infos.barangay_id') 
        ->join('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        ->distinct()
        ->orderBy('barangays.mun_id', 'asc')
        ->orderBy('barangays.id', 'asc')
        ->get();

        $locationArray = [];
        $locationArrayB = [];
        $amusementShareArray = [];

        $getAccTitles = LandTaxInfo::where('land_tax_accounts.acc_category_id', $request->cdType)
        ->select('account_titles.id', 'account_titles.title_name', DB::raw('SUM(amount) AS sum'))
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        ->where([['land_tax_accounts.sub_title_id', null], ['land_tax_infos.submission_type', 'Revenue Collection']])
        ->join('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->join('account_titles', 'land_tax_accounts.acc_title_id', 'account_titles.id')
        ->groupBy('account_titles.id', 'account_titles.title_name')
        ->get();

        $subTitlesColumns = [];

        $getSubTitles = LandTaxInfo::where('land_tax_accounts.acc_category_id', $request->cdType)
        ->select('account_subtitles.id', 'account_subtitles.subtitle', DB::raw('SUM(amount) AS sum'))
        ->where('land_tax_infos.submission_type', 'Revenue Collection')
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        ->join('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->join('account_subtitles', 'land_tax_accounts.sub_title_id', 'account_subtitles.id')
        ->groupBy('account_subtitles.id', 'account_subtitles.subtitle')
        ->get();

        $getReportOffcierA = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'cert_officers.id')
        ->where('cert_officers.id', $request->reportOfficerCol)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();

        $getReportOffcierB = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'cert_officers.id')
        ->where('cert_officers.id', $request->reportOfficerColB)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();

        $getReportOffcierD = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'cert_officers.id')
        ->where('cert_officers.id', $request->reportOfficerColD)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();

        $getReportOffcierV = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'cert_officers.id')
        ->where('cert_officers.id', $request->reportOfficerColV)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();
         
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('storage/ReportsTemplate/CollectionsDeposits.xlsx'));
        // Report A
        $worksheet = $spreadsheet->getSheetByName('A');
        
        $row = 10;

        // array styles
        $borderedStyleArray = [
            'borders' => [
              'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
              ]
            ]
        ];

        $borderedCenterArray = [
            'borders' => [
              'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
              ]
            ],
            
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $verticalLeft = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $verticalRight = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $numberFormat = [
            'numberFormat' => [
                'formatCode' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_EUR
            ]
        ];
        
        $columnStart = 'C';
        $worksheet->insertNewColumnBefore('C', count($getAccTitles)-1);
        if (count($getAccTitles) === 0) {
            // $worksheet->removeColumn($columnStart);
        } else {
            foreach ($getAccTitles as $accTitle) {
                array_push($accTitlesColumns, [$accTitle->title_name=>$columnStart]);
                $allSum[$accTitle->title_name]=0;
                array_push($allColumns, $columnStart);
                $worksheet->setCellValue($columnStart.$row, str_replace('(General Fund-Proper)', '' , $accTitle->title_name));
                $worksheet->getColumnDimension($columnStart)->setWidth(15);
                $worksheet->getStyle('A9:'.$columnStart.'9')->getFont()->setBold(true);
                $worksheet->getStyle('C10:'.$columnStart.'10')->getFont()->setBold(true);
                $columnStart++;
            }
        }
        
        if (count($getSubTitles) === 0) {
            $worksheet->removeColumn($columnStart);
        } else {
            $worksheet->insertNewColumnBefore($columnStart, count($getSubTitles));
            foreach ($getSubTitles as $subTitle) {
                array_push($subTitlesColumns, [$subTitle->subtitle=>$columnStart]);
                $allSum[$subTitle->subtitle]=0;
                array_push($allColumns, $columnStart);
                $worksheet->setCellValue($columnStart.$row, str_replace('(General Fund-Proper)', '' , $subTitle->subtitle));
                $worksheet->getColumnDimension($columnStart)->setWidth(15);
                $worksheet->getStyle($columnStart.'10:'.$columnStart.'10')->getFont()->setBold(true);
                $columnStart++;
            }
        }
        
        if (count($allColumns) > 2) {
            $worksheet->mergeCells('C7:'.$allColumns[count($allColumns)-2].'7');
        }
        
        $column1 = $columnStart;
        // $worksheet->mergeCells('C',':B'.$row);
        $worksheet->setCellValue('C7', $getReportOffcierA->name.' - '.$getReportOffcierA->position);
        $worksheet->getStyle('C7')->getFont()->setBold(true);
        $startRow = $columnStart;
        $worksheet->mergeCells('C9'.':'.chr(ord($columnStart) - 1).'9');
        $worksheet->setCellValue('C9',"General Fund-Proper");
        foreach ($getMunicipalities as $municipality) {
            array_push($locationArray, [$municipality->municipality=>$columnStart]);
            $locationArrayB[$municipality->municipality]=0;
            array_push($allColumns, $columnStart); //
            $worksheet->insertNewColumnBefore($columnStart, 1); // push municipality & barangay cells
            $worksheet->setCellValue($columnStart.$row, $municipality->municipality);
            $columnStart++;
            $selectedBarangay = [];
            foreach ($getBarangays as $barangay) {
                if ($barangay->mun_id === $municipality->id) {
                    $special = SpecialCase::where([['source_barangay', $municipality->municipality.'-'.$barangay->barangay_name], ['effectivity_date', '<=', $startDate], ['effectivity_end_date', null]])
                    ->orWhere([['source_barangay', $municipality->municipality.'-'.$barangay->barangay_name], ['effectivity_date', '<=', $startDate], ['effectivity_end_date', '>', $endDate]])
                    ->first();
                    $sharingStatus = LandTaxInfo::select('sharing_status')
                    ->where([['land_tax_accounts.acc_category_id', $request->cdType], ['land_tax_infos.submission_type', 'Revenue Collection'], ['land_tax_infos.sharing_status', 'on']])
                    ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
                    ->orderBy('serial_number', 'asc')
                    ->join('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
                    // ->distinct()
                    ->first();
                    
                    $validateBarangay = in_array($municipality->municipality.'-'.$barangay->barangay_name, $selectedBarangay);
                    if (!$validateBarangay) {
                        
                        array_push($selectedBarangay, $municipality->municipality.'-'.$barangay->barangay_name);
                        array_push($locationArray, [$municipality->municipality.'-'.$barangay->barangay_name=>$columnStart]);
                        $locationArrayB[$municipality->municipality.'-'.$barangay->barangay_name]=0;
                        array_push($allColumns, $columnStart); //
                        $worksheet->insertNewColumnBefore($columnStart, 1); // push municipality & barangay cells
                        $worksheet->setCellValue($columnStart.$row, $barangay->barangay_name);
                        $columnStart++;
                        
                        if ($special != null) {
                            $validateBarangay = in_array($special->barangay_sharing, $selectedBarangay);
                            if (!$validateBarangay) {
                                if ($sharingStatus != null) {
                                    array_push($selectedBarangay, $special->barangay_sharing);
                                    array_push($locationArray, [$special->barangay_sharing=>$columnStart]);
                                    $locationArrayB[$special->barangay_sharing]=0;
                                    array_push($allColumns, $columnStart); //
                                    $barangayName = explode('-', $special->barangay_sharing);
                                    $worksheet->insertNewColumnBefore($columnStart, 1); // push municipality & barangay cells
                                    $worksheet->setCellValue($columnStart.$row, $barangayName[1]);
                                    $columnStart++;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        $lastLetter = substr($columnStart, -1, 1);
        if ($startRow === $lastLetter) {
            $letters = $lastLetter;
        } else {
            if ($lastLetter == 'A') {
                $end = chr(ord($lastLetter));
            } else {
                $end = chr(ord($lastLetter) - 1);
            }
            if (strlen($columnStart) > 1) {
                $letters = substr($columnStart, 0, (strlen($columnStart) - 1));
                $letters = $letters.$end;
            } else {
                $letters = $end;
            }
            $start = $startRow;
            while ($start != $letters) {
                $worksheet->getColumnDimension($start)->setAutoSize(true);
                $start++;
                if ($start == $letters) {
                    $worksheet->getColumnDimension($start)->setAutoSize(true);
                }
            }
            $worksheet->mergeCells($startRow.'9:'.$letters.'9');
            $worksheet->setCellValue($startRow.'9',"MUNICIPAL & BRGY SHARES");
        }
        
        $worksheet->getStyle("C".$row.":".$columnStart.$row)->applyFromArray($borderedCenterArray);
        $letter = $allColumns[count($allColumns)-1];
        $letter = ++$letter;
        $worksheet->mergeCells($letter.'6:'.$columnStart.'6');
        $worksheet->setCellValue($columnStart.'9',"TOTAL");
        $worksheet->getStyle($columnStart.'9')->getFont()->setBold(true);
        $worksheet->getStyle($columnStart.'9')->applyFromArray($borderedCenterArray);
        
        // $columnStart++;
        // Info /data
        $calculateShares = 0.00;
        $row=11;
        $worksheet->setCellValue('A'.$row, $dateFormat);
        $row=$row+1;
        
        foreach($landTaxInfo as $data) {
            $worksheet->setCellValue('A'.$row, $data->serial_number);
            if ($data->status == 'Cancelled') {
                $worksheet->setCellValue('B'.$row, 'Cancelled');
                $worksheet->mergeCells('C'.$row.':'.$columnStart.$row);
                $worksheet->setCellValue('C'.$row, '');
            } else {
                if ($data->client_type_id == '2' || $data->client_type_id == '3' || $data->client_type_id == '14') {
                    if ($data->business_name != null && $data->owner != null) {
                        $worksheet->setCellValue('B'.$row, $data->business_name.' By: '.$data->owner);
                    } else if ($data->business_name != null && $data->owner == null) {
                        $worksheet->setCellValue('B'.$row, $data->business_name);
                    } else if ($data->business_name == null && $data->owner != null) {
                        $worksheet->setCellValue('B'.$row, $data->owner);
                    }
                    
                } else if ($data->client_type_id == '4') {
                    $worksheet->setCellValue('B'.$row, $data->barangay_name .', '. $data->municipality);
                } else if ($data->client_type_id == '5') {
                    $worksheet->setCellValue('B'.$row, 'Municipal Government of '. $data->municipality);
                } else if ($data->client_type_id == '6' || $data->client_type_id == '7') {
                    if ($data->trade_name_permittees != null && $data->permittee != null) {
                        $worksheet->setCellValue('B'.$row, $data->trade_name_permittees.' By: '.$data->permittee);
                    } else if ($data->trade_name_permittees != null && $data->permittee == null) {
                        $worksheet->setCellValue('B'.$row, $data->trade_name_permittees);
                    } else if ($data->trade_name_permittees == null && $data->permittee != null) {
                        $worksheet->setCellValue('B'.$row, $data->permittee);
                    }
                } else if ($data->client_type_id == '9') {
                    $worksheet->setCellValue('B'.$row, $data->rental_name);
                } else if ($data->client_type_id == '10' || $data->client_type_id == '11') {
                    if ($data->trade_name_permit_fees != null && $data->proprietor != null) {
                        $worksheet->setCellValue('B'.$row, $data->trade_name_permit_fees.' By: '.$data->proprietor);
                    } else if ($data->trade_name_permit_fees != null && $data->proprietor == null) {
                        $worksheet->setCellValue('B'.$row, $data->trade_name_permit_fees);
                    } else if ($data->trade_name_permit_fees == null && $data->proprietor != null) {
                        $worksheet->setCellValue('B'.$row, $data->proprietor);
                    }
                } else if ($data->client_type_id == '12' || $data->client_type_id == '13') {
                    if ($data->bidders_business_name == null) {
                        $worksheet->setCellValue('B'.$row, $data->owner_representative);
                    } else if ($data->owner_representative == null) {
                        $worksheet->setCellValue('B'.$row, $data->bidders_business_name);
                    } else {
                        $worksheet->setCellValue('B'.$row, $data->bidders_business_name.' By: '.$data->owner_representative);
                    }
                } else {
                    if ($data->client_type_radio == "Individual") {
                        if ($data->middle_initial == null) {
                            $worksheet->setCellValue('B'.$row, $data->first_name.' '.$data->last_name);
                        } else {
                            $worksheet->setCellValue('B'.$row, $data->first_name.' '.$data->middle_initial.' '.$data->last_name);
                        }
                        
                    } else if ($data->client_type_radio == "Company") {
                        $worksheet->setCellValue('B'.$row, $data->company);
                    } else if ($data->client_type_radio == "Spouse") {
                        $worksheet->setCellValue('B'.$row, $data->spouses);
                    }
                }

                
            }
            
            $landTaxAccountTitles = LandTaxAccount::where([['info_id', $data->id], ['sub_title_id', null], ['land_tax_infos.status', '<>' ,'Cancelled']])
            ->select('acc_title_id', 'account', DB::raw('SUM(amount) AS total'))
            ->join('land_tax_infos', 'land_tax_accounts.info_id', 'land_tax_infos.id')
            ->groupBy('acc_title_id')
            ->get();

            $landTaxAccountSubTitles = LandTaxAccount::where([['info_id', $data->id], ['land_tax_infos.status', '<>' ,'Cancelled']])
            ->select('sub_title_id', 'account', DB::raw('SUM(amount) AS total'))
            ->join('land_tax_infos', 'land_tax_accounts.info_id', 'land_tax_infos.id')
            ->groupBy('sub_title_id')
            ->get();
            
            foreach($landTaxAccountTitles as $accountTitle) {
                $provincialShare = 0.00;
                $municipalShare = 0.00;
                $barangayShare = 0.00;
                $sharingBarangay = 0.00;
                $sourceBarangay = 0.00;
                $provincialRate = 1;
                $municipalRate = 0;
                $barangayRate = 0;
                $tmp = $accountTitle->account;
                
                $collectionRate = CollectionRate::where('acc_titles_id', $accountTitle->acc_title_id)->orderBy('id', 'desc')->first();
                if ($collectionRate == null) {
                }
                if ($collectionRate->provincial_share > 0 || $collectionRate->provincial_share != null) {
                    // if ($collectionRate->provincial_share != null) {
                    //     $provincialRate = $collectionRate->provincial_share / 100;
                    // }
                    if ($collectionRate->barangay_share != null || $collectionRate->barangay_share > 1) {
                        $share = 0;
                        $barangayRate = $collectionRate->barangay_share / 100;
                        $barangayShare = round(($accountTitle->total * $barangayRate), 2);
                        $special = SpecialCase::where([['source_barangay', $data->municipality.'-'.$data->barangay_name], ['effectivity_date', '<=', $startDate], ['effectivity_end_date', null], ['sand_gravel_permittees.permittee', $data->permittee]])
                        ->orWhere([['source_barangay', $data->municipality.'-'.$data->barangay_name], ['effectivity_date', '<=', $startDate], ['effectivity_end_date', '>', $endDate], ['sand_gravel_permittees.permittee', $data->permittee]])
                        ->join('special_permitees', 'special_cases.id', 'special_permitees.special_case_id')
                        ->join('sand_gravel_permittees', 'sand_gravel_permittees.id', 'special_permitees.permitee_id')
                        ->first();
                        if ($special == null) {
                            foreach ($locationArray as $location) {
                                if (isset($location[$data->municipality.'-'.$data->barangay_name]) == true) {
                                    $worksheet->setCellValue($location[$data->municipality.'-'.$data->barangay_name].$row, $barangayShare);
                                    $locationArrayB[$data->municipality.'-'.$data->barangay_name] = $locationArrayB[$data->municipality.'-'.$data->barangay_name] + $barangayShare;
                                    break;
                                }
                            }
                        } else {
                            $source = round(($barangayShare*$special->source_percentage/100), 2);
                            $share = $barangayShare-$source;
                            
                            foreach ($locationArray as $sharingLocation) {
                                if (array_key_exists($special->barangay_sharing, $sharingLocation)) {
                                    $worksheet->setCellValue($sharingLocation[$special->barangay_sharing].$row, $share);
                                    $locationArrayB[$special->barangay_sharing] = $locationArrayB[$special->barangay_sharing] + $share;
                                    break;
                                }
                            }

                            foreach ($locationArray as $location) {
                                if (isset($location[$data->municipality.'-'.$data->barangay_name]) == true) {
                                    $worksheet->setCellValue($location[$data->municipality.'-'.$data->barangay_name].$row, $source);
                                    $locationArrayB[$data->municipality.'-'.$data->barangay_name] = $locationArrayB[$data->municipality.'-'.$data->barangay_name] + $source;
                                    break;
                                }
                            }
                            $barangayShare = $source;
                            $sharingBarangay = $share;
                        }
                        
                    }

                    if ($collectionRate->municipal_share != null) {
                        $municipalRate = $collectionRate->municipal_share / 100;
                        // $municipalShare = bcdiv(($accountTitle->total * $municipalRate), 1, 2);
                        $municipalShare = round(($accountTitle->total * $municipalRate), 2);
                        $provincialShare = $accountTitle->total - $barangayShare - $municipalShare - $sharingBarangay;
                        $tmpMunicpalShare = $municipalShare;
                        if ($municipalShare > $provincialShare) {
                            $municipalShare = $provincialShare;
                            $provincialShare = $tmpMunicpalShare;
                        }
                        foreach ($locationArray as $location) {
                            if (isset($location[$data->municipality]) == true) {
                                $worksheet->setCellValue($location[$data->municipality].$row, $municipalShare);
                                $locationArrayB[$data->municipality] = $locationArrayB[$data->municipality] + $municipalShare;
                                break;
                            }
                        }
                    }

                    foreach ($accTitlesColumns as $accTitle) {
                        if (isset($accTitle[$tmp]) == true) {
                            $worksheet->setCellValue($accTitle[$tmp].$row, $provincialShare);
                            break;
                        }
                    }

                    $allSum[$tmp] = $allSum[$tmp] + $provincialShare;
                    $updateInfo = LandTaxInfo::find($data->id);

                    $updateInfo->prov_share = $provincialShare;
                    $updateInfo->mun_share = $municipalShare;
                    $updateInfo->bar_share = $barangayShare;
                    $updateInfo->special_share = $share;
                    $updateInfo->save();
                    
                    $provincialShare = 0;
                    $municipalShare = 0;
                    $barangayShare = 0;
                    $share = 0;

                } else {
                    foreach ($accTitlesColumns as $accTitle) {
                        if (isset($accTitle[$tmp]) == true) {
                            $allSum[$tmp] = $allSum[$tmp] + $accountTitle->total;
                            $worksheet->setCellValue($accTitle[$tmp].$row, $accountTitle->total);
                            break;
                        }
                    }
                }
                
            }

            foreach($landTaxAccountSubTitles as $subTitle) {
                $provincialShare = 0.00;
                $municipalShare = 0.00;
                $barangayShare = 0.00;
                $sharingBarangay = 0.00;
                $sourceBarangay = 0.00;
                $provincialRate = 1;
                $municipalRate = 0;
                $barangayRate = 0;
                $tmp = $subTitle->account;
                
                $collectionRate = CollectionRate::where('acc_subtitles_id', $subTitle->acc_subtitle_id)->orderBy('id', 'desc')->first();
                if ($collectionRate->provincial_share > 0 || $collectionRate->provincial_share != null) {
                    // if ($collectionRate->provincial_share != null) {
                    //     $provincialRate = $collectionRate->provincial_share / 100;
                    // }
                    if ($collectionRate->barangay_share != null) {
                        $barangayRate = $collectionRate->barangay_share / 100;
                        $barangayShare = round(($subTitle->total * $barangayRate), 2);
                        $special = SpecialCase::where([['source_barangay', $data->municipality.'-'.$data->barangay_name], ['effectivity_date', '<=', $startDate], ['effectivity_end_date', null], ['sand_gravel_permittees.permittee', $data->permittee]])
                        ->orWhere([['source_barangay', $data->municipality.'-'.$data->barangay_name], ['effectivity_date', '<=', $startDate], ['effectivity_end_date', '>', $endDate], ['sand_gravel_permittees.permittee', $data->permittee]])
                        ->join('special_permitees', 'special_cases.id', 'special_permitees.special_case_id')
                        ->join('sand_gravel_permittees', 'sand_gravel_permittees.id', 'special_permitees.permitee_id')
                        ->first();
                        if ($special == null) {
                            foreach ($locationArray as $location) {
                                if (isset($location[$data->municipality.'-'.$data->barangay_name]) == true) {
                                    $worksheet->setCellValue($location[$data->municipality.'-'.$data->barangay_name].$row, $barangayShare);
                                    $locationArrayB[$data->municipality.'-'.$data->barangay_name] = $locationArrayB[$data->municipality.'-'.$data->barangay_name] + $barangayShare;
                                    break;
                                }
                            }
                        } else {
                            $source = round(($barangayShare*$special->source_percentage/100), 2);
                            $share = $barangayShare-$source;
                            foreach ($locationArray as $sharingLocation) {
                                if (array_key_exists($special->barangay_sharing, $sharingLocation)) {
                                    $worksheet->setCellValue($sharingLocation[$special->barangay_sharing].$row, $share);
                                    $locationArrayB[$special->barangay_sharing] = $locationArrayB[$special->barangay_sharing] + $share;
                                    break;
                                }
                            }

                            foreach ($locationArray as $location) {
                                if (isset($location[$data->municipality.'-'.$data->barangay_name]) == true) {
                                    $worksheet->setCellValue($location[$data->municipality.'-'.$data->barangay_name].$row, $source);
                                    $locationArrayB[$data->municipality.'-'.$data->barangay_name] = $locationArrayB[$data->municipality.'-'.$data->barangay_name] + $source;
                                    break;
                                }
                            }
                        }
                        
                    }
                    
                    if ($collectionRate->municipal_share != null) {
                        $municipalRate = $collectionRate->municipal_share / 100;
                        // $municipalShare = bcdiv(($subTitle->total * $municipalRate), 1, 2);
                        $municipalShare = round(($subTitle->total * $municipalRate), 2);
                        $provincialShare = $subTitle->total - $barangayShare - $municipalShare;
                        $tmpMunicpalShare = $municipalShare;
                        if ($municipalShare > $provincialShare) {
                            $municipalShare = $provincialShare;
                            $provincialShare = $tmpMunicpalShare;
                        }
                        foreach ($locationArray as $location) {
                            if (isset($location[$data->municipality]) == true) {
                                $worksheet->setCellValue($location[$data->municipality].$row, $municipalShare);
                                $locationArrayB[$data->municipality] = $locationArrayB[$data->municipality] + $municipalShare;
                                break;
                            }
                        }
                    }

                    foreach ($subTitlesColumns as $subtitleCol) {
                        if (isset($subtitleCol[$tmp]) == true) {
                            $worksheet->setCellValue($subtitleCol[$tmp].$row, $provincialShare);
                            break;
                        }
                    }

                    $allSum[$tmp] = $allSum[$tmp] + $provincialShare;
                } else {
                    foreach ($subTitlesColumns as $subtitleCol) {
                        if (isset($subtitleCol[$tmp]) == true) {
                            $allSum[$tmp] = $allSum[$tmp] + $subTitle->total;
                            $worksheet->setCellValue($subtitleCol[$tmp].$row, $subTitle->total);
                            break;
                        }
                    }
                }
            }
            
            $worksheet->setCellValue($columnStart.$row, '=SUM(C'.$row.':'.$letters.$row.')' );

            $updateReportNumber = LandTaxInfo::find($data->id);

            $updateReportNumber->report_number = $request->reportNumber;
            $updateReportNumber->save();
            
            $row++;
        }

        $worksheet->getStyle('B12:B'.$row)->applyFromArray($verticalLeft);
        $worksheet->setCellValue(chr(ord($column1) - 1).'6', 'Date:');
        $worksheet->setCellValue($column1.'6', $dateFormat);
        $worksheet->setCellValue(chr(ord($column1) - 1).'7', 'Report No.');
        $worksheet->setCellValue($column1.'7', $request->reportNumber);
        
        foreach ($allColumns as $column) {
            $worksheet->setCellValue($column.$row, '=SUM('.$column.'11'.':'.$column.$row.')' );
        }
        $worksheet->setCellValue($columnStart.$row, '=SUM('.$columnStart.'11'.':'.$columnStart.($row-1).')' );
        $cashTotal = $worksheet->getCell($columnStart.$row)->getCalculatedValue();

        $worksheet->getStyle($columnStart.'12:'.$columnStart.$row)->getFont()->setBold(true);
        $worksheet->getStyle('A'.$row.':'.$columnStart.$row)->getFont()->setBold(true);
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
        $worksheet->getStyle('A12:'.$columnStart.$row)->getFont()->setSize(12);
        $worksheet->getStyle('C11:'.$columnStart.$row)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $worksheet->getStyle("A11:".$columnStart.$row)->applyFromArray($borderedStyleArray);
        
        $worksheet->mergeCells('A'.$row.':B'.$row);
        $worksheet->setCellValue('A'.$row, 'Total');
        $worksheet->getStyle('C12:CZ'.$row)->applyFromArray($verticalRight);

        // Report B
        $worksheet = $spreadsheet->getSheetByName('B');
        $row = 3;

        $columnStart = 'B';

        $worksheet->setCellValue('A'.($row+3), $getReportOffcierB->name.' - '.$getReportOffcierB->position); // Accountable Officer
        $worksheet->setCellValue('E'.($row+3), 'PHP');
        $worksheet->getStyle('E'.($row+3))->applyFromArray($verticalRight);
        $worksheet->getStyle('F'.($row+3))->applyFromArray($verticalLeft);
        $worksheet->setCellValue('D'.($row+3), $request->reportNumber); // reference
        $worksheet->insertNewRowBefore($row+1, count($getAccTitles));
        // $totalSummary = 0.00;
        $startRow = $row;
        
        foreach ($getAccTitles as $titles) {
            $worksheet->setCellValue('A'.$row, $titles->title_name);
            $worksheet->setCellValue('B'.$row, $allSum[$titles->title_name]);
            // $totalSummary = $totalSummary + $allSum[$titles->title_name];
            $row++;
        }
        
        if (count($getSubTitles) > 0) {
            $worksheet->insertNewRowBefore($row+1, count($getSubTitles));
            foreach ($getSubTitles as $subTitles) {
                $worksheet->setCellValue('A'.$row, $subTitles->subtitle);
                $worksheet->setCellValue('B'.$row, $allSum[$subTitles->subtitle]);
                // $totalSummary = $totalSummary + $allSum[$subTitles->subtitle];
                $row++;
            }
        }
        
        $worksheet->setCellValue('A'.$row, 'TOTAL');
        $worksheet->getStyle('A'.$row)->getFont()->setBold(true);
        $worksheet->setCellValue('B'.$row, '= SUM(B'.$startRow.':B'.($row-1).')');
        $worksheet->getStyle('B3:B'.$row)->getFont()->setBold(true);
        $grandTotal = $grandTotal.'B'.$row;
        
        $colA = count($getAccTitles) + count($getSubTitles)+1;
        $colB = count($locationArrayB) + count($amusementShareArray) + 2;
        
        if ($colB > $colA) {
            $worksheet->insertNewRowBefore($row+1, ($colB - $colA));
        } 

        $row = 3;
        foreach ($locationArrayB as $key=>$value) {
            if ($value > 0) {
                $keySplit = explode('-', $key);
                if (count($keySplit) === 1) {
                    $worksheet->setCellValue('D'.$row, $key);
                    $worksheet->setCellValue('E'.$row, $value);
                    $worksheet->getStyle('E'.$row)->getFont()->setBold(true);
                } else {
                    $worksheet->setCellValue('D'.$row, $keySplit[1]);
                    $worksheet->setCellValue('F'.$row, $value);
                    $worksheet->getStyle('F'.$row)->getFont()->setBold(true);
                }
                $row++;
            }
        }
        $worksheet->setCellValue('D'.$row, 'TOTAL');
        $worksheet->getStyle('D'.$row)->getFont()->setBold(true);
        $worksheet->setCellValue('F'.$row, '=SUM(E3:F'.($row-1).')');
        $worksheet->getStyle('F'.$row)->getFont()->setBold(true);
        $grandTotal = $grandTotal.'+F'.$row;
        
        $row = $row + 1;
        $worksheet->setCellValue('D'.$row, 'Add: Amusement Share');
        $worksheet->getStyle('D'.$row)->getFont()->setBold(true);
        $row = $row + 1;

        $startRow = $row;
        foreach ($amusementShareArray as $key=>$value) {
            if ($value > 0) {
                if (count($keySplit) === 1) {
                    $worksheet->setCellValue('D'.$row, $key);
                    $worksheet->setCellValue('E'.$row, $value);
                } else {
                    $worksheet->setCellValue('D'.$row, $keySplit[1]);
                    $worksheet->setCellValue('F'.$row, $value);
                }
                $row++;
            }
        }

        $worksheet->setCellValue('D'.$row, 'TOTAL');
        $worksheet->getStyle('D'.$row)->getFont()->setBold(true);
        $worksheet->setCellValue('F'.$row, '=SUM(E'.$startRow.':F'.($row-1).')');
        $worksheet->getStyle('F'.$row)->getFont()->setBold(true);
        
        $worksheet->getStyle('E3:F'.$row)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        
        if ($colB < $colA) {
            $row = $colA+3;
            $worksheet->insertNewRowBefore($row, 1);
        } else {
            $worksheet->insertNewRowBefore($row+1, 1);
            $row = $row+1;
        }
        
        $worksheet->getStyle('B3:'.$columnStart.$row)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        
        
        $grandTotal = $grandTotal.'+F'.$row;
        $worksheet->setCellValue('F'.($row+3), $grandTotal);

        $worksheet->getStyle('F'.($row+3))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Report C 
        $worksheet = $spreadsheet->getSheetByName('C');
        $row = 7;
        
        $worksheet->insertNewRowBefore($row+1, count($beginningSerials));
        
        foreach ($beginningSerials as $index => $beginning) {
            $startDate = Date('Y-m-d', strtotime($request->startDate));
            
            $max = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', DB::raw('max(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$beginning->id.' AND land_tax_infos.report_date ="'.$startDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();

            $min = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', DB::raw('min(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$beginning->id.' AND land_tax_infos.report_date >="'.$startDate.'" AND land_tax_infos.report_date <="'.$endDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();
            
            $worksheet->setCellValue('C'.$row, $beginning->start_serial);
            $qty = $beginning->end_serial - $beginning->start_serial + 1;
            $f = null;
            
            if ($beginning->report_date == $endDate) {
                $worksheet->setCellValue('C'.$row, $beginning->start_serial);
            } else if ($beginning->latest == null) {
                $worksheet->setCellValue('C'.$row, $beginning->start_serial);
            }  else {
                $worksheet->setCellValue('C'.$row, $beginning->latest+1);
                $qty = $beginning->end_serial - $beginning->start_serial; 
            }
            
            $issuedQty = 0;
            if ($min != null) {
                
                if ($beginning->start_serial < $min->latest) {
                    $worksheet->setCellValue('C'.$row, $beginning->start_serial+1);
                } else {
                    $worksheet->setCellValue('C'.$row, $beginning->start_serial);
                }
                
                $worksheet->setCellValue('I'.$row, $min->latest);
                $worksheet->setCellValue('J'.$row, $max->latest);
                if ($max->latest == $beginning->end_serial) {
                    $worksheet->setCellValue('L'.$row, $max->latest);
                } else {
                    $worksheet->setCellValue('L'.$row, $max->latest+1);
                }
                $issuedQty = $max->latest - $min->latest + 1;
                $worksheet->setCellValue('H'.$row, $issuedQty);
            } else {
                
                if ($beginning->latest+1 < $beginning->start_serial) {
                    $worksheet->setCellValue('C'.$row, $beginning->start_serial);
                    $worksheet->setCellValue('L'.$row, $beginning->start_serial);
                } else {
                    $worksheet->setCellValue('C'.$row, $beginning->start_serial+1);
                    $worksheet->setCellValue('L'.$row, $beginning->start_serial+1);
                }
            }
            
            
            $worksheet->setCellValue('M'.$row, $beginning->end_serial);
            if ($issuedQty != 1) {
                $endingQty = $qty - $issuedQty;
                if ($endingQty == 0) {
                    $worksheet->setCellValue('L'.$row, '-');
                    $worksheet->setCellValue('M'.$row, '-');
                }
            } else if ($issuedQty == 1) {
                $endingQty = $qty - $issuedQty;
                if ($endingQty == 0) {
                    $worksheet->setCellValue('L'.$row, '-');
                    $worksheet->setCellValue('M'.$row, '-');
                } else {
                    $worksheet->setCellValue('L'.$row, $max->latest+1);
                }
                // $worksheet->setCellValue('M'.$row, $new->end_serial); uncomment if soemthing goes wrong
            } else {
                $endingQty = $beginning->end_serial - $beginning->start_serial + 1;
            }
            
            if ($endingQty < 0) {
                $endingQty = 0;
            }

            if ($endingQty == 0) {
                $worksheet->setCellValue('K'.$row, '');
            } else {
                $worksheet->setCellValue('K'.$row, $endingQty);
            }
            
            
            
            $worksheet->setCellValue('B'.$row, $qty);
            $worksheet->setCellValue('D'.$row, $beginning->end_serial);
            $row++;
        }
        
        foreach ($newReceipts as $new) {
            $startDate = Date('Y-m-d', strtotime($request->startDate));
            $max = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', DB::raw('max(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$new->id.' AND land_tax_infos.report_date ="'.$startDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();

            $min = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', DB::raw('min(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$new->id.' AND land_tax_infos.report_date >="'.$startDate.'" AND land_tax_infos.report_date <="'.$endDate.'" AND ISNULL(serials.assigned_office) AND ISNULL(land_tax_infos.deleted_at)')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();
            
            $qty = $new->end_serial - $new->start_serial + 1;
            $f = null;
            $issuedQty = 0;
            
            if ($new->report_date == $endDate) {
                $f =  $new->start_serial;
            } else if ($new->latest == null) {
                $f =  $new->start_serial;
            } else {
                $f =  $new->latest;
                $qty = $new->end_serial - $new->latest + 1;
            }

            $worksheet->setCellValue('F'.$row, $f);
            
            if ($min != null) {
                // $worksheet->setCellValue('C'.$row, $new->start_serial+1);
                $worksheet->setCellValue('I'.$row, $min->latest);
                $worksheet->setCellValue('J'.$row, $max->latest);
                
                if ($max->latest == $new->end_serial) {
                    $worksheet->setCellValue('L'.$row, $max->latest);
                } else {
                    $worksheet->setCellValue('L'.$row, $max->latest+1);
                }
                $issuedQty = $max->latest - $min->latest + 1;
                $worksheet->setCellValue('H'.$row, $issuedQty);
            } else {
                $worksheet->setCellValue('L'.$row, $new->start_serial);
            }
            // $worksheet->setCellValue('L'.$row, $new->start_serial);
            $worksheet->setCellValue('M'.$row, $new->end_serial);
            if ($issuedQty != 1) {
                $endingQty = $qty - $issuedQty;
                if ($endingQty == 0) {
                    $worksheet->setCellValue('L'.$row, '-');
                    $worksheet->setCellValue('M'.$row, '-');
                }
            } else if ($issuedQty == 1) {
                $endingQty = $qty - $issuedQty;
                $worksheet->setCellValue('L'.$row, $max->latest+1);
                $worksheet->setCellValue('M'.$row, $new->end_serial);
            } else {
                $endingQty = $beginning->end_serial - $beginning->start_serial + 1;
            }
            if ($endingQty < 0) {
                $endingQty = 0;
            }
               
            $worksheet->setCellValue('K'.$row, $endingQty);
            $worksheet->setCellValue('E'.$row, $qty);
            $worksheet->setCellValue('G'.$row, $new->end_serial);
            $row++;
        }
        $worksheet->setCellValue('A'.$row, '');
        $worksheet->setCellValue('B'.$row, '=SUM(B7:B'.($row-1).')' );
        $worksheet->setCellValue('E'.$row, '=SUM(E7:E'.($row-1).')' );
        $worksheet->setCellValue('H'.$row, '=SUM(H7:H'.($row-1).')' );
        $worksheet->setCellValue('K'.$row, '=SUM(K7:K'.($row-1).')' );
        $worksheet->getStyle('B'.$row.':K'.$row)
            ->getNumberFormat()
            ->setFormatCode('#,##0');

        $worksheet->getStyle('A7:M'.$row)->applyFromArray($borderedStyleArray);

        // Report D
        $worksheet = $spreadsheet->getSheetByName('D');
        $grandTotalCash = 0;
        $grandTotalCheck = 0;
        $grandTotalMoneyOrder = 0;
        $grandTotalADA = 0;
        $grandTotalBankDeposit = 0;
        
        foreach ($allCollections as $coll) {
            if ($coll->transact_type == 'Cash') {
                $grandTotalCash += (float)str_replace(',', '', $coll->total_amount);
            }

            if ($coll->transact_type == 'Check') {
                $grandTotalCheck += (float)str_replace(',', '', $coll->total_amount);
            }

            if ($coll->transact_type == 'Money Order') {
                $grandTotalMoneyOrder += (float)str_replace(',', '', $coll->total_amount);
            }

            if ($coll->transact_type == 'ADA-LBP') {
                $grandTotalADA += (float)str_replace(',', '', $coll->total_amount);
            }

            if ($coll->transact_type == 'Bank Deposit/Transfer') {
                $grandTotalBankDeposit += (float)str_replace(',', '', $coll->total_amount);
            }
        }

        $row = 5;
        if (count($getCheckOrMoneyOrder) > 10 ){
            foreach ($getCheckOrMoneyOrder as $order) {
                $checkOrder = $order->number;
                if ($order->number == $checkOrder) {
                    break;
                } else {
                    $worksheet->insertNewRowBefore(14, (count($getCheckOrMoneyOrder) - 10));
                    break;
                }
            }
        }

        foreach ($getCheckOrMoneyOrder as $check) {
            $worksheet->setCellValue('F'.($row-1), $check->bank_name);
            $worksheet->setCellValue('G'.($row-1), $check->number);
            $worksheet->setCellValue('H'.($row-1), 'Provincial Government of Benguet');
            $worksheet->setCellValue('I'.($row-1), $check->total_amount);
            $worksheet->getStyle('I'.($row-1).':I'.($row+1))->getFont()->setBold(true);
            $row++;
        }

        $worksheet->getStyle('G3:G'.$row)->applyFromArray($verticalLeft);
        $worksheet->getStyle('I3:I'.$row)->applyFromArray($verticalRight);

        $worksheet->mergeCells('F'.($row-1).':H'.($row-1));
        $worksheet->setCellValue('F'.($row-1), 'TOTAL');
        $worksheet->setCellValue('I'.($row-1), '=SUM(I4:I'.($row-1).')' );
        $worksheet->getStyle('F5:I'.($row-1))->applyFromArray($borderedStyleArray);
        $worksheet->getStyle('I3:I'.($row-1))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            
        $worksheet->setCellValue('C5', $grandTotalCash);
        $worksheet->setCellValue('C6', $grandTotalCheck);
        $worksheet->setCellValue('C7', $grandTotalMoneyOrder);
        $worksheet->setCellValue('C8', $grandTotalADA);
        $worksheet->setCellValue('C9', $grandTotalBankDeposit);
        $worksheet->setCellValue('D3', 0);
        $worksheet->setCellValue('D13', 0);
        
        $worksheet->setCellValue('A3', 'Beginning Balance '.$dateFormat);
        $worksheet->setCellValue('A4', 'Add: Collections '.$dateFormat);
        if ($row >= 14) {
            $worksheet->setCellValue('B'.($row+5), $dateFormat);
            $worksheet->setCellValue('A'.($row+5), $getReportOffcierD->name);
            $worksheet->setCellValue('A'.($row+6), $getReportOffcierD->position);
            $worksheet->setCellValue('H'.($row+5), $dateFormat);
            $worksheet->setCellValue('C'.($row+5), $getReportOffcierV->name);
            $worksheet->setCellValue('C'.($row+6), $getReportOffcierV->position);
        } else if ($row < 14) {
            $row = 14;
            $worksheet->setCellValue('B'.($row+6), $dateFormat);
            $worksheet->setCellValue('A'.($row+6), $getReportOffcierD->name);
            $worksheet->setCellValue('A'.($row+7), $getReportOffcierD->position);
            $worksheet->setCellValue('H'.($row+6), $dateFormat);
            $worksheet->setCellValue('C'.($row+6), $getReportOffcierV->name);
            $worksheet->setCellValue('C'.($row+7), $getReportOffcierV->position);
        } else {
            $worksheet->setCellValue('B'.($row+10), $dateFormat);
            $worksheet->setCellValue('A'.($row+10), $getReportOffcierD->name);
            $worksheet->setCellValue('A'.($row+11), $getReportOffcierD->position);
            $worksheet->setCellValue('H'.($row+10), $dateFormat);
            $worksheet->setCellValue('C'.($row+10), $getReportOffcierV->name);
            $worksheet->setCellValue('C'.($row+11), $getReportOffcierV->position);
        }
        
        
        $grandTotal = $grandTotalCash + $grandTotalCheck + $grandTotalBankDeposit;
        $remittance = abs($grandTotalCash + $grandTotalCheck);
        
        $worksheet->setCellValue('D9', $grandTotal);
        $worksheet->setCellValue('D10', $grandTotal);
        $worksheet->setCellValue('C11', $grandTotalBankDeposit);
        $worksheet->setCellValue('C12', $remittance);
        $worksheet->setCellValue('D12', $remittance);

        $worksheet->getStyle('C5:C12')->getFont()->setBold(true);
        $worksheet->getStyle('D3:D13')->getFont()->setBold(true);
        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $remittance = number_format($remittance, 2);
        $numWords = explode('.', strval($remittance));
        $wholeNumber = $f->format(str_replace(',', '', $numWords[0]));
        if (count($numWords) > 1) {
            $decimalNumber = $f->format($numWords[1]);
            if ($row >= 14) {
                $worksheet->setCellValue('C'.($row+4), $wholeNumber.' pesos and '.$decimalNumber.' centavos only (PHP '.$remittance.')');
            } else {
                $worksheet->setCellValue('C18', $wholeNumber.' pesos and '.$decimalNumber.' centavos only (PHP '.$remittance.')');
            }
            
        } else {
            if ($row >= 14) {
                $worksheet->setCellValue('C'.($row+4), $wholeNumber.' pesos only (PHP '.$remittance.'.00)');
            } else {
                $worksheet->setCellValue('C18', $wholeNumber.' pesos only (PHP '.$remittance.'.00)');
            }
            
        }
        $worksheet->getStyle('C3:D13')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        if ($row >= 14) {
            $worksheet->getStyle('C'.($row+3))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        } else {
            $worksheet->getStyle('C18')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        }
        

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(public_path('storage/ReportsTemplate/CollectionsDepositsReport.xlsx'));
        
        return response()->download(public_path('storage/ReportsTemplate/CollectionsDepositsReport.xlsx'))->DeleteFileAfterSend(true);
    }
}
