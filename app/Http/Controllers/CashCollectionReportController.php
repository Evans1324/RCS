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
use App\Models\Municipalities;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;


class CashCollectionReportController extends Controller
{
    public function generateDailyPvetReport(Request $request)
    {
        $startRangeDate = date('Y-m-d', strtotime($request->startDate));
        $endRangeDate = date('Y-m-d', strtotime($request->endDate));
        $endDateTS = Date('Y-m-d',strtotime('+1 day', strtotime($request->startDate)));
        $beforeDateTS = Date('Y-m-d',strtotime('-1 day', strtotime($request->startDate)));
        $balanceDate = Date('F j, Y', strtotime($request->endDate));

        $qsArray = [];
        foreach ($request->quarantineStation as $qs) {
            $stations = $qs;
            array_push($qsArray, $stations);
        }
        
        $pvetCollections = LandTaxInfo::select('report_date', 'serial_number', 'last_name', 'first_name', 'middle_initial', 'land_tax_accounts.account', 'land_tax_accounts.amount', 'serials.quarantine_stations')
        ->where(function($queue) {
            $queue->where('land_tax_accounts.account', 'Clearance & Certification Fees (General Fund-Proper)')
            ->orWhere('land_tax_accounts.account', 'Supervision and Regulation, Enforcement Fees (Quarantine Fees)')
            ->orWhere('land_tax_accounts.account', 'Fines & Penalties - Service Income (General Fund-Proper)');
        })
        ->where('submission_type', 'Pvet Collection')
        ->whereIn('quarantine_stations', $qsArray)
        ->whereBetween('land_tax_infos.report_date', [$startRangeDate, $endRangeDate])
        ->orderBy('land_tax_infos.id', 'asc')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('serials', 'serials.id', 'land_tax_infos.series_id')
        ->get();

        $pvetAccTitles = LandTaxInfo::select('land_tax_accounts.id', 'land_tax_accounts.account', 'land_tax_accounts.amount')
        ->where(function($queue) {
            $queue->where('land_tax_accounts.account', 'Clearance & Certification Fees (General Fund-Proper)')
            ->orWhere('land_tax_accounts.account', 'Supervision and Regulation, Enforcement Fees (Quarantine Fees)')
            ->orWhere('land_tax_accounts.account', 'Fines & Penalties - Service Income (General Fund-Proper)');
        })
        ->where('submission_type', 'Pvet Collection')
        ->whereIn('quarantine_stations', $qsArray)
        ->whereBetween('land_tax_infos.report_date', [$startRangeDate, $endRangeDate])
        ->orderBy('land_tax_infos.id', 'asc')
        ->groupBy('land_tax_accounts.account')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('serials', 'serials.id', 'land_tax_infos.series_id')
        ->get();

        $getPreparedByOffcierB = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'cert_officers.id')
        ->where('cert_officers.id', $request->reportOfficerColB)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();
        
        $beginningSerials = Serial::select('land_tax_infos.report_date', 'serial_number', 'start_serial', 'serials.created_at', 'end_serial', 'serials.id', 'serials.pvet_officer', DB::raw('max(land_tax_infos.serial_number) AS latest'))
        ->whereRaw('land_tax_infos.serial_number < serials.end_serial AND serials.created_at <"'.$beforeDateTS.' 12:00:00" AND land_tax_infos.report_date <= "'.$endRangeDate.'" AND land_tax_infos.deleted_at IS NULL AND pvet_officer = "'.$request->reportOfficerCol.'"')
        ->orWhereRaw('land_tax_infos.serial_number <= serials.end_serial AND land_tax_infos.report_date <"'.$endRangeDate.'" AND serials.created_at <"'.$beforeDateTS.' 12:00:00" AND land_tax_infos.deleted_at IS NULL AND pvet_officer = "'.$request->reportOfficerCol.'"')
        ->orWhereRaw('ISNULL(land_tax_infos.report_date) AND serials.created_at <="'.$beforeDateTS.' 12:00:00" AND land_tax_infos.deleted_at IS NULL AND pvet_officer = "'.$request->reportOfficerCol.'"')
        // ->whereBetween('land_tax_infos.report_date', [$startRangeDate, $endRangeDate])
        ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
        ->orderBy('serials.unit', 'asc')
        ->orderBy('start_serial', 'asc')
        ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
        ->get();
        // dd($beginningSerials);

