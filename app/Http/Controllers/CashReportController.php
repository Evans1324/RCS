<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use App\Models\LandTaxInfo;
use App\Models\LandTaxAccount;
use App\Models\DistrictHospitalsCollections;
use App\Models\Serial;
use App\Models\Holidays;
use App\Models\CashBegBalance;

class CashReportController extends Controller
{
    public function generateCashReport(Request $request)
    {
        $startDate = Date('Y-m-d',strtotime($request->startDate));
        $endDate = Date('Y-m-d',strtotime($request->endDate));
        $dailyStart = Date('Y-m-d',strtotime('-1 day', strtotime($request->startDate)));

        $endDateTS = Date('Y-m-d',strtotime('+1 day', strtotime($request->startDate)));
        $beforeDateTS = Date('Y-m-d',strtotime('-1 day', strtotime($request->startDate)));
        
        $currentDay = Date('D', strtotime($request->startDate));
        
        if ($currentDay == 'Mon') {
            $currentDateStart = Date('Y-m-d', strtotime('-3 day', strtotime($request->startDate)));
            $currentDateEnd= Date('Y-m-d', strtotime('-3 day', strtotime($request->endDate)));
        } else {
            $currentDateStart = Date('Y-m-d', strtotime('-1 day', strtotime($request->startDate)));
            $currentDateEnd = Date('Y-m-d', strtotime('-1 day', strtotime($request->endDate)));
        }

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
        
        $cashBegBalance = CashBegBalance::where('cash_date', $beforeDateTS)
        ->first();

        $landTaxInfo = LandTaxInfo::select('municipalities.*', 'land_tax_infos.*')
        ->where([['receipt_type', 'Field Land Tax Collection Cash']])
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        ->whereNull('report_number')
        ->orderBy('serial_number', 'asc')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id')
        ->distinct()
        ->get();

        $revenueDailyTotal = LandTaxInfo::select(DB::raw('SUM(land_tax_accounts.amount) AS amount'))
        ->where([['land_tax_infos.deleted_at', null], ['land_tax_infos.status', '<>', 'Cancelled'], ['land_tax_infos.submission_type', 'Revenue Collection']])
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        ->whereIn('transact_type', ['Cash', 'Check'])
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->groupBy('report_date')
        ->first();

        $revenueDailyCash = LandTaxInfo::select(DB::raw('SUM(land_tax_accounts.amount) AS amount'))
        ->where([['land_tax_infos.deleted_at', null], ['land_tax_infos.submission_type', 'Revenue Collection'], ['transact_type', 'Cash'], ['land_tax_infos.status', '<>', 'Cancelled'],])
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->groupBy('report_date')
        ->first();

        $revenueDailyCheck = LandTaxInfo::select(DB::raw('SUM(land_tax_accounts.amount) AS amount'))
        ->where([['land_tax_infos.deleted_at', null], ['land_tax_infos.submission_type', 'Revenue Collection'], ['transact_type', 'Check'], ['land_tax_infos.status', '<>', 'Cancelled'],])
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->groupBy('report_date')
        ->first();
        
        $revCheck = 0.00;
        if ($revenueDailyCheck == null) {
            $revCheck = 0.00;
        } else {
            $revCheck = $revenueDailyCheck->amount;
        }

        $revenueDailyTotalPrevDay = LandTaxInfo::select(DB::raw('SUM(land_tax_accounts.amount) AS amount'))
        ->where([['land_tax_infos.deleted_at', null], ['land_tax_infos.submission_type', 'Revenue Collection']])
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->groupBy('report_date')
        ->first();

        $revenueDailyCashPrevDay = LandTaxInfo::select(DB::raw('SUM(land_tax_accounts.amount) AS amount'))
        ->where([['land_tax_infos.deleted_at', null], ['land_tax_infos.submission_type', 'Revenue Collection'], ['transact_type', 'Cash']])
        ->whereBetween('land_tax_infos.report_date', [$currentDateStart, $currentDateEnd])
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->groupBy('report_date')
        ->first();

        $revenueDailyCheckPrevDay = LandTaxInfo::select(DB::raw('SUM(land_tax_accounts.amount) AS amount'))
        ->where([['land_tax_infos.deleted_at', null], ['land_tax_infos.submission_type', 'Revenue Collection'], ['transact_type', 'Check']])
        ->whereBetween('land_tax_infos.report_date', [$currentDateStart, $currentDateEnd])
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->groupBy('report_date')
        ->first();

        $CheckPrevDay = 0.00;
        if ($revenueDailyCheckPrevDay == null) {
            $CheckPrevDay = 0.00;
        } else {
            $CheckPrevDay = $revenueDailyCheckPrevDay->amount;
        }

        $liqudiatingOfficers = LandTaxInfo::select('officers.*', 'land_tax_infos.*')
        ->where([['receipt_type', 'Field Land Tax Collection Cash']])
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        ->whereNotNull('report_number')
        ->orderBy('report_number', 'asc')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('officers', 'officers.id', 'land_tax_infos.accountable_officer')
        ->distinct()
        ->get();

        $allCollections = LandTaxInfo::select('report_date', 'transact_type', 'total_amount')
        ->where([['land_tax_infos.status', '<>' ,'Cancelled'], ['land_tax_infos.receipt_type', 'Field Land Tax Collection Cash']])
        ->whereRaw('land_tax_infos.report_date ="'.$startDate.'"')
        ->get();
        
        $districtHospitals = DistrictHospitalsCollections::select('*', DB::raw('left_total AS total_amount'), DB::raw('ada_hc + ada_pc as total_ada'), 'officers.name')
        ->whereBetween('district_hospitals_collections.r_date', [$startDate, $endDate])
        ->leftJoin('officers', 'officers.id', 'district_hospitals_collections.acc_officer')
        ->get();
        
        $allCollectionsPrevDay = LandTaxInfo::select('report_date', 'transact_type', 'total_amount')
        ->where([['land_tax_infos.status', '<>' ,'Cancelled'], ['land_tax_infos.receipt_type', 'Field Land Tax Collection Cash']])
        ->whereRaw('land_tax_infos.report_date ="'.$currentDateStart.'"')
        ->get();
        
        $districtHospitalsPrevDay = DistrictHospitalsCollections::select('*', DB::raw('left_total AS total_amount'), DB::raw('ada_hc + ada_pc as total_ada'), 'officers.name')
        ->whereBetween('district_hospitals_collections.r_date', [$currentDateStart, $currentDateEnd])
        ->leftJoin('officers', 'officers.id', 'district_hospitals_collections.acc_officer')
        ->get();
        
        $getCheckOrMoneyOrder = LandTaxInfo::select('transact_type', 'total_amount', 'bank_name', 'number')
        ->whereRaw('land_tax_infos.report_date ="'.$startDate.'"')
        ->whereIn('transact_type', ['Check', 'Money Order'])
        ->orderBy('transact_type', 'asc')
        ->orderBy('bank_name', 'asc')
        ->get();
        
        $beginningSerials = Serial::select('land_tax_infos.report_date', 'serial_number', 'start_serial', 'serials.created_at', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'))
        ->whereRaw('land_tax_infos.serial_number < serials.end_serial AND serials.created_at <"'.$beforeDateTS.' 12:00:00" AND land_tax_infos.report_date <= "'.$endDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
        ->orWhereRaw('land_tax_infos.serial_number <= serials.end_serial AND land_tax_infos.report_date <"'.$endDate.'" AND serials.created_at <"'.$beforeDateTS.' 12:00:00" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
        ->orWhereRaw('ISNULL(land_tax_infos.report_date) AND serials.created_at <="'.$beforeDateTS.' 12:00:00" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
        ->orWhereRaw('land_tax_infos.report_date IS NOT NULL AND serials.created_at <="'.$beforeDateTS.' 12:00:00" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
        ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
        ->orderBy('serials.unit', 'asc')
        ->orderBy('start_serial', 'asc')
        ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
        ->get();
        
        $startDate = Date('Y-m-d',strtotime($request->endDate));
        
        $newReceipts = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'))
        ->whereRaw('serials.created_at >= "'.$endDate.' 12:00:00" AND serials.created_at < "'.$endDateTS.' 12:00:00" AND land_tax_infos.report_date ="'.$startDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
        ->orWhereRaw('serials.created_at >= "'.$endDate.' 12:00:00" AND serials.created_at < "'.$endDateTS.' 12:00:00" AND ISNULL(land_tax_infos.report_date) AND serials.assigned_office = "Cash" AND serials.status = "Active"')
        ->orWhereRaw('serials.created_at <= "'.$endDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND land_tax_infos.report_date ="'.$startDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
        ->orWhereRaw('serials.created_at <= "'.$endDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND ISNULL(land_tax_infos.report_date) AND serials.assigned_office = "Cash" AND serials.status = "Active"')
        ->orWhereRaw('serials.created_at <= "'.$endDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND land_tax_infos.report_date > "'.$startDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
        ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
        ->orderBy('serials.unit', 'asc')
        ->orderBy('start_serial', 'asc')
        ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
        ->get();

        foreach($newReceipts as $new) {
            if ($new->report_date != $endDate) {
                $validateReceipt = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'))
                ->whereRaw('serials.id = '.$new->id.' AND serials.created_at >= "'.$endDate.' 12:00:00" AND serials.created_at < "'.$endDateTS.' 12:00:00" AND land_tax_infos.report_date ="'.$startDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
                ->orWhereRaw('serials.id = '.$new->id.' AND serials.created_at >= "'.$endDate.' 12:00:00" AND serials.created_at < "'.$endDateTS.' 12:00:00" AND ISNULL(land_tax_infos.report_date) AND serials.assigned_office = "Cash" AND serials.status = "Active"')
                ->orWhereRaw('serials.id = '.$new->id.' AND serials.created_at <= "'.$endDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND land_tax_infos.report_date ="'.$startDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
                ->orWhereRaw('serials.id = '.$new->id.' AND serials.created_at <= "'.$endDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND ISNULL(land_tax_infos.report_date) AND serials.assigned_office = "Cash" AND serials.status = "Active"')
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
            ->whereRaw('serials.id = '.$new->id.' AND land_tax_infos.serial_number < serials.end_serial AND serials.created_at <"'.$endDate.' 12:00:00" AND land_tax_infos.report_date < "'.$endDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();
            
            $validateSeries = Serial::select('serial_number', 'start_serial', 'serials.created_at', 'end_serial', 'serials.id', DB::raw('max(land_tax_infos.serial_number) AS latest'), 'land_tax_infos.report_date')
            ->whereRaw('serials.id = '.$new->id.' AND land_tax_infos.serial_number < serials.end_serial AND serials.created_at <"'.$endDate.' 12:00:00" AND land_tax_infos.report_date < "'.$endDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
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
                }
            }
        }
        
        $beginningSerials = $beginningSerialsArray;

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

        $centerAlign = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $verticalRight = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $verticalLeft = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];
        
        // Report A
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('storage/ReportsTemplate/CashCollectionsDeposits.xlsx'));
        $worksheet = $spreadsheet->getSheetByName('AB');

        $worksheet->setCellValue('D5', date('F j, Y', strtotime($startDate)));
        $worksheet->setCellValue('A6', 'NAME OF ACCOUNTABLE OFFICER:    '.$getReportOffcierA->name);
        $worksheet->setCellValue('D6', $request->reportNumber);
        $worksheet->getStyle('D5:D6')->applyFromArray($centerAlign);
        $worksheet->getStyle('D5:D6')->getFont()->setBold(true);

        $row = 10;
        foreach ($landTaxInfo as $info) {
            if ($info->client_type_radio == 'Individual' && $info->municipality_id != null) {
                $worksheet->setCellValue('A'.$row, 'Municipal Government of '.$info->municipality);
            } else {
                if ($info->client_type_radio== 'Individual') {
                    if ($info->middle_initial == null) {
                        $worksheet->setCellValue('A'.$row, $info->last_name.', '.$info->first_name);
                    } else {
                        $worksheet->setCellValue('A'.$row, $info->last_name.', '.$info->first_name.' '.$info->middle_initial);
                    }
                    
                } else {
                    $worksheet->setCellValue('A'.$row, $info->company);
                }
            }

            $worksheet->mergeCells('B'.$row.':C'.$row);
            $worksheet->setCellValue('B'.$row, $info->serial_number);
            $worksheet->getStyle('B'.$row)->applyFromArray($centerAlign);

            //Total
            $worksheet->setCellValue('D'.$row, (float)str_replace(',', '', $info->total_amount));
            $worksheet->getStyle('D10:D'.($row+2))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $worksheet->getStyle('D'.$row)->applyFromArray($verticalRight);

            $row++;
        }

        $worksheet->setCellValue('A'.($row+1), 'SUB-TOTAL');
        $worksheet->getStyle('A'.($row+1))->applyFromArray($centerAlign);
        $worksheet->getStyle('A'.($row+1))->getFont()->setBold(true);
        $worksheet->setCellValue('D'.($row+1), '=SUM(D10:D'.($row-1).')' );
        $collectorsTotal = $worksheet->getCell('D'.($row+1))->getCalculatedValue();
        
        $row2 = $row+3;

        $worksheet->setCellValue('A'.$row2, '2. For Liquidating Officers/Treasurer');
        $worksheet->getStyle('A'.$row2)->getFont()->setBold(true);
        $worksheet->mergeCells('B'.$row2.':C'.$row2);
        $worksheet->setCellValue('B'.$row2, 'REPORT NO.');
        $worksheet->getStyle('B'.$row2)->applyFromArray($centerAlign);
        $worksheet->getStyle('B'.$row2)->getFont()->setBold(true);
        $worksheet->setCellValue('D'.$row2, 'AMOUNT');
        $worksheet->getStyle('D'.$row2)->applyFromArray($centerAlign);
        $worksheet->getStyle('D'.$row2)->getFont()->setBold(true);
        $worksheet->setCellValue('A'.($row2+1), 'Name of Accountable Officer');
        $worksheet->getStyle('A'.($row2+1))->getFont()->setBold(true);

        foreach ($districtHospitals as $dh) {
            if ($dh->district_hospital != null) {
                $split = explode(' ', $dh->r_no);
                
                $worksheet->setCellValue('A'.($row2+2), $dh->name);
                $worksheet->setCellValue('D'.($row2+2), $dh->total_amount);
                // dump($split[0].' - '.$split[1]);
                if (count($split) <= 1) {
                    $worksheet->setCellValue('B'.($row2+2), $split[0]);
                } else {
                    $worksheet->setCellValue('B'.($row2+2), $split[0]);
                    $worksheet->setCellValue('C'.($row2+2), $split[1]);
                }

                if ($dh->total_ada != 0.00) {
                    if ($dh->cash != 0.00) {
                        $worksheet->setCellValue('B'.($row2+2), $split[0]);
                        $worksheet->setCellValue('C'.($row2+2), $split[1]);
                        $worksheet->setCellValue('D'.($row2+2), $dh->cash);
                        $row2++;
                    }

                    if ($dh->check != 0.00) {
                        $worksheet->setCellValue('B'.($row2+2), $split[0]);
                        $worksheet->setCellValue('C'.($row2+2), $split[1]);
                        $worksheet->setCellValue('D'.($row2+2), $dh->check);
                        $row2++;
                    }

                    if ($dh->bank_deposit != 0.00) {
                        $worksheet->setCellValue('B'.($row2+2), $dh->r_no);
                        $worksheet->setCellValue('C'.($row2+2), 'Deposited @ LBP Buguias Branch');
                        $worksheet->setCellValue('D'.($row2+2), $dh->bank_deposit);
                        $row2++;
                    }

                    $worksheet->setCellValue('B'.($row2+2), $split[0]);
                    $worksheet->setCellValue('C'.($row2+2), 'ADA');
                    $worksheet->setCellValue('D'.($row2+2), $dh->total_ada);
                }
                
                $worksheet->getStyle('B'.($row2+2).':B'.($row2+4))->applyFromArray($verticalRight);
                $worksheet->getStyle('C'.($row2+2))->applyFromArray($verticalLeft);
                $worksheet->getStyle('C'.($row2+2))->getFont()->setBold(true);
                
                $row2++;
            }
        }
        
        foreach($liqudiatingOfficers as $liquid) {
            
            $worksheet->setCellValue('A'.($row2+4), $liquid->name);
            $split = explode(' ', $liquid->report_number);
            
            if (count($split) <= 1) {
                $worksheet->setCellValue('B'.($row2+4), $split[0]);
            } else if (count($split) > 2) {
                $worksheet->setCellValue('B'.($row2+4), $split[0].'-'.$split[1]);
                $worksheet->setCellValue('C'.($row2+4), $split[2]);
            } else {
                $worksheet->setCellValue('B'.($row2+4), $split[0]);
                $worksheet->setCellValue('C'.($row2+4), $split[1]);
            }
            $worksheet->getStyle('B'.($row2+2))->applyFromArray($verticalRight);
            $worksheet->getStyle('C'.($row2+4))->applyFromArray($verticalLeft);
            $worksheet->getStyle('C'.($row2+2))->getFont()->setBold(true);
            $worksheet->setCellValue('D'.($row2+4), (float)str_replace(',', '', $liquid->total_amount));

            $row2++;
        }

        $genneralFund = LandTaxInfo::select('report_number')->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])->first();
        // $gfSplit = explode(' ', $genneralFund->report_number);

        $worksheet->setCellValue('A'.($row2+4), 'Mary Jane P. Lampacan');
        $worksheet->mergeCells('B'.($row2+4).':C'.($row2+4));
        $worksheet->setCellValue('B'.($row2+4), $genneralFund->report_number);
        // $worksheet->setCellValue('B'.($row2+4), $gfSplit[0]);
        // $worksheet->setCellValue('C'.($row2+4), $gfSplit[1]);
        $worksheet->setCellValue('D'.($row2+4), $revenueDailyTotal->amount);

        $worksheet->getStyle('B'.($row2+2).':B'.($row2+3))->applyFromArray($verticalRight);
        // $worksheet->getStyle('C'.($row2+2).':C'.($row2+3))->applyFromArray($verticalLeft);
        $worksheet->getStyle('B'.($row2+4).':B'.($row2+4))->applyFromArray($centerAlign);
        $worksheet->getStyle('C'.($row2+2).':C'.($row2+3))->getFont()->setBold(true);

        $worksheet->setCellValue('A'.($row2+6), 'SUB-TOTAL');
        $worksheet->getStyle('A'.($row2+6))->applyFromArray($centerAlign);
        $worksheet->getStyle('A'.($row2+6))->getFont()->setBold(true);
        
        $worksheet->setCellValue('D'.($row2+6), '=SUM(D'.($row+5).':D'.($row2+5).')' );
        $worksheet->getStyle('D'.($row+5).':D'.($row2+7))
            ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $officersTotal = $worksheet->getCell('D'.($row2+6))->getCalculatedValue();

        $worksheet->mergeCells('A'.($row2+7).':C'.($row2+7));
        $worksheet->setCellValue('A'.($row2+7), 'GRAND TOTAL');
        $worksheet->getStyle('A'.($row2+7))->getFont()->setBold(true);

        //Sheet B
        $rowB = $row2+8;
        $worksheet->setCellValue('A'.$rowB, 'B. REMITTANCES/DEPOSITS');
        $worksheet->getStyle('A'.$rowB)->getFont()->setBold(true);
        $worksheet->mergeCells('B'.$rowB.':C'.$rowB);
        $worksheet->setCellValue('B'.$rowB, 'Reference');
        $worksheet->getStyle('B'.$rowB)->applyFromArray($centerAlign);
        $worksheet->getStyle('B'.$rowB)->getFont()->setBold(true);
        $worksheet->setCellValue('D'.$rowB, 'AMOUNT');
        $worksheet->getStyle('D'.$rowB)->applyFromArray($centerAlign);
        $worksheet->getStyle('D'.$rowB)->getFont()->setBold(true);

        $worksheet->setCellValue('A'.($rowB+1), 'Land Bank ok the Philippines-La Trinidad Branch');
        $worksheet->getStyle('A'.($rowB+1))->getFont()->setBold(true);
        
        $getNature = LandTaxAccount::select('land_tax_infos.id', 'report_date', 'nature', 'amount')
        ->where([['account', 'Non-Income Collection (GF-LA)'], ['land_tax_infos.report_date', $startDate]])
        ->leftJoin('land_tax_infos', 'land_tax_infos.id', 'land_tax_accounts.info_id')
        ->get();
        
        $worksheet->setCellValue('B'.($rowB+1), 'GF');
        $worksheet->getStyle('B'.($rowB+1))->getFont()->setBold(true);
        $worksheet->getStyle('B'.($rowB+1))->applyFromArray($verticalRight);

        if ($getNature->isNotEmpty()) {
            $worksheet->setCellValue('C'.($rowB+1), 'LA');
            $worksheet->setCellValue('C'.($rowB+2), 'Cash');
            $worksheet->setCellValue('C'.($rowB+3), 'Check');
        } else {
            $worksheet->setCellValue('C'.($rowB+1), 'Cash');
            $worksheet->setCellValue('C'.($rowB+2), 'Check'); 
        }

        $dhCollCashB = 0;
        $dhCollCheckB = 0;
        $dhCollDepositB = 0;

        foreach ($districtHospitalsPrevDay as $dhColl) {
            $dhCollCashB += $dhColl->cash;
            $dhCollCheckB += $dhColl->check;
            $dhCollDepositB += $dhColl->bank_deposit;
        }
        
        $totalCashB = 0;
        $totalCheckB = 0;
        $totalDepositedB = 0;
        $grandTotalCashB = 0;
        $grandTotalCheckB = 0;
        $grandTotalMoneyOrderB = 0;
        $grandTotalADAB = 0;
        $grandTotalBankDepositB = 0;
        $natureAmount = 0;
        foreach($getNature as $nature) {
            $natureAmount += $nature->amount;
        }
        foreach ($allCollectionsPrevDay as $collPrev) {
            $totalCashB += (float)str_replace(',', '', $collPrev->total_amount);
            $grandTotalCashB = $totalCashB+$dhCollCashB+$revenueDailyCashPrevDay->amount;
            if ($getNature->isNotEmpty()) {
                if ($collPrev->transact_type == 'Cash') {
                    
                    $worksheet->setCellValue('D'.($rowB+1), $natureAmount);
                    $worksheet->setCellValue('D'.($rowB+2), $grandTotalCashB);
                }
                
                if ($dhCollCheckB != null) {
                    if ($collPrev->transact_type == 'Check') {
                        $totalCheckB += (float)str_replace(',', '', $collPrev->total_amount);
                    }
                    $grandTotalCheckB = $totalCheckB+$dhCollCheckB+$CheckPrevDay;
                    $worksheet->setCellValue('D'.($rowB+3), $grandTotalCheckB);
                } else {
                    if ($collPrev->transact_type == 'Check') {
                        $totalCheckB += (float)str_replace(',', '', $collPrev->total_amount);
                    }
                    $grandTotalCheckB = $totalCheckB+$dhCollCheckB+$CheckPrevDay;
                    $worksheet->setCellValue('D'.($rowB+3), $grandTotalCheckB);
                }
            } else {
                if ($collPrev->transact_type == 'Cash') {
                    $worksheet->setCellValue('D'.($rowB+1), $grandTotalCashB);
                }
                
                if ($dhCollCheckB != null) {
                    if ($collPrev->transact_type == 'Check') {
                        $totalCheckB += (float)str_replace(',', '', $collPrev->total_amount);
                    }
                    $grandTotalCheckB = $totalCheckB+$dhCollCheckB+$CheckPrevDay;
                    $worksheet->setCellValue('D'.($rowB+2), $grandTotalCheckB);
                } else {
                    if ($collPrev->transact_type == 'Check') {
                        $totalCheckB += (float)str_replace(',', '', $collPrev->total_amount);
                    }
                    $grandTotalCheckB = $totalCheckB+$dhCollCheckB+$CheckPrevDay;
                    $worksheet->setCellValue('D'.($rowB+2), $grandTotalCheckB);
                }
            }
            
        }

        foreach ($districtHospitals as $dhPrev) {
            if ($dhPrev->bank_deposit != 0.00) {
                $worksheet->setCellValue('D'.($rowB+3), $dhPrev->bank_deposit);
                $worksheet->setCellValue('B'.($rowB+3), 'Deposited @ LBP');
                $worksheet->getStyle('B'.($rowB+3))->applyFromArray($verticalRight);
                $worksheet->setCellValue('C'.($rowB+3), 'Buguias Branch');
            }
            
            if ($dhPrev->ada_hc != 0.00) {
                $rowB++;
                $worksheet->setCellValue('A'.($rowB+5), ' ');
                $worksheet->setCellValue('B'.($rowB+5), $dhPrev->district_hospital.'-HC');
                $worksheet->setCellValue('C'.($rowB+5), 'ADA');
                $worksheet->getStyle('B'.($rowB+5))->applyFromArray($verticalRight);
                $worksheet->getStyle('C'.($rowB+5))->applyFromArray($verticalLeft);
                $worksheet->getStyle('C'.($rowB+5))->getFont()->setBold(true);
                $worksheet->setCellValue('D'.($rowB+5), $dhPrev->ada_hc);
            } 
            
            if ($dhPrev->ada_pc != 0.00) {
                $worksheet->setCellValue('A'.($rowB+6), ' ');
                $worksheet->setCellValue('B'.($rowB+6), $dhPrev->district_hospital.'-PC');
                $worksheet->setCellValue('C'.($rowB+6), 'ADA');
                $worksheet->getStyle('B'.($rowB+6))->applyFromArray($verticalRight);
                $worksheet->getStyle('C'.($rowB+6))->applyFromArray($verticalLeft);
                $worksheet->getStyle('C'.($rowB+6))->getFont()->setBold(true);
                $worksheet->setCellValue('D'.($rowB+6), $dhPrev->ada_pc);
                $rowB++;
            }
            
        }

        $worksheet->getStyle('C'.($rowB).':C'.($rowB+7))->getFont()->setBold(true);
        $worksheet->setCellValue('D'.($rowB+8), '=SUM(D'.($rowB+1).':D'.($rowB+6).')');
        $worksheet->setCellValue('A'.($rowB+8), 'GRAND TOTAL');
        $worksheet->getStyle('A'.($rowB+8))->getFont()->setBold(true);
        $worksheet->getStyle('D'.($rowB+8))->getFont()->setBold(true);
        $worksheet->getStyle('A9'.':D'.($rowB+8))->applyFromArray($borderedStyleArray);
        $worksheet->getStyle('D'.($row2+7).':D'.($rowB+8))
            ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $worksheet->setCellValue('D'.($row2+7), $collectorsTotal+$officersTotal);

        //Sheet C
        $worksheet = $spreadsheet->getSheetByName('CD');
        $row = 6;
        
        $worksheet->insertNewRowBefore($row+1, count($beginningSerials));
        
        foreach ($beginningSerials as $index => $beginning) {
            $startDate = Date('Y-m-d', strtotime($request->startDate));

            $max = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', DB::raw('max(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$beginning->id.' AND land_tax_infos.report_date ="'.$startDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();

            $min = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', DB::raw('min(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$beginning->id.' AND land_tax_infos.report_date >="'.$startDate.'" AND land_tax_infos.report_date <="'.$endDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
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
            ->whereRaw('serials.id ='.$new->id.' AND land_tax_infos.report_date ="'.$startDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();

            $min = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', DB::raw('min(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$new->id.' AND land_tax_infos.report_date >="'.$startDate.'" AND land_tax_infos.report_date <="'.$endDate.'" AND serials.assigned_office = "Cash" AND serials.status = "Active"')
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
        // $worksheet->setCellValue('B'.$row, '=SUM(B7:B'.($row-1).')' );
        // $worksheet->setCellValue('E'.$row, '=SUM(E7:E'.($row-1).')' );
        // $worksheet->setCellValue('H'.$row, '=SUM(H7:H'.($row-1).')' );
        // $worksheet->setCellValue('K'.$row, '=SUM(K7:K'.($row-1).')' );
        $worksheet->getStyle('B'.$row.':K'.$row)
            ->getNumberFormat()
            ->setFormatCode('#,##0');

        $worksheet->getStyle('A3:M'.$row)->applyFromArray($borderedStyleArray);

        $rowD = $row+2;

        //Sheet D
        $worksheet->mergeCells('A'.$rowD.':E'.$rowD);
        $worksheet->setCellValue('A'.$rowD, 'D. SUMMARY OF COLLECTIONS AND REMITTANCES/DEPOSITS');
        $worksheet->getStyle('A'.$rowD)->getFont()->setBold(true);

        $worksheet->setCellValue('H'.$rowD, 'Check No.');
        $worksheet->getStyle('H'.$rowD)->getFont()->setBold(true);
        $worksheet->mergeCells('I'.$rowD.':J'.$rowD);
        $worksheet->setCellValue('I'.$rowD, 'Payee');
        $worksheet->getStyle('I'.$rowD)->getFont()->setBold(true);
        $worksheet->mergeCells('K'.$rowD.':L'.$rowD);
        $worksheet->setCellValue('K'.$rowD, 'Bank');
        $worksheet->getStyle('K'.$rowD)->getFont()->setBold(true);
        $worksheet->setCellValue('M'.$rowD, 'Amount');
        $worksheet->getStyle('M'.$rowD)->getFont()->setBold(true);
        $worksheet->setCellValue('I'.($rowD+14), 'TOTAL');
        $worksheet->getStyle('I'.($rowD+14))->getFont()->setBold(true);

        $rowL = 10;
        foreach ($getCheckOrMoneyOrder as $checkType) {
            $worksheet->setCellValue('H'.$rowL, $checkType->number);
            $worksheet->mergeCells('I'.$rowL.':J'.$rowL);
            $worksheet->setCellValue('I'.$rowL, "Prov'l Gov't of Benguet");
            $worksheet->mergeCells('K'.$rowL.':L'.$rowL);
            $worksheet->setCellValue('K'.$rowL, $checkType->bank_name);
            $worksheet->setCellValue('M'.$rowL, str_replace(',', '', $checkType->total_amount));
            $worksheet->getStyle('H'.$rowL.':M'.$rowL)->applyFromArray($centerAlign);
            $worksheet->getStyle('L'.$rowL.':M'.$rowL)->getFont()->setBold(true);
            $rowL++;
        }

        $worksheet->setCellValue('M'.($rowD+14), '=SUM(M10:M'.($rowD+13).')');
        $worksheet->getStyle('M'.($rowD+14))->getFont()->setBold(true);
        $worksheet->getStyle('M'.($rowD+14))->applyFromArray($centerAlign);
        $worksheet->getStyle('H'.($rowD).':M'.($rowD+14))->applyFromArray($borderedStyleArray);
        $worksheet->getStyle('M10:M'.($rowD+14))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $worksheet->setCellValue('A'.($rowD+1), 'Beginning Balance:');
        $worksheet->getStyle('A'.($rowD+1))->getFont()->setBold(true);
        $worksheet->mergeCells('C'.($rowD+1).':D'.($rowD+1));
        $worksheet->setCellValue('C'.($rowD+1), date('F j, Y', strtotime($request->reportDate)));
        $worksheet->getStyle('C'.($rowD+1))->applyFromArray($centerAlign);
        $worksheet->mergeCells('E'.($rowD+1).':F'.($rowD+1));

        if ($cashBegBalance != null) {
            $worksheet->setCellValue('E'.($rowD+1), $cashBegBalance->beg_balance);
            $worksheet->getStyle('E'.($rowD+1))->getFont()->setBold(true);
            $worksheet->getStyle('E'.($rowD+1))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        }
        
        $beginningTotal = $worksheet->getCell('E'.($rowD+1))->getCalculatedValue();
        $worksheet->getStyle('E'.($rowD+1))->applyFromArray($centerAlign);

        $worksheet->setCellValue('A'.($rowD+2), 'Add: Collections:');
        $worksheet->getStyle('A'.($rowD+2))->getFont()->setBold(true);
        $worksheet->setCellValue('B'.($rowD+3), 'Cash');

        $dhCollCash = 0;
        $dhCollCheck = 0;
        $dhCollDeposit = 0;

        foreach ($districtHospitals as $dhColl) {
            $dhCollCash += $dhColl->cash;
            $dhCollCheck += $dhColl->check;
            $dhCollDeposit += $dhColl->bank_deposit;
        }
        
        $totalCash = 0;
        $totalCheck = 0;
        $totalDeposited = 0;
        $grandTotalCash = 0;
        $grandTotalCheck = 0;
        $grandTotalMoneyOrder = 0;
        $grandTotalADA = 0;
        $grandTotalBankDeposit = 0;

        foreach ($allCollections as $coll) {
            if ($coll->transact_type == 'Cash') {
                $worksheet->mergeCells('C'.($rowD+3).':D'.($rowD+3));
                $totalCash += (float)str_replace(',', '', $coll->total_amount);
                $grandTotalCash = $totalCash+$dhCollCash+$revenueDailyCash->amount;
                $worksheet->setCellValue('C'.($rowD+3), $grandTotalCash);
            }
            
            if ($dhCollCheck != null) {
                $worksheet->mergeCells('C'.($rowD+4).':D'.($rowD+4));
                if ($coll->transact_type == 'Check') {
                    $totalCheck += (float)str_replace(',', '', $coll->total_amount);
                }
                $grandTotalCheck = $totalCheck+$dhCollCheck+$revCheck;
                $worksheet->setCellValue('C'.($rowD+4), $grandTotalCheck);
            } else {
                $worksheet->mergeCells('C'.($rowD+4).':D'.($rowD+4));
                if ($coll->transact_type == 'Check') {
                    $totalCheck += (float)str_replace(',', '', $coll->total_amount);
                }
                $grandTotalCheck = $totalCheck+$dhCollCheck+$revCheck;
                $worksheet->setCellValue('C'.($rowD+4), $grandTotalCheck);
            }

            // if ($coll->transact_type == 'Money Order') {
            //     $grandTotalMoneyOrder += (float)str_replace(',', '', $coll->total_amount);
            // }

            // if ($coll->transact_type == 'ADA-LBP') {
            //     $grandTotalADA += (float)str_replace(',', '', $coll->total_amount);
            // }

            // if ($coll->transact_type == 'Bank Deposit/Transfer') {
            //     $grandTotalBankDeposit += (float)str_replace(',', '', $coll->total_amount);
            // }
        }

        $grandTotalBankDH = 0;
        $deposited = '';
        $depositedBank = 0;
        $addTotal = 0;
        $ada = 0;

        if (count($districtHospitals) == 0) {
            $worksheet->mergeCells('E'.($rowD+6).':F'.($rowD+6));
            $worksheet->setCellValue('E'.($rowD+6), '=SUM(C'.($rowD+3).':C'.($rowD+6).')');
            $addTotal = $worksheet->getCell('E'.($rowD+6))->getCalculatedValue();
            $worksheet->getStyle('E'.($rowD+6))->getFont()->setBold(true);
            $worksheet->getStyle('E'.($rowD+6))->applyFromArray($centerAlign);
        } else {
            foreach ($districtHospitals as $dh) {
                $grandTotalBankDH += $dh->total_amount;
                if ($dh->bank_branch == 'LBP-Buguias') {
                    $worksheet->mergeCells('C'.($rowD+5).':D'.($rowD+5));
                    $worksheet->setCellValue('C'.($rowD+5), $dhCollDeposit);
                    $deposited = ' LBP-Buguias';
                } else if ($dh->bank_branch == 'LBP-Buguias' && $dh->bank_branch == 'LBP-LTB') {
                    $worksheet->mergeCells('C'.($rowD+5).':D'.($rowD+5));
                    $worksheet->setCellValue('C'.($rowD+5), $dhCollDeposit);
                    $deposited = ' LBP-Buguias & LBP-LTB';
                } else {
                    $worksheet->mergeCells('C'.($rowD+5).':D'.($rowD+5));
                    $worksheet->setCellValue('C'.($rowD+5), $dhCollDeposit);
                    $deposited = ' LBP-LTB';
                }
                $depositedBank = $worksheet->getCell('C'.($rowD+5))->getCalculatedValue();
    
                $worksheet->mergeCells('C'.($rowD+6).':D'.($rowD+6));
                if ($dh->total_ada != 0.00) {
                    $ada = $dh->total_ada;
                    $worksheet->setCellValue('C'.($rowD+6), $dh->total_ada);
                }
                
                $ada = $worksheet->getCell('C'.($rowD+6))->getCalculatedValue();
                $worksheet->mergeCells('E'.($rowD+6).':F'.($rowD+6));
                $worksheet->setCellValue('E'.($rowD+6), $grandTotalCash+$grandTotalCheck+$ada+$dhCollDeposit);
                // $worksheet->setCellValue('E'.($rowD+6), '=SUM(C'.($rowD+3).':C'.($rowD+6).')');
                $addTotal = $worksheet->getCell('E'.($rowD+6))->getCalculatedValue();
                $worksheet->getStyle('E'.($rowD+6))->getFont()->setBold(true);
                $worksheet->getStyle('E'.($rowD+6))->applyFromArray($centerAlign);
            }
        }
        
        $worksheet->getStyle('B'.($rowD+3))->getFont()->setBold(true);
        $worksheet->getStyle('B'.($rowD+3))->applyFromArray($verticalRight);
        $worksheet->setCellValue('B'.($rowD+4), 'Checks');
        $worksheet->getStyle('B'.($rowD+4))->getFont()->setBold(true);
        $worksheet->getStyle('B'.($rowD+4))->applyFromArray($verticalRight);
        $worksheet->setCellValue('B'.($rowD+5), 'Deposited @'.$deposited);
        $worksheet->getStyle('B'.($rowD+5))->getFont()->setBold(true);
        $worksheet->getStyle('B'.($rowD+5))->applyFromArray($verticalRight);
        $worksheet->setCellValue('B'.($rowD+6), 'ADA (PHIC)');
        $worksheet->getStyle('B'.($rowD+6))->getFont()->setBold(true);
        $worksheet->getStyle('B'.($rowD+6))->applyFromArray($verticalRight);
        $worksheet->mergeCells('A'.($rowD+7).':B'.($rowD+7));
        $worksheet->setCellValue('A'.($rowD+7), 'TOTAL');
        $worksheet->getStyle('E'.($rowD+7).':F'.($rowD+7))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        $worksheet->getStyle('E'.($rowD+7).':F'.($rowD+7))->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THICK)->setColor(new Color('000000'));
        $worksheet->mergeCells('E'.($rowD+7).':F'.($rowD+7));
        $worksheet->setCellValue('E'.($rowD+7), $beginningTotal+$addTotal);
        $firstTotal = $worksheet->getCell('E'.($rowD+7))->getCalculatedValue();
        $worksheet->getStyle('E'.($rowD+7))->getFont()->setBold(true);
        $worksheet->getStyle('E'.($rowD+7))->applyFromArray($centerAlign);
        $worksheet->getStyle('A'.($rowD+7))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($rowD+7))->applyFromArray($verticalLeft);

        $worksheet->setCellValue('A'.($rowD+8), 'Less:');
        $worksheet->getStyle('A'.($rowD+8))->getFont()->setBold(true);
        $worksheet->mergeCells('A'.($rowD+9).':B'.($rowD+9));
        $worksheet->setCellValue('A'.($rowD+9), 'Remittance/Deposit to Cashier Treasurer/');
        $worksheet->getStyle('A'.($rowD+9))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($rowD+9))->applyFromArray($verticalRight);
        $worksheet->mergeCells('A'.($rowD+10).':B'.($rowD+10));
        $worksheet->setCellValue('A'.($rowD+10), 'Depository Bank');
        $worksheet->getStyle('A'.($rowD+10))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($rowD+10))->applyFromArray($verticalRight);
        $worksheet->mergeCells('E'.($rowD+10).':F'.($rowD+10));
        $worksheet->setCellValue('E'.($rowD+10), $beginningTotal);
        $worksheet->getStyle('E'.($rowD+10))->applyFromArray($centerAlign);
        $worksheet->mergeCells('A'.($rowD+11).':B'.($rowD+11));
        $worksheet->setCellValue('A'.($rowD+11), 'Deposited @'.$deposited);
        $worksheet->getStyle('A'.($rowD+11))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($rowD+11))->applyFromArray($verticalRight);
        $worksheet->mergeCells('E'.($rowD+11).':F'.($rowD+11));
        $worksheet->setCellValue('E'.($rowD+11), $depositedBank);
        $worksheet->getStyle('E'.($rowD+11))->applyFromArray($centerAlign);
        $worksheet->mergeCells('A'.($rowD+12).':B'.($rowD+12));
        $worksheet->setCellValue('A'.($rowD+12), 'ADA (PHIC)');
        $worksheet->getStyle('A'.($rowD+12))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($rowD+12))->applyFromArray($verticalRight);
        $worksheet->mergeCells('E'.($rowD+12).':F'.($rowD+12));
        $worksheet->setCellValue('E'.($rowD+12), $ada);
        
        $worksheet->getStyle('E'.($rowD+12))->applyFromArray($centerAlign);
        $worksheet->mergeCells('A'.($rowD+13).':B'.($rowD+13));
        $worksheet->setCellValue('A'.($rowD+13), 'TOTAL');
        $worksheet->getStyle('A'.($rowD+13))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($rowD+13))->applyFromArray($verticalLeft);
        $worksheet->mergeCells('E'.($rowD+13).':F'.($rowD+13));
        $worksheet->getStyle('E'.($rowD+13).':F'.($rowD+13))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        $worksheet->setCellValue('E'.($rowD+13), $beginningTotal+$depositedBank+$ada);
        $secondTotal = $worksheet->getCell('E'.($rowD+13))->getCalculatedValue();
        $worksheet->getStyle('E'.($rowD+13))->getFont()->setBold(true);
        $worksheet->getStyle('E'.($rowD+13))->applyFromArray($centerAlign);
        $worksheet->mergeCells('A'.($rowD+14).':B'.($rowD+14));
        $worksheet->setCellValue('A'.($rowD+14), 'ENDING BALANCE');
        $worksheet->getStyle('A'.($rowD+14))->getFont()->setBold(true);
        $worksheet->mergeCells('E'.($rowD+14).':F'.($rowD+14));
        $grandTotal = $firstTotal-$secondTotal;
        $worksheet->setCellValue('E'.($rowD+14), $firstTotal-$secondTotal);
        $worksheet->getStyle('E'.($rowD+14).':F'.($rowD+14))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        $worksheet->getStyle('E'.($rowD+14).':F'.($rowD+14))->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THICK)->setColor(new Color('000000'));
        $endingBalance = $worksheet->getCell('E'.($rowD+14))->getCalculatedValue();
        $worksheet->getStyle('E'.($rowD+14))->getFont()->setBold(true);
        $worksheet->getStyle('E'.($rowD+14))->applyFromArray($centerAlign);

        $worksheet->getStyle('C12:C17')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $worksheet->getStyle('E12:E25')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $check = CashBegBalance::where('cash_date' ,$startDate)->first();
        if ($check) {
            $balance = CashBegBalance::find($check->id);
            $balance->cash_date = $startDate;
            $balance->beg_balance = $endingBalance;
            $balance->save();
        } else {
            $balance = new CashBegBalance;
            $balance->cash_date = $startDate;
            $balance->beg_balance = $endingBalance;
            $balance->save(); 
        }

        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $remittance = number_format($grandTotal, 2);
        $numWords = explode('.', strval($remittance));
        $wholeNumber = $f->format(str_replace(',', '', $numWords[0]));
        if (count($numWords) > 1) {
            $decimalNumber = $f->format($numWords[1]);
            $worksheet->setCellValue('G30', $wholeNumber.' pesos and '.$decimalNumber.' centavos only');
        } else {
            $worksheet->setCellValue('G30', $wholeNumber.' pesos only (PHP '.$remittance.'.00)');
        }
        $worksheet->mergeCells('G30:M30');
        $worksheet->getStyle('G30')->getAlignment()->setWrapText(true);
        // remittance grand total
        $worksheet->mergeCells('K32:M32');
        $worksheet->getStyle('K32:M32')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THICK)->setColor(new Color('000000'));
        $worksheet->setCellValue('K32', $grandTotal);
        $worksheet->getStyle('K32')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $worksheet->getStyle('G'.($rowD+17).':G'.($row+30))->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        $worksheet->getStyle('G30')->getFont()->setBold(true);
        $worksheet->getStyle('K32')->getFont()->setBold(true);

        $worksheet->getStyle('A'.($rowD+17).':M'.($rowD+17))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        $worksheet->getStyle('A'.($rowD+17).':A'.($rowD+30))->getBorders()->getleft()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));

        $worksheet->setCellValue('A'.($rowD+17), 'CERTIFICATION:');
        $worksheet->getStyle('A'.($rowD+17))->getFont()->setBold(true);
        $worksheet->setCellValue('A'.($rowD+19), '      I hereby certify that the foregoing report of Collections and deposit, and  accountability for ');
        $worksheet->setCellValue('A'.($rowD+20), 'accountable forms is true and correct.');

        $worksheet->mergeCells('A'.($rowD+25).':B'.($rowD+25));
        $worksheet->setCellValue('A'.($rowD+25), $getReportOffcierA->name);
        $worksheet->getStyle('A'.($rowD+25))->getFont()->setBold(true);
        $worksheet->setCellValue('D'.($rowD+25), date('F j, Y', strtotime($request->reportDate)));
        $worksheet->mergeCells('A'.($rowD+26).':B'.($rowD+26));
        $worksheet->setCellValue('A'.($rowD+26), 'Name and Signature');
        $worksheet->mergeCells('A'.($rowD+27).':B'.($rowD+27));
        $worksheet->setCellValue('A'.($rowD+27), 'Accountable Officer');
        $worksheet->getStyle('A'.($rowD+25).':D'.($rowD+27))->applyFromArray($centerAlign);
        // $worksheet->getStyle('G'.($rowD+17).':G'.($rowD+30))->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));

        $worksheet->setCellValue('G'.($rowD+17), 'VERIFICATION AND ACKNOWLEDGEMENT:');
        $worksheet->getStyle('G'.($rowD+17))->getFont()->setBold(true);
        $worksheet->setCellValue('G'.($rowD+19), '      I hereby certify that the foregoing report of collections has been verified and acknowledge ');
        $worksheet->setCellValue('G'.($rowD+20), 'receipt the amount of');

        $worksheet->setCellValue('J'.($rowD+23), 'Php');
        $worksheet->getStyle('J'.($rowD+23))->getFont()->setBold(true);
        $worksheet->getStyle('J'.($rowD+23))->applyFromArray($verticalRight);

        $worksheet->mergeCells('G'.($rowD+25).':H'.($rowD+25));
        $worksheet->setCellValue('G'.($rowD+25), $getReportOffcierB->name);
        $worksheet->getStyle('G'.($rowD+25))->getFont()->setBold(true);
        $worksheet->mergeCells('K'.($rowD+25).':M'.($rowD+25));
        $worksheet->setCellValue('K'.($rowD+25), date('F j, Y', strtotime($request->reportDate)));
        $worksheet->getStyle('K'.($rowD+25))->applyFromArray($centerAlign);
        $worksheet->mergeCells('G'.($rowD+26).':H'.($rowD+26));
        $worksheet->setCellValue('G'.($rowD+26), 'Name and Signature');
        $worksheet->mergeCells('G'.($rowD+27).':H'.($rowD+27));
        $worksheet->setCellValue('G'.($rowD+27), 'Accountable Officer');
        $worksheet->getStyle('G'.($rowD+25).':J'.($rowD+27))->applyFromArray($centerAlign);

        $worksheet->getStyle('M'.($rowD+17).':M'.($row+30))->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        $worksheet->getStyle('A'.($rowD+28).':M'.($rowD+28))->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(public_path('storage/ReportsTemplate/CashCollectionsDepositsReport.xlsx'));
        return response()->download(public_path('storage/ReportsTemplate/CashCollectionsDepositsReport.xlsx'))->DeleteFileAfterSend(true);

    }
}
