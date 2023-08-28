<?php

namespace App\Http\Controllers;

use \Datetime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Positions;
use App\Models\CertOfficers;
use App\Models\LandTaxInfo;
use App\Models\LandTaxAccount;
use App\Models\CollectionRate;
use App\Models\BudgetEstimate;
use App\Models\SpecialCase;
use App\Models\Municipalities;
use App\Models\AccountGroup;
use App\Models\AccountTitles;
use App\Models\AccountSubtitles;
use App\Models\Post;
use App\Models\DistrictHospitalsCollections;
use App\Models\AccountSubSubtitles;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class procincialIncomeReportController extends Controller
{
    public function generateProvIncomeReport(Request $request) 
    {
        $currentDay = Date('d');
        $currentMonth = Date('m');
        $currYear = Date('Y');
        $nextYear = Date('Y', strtotime($request->piYear));

        $getAccCategories = Post::select('posts.id', 'posts.acc_category_settings')
        ->whereNotIn('posts.acc_category_settings', ['Trust Fund'])
        ->get();

        $getAccGroups = AccountGroup::select('account_groups.id', 'account_groups.type', 'account_groups.category_id')
        ->whereNotIn('account_groups.type', ['BAC Drugs & Meds', 'BAC Goods & Services', 'BAC INFRA', 'Accounts Payable', 'Particulars'])
        ->get();

        $getIncomeType = LandTaxInfo::select('land_tax_infos.role', 'land_tax_infos.role', 'land_tax_accounts.acc_title_id', 'land_tax_accounts.sub_title_id', 'serial_number', DB::raw('SUM(land_tax_accounts.amount) AS total'))
        ->orWhereBetween('role_created', [$nextYear.'-01-01', $nextYear.'-1-31'])
        ->groupBy('land_tax_infos.id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->get();
        
        $startOfCollectionAcc = LandTaxInfo::select('land_tax_accounts.acc_title_id','serial_number', 'role', DB::raw('SUM(land_tax_accounts.amount) AS total'))
        ->where([['land_tax_infos.status', '<>', 'Cancelled'], ['land_tax_infos.deleted_at', null], ['land_tax_infos.role', 0]])
        ->whereBetween('report_date', [$request->piYear.'-01-01', $request->piYear.'-'.$request->piMonthStart.'-31'])
        ->orWhereBetween('role_created', [$nextYear.'-01-01', $nextYear.'-01-31'], ['land_tax_infos.role', 2])
        ->groupBy('land_tax_accounts.acc_title_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->get();
        
        $monthlyCollectionAcc = LandTaxInfo::select('land_tax_accounts.acc_title_id', 'land_tax_infos.role', 'serial_number', 'land_tax_accounts.amount', DB::raw('SUM(prov_share) AS prov'), DB::raw('SUM(land_tax_accounts.amount) AS total'))
        ->where([['land_tax_infos.status', '<>', 'Cancelled'], ['deleted_at', null], ['land_tax_infos.role', 0]])
        // ->whereMonth('report_date', $request->piMonthStart)
        ->whereBetween('report_date', [$request->piYear.'-'.$request->piMonthStart.'-01', $request->piYear.'-'.$request->piMonthStart.'-31'])
        ->orWhereBetween('role_created', [$nextYear.'-01-01', $nextYear.'-01-31'], ['land_tax_infos.role', 2])
        ->groupBy('land_tax_accounts.acc_title_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->get();

        $monthlyCollectionSandGravel = LandTaxInfo::select('land_tax_accounts.acc_title_id', 'land_tax_infos.role', 'report_date', 'prov_share', DB::raw('SUM(land_tax_accounts.amount) AS total'))
        ->where([['land_tax_infos.status', '<>', 'Cancelled'], ['land_tax_accounts.account', 'Tax on Sand, Gravel & Other Quarry Prod.'], ['deleted_at', null], ['land_tax_infos.role', 0]])
        // ->whereMonth('report_date', $request->piMonthStart)
        ->whereBetween('report_date', [$request->piYear.'-'.$request->piMonthStart.'-01', $request->piYear.'-'.$request->piMonthStart.'-31'])
        ->orWhereBetween('role_created', [$nextYear.'-01-01', $nextYear.'-01-31'], ['land_tax_infos.role', 2])
        ->groupBy('land_tax_infos.serial_number')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->get();

        $setBudget = BudgetEstimate::select('acc_titles_id', 'sub_titles_id', 'sub_subtitles_id', 'amount', 'year')
        ->where('year', $request->piYear)
        ->get();

        $getAccTitles = AccountTitles::select('account_titles.id', 'account_titles.title_pos', 'account_titles.title_code', 'account_titles.title_name', 'account_titles.title_category_id')
        // ->whereNotIn('account_titles.title_name', ['BAC Drugs & Meds', 'BAC Goods & Services', 'BAC INFRA', 'Accounts Payable'])
        ->where('account_titles.title_pos', '<>', 0)
        ->orderBy('account_titles.title_pos', 'asc')
        ->get();

        $AccTitlesLastIteration = AccountTitles::select('account_titles.id', 'account_titles.title_pos')
        ->where([['account_titles.title_pos', '<>', 0], ['title_category_id', '1']])
        ->orderBy('account_titles.title_pos', 'asc')
        ->get();

        $getSubTitles = AccountSubtitles::select('id', 'title_id', 'subtitle')
        // ->orderBy('account_subtitles.title_id', 'asc')
        ->orderBy('account_subtitles.sub_code')
        ->get();
        
        $startOfCollectionSub = LandTaxInfo::select('land_tax_accounts.sub_title_id', 'land_tax_infos.role', DB::raw('SUM(land_tax_accounts.amount) AS total'))
        ->where([['land_tax_infos.status', '<>', 'Cancelled'], ['land_tax_infos.deleted_at', null], ['land_tax_infos.role', 0]])
        ->whereBetween('report_date', [$request->piYear.'-01-01', $request->piYear.'-'.$request->piMonthStart.'-31'])
        ->orWhereBetween('role_created', [$nextYear.'-01-01', $nextYear.'-01-31'], ['land_tax_infos.role', 2])
        ->groupBy('land_tax_accounts.sub_title_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->get();

        $monthlyCollectionSub = LandTaxInfo::select('land_tax_accounts.sub_title_id', DB::raw('SUM(land_tax_accounts.amount) AS total'))
        ->where([['land_tax_infos.status', '<>', 'Cancelled'], ['deleted_at', null], ['land_tax_infos.role', 0]])
        ->whereMonth('report_date', $request->piMonthStart)
        ->orWhereBetween('role_created', [$nextYear.'-01-01', $nextYear.'-01-31'], ['land_tax_infos.role', 2])
        ->groupBy('land_tax_accounts.sub_title_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->get();

        $getSubSubTitles = AccountSubSubtitles::select('id', 'subtitle_id', 'sub_subtitles')
        ->get();
        
        $getDistrictHospitalsStart = DistrictHospitalsCollections::select( DB::raw('SUM(cost_price) AS cost_sales'), DB::raw('SUM(prof_fees) AS prof_fees'))
        ->whereBetween('r_date', [$request->piYear.'-1-01', $request->piYear.'-'.$request->piMonthStart.'-'.$currentDay])
        // ->groupBy('district_hospitals_collections.cash_status')
        ->get();

        $getDistrictHospitalsMonthly = DistrictHospitalsCollections::select(DB::raw('SUM(cost_price) AS cost_sales'), DB::raw('SUM(prof_fees) AS prof_fees'))
        ->whereMonth('r_date', '=', $request->piMonthStart)
        // ->groupBy('district_hospitals_collections.cash_status')
        ->get();

        $getProfFeesMonthly = DistrictHospitalsCollections::select(DB::raw('SUM(prof_fees) AS others'))
        ->whereMonth('r_date', '=', $request->piMonthStart)
        ->get();


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
        
        // Report A
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('storage/ReportsTemplate/ProvincialIncome.xlsx'));
        $worksheet = $spreadsheet->getSheetByName('A');
 
        $currentMonth = date('m');
        $currentYear = date('Y');
        $today = date($request->piYear.'-'.$request->piMonthStart.'-d 00:00:00', strtotime($request->piMonthStart));
        $startMonth = strtoupper(date('F', mktime(0, 0, 0, $request->piMonthStart, 10)));
        $startMonthPascal = date('F', mktime(0, 0, 0, $request->piMonthStart, 10));
        $endMonth = strtoupper(date('F', strtotime("-1 month", mktime(0, 0, 0, $request->piMonthStart, 10))));
        $lastMonth = date('m', strtotime($endMonth));
        $lastDate = date('d', strtotime('last day of this month', strtotime($today)));

        $columnStart = 'A';
        $row = 9;
        if ($startMonth == 'JANUARY') {
            $worksheet->setCellValue($columnStart.'8', 'FOR THE PERIOD JANUARY');
        } else {
            $worksheet->setCellValue($columnStart.'8', 'FOR THE PERIOD JANUARY 01 TO '.$startMonth.' '.$lastDate.', '.$request->piYear);
        }
        
        $counter = 0;
        $share = 0;
        $monthlyShare = 0;
        foreach ($getAccCategories as $acc) {
                $worksheet->getStyle('A'.$row.':J'.($row+1))->applyFromArray($borderedStyleArray);
                // $worksheet->getStyle('A11:A'.($row+1))->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
            // if ($acc->acc_category_settings == 'General Fund-Proper') {
                $worksheet->setCellValue('A'.$row, 'ACCOUNT TITLE');
                $worksheet->mergeCells('A'.$row.':D'.$row);
                $worksheet->getStyle('A'.$row)->getFont()->setBold(true);
                $worksheet->getStyle('A'.$row)->getFont()->setSize(26);
                $worksheet->getStyle('A'.$row)->applyFromArray($centerAlign);
                $worksheet->getRowDimension($row)->setRowHeight(85);

                $worksheet->setCellValue('E'.$row, 'ACCOUNT CODE');
                $worksheet->mergeCells('E'.$row.':E'.($row+1));
                $worksheet->getStyle('E'.$row)->getFont()->setBold(true);
                $worksheet->getStyle('E'.$row)->getFont()->setSize(26);
                $worksheet->getStyle('E'.$row)->applyFromArray($centerAlign);
                $worksheet->getStyle('E'.$row)->getAlignment()->setWrapText(true);

                $worksheet->setCellValue('F'.$row, 'BUDGET ESTIMATE');
                $worksheet->mergeCells('F'.$row.':F'.($row+1));
                $worksheet->getStyle('F'.$row)->getFont()->setBold(true);
                $worksheet->getStyle('F'.$row)->getFont()->setSize(26);
                $worksheet->getStyle('F'.$row)->applyFromArray($centerAlign);
                $worksheet->getStyle('F'.$row)->getAlignment()->setWrapText(true);

                if ($startMonth == 'JANUARY') {
                    $worksheet->setCellValue('G'.$row, 'ACTUAL COLLECTION '.$startMonth.' 01 TO '.$lastDate.', '.$request->piYear);
                } else {
                    $worksheet->setCellValue('G'.$row, 'ACTUAL COLLECTION JANUARY 01 TO '.$endMonth.' '.$lastDate.', '.$request->piYear);
                }
                
                $worksheet->mergeCells('G'.$row.':G'.($row+1));
                $worksheet->getStyle('G'.$row)->getFont()->setBold(true);
                $worksheet->getStyle('G'.$row)->getFont()->setSize(26);
                $worksheet->getStyle('G'.$row)->applyFromArray($centerAlign);
                $worksheet->getStyle('G'.$row)->getAlignment()->setWrapText(true);

                $worksheet->setCellValue('H'.$row, 'ACTUAL COLLECTION '.$startMonth.' 01 TO '.$lastDate.', '.$request->piYear);
                $worksheet->mergeCells('H'.$row.':H'.($row+1));
                $worksheet->getStyle('H'.$row)->getFont()->setBold(true);
                $worksheet->getStyle('H'.$row)->getFont()->setSize(26);
                $worksheet->getStyle('H'.$row)->applyFromArray($centerAlign);
                $worksheet->getStyle('H'.$row)->getAlignment()->setWrapText(true);

                $worksheet->setCellValue('I'.$row, 'TOTAL');
                $worksheet->mergeCells('I'.$row.':I'.($row+1));
                $worksheet->getStyle('I'.$row)->getFont()->setBold(true);
                $worksheet->getStyle('I'.$row)->getFont()->setSize(26);
                $worksheet->getStyle('I'.$row)->applyFromArray($centerAlign);
                $worksheet->getStyle('I'.$row)->getAlignment()->setWrapText(true);

                $worksheet->setCellValue('J'.$row, '% OF COLLECTION');
                $worksheet->mergeCells('J'.$row.':J'.($row+1));
                $worksheet->getStyle('J'.$row)->getFont()->setBold(true);
                $worksheet->getStyle('J'.$row)->getFont()->setSize(26);
                $worksheet->getStyle('J'.$row)->applyFromArray($centerAlign);
                $worksheet->getStyle('J'.$row)->getAlignment()->setWrapText(true);

                $worksheet->setCellValue('A'.($row+1), $acc->acc_category_settings);
                $worksheet->getStyle('A'.($row+1))->getFont()->setBold(true);
                $worksheet->getStyle('A'.($row+1))->getFont()->setSize(22);
                $worksheet->getRowDimension(($row+1))->setRowHeight(85);
                $worksheet->getRowDimension(($row+2))->setRowHeight(25);
                
                
                foreach ($getAccGroups as $kgroup=>$groups) {
                    if ($acc->id == $groups->category_id) {
                        $worksheet->setCellValue($columnStart.($row+2), $groups->type);
                        $worksheet->getStyle('A'.($row+2))->getFont()->setBold(true);
                        $worksheet->getStyle('A'.($row+2))->getFont()->setUnderline(true);
                        $worksheet->getStyle('A'.($row+2))->getFont()->setSize(21);
                        $worksheet->getStyle('J'.($row+2).':J'.($row+2))->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                        $worksheet->getStyle('A'.($row+2).':A'.($row+2))->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                        foreach ($getAccTitles as $key=>$titles) {
                            if ($groups->id == $titles->title_category_id) {
                                $worksheet->setCellValue('B'.($row+3), $titles->title_name);
                                $worksheet->getStyle('B'.($row+3))->getFont()->setSize(21);
                                $worksheet->getStyle('A'.($row+3).':A'.($row+3))->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                                $worksheet->setCellValue('E'.($row+3), $titles->title_code);
                                
                                // Budget Estimate Acc. Titles
                                foreach ($setBudget as $budget) {
                                    if ($titles->id == $budget->acc_titles_id) {
                                        if ($titles->title_name == 'Share from National Wealth-Mining') {
                                            $worksheet->mergeCells('F'.($row+2).':F'.($row+3));
                                        }
                                        
                                        if ($budget->amount == 0.00) {
                                            $worksheet->setCellValue('F'.($row+3), '');
                                        } else {
                                            $worksheet->setCellValue('F'.($row+3), $budget->amount);
                                        }
                                        
                                        $worksheet->getStyle('F'.($row+3))->applyFromArray($verticalRight);
                                        $worksheet->getStyle('F'.($row+3))->getFont()->setBold(true);
                                    }
                                }

                                // Start of Collection
                                foreach ($startOfCollectionAcc as $start) {
                                    if ($titles->id == $start->acc_title_id) {
                                        if ($titles->title_name == 'Hospital Fees') {
                                            $worksheet->setCellValue('G'.($row+4), $start->total);
                                            if ($startMonth == 'JANUARY') {
                                                $startHosTotal = $worksheet->getCell('H'.($row+3))->getCalculatedValue();
                                                $worksheet->setCellValue('I'.($row+4), $startHosTotal);
                                            } else {
                                                $worksheet->setCellValue('I'.($row+4), '=SUM(G'.($row+4).':H'.($row+4).')');
                                            }
                                            
                                        } else if ($titles->title_name == 'Tax on Sand, Gravel & Other Quarry Prod.') {
                                            foreach ($monthlyCollectionSandGravel as $sgMonthly) {
                                                $share += $sgMonthly->prov_share;
                                            }
                                            $worksheet->setCellValue('G'.($row+3), $share);
                                        } else {
                                            $worksheet->setCellValue('G'.($row+3), $start->total);
                                            foreach ($getIncomeType as $type) {
                                                if ($titles->id == $type->acc_title_id) {
                                                    $worksheet->setCellValue('G'.($row+3), $start->total-$type->total);
                                                }
                                            }
                                        }

                                        if ($titles->title_name == 'Rent Income') {
                                            $worksheet->setCellValue('G'.($row+3), '');
                                        }
                                    }
                                }

                                // Monthly Collection
                                foreach ($monthlyCollectionAcc as $month) {
                                    if ($titles->id == $month->acc_title_id) {
                                        if ($titles->title_name == 'Hospital Fees') {
                                            $worksheet->setCellValue('H'.($row+4), $month->total);
                                            if ($startMonth == 'JANUARY') {
                                                $monthHosTotal = $worksheet->getCell('H'.($row+3))->getCalculatedValue();
                                                $worksheet->setCellValue('I'.($row+4), $monthHosTotal);
                                            } else {
                                                $worksheet->setCellValue('I'.($row+4), '=SUM(G'.($row+4).':H'.($row+4).')');
                                            }
                                        } else if ($titles->title_name == 'Tax on Sand, Gravel & Other Quarry Prod.') {
                                            foreach ($monthlyCollectionSandGravel as $sgMonthlyShare) {
                                                $monthlyShare += $sgMonthlyShare->prov_share;
                                            }
                                            $worksheet->setCellValue('H'.($row+3), $monthlyShare);
                                        } else {
                                            $worksheet->setCellValue('H'.($row+3), $month->total);
                                            foreach ($getIncomeType as $type) {
                                                if ($titles->id == $type->acc_title_id) {
                                                    $worksheet->setCellValue('H'.($row+3), $month->total-$type->total);
                                                }
                                            }
                                        }

                                        if ($titles->title_name == 'Rent Income') {
                                            $worksheet->setCellValue('H'.($row+3), '');
                                        }
                                    }
                                }

                                // Total
                                
                                if ($startMonth == 'JANUARY') {
                                    $janTotal = $worksheet->getCell('H'.($row+3))->getCalculatedValue();
                                    $worksheet->setCellValue('I'.($row+3), $janTotal);
                                } else {
                                    $worksheet->setCellValue('I'.($row+3), '=SUM(G'.($row+3).':H'.($row+3).')');
                                }
                                $totalSum = $worksheet->getCell('I'.($row+3))->getCalculatedValue();
                                
                                if ($totalSum == 0) {
                                    $worksheet->setCellValue('I'.($row+3), '');
                                }

                                $startCostSales = 0.00;
                                $monthlyCostSales = 0.00;

                                if ($titles->title_name == 'Other Service Income (General Fund-Proper)') {
                                    $start = $worksheet->getCell('G'.($row+3))->getCalculatedValue();
                                    $monthly = $worksheet->getCell('H'.($row+3))->getCalculatedValue();
                                    
                                    // Start of Collection
                                    foreach ($getDistrictHospitalsStart as $startDH) {
                                        $startCostSales = $startDH->prof_fees*0.05;
                                        $worksheet->setCellValue('G'.($row+3), $startCostSales+$start);
                                    }

                                    // Monthly Collection
                                    foreach ($getDistrictHospitalsMonthly as $monthlyDH) {
                                        $monthlyCostSales = $startDH->prof_fees*0.05;
                                        $worksheet->setCellValue('H'.($row+3), $monthlyCostSales+$monthly);
                                    }
                                    if ($startMonth == 'JANUARY') {
                                        $siTotal = $worksheet->getCell('H'.($row+3))->getCalculatedValue();
                                        $worksheet->setCellValue('I'.($row+4), $siTotal);
                                    } else {
                                        $worksheet->setCellValue('I'.($row+3), $startCostSales+$start+$monthlyCostSales+$monthly);
                                    }
                                }

                                if ($titles->title_name == 'Sales Revenue') {
                                    $worksheet->setCellValue('G'.($row+3), '');
                                    $worksheet->setCellValue('H'.($row+3), '');
                                    $worksheet->setCellValue('I'.($row+3), '');
                                }
                                
                                // Subtitles
                                foreach ($getSubTitles as $sub) {
                                    if ($titles->id == $sub->title_id) {
                                        $worksheet->setCellValue('C'.($row+4), $sub->subtitle);
                                        
                                        // Start of Collection
                                        foreach ($startOfCollectionSub as $startSub) {
                                            if ($sub->id == $startSub->sub_title_id) {
                                                $worksheet->setCellValue('G'.($row+4), $startSub->total);
                                                foreach ($getIncomeType as $type) {
                                                    if ($sub->id == $type->sub_title_id) {
                                                        $worksheet->setCellValue('G'.($row+4), $startSub->total-$type->total);
                                                    }
                                                }
                                            }
                                        }

                                        // Monthly Collection
                                        foreach ($monthlyCollectionSub as $monthlySub) {
                                            if ($sub->id == $monthlySub->sub_title_id) {
                                                $worksheet->setCellValue('H'.($row+4), $monthlySub->total);
                                                foreach ($getIncomeType as $type) {
                                                    if ($sub->id == $type->sub_title_id) {
                                                        $worksheet->setCellValue('H'.($row+4), $monthlySub->total-$type->total);
                                                    }
                                                }
                                            }
                                        }

                                        // Total
                                        if ($startMonth == 'JANUARY') {
                                            $subTotal = $worksheet->getCell('H'.($row+4))->getCalculatedValue();
                                            $worksheet->setCellValue('I'.($row+4), $subTotal);
                                            $totalSum = $worksheet->getCell('I'.($row+4))->getCalculatedValue();
                                        } else {
                                            $worksheet->setCellValue('I'.($row+4), '=SUM(G'.($row+4).':H'.($row+4).')');
                                            $totalSum = $worksheet->getCell('I'.($row+4))->getCalculatedValue();
                                        }
                                        
                                        
                                        if ($totalSum == 0) {
                                            $worksheet->setCellValue('I'.($row+4), '');
                                        }
                                        
                                        if ($sub->subtitle == 'Drugs and Medicines-5 District Hospitals') {
                                            $row++; 
                                            $worksheet->setCellValue('D'.($row+4), 'Sales');
                                            $worksheet->getStyle('D'.($row+4))->getFont()->setSize(21);
                                            
                                            $worksheet->setCellValue('D'.($row+5), 'Less: Cost of Sale');
                                            $worksheet->getStyle('D'.($row+5))->getFont()->setSize(21);
                                            $worksheet->getStyle('E'.($row+2).':J'.($row+3))->applyFromArray($borderedStyleArray);
                                            $row++;

                                            // Start of Collection
                                            foreach ($getDistrictHospitalsStart as $startDH) {
                                                $worksheet->setCellValue('G'.($row+4), $startDH->cost_sales);
                                            }

                                            // Monthly Collection
                                            foreach ($getDistrictHospitalsMonthly as $monthlyDH) {
                                                $worksheet->setCellValue('H'.($row+4), $monthlyDH->cost_sales);
                                            }

                                            foreach ($getSubSubTitles as $subSub) {
                                                foreach ($setBudget as $subBudget) {
                                                    if ($subSub->id == $subBudget->sub_subtitles_id) {
                                                        if ($subBudget->amount == 0.00) {
                                                            $worksheet->setCellValue('F'.($row+2), '');
                                                        } else {
                                                            if ($subSub->sub_subtitles == 'Sales') {
                                                                $worksheet->setCellValue('F'.($row+3), $subBudget->amount);
                                                                $worksheet->setCellValue('I'.($row+3), '=SUM(G'.($row+3).':H'.($row+3).')');
                                                                $salesTotal = $worksheet->getCell('I'.($row+3))->getCalculatedValue();
                                                                $worksheet->setCellValue('J'.($row+3), number_format((($salesTotal/$subBudget->amount)*100), 2).'%');
                                                            } else {
                                                                $worksheet->setCellValue('F'.($row+4), $subBudget->amount);
                                                                $worksheet->setCellValue('I'.($row+4), '=SUM(G'.($row+4).':H'.($row+4).')');
                                                                $lessTotal = $worksheet->getCell('I'.($row+4))->getCalculatedValue();
                                                                $worksheet->setCellValue('J'.($row+4), number_format((($lessTotal/$subBudget->amount)*100), 2).'%');
                                                            }
                                                        }
                                                        $worksheet->getStyle('F'.($row+2))->getFont()->setBold(true);
                                                        
                                                    }
                                                }


                                            }
                                        }

                                        if ($sub->subtitle == 'Accountable Forms/Printed forms') {
                                            $row++;
                                            $worksheet->setCellValue('D'.($row+4), 'Sales');
                                            $worksheet->getStyle('D'.($row+4))->getFont()->setSize(21);
                                            
                                            $worksheet->setCellValue('D'.($row+5), 'Less: Cost of Sale');
                                            $worksheet->getStyle('D'.($row+5))->getFont()->setSize(21);
                                            $worksheet->getStyle('E'.($row+3).':J'.($row+3))->applyFromArray($borderedStyleArray);
                                            $row++;
                                        }

                                        if ($sub->subtitle == 'Sales on Veterinary Products') {
                                            $row++;
                                            $worksheet->setCellValue('D'.($row+4), 'Sales');
                                            $worksheet->getStyle('D'.($row+4))->getFont()->setSize(21);
                                            
                                            $worksheet->setCellValue('D'.($row+5), 'Less: Cost of Sale');
                                            $worksheet->getStyle('D'.($row+5))->getFont()->setSize(21);
                                            $worksheet->getStyle('E'.($row+3).':J'.($row+3))->applyFromArray($borderedStyleArray);
                                            $row++;
                                        }
                                        // $worksheet->setCellValue('H'.($row+4), $sub->total);
                                        $worksheet->getStyle('C'.($row+2))->getFont()->setSize(21);
                                        $worksheet->getStyle('C'.($row+4))->getFont()->setSize(21);
                                        $worksheet->getStyle('E'.($row+3).':J'.($row+4))->applyFromArray($borderedStyleArray);
                                        $worksheet->getStyle('A'.($row+3).':A'.($row+4))->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                                        $row++;
                                        
                                        foreach ($setBudget as $budget) {
                                            if ($sub->id == $budget->sub_titles_id) {
                                                if ($budget->amount == 0.00) {
                                                    
                                                } else {
                                                    if ($sub->subtitle == 'Accountable Forms/Printed forms') {
                                                        $worksheet->setCellValue('F'.($row+1), $budget->amount);
                                                    } else {
                                                        $worksheet->setCellValue('F'.($row+3), $budget->amount);
                                                    }
                                                }
                                                $worksheet->getStyle('F'.($row+1).':F'.($row+3))->getFont()->setBold(true);
                                            }
                                        }

                                        $totalValSub = $worksheet->getCell('I'.($row+3))->getCalculatedValue();
                                        $budgetValSub = $worksheet->getCell('F'.($row+3))->getCalculatedValue();
                                        
                                        if ($totalValSub == 0 || $budgetValSub == null) {
                                            $worksheet->setCellValue('J'.($row+3), '');
                                        } else {
                                            $worksheet->setCellValue('J'.($row+3), number_format((($totalValSub/$budgetValSub)*100), 2).'%');
                                        }
                                    }
                                    
                                }

                                
                                
                                $totalVal = $worksheet->getCell('I'.($row+3))->getCalculatedValue();
                                $budgetVal = $worksheet->getCell('F'.($row+3))->getCalculatedValue();
                                if ($budgetVal == 0 || $totalVal == null) {
                                    $worksheet->setCellValue('J'.($row+3), '');
                                } else {
                                    $worksheet->setCellValue('J'.($row+3), number_format((($totalVal/$budgetVal)*100), 2).'%');
                                }
                                
                                $row++;
                                // replace 15 with the $AccTitlesLastIteration query that takes the last entered acc title for category_id 1
                                if ($key == 15 && $groups->id == 1) {
                                    $row++;
                                    $worksheet->getStyle('E'.($row+1).':J'.($row+1))->applyFromArray($borderedStyleArray);
                                    $worksheet->setCellValue('B'.($row+2), 'Sub - Total: Tax Revenue');
                                    $worksheet->getStyle('B'.($row+2))->getFont()->setSize(21);
                                    $worksheet->getStyle('A'.($row+2).':A'.($row+2))->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                                    // $worksheet->getStyle('E'.($row+2).':J'.($row+2))->applyFromArray($borderedStyleArray);
                                    
                                    //Budget Subtotal
                                    $worksheet->setCellValue('F'.($row+2), '=SUM(F12:F'.($row+2).')');
                                    $taxBudgetSub = $worksheet->getCell('F'.($row+2))->getCalculatedValue();
                                    //Actual Collection Jan - Current month Subtotal
                                    $worksheet->setCellValue('G'.($row+2), '=SUM(G12:G'.($row+2).')');
                                    $actualCollTax = $worksheet->getCell('G'.($row+2))->getCalculatedValue();
                                    //Actual Collection Current month Subtotal
                                    $worksheet->setCellValue('H'.($row+2), '=SUM(H12:H'.($row+2).')');
                                    $monthlyActualCollTax = $worksheet->getCell('H'.($row+2))->getCalculatedValue();
                                    //Total
                                    $worksheet->setCellValue('I'.($row+2), '=SUM(I12:I'.($row+2).')');
                                    $taxTotalSub = $worksheet->getCell('I'.($row+2))->getCalculatedValue();
                                    //% of Collection Subtotal
                                    if ($taxTotalSub == 0 || $taxBudgetSub == 0) {

                                    } else {
                                        $worksheet->setCellValue('J'.($row+2), number_format((($taxTotalSub/$taxBudgetSub)*100), 2).'%');
                                    }
                                    
                                    $worksheet->getStyle('B'.($row+2).':J'.($row+2))->getFont()->setBold(true);
                                }
                                $worksheet->getStyle('E'.($row+2).':J'.($row+2))->applyFromArray($borderedStyleArray);
                            }
                        }
                        
                        $row++;
                        if ($acc->acc_category_settings == 'General Fund-Proper') {
                            if ($groups->type == 'Share, Grants & Donations/Gains/Misc. Income') {
                                $worksheet->setCellValue('B'.($row+2), 'Sub - Total: Non-Tax Revenue');
                                $worksheet->getStyle('B'.($row+2))->getFont()->setSize(21);
                                //Budget Estimate
                                $worksheet->setCellValue('F'.($row+2), '=SUM(F'.($row-32).':F'.($row+2).')');
                                $nonTaxBudgetSub = $worksheet->getCell('F'.($row+2))->getCalculatedValue();
                                //Actual Collection Jan - Current month Subtotal
                                $worksheet->setCellValue('G'.($row+2), '=SUM(G'.($row-32).':G'.($row+2).')');
                                $actualCollNonTax = $worksheet->getCell('G'.($row+2))->getCalculatedValue();
                                //Actual Collection Current month Subtotal
                                $worksheet->setCellValue('H'.($row+2), '=SUM(H'.($row-32).':H'.($row+2).')');
                                $monthlyActualCollNonTax = $worksheet->getCell('H'.($row+2))->getCalculatedValue();
                                //Total
                                $worksheet->setCellValue('I'.($row+2), '=SUM(I'.($row-32).':I'.($row+2).')');
                                $nonTaxTotalSub = $worksheet->getCell('I'.($row+2))->getCalculatedValue();
                                //% of Collection Subtotal
                                if ($nonTaxTotalSub == 0 || $nonTaxBudgetSub == 0) {
    
                                } else {
                                    $worksheet->setCellValue('J'.($row+2), number_format((($nonTaxTotalSub/$nonTaxBudgetSub)*100), 2).'%');
                                }
                                $worksheet->getStyle('B'.($row+2).':J'.($row+2))->getFont()->setBold(true);
                                $worksheet->getStyle('A'.($row+2).':D'.($row+2))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                                $worksheet->getStyle('A'.($row+2).':D'.($row+2))->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                                $worksheet->getStyle('E'.($row+2).':J'.($row+2))->applyFromArray($borderedStyleArray);
                                $row++;
                            }
                        } else if ($acc->acc_category_settings == 'Special Education Fund (SEF)') {
                            //Budget Estimate
                            $worksheet->setCellValue('F'.($row+2), '=SUM(F'.($row-2).':F'.($row+1).')');
                            $budgetSef = $worksheet->getCell('F'.($row+2))->getCalculatedValue();
                            //Actual Collection Jan - Current month Subtotal
                            $worksheet->setCellValue('G'.($row+2), '=SUM(G'.($row-2).':G'.($row+1).')');
                            $actualCollSef = $worksheet->getCell('G'.($row+2))->getCalculatedValue();
                            //Actual Collection Current month Subtotal
                            $worksheet->setCellValue('H'.($row+2), '=SUM(H'.($row-2).':H'.($row+1).')');
                            $monthlyActualCollSef = $worksheet->getCell('H'.($row+2))->getCalculatedValue();
                            //Total
                            $worksheet->setCellValue('I'.($row+2), '=SUM(I'.($row-2).':I'.($row+1).')');
                            $TotalSef = $worksheet->getCell('I'.($row+2))->getCalculatedValue();
                            //% of Collection Subtotal
                            if ($TotalSef == 0 || $budgetSef == 0) {
    
                            } else {
                                $worksheet->setCellValue('J'.($row+2), number_format((($TotalSef/$budgetSef)*100), 2).'%');
                            }
                            $worksheet->getStyle('B'.($row+2).':J'.($row+2))->getFont()->setBold(true);
                            $worksheet->getStyle('A'.($row+2).':D'.($row+2))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                            $worksheet->getStyle('E'.($row+2).':J'.($row+2))->applyFromArray($borderedStyleArray);
                        } else {
                            //Budget Estimate
                            $worksheet->setCellValue('F'.($row+2), '=SUM(F'.($row-2).':F'.($row+1).')');
                            $budgetTrustFund = $worksheet->getCell('F'.($row+1))->getCalculatedValue();
                            //Actual Collection Jan - Current month Subtotal
                            $worksheet->setCellValue('G'.($row+2), '=SUM(G'.($row-2).':G'.($row+1).')');
                            $actualCollTrustFund = $worksheet->getCell('G'.($row+1))->getCalculatedValue();
                            //Actual Collection Current month Subtotal
                            $worksheet->setCellValue('H'.($row+2), '=SUM(H'.($row-2).':H'.($row+1).')');
                            $monthlyActualCollTrustFund = $worksheet->getCell('H'.($row+1))->getCalculatedValue();
                            //Total
                            $worksheet->setCellValue('I'.($row+2), '=SUM(I'.($row-2).':I'.($row+1).')');
                            $TotalTrustFund = $worksheet->getCell('I'.($row+1))->getCalculatedValue();
                            //% of Collection Subtotal
                            if ($TotalTrustFund == 0 || $budgetTrustFund == 0) {
    
                            } else {
                                $worksheet->setCellValue('J'.($row+2), number_format((($TotalTrustFund/$budgetTrustFund)*100), 2).'%');
                            }
                            $worksheet->getStyle('B'.($row+2).':J'.($row+2))->getFont()->setBold(true);
                            $worksheet->getStyle('A'.($row+2).':D'.($row+2))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                            $worksheet->getStyle('E'.($row+2).':J'.($row+2))->applyFromArray($borderedStyleArray);
                        }
                        
                    }
                }
                
                $row = $row+2;
                $worksheet->setCellValue('B'.$row, 'GRAND TOTAL - '.strtoupper(trim($acc->acc_category_settings, '-Proper')));
                $worksheet->getStyle('B'.$row.':J'.$row)->getFont()->setBold(true);
                $worksheet->getStyle('B'.$row)->getFont()->setSize(21);
                $worksheet->getStyle('A'.$row.':D'.$row)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                $worksheet->getStyle('E'.$row.':J'.$row)->applyFromArray($borderedStyleArray);
                
                if ($acc->acc_category_settings == 'General Fund-Proper') {
                    $grandBudgetTotal = $taxBudgetSub+$nonTaxBudgetSub;
                    $worksheet->setCellValue('F'.$row, $grandBudgetTotal);
                    $grandActualColl = $actualCollTax+$actualCollNonTax;
                    $worksheet->setCellValue('G'.$row, $grandActualColl);
                    $grandMonthlyActualColl = $monthlyActualCollTax+$monthlyActualCollNonTax;
                    $worksheet->setCellValue('H'.$row, $grandMonthlyActualColl);
                    $grandTotal = $taxTotalSub+$nonTaxTotalSub;
                    $worksheet->setCellValue('I'.$row, $grandTotal);
                    if ($grandTotal == 0) {
                        $worksheet->setCellValue('j'.$row, number_format(((1/$grandBudgetTotal)*100), 2).'%');
                    } elseif ($grandBudgetTotal == 0) {
                        $worksheet->setCellValue('j'.$row, number_format((($grandTotal/1)*100), 2).'%');
                    } else {
                        $worksheet->setCellValue('j'.$row, number_format((($grandTotal/$grandBudgetTotal)*100), 2).'%');
                    }
                    
                }
                $worksheet->getStyle('F12:J'.$row)
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                $worksheet->getStyle('J12:J'.$row)->applyFromArray($verticalRight);
                if ($acc->acc_category_settings == 'Special Education Fund (SEF)') {
                    $worksheet->getStyle('J'.($row-7))->applyFromArray($centerAlign);
                    $worksheet->getStyle('A'.($row-6))->applyFromArray($verticalLeft);
                }
                $worksheet->getStyle('E12:E'.$row)->applyFromArray($centerAlign);
                $worksheet->getStyle('E12:J'.$row)->getFont()->setSize(21);
                $row = $row+2;
            // }
        }

        $worksheet->setCellValue('H'.($row+7), $request->reportOfficerCol);
        $worksheet->mergeCells('H'.($row+7).':J'.($row+7));
        $worksheet->getStyle('H'.($row+7))->getFont()->setBold(true);
        $worksheet->getStyle('H'.($row+7))->applyFromArray($centerAlign);
        $worksheet->getStyle('H'.($row+7))->getFont()->setSize(30);
        $worksheet->setCellValue('H'.($row+8), 'Provincial Treasurer');
        $worksheet->mergeCells('H'.($row+8).':J'.($row+8));
        $worksheet->getStyle('H'.($row+8))->applyFromArray($centerAlign);
        $worksheet->getStyle('H'.($row+8))->getFont()->setSize(35);
        $worksheet->setBreak('A64', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);
        $worksheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(9,10);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(public_path('storage/ReportsTemplate/ProvincialIncomeReport.xlsx'));
        return response()->download(public_path('storage/ReportsTemplate/ProvincialIncomeReport.xlsx'))->DeleteFileAfterSend(true);
    }

    function getAccountTitlesPIR(Request $request) {
        $accData = DB::table('account_titles')->select('title_name AS title', 'title_name AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->leftJoin('collection_rates', 'collection_rates.acc_titles_id', 'account_titles.id')
        ->where([['title_name', 'like', '%'.$request->term.'%'],['deleted_at', null]])
        ->limit(10)->get();

        $accSubData = DB::table('account_subtitles')->select('subtitle AS title', 'subtitle AS value', 'rate_type AS type', 'fixed_rate', 'percent_value', 'percent_of',  'collection_rates.id')
        ->leftJoin('collection_rates', 'collection_rates.acc_subtitles_id', 'account_subtitles.id')
        ->where('subtitle', 'like', '%'.$request->term.'%')
        ->orderBy('subtitle')->limit(10)->get();

        $displayArray = array_merge($accData->toArray(), $accSubData->toArray());
        return ($displayArray);
    }
}