        $newReceipts = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.id', 'serials.pvet_officer', DB::raw('max(land_tax_infos.serial_number) AS latest'))
        ->whereRaw('serials.created_at >= "'.$endRangeDate.' 12:00:00" AND serials.created_at < "'.$endDateTS.' 12:00:00" AND land_tax_infos.report_date ="'.$startRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
        ->orWhereRaw('serials.created_at >= "'.$endRangeDate.' 12:00:00" AND serials.created_at < "'.$endDateTS.' 12:00:00" AND ISNULL(land_tax_infos.report_date) AND pvet_officer = "'.$request->reportOfficerCol.'"')
        ->orWhereRaw('serials.created_at <= "'.$endRangeDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND land_tax_infos.report_date ="'.$startRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
        ->orWhereRaw('serials.created_at <= "'.$endRangeDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND ISNULL(land_tax_infos.report_date) AND pvet_officer = "'.$request->reportOfficerCol.'"')
        ->orWhereRaw('serials.created_at <= "'.$endRangeDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND land_tax_infos.report_date > "'.$startRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
        ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
        ->orderBy('serials.unit', 'asc')
        ->orderBy('start_serial', 'asc')
        ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
        ->get();
        
        foreach($newReceipts as $new) {
            if ($new->report_date != $endRangeDate) {
                $validateReceipt = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.id', 'serials.pvet_officer', DB::raw('max(land_tax_infos.serial_number) AS latest'))
                ->whereRaw('serials.id = '.$new->id.' AND serials.created_at >= "'.$endRangeDate.' 12:00:00" AND serials.created_at < "'.$endDateTS.' 12:00:00" AND land_tax_infos.report_date ="'.$startRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
                ->orWhereRaw('serials.id = '.$new->id.' AND serials.created_at >= "'.$endRangeDate.' 12:00:00" AND serials.created_at < "'.$endDateTS.' 12:00:00" AND ISNULL(land_tax_infos.report_date) AND pvet_officer = "'.$request->reportOfficerCol.'"')
                ->orWhereRaw('serials.id = '.$new->id.' AND serials.created_at <= "'.$endRangeDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND land_tax_infos.report_date ="'.$startRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
                ->orWhereRaw('serials.id = '.$new->id.' AND serials.created_at <= "'.$endRangeDate.' 12:00:00" AND serials.created_at > "'.$beforeDateTS.' 12:00:00" AND ISNULL(land_tax_infos.report_date) AND pvet_officer = "'.$request->reportOfficerCol.'"')
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
            $validateReceipt = Serial::select('land_tax_infos.report_date', 'serial_number', 'start_serial', 'serials.created_at', 'end_serial', 'serials.id', 'serials.pvet_officer', DB::raw('max(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id = '.$new->id.' AND land_tax_infos.serial_number < serials.end_serial AND serials.created_at <"'.$endRangeDate.' 12:00:00" AND land_tax_infos.report_date < "'.$endRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
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
            }
        }
        
        $beginningSerials = $beginningSerialsArray;

        $borderedStyleArray = [
            'borders' => [
              'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000']
              ]
            ]
        ];

        $centerAlign = [
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

        // Report AB
            // Report A
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('storage/ReportsTemplate/PvetReport.xlsx'));
        $worksheet = $spreadsheet->getSheetByName('AB');

        $accTitlesColumns = [];
        $allColumns = [];
        $columnStart = 'D';
        $row = 11;

        if (count($pvetAccTitles) === 0) {

        } else {
            foreach ($pvetAccTitles as $pvetTitles) {
                array_push($accTitlesColumns, [$pvetTitles->account=>$columnStart]);
                array_push($allColumns, $columnStart);
                $worksheet->setCellValue($columnStart.($row-1), $pvetTitles->account);
                $worksheet->setCellValue(chr(ord($columnStart)+1).($row-1), 'Total');
                $worksheet->getColumnDimension($columnStart)->setWidth(25);
                $worksheet->getStyle($columnStart.($row-1).':'.chr(ord($columnStart)+1).($row-1))->applyFromArray($centerAlign);
                $spreadsheet->getActiveSheet()->getStyle($columnStart.($row-1))->getAlignment()->setWrapText(true);
                $columnStart++;
            }
        }
        
        foreach ($pvetCollections as $coll) {
            $tmp = $coll->account;

            $collDate = date('d-M-y', strtotime($coll->report_date));
            $worksheet->setCellValue('A'.$row, $collDate);
            $worksheet->setCellValue('B'.$row, $coll->serial_number);
            $worksheet->getStyle('A'.$row.':B'.$row)->applyFromArray($centerAlign);
            $worksheet->setCellValue('C'.$row, $coll->last_name.', '.$coll->first_name.' '.$coll->middle_initial);

            foreach ($accTitlesColumns as $accCols) {
                if (isset($accCols[$tmp]) == true) {
                    $worksheet->setCellValue($accCols[$tmp].$row, $coll->amount);
                    break;
                }
            }

            $worksheet->setCellValue($columnStart.$row, '=SUM(C'.$row.':'.$columnStart.$row.')');
            $row++;
        }

        $worksheet->setCellValue('B'.$row, 'Total');
        $worksheet->getStyle('B'.$row)->getFont()->setBold(true);
        
        foreach ($allColumns as $colls) {
            $worksheet->setCellValue($colls.$row, '=SUM('.$colls.'11'.':'.$colls.($row-1).')');
        }
        
        $worksheet->setCellValue($columnStart.$row, '=SUM('.$columnStart.'11'.':'.$columnStart.($row-1).')' );
        $grandTotal = $worksheet->getCell($columnStart.$row)->getCalculatedValue();
        
        $worksheet->mergeCells('A2:'.$columnStart.'2');
        $worksheet->mergeCells('A3:'.$columnStart.'3');
        $worksheet->mergeCells('A5:'.$columnStart.'5');

        $worksheet->mergeCells('A'.($row+1).':B'.($row+1));
        $worksheet->setCellValue('A'.($row+1), '2. For Liquidating Officers');
        $worksheet->mergeCells('A'.($row+2).':B'.($row+2));
        $worksheet->setCellValue('A'.($row+2), '    Name of Accountable Officer');
        $worksheet->mergeCells('A'.($row+3).':B'.($row+3));
        $worksheet->setCellValue('A'.($row+3), '    Sub-Total');
        $worksheet->mergeCells('A'.($row+4).':B'.($row+4));
        $worksheet->setCellValue('A'.($row+4), 'GRAND TOTAL');
        $worksheet->setCellValue($columnStart.($row+4) , $grandTotal);
        $worksheet->getStyle($columnStart.($row+4))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($row+4))->getFont()->setBold(true);
        $worksheet->getStyle("A10:".$columnStart.($row+4))->applyFromArray($borderedStyleArray);

            // Report B
        $rowB = ($row+5);

        $worksheet->mergeCells('A'.$rowB.':B'.$rowB);
        $worksheet->setCellValue('A'.$rowB, 'B. REMITTANCES/DEPOSITS');
        $worksheet->getStyle('A'.$rowB)->getFont()->setBold(true);
        $worksheet->mergeCells('A'.($rowB+1).':B'.($rowB+1));
        $worksheet->setCellValue('A'.($rowB+1), 'Accountale Officer/Bank');
        $worksheet->mergeCells('A'.($rowB+2).':B'.($rowB+2));
        $worksheet->setCellValue('A'.($rowB+2), strtoupper($getPreparedByOffcierB->name));

        $worksheet->setCellValue('C'.($rowB+1), 'Reference No.');
        $worksheet->setCellValue('C'.($rowB+2), $request->reportNo);
        $worksheet->getStyle('C'.($rowB+1).':C'.($rowB+2))->applyFromArray($centerAlign);

        $worksheet->setCellValue('D'.($rowB+1), 'Amount');
        $worksheet->getStyle('D'.($rowB+1))->applyFromArray($centerAlign);
        $worksheet->setCellValue('D'.($rowB+2), $grandTotal);
        $worksheet->getStyle('D'.($rowB+2))->getFont()->setBold(true);
        $worksheet->getStyle('D'.($rowB+2))->applyFromArray($verticalRight);
        $worksheet->getStyle('D11:'.$columnStart.$rowB)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $worksheet->getStyle('D'.($rowB+2))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


        // Report CD
            // Report C
        $worksheet = $spreadsheet->getSheetByName('CD');

        $row = 5;
        foreach ($beginningSerials as $beginning) {
            $max = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.pvet_officer', DB::raw('max(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$beginning->id.' AND land_tax_infos.report_date ="'.$startRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();

            $min = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.pvet_officer', DB::raw('min(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$beginning->id.' AND land_tax_infos.report_date >="'.$startRangeDate.'" AND land_tax_infos.report_date <="'.$endRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();

            $worksheet->setCellValue('C'.$row, $beginning->start_serial);
            $qty = $beginning->end_serial - $beginning->start_serial + 1;
            $f = null;

            if ($beginning->report_date == $endRangeDate) {
                $worksheet->setCellValue('C'.$row, $beginning->start_serial);
            } else if ($beginning->latest == null) {
                $worksheet->setCellValue('C'.$row, $beginning->start_serial);
            }  else {
                $worksheet->setCellValue('C'.$row, $beginning->latest+1);
                $qty = $beginning->end_serial - $beginning->start_serial;
            }

            $issuedQty = 0;
            if ($min != null) {
                $worksheet->setCellValue('C'.$row, $beginning->start_serial+1);
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
                $worksheet->setCellValue('L'.$row, $beginning->start_serial);
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
                $worksheet->setCellValue('L'.$row, $max->latest+1);
                $worksheet->setCellValue('M'.$row, $new->end_serial);
            } else {
                $endingQty = $beginning->end_serial - $beginning->start_serial + 1;
            }
            if ($endingQty < 0) {
                $endingQty = 0;
            }
            $worksheet->setCellValue('K'.$row, $endingQty);
            
            $worksheet->setCellValue('B'.$row, $qty);
            $worksheet->setCellValue('D'.$row, $beginning->end_serial);
            $row++;
        }

        foreach ($newReceipts as $new) {
            $max = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.pvet_officer', DB::raw('max(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$new->id.' AND land_tax_infos.report_date ="'.$startRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();

            $min = Serial::select('land_tax_infos.report_date', 'start_serial', 'end_serial', 'serials.pvet_officer', DB::raw('min(land_tax_infos.serial_number) AS latest'))
            ->whereRaw('serials.id ='.$new->id.' AND land_tax_infos.report_date >="'.$startRangeDate.'" AND land_tax_infos.report_date <="'.$endRangeDate.'" AND pvet_officer = "'.$request->reportOfficerCol.'"')
            ->groupBy('serials.id', 'serials.start_serial', 'serials.end_serial')
            ->orderBy('serials.unit', 'asc')
            ->orderBy('start_serial', 'asc')
            ->leftJoin('land_tax_infos', 'serials.id', 'land_tax_infos.series_id')
            ->first();

            $qty = $new->end_serial - $new->start_serial + 1;
            $f = null;
            $issuedQty = 0;
            if ($new->report_date != $endRangeDate) {
                $f =  $new->start_serial;
            } else if ($new->latest == null) {
                $f =  $new->start_serial;
            } else {
                $f =  $new->start_serial;
                $qty = $new->end_serial - $new->start_serial + 1;
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
        $worksheet->setCellValue('B'.$row, '=SUM(B5:B'.($row-1).')' );
        $worksheet->setCellValue('E'.$row, '=SUM(E5:E'.($row-1).')' );
        $worksheet->setCellValue('H'.$row, '=SUM(H5:H'.($row-1).')' );
        $worksheet->setCellValue('K'.$row, '=SUM(K5:K'.($row-1).')' );
        $worksheet->getStyle("A5:M".$row)->applyFromArray($borderedStyleArray);

        $rowC = ($row+1);
        
        $worksheet->setCellValue('A'.$rowC, 'D. SUMMARY OF COLLECTIONS AND REMITTANCES/DEPOSITS');
        $worksheet->getStyle('A'.$rowC)->getFont()->setBold(true);
        $worksheet->setCellValue('A'.($rowC+1), '   Beginning Balance, '.$balanceDate);
        $worksheet->setCellValue('A'.($rowC+2), '   Add: Collections');
        $worksheet->setCellValue('A'.($rowC+3), '   Cash');
        $worksheet->setCellValue('A'.($rowC+4), '   Check');
        $worksheet->setCellValue('A'.($rowC+5), '   Less: Remittance/Deposit to Cashier/Treasurer');
        $worksheet->setCellValue('A'.($rowC+6), '   Balance');

        $worksheet->mergeCells('G'.($rowC+1).':H'.($rowC+1));
        $worksheet->setCellValue('G'.($rowC+1), 'Check No.');
        $worksheet->getStyle('G'.($rowC+1))->applyFromArray($centerAlign);

        $worksheet->mergeCells('I'.($rowC+1).':K'.($rowC+1));
        $worksheet->setCellValue('I'.($rowC+1), 'Payee');
        $worksheet->getStyle('I'.($rowC+1))->applyFromArray($centerAlign);

        $worksheet->mergeCells('L'.($rowC+1).':M'.($rowC+1));
        $worksheet->setCellValue('L'.($rowC+1), 'Amount');
        $worksheet->getStyle('L'.($rowC+1))->applyFromArray($centerAlign);

        $worksheet->setCellValue('E'.($rowC+3), $grandTotal);
        $worksheet->setCellValue('E'.($rowC+5), $grandTotal);
        $worksheet->getStyle('E'.($rowC+3).':E'.($rowC+6))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $worksheet->getStyle('G'.($rowC+1).':M'.($rowC+1))->applyFromArray($borderedStyleArray);
        $worksheet->getStyle('G'.($rowC+1).':M'.($rowC+3))->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));

        $rowD = $rowC+8;
        //Left side
        $worksheet->setCellValue('A'.$rowD, 'CERTIFICATION:');
        $worksheet->mergeCells('A'.($rowD+1).':F'.($rowD+1));
        $worksheet->setCellValue('A'.($rowD+1), '   I hereby certify that the foregoing report of collections and deposits');
        $worksheet->mergeCells('A'.($rowD+2).':F'.($rowD+2));
        $worksheet->setCellValue('A'.($rowD+2), 'and accountability for the accountable forms is true and correct.');

        $worksheet->mergeCells('A'.($rowD+5).':B'.($rowD+5));
        $worksheet->setCellValue('A'.($rowD+5), strtoupper($request->reportOfficerCol));
        $worksheet->getStyle('A'.($rowD+5))->applyFromArray($centerAlign);

        $worksheet->mergeCells('A'.($rowD+6).':B'.($rowD+6));
        $worksheet->setCellValue('A'.($rowD+6), 'Name and Signature');
        $worksheet->getStyle('A'.($rowD+6))->applyFromArray($centerAlign);

        $worksheet->mergeCells('A'.($rowD+7).':B'.($rowD+7));
        $worksheet->setCellValue('A'.($rowD+7), 'Accountabe Officer');
        $worksheet->getStyle('A'.($rowD+7))->applyFromArray($centerAlign);
        
        $worksheet->mergeCells('D'.($rowD+5).':E'.($rowD+5));
        $worksheet->setCellValue('D'.($rowD+5), $collDate);
        $worksheet->getStyle('D'.($rowD+5))->applyFromArray($centerAlign);

        $worksheet->mergeCells('D'.($rowD+6).':E'.($rowD+6));
        $worksheet->setCellValue('D'.($rowD+6), 'Date');
        $worksheet->getStyle('D'.($rowD+6))->applyFromArray($centerAlign);
        $worksheet->getStyle('D'.($rowD+6).':E'.($rowD+6))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));

        //Right side
        $worksheet->setCellValue('G'.$rowD, 'VERIFICATION AND ACKNOWLEDGEMENT:');
        $worksheet->mergeCells('G'.($rowD+1).':M'.($rowD+1));
        $worksheet->setCellValue('G'.($rowD+1), '   I hereby certify that the foregoing report of collections has been verified and acknowledge receipt of');
        $worksheet->mergeCells('G'.($rowD+2).':M'.($rowD+2));
        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $numWords = explode('.', strval($grandTotal));
        $wholeNumber = $f->format($numWords[0]);
        if (count($numWords) > 1) {
            $decimalNumber = $f->format($numWords[1]);
            $worksheet->setCellValue('G'.($rowD+2), $wholeNumber.' pesos and '.$decimalNumber.' centavos only (PHP '.number_format($grandTotal, 2).')');
        } else {
            $worksheet->setCellValue('G'.($rowD+2), $wholeNumber.' pesos only (PHP '.number_format($grandTotal, 2).'.00)');
        }
        $worksheet->getStyle('G'.($rowD+2))->getFont()->setBold(true);

        $worksheet->mergeCells('G'.($rowD+5).':I'.($rowD+5));
        $worksheet->setCellValue('G'.($rowD+5), strtoupper($getPreparedByOffcierB->name));
        $worksheet->getStyle('G'.($rowD+5))->applyFromArray($centerAlign);

        $worksheet->mergeCells('G'.($rowD+6).':I'.($rowD+6));
        $worksheet->setCellValue('G'.($rowD+6), 'Name and Signature');
        $worksheet->getStyle('G'.($rowD+6))->applyFromArray($centerAlign);

        $worksheet->mergeCells('G'.($rowD+7).':I'.($rowD+7));
        $worksheet->setCellValue('G'.($rowD+7), 'Accountabe Officer');
        $worksheet->getStyle('G'.($rowD+7))->applyFromArray($centerAlign);

        $worksheet->mergeCells('K'.($rowD+5).':L'.($rowD+5));
        $worksheet->setCellValue('K'.($rowD+5), $collDate);
        $worksheet->getStyle('K'.($rowD+5))->applyFromArray($centerAlign);

        $worksheet->mergeCells('K'.($rowD+6).':L'.($rowD+6));
        $worksheet->setCellValue('K'.($rowD+6), 'Date');
        $worksheet->getStyle('K'.($rowD+6))->applyFromArray($centerAlign);
        $worksheet->getStyle('K'.($rowD+6).':L'.($rowD+6))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));

        $worksheet->getStyle('A'.$rowD.':F'.($rowD+7))->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        $worksheet->getStyle('G'.$rowD.':M'.($rowD+7))->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
        $worksheet->getStyle('A'.$row.':M'.($rowD+7))->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(public_path('storage/ReportsTemplate/PvetReportTemplate.xlsx'));
        return response()->download(public_path('storage/ReportsTemplate/PvetReportTemplate.xlsx'))->DeleteFileAfterSend(true);
    }
}
