<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\DB;
use App\Models\LandTaxInfo;
use App\Models\LandTaxAccount;
use App\Models\CollectionRate;
use App\Models\Serial;
use App\Models\Positions;
use App\Models\CertOfficers;
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

class CounterCheckController extends Controller
{
    public function generateProvIncomeCounterCheck(Request $request) {
        $startDate = Date('Y-m-d', strtotime($request->startDate));
        $endDate = Date('Y-m-d', strtotime($request->endDate));
        $nextYear = Date('Y', strtotime($request->startDate));
        
        $landTaxInfo = LandTaxInfo::select('officers.name AS accOfficer', 'rentals.*', 'rentals.name AS rental_name', 'land_tax_accounts.nature', 'barangays.*', 'municipalities.*', 'land_tax_infos.*', DB::raw('sum(land_tax_accounts.amount) as totalAmount'))
        ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
        ->where([['land_tax_accounts.account', $request->accTitle], ['land_tax_infos.status', '<>', 'Cancelled'], ['land_tax_infos.role', 0]])
        ->orWhereBetween('role_created', [$nextYear.'-01-01', $nextYear.'-01-31'], ['land_tax_infos.role', 2])
        // ->whereIn('land_tax_infos.submission_type', ['Revenue Collection', 'Cash Collection', 'OPAG Collection' ,'PVET Collection', 'PHO Collection', 'Memo Collection'])
        ->orderBy('report_date', 'asc')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id')
        ->leftJoin('barangays', 'barangays.id', 'land_tax_infos.barangay_id')
        ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id')
        ->leftJoin('officers', 'officers.id', 'land_tax_infos.accountable_officer')
        ->groupBy('land_tax_infos.id')
        ->distinct()
        ->get();
        
        $occurences = count($landTaxInfo);

        $file = public_path('storage/WordTemplates/AccountTitlesCounterCheck.docx');
        $templateProcessor = new TemplateProcessor($file);
        $grandTotal = 0;
        
        $templateProcessor->setValue('startRangeDate', Date('F j, Y', strtotime($startDate)));
        $templateProcessor->setValue('endRangeDate', Date('F j, Y', strtotime($endDate)));
        $templateProcessor->setValue('account_title', str_replace('&', '&amp;', strip_tags($request->accTitle)));
        $templateProcessor->cloneRow('or_number', $occurences);
        foreach ($landTaxInfo as $key => $info) {
            $grandTotal += str_replace(',', '', $info->totalAmount);
            $templateProcessor->setValue('or_number#'.($key+1), $info->serial_number);
            $templateProcessor->setValue('transact_date#'.($key+1), Date('M j, Y', strtotime($info->report_date)));
            $templateProcessor->setValue('coll_type#'.($key+1), $info->submission_type);

            if ($info->client_type_id == '2' || $info->client_type_id == '3' || $info->client_type_id == '14') {
                if ($info->business_name == null) {
                    $payor = $info->owner;
                } else if ($info->owner == null) {
                    $payor = str_replace('&', '&amp;', strip_tags($info->business_name));
                } else {
                    $payor = str_replace('&', '&amp;', strip_tags($info->business_name)).' By: '. $info->owner;
                }
            } else if ($info->client_type_id == '4') {
                $payor = $info->parentMunicipality->municipality .', '. $info->parentBarangay->barangay_name;
            } else if ($info->client_type_id == '5') {
                $payor = 'Municipal Government of ' . $info->parentMunicipality->municipality;
            } else if ($info->client_type_id == '6' || $info->client_type_id == '7') {
                if ($info->trade_name_permittees != null && $info->permittee != null) {
                    $payor = str_replace('&', '&amp;', strip_tags($info->trade_name_permittees)).' By: '. $info->permittee;
                } else if ($info->trade_name_permittees != null && $info->permittee == null) {
                    $payor = str_replace('&', '&amp;', strip_tags($info->trade_name_permittees));
                } else if ($info->trade_name_permittees == null && $info->permittee != null) {
                    $payor = $info->permittee;
                }
            } else if ($info->client_type_id == '9') {
                $payor = $info->parentRentals->name;
            } else if ($info->client_type_id == '10' || $info->client_type_id == '11') {
                if ($info->trade_name_permit_fees != null && $info->proprietor != null) {
                    $payor = str_replace('&', '&amp;', strip_tags($info->trade_name_permit_fees)).' By: '. $info->proprietor;
                } else if ($info->trade_name_permit_fees != null && $info->proprietor == null) {
                    $payor = str_replace('&', '&amp;', strip_tags($info->company));
                } else if ($info->trade_name_permit_fees == null && $info->proprietor != null) {
                    $payor = $info->proprietor;
                }
            } else if ($info->client_type_id == '12' || $info->client_type_id == '13') {
                if ($info->bidders_business_name == null) {
                    $payor = $info->owner_representative;
                } else if ($info->owner_representative == null) {
                    $payor = str_replace('&', '&amp;', strip_tags($info->bidders_business_name));
                } else {
                    $payor = str_replace('&', '&amp;', strip_tags($info->bidders_business_name)).' By: '. $info->owner_representative;
                }
            } else if ($info->accOfficer != null) {
                $payor = str_replace('&', '&amp;', strip_tags($info->accOfficer));
            } else {
                if ($info->client_type_radio == 'Individual') {
                    $payor = $info->first_name.' '.$info->middle_initial.' '.$info->last_name;
                } else if ($info->client_type_radio == 'Company') {
                    $payor = str_replace('&', '&amp;', strip_tags($info->company));
                } else {
                    $payor = str_replace('&', '&amp;', strip_tags($info->spouses));
                }
            }
            $templateProcessor->setValue('payor#'.($key+1), $payor);
            $templateProcessor->setValue('receipt_remarks#'.($key+1), str_replace(array("\r\n","&nbsp;"), array("</w:t><w:br/><w:t xml:space='preserve'>", " "), strip_tags($info->receipt_remarks)));
            $templateProcessor->setValue('nature#'.($key+1), str_replace('&', '&amp;', strip_tags($info->nature)));
            $templateProcessor->setValue('total#'.($key+1), $info->totalAmount);
            
        }
        
        $templateProcessor->setValue('total_transact', $occurences);
        $templateProcessor->setValue('grand_total', number_format($grandTotal, 2, '.', ','));
        
        // SAVE DOCUMENT TO TEMPORARY RESULT FILE
        $resultFile = $templateProcessor->saveAs('storage/WordResults/results.docx');

        // Get the directory of the saved .docx file
        $resultPath = public_path().'\storage\WordResults\results.docx';
        // Initialize file name for the PDF
        $resultfilepath = public_path().'\storage\WordResults\PPMP_'.date('m_d_Y-h_i_s').'.pdf';
        $word = new \COM("Word.Application") or die ("Could not initialise Object.");
        $word->Visible = 0;
        $word->DisplayAlerts = 0;
        // Open existing docx file
        $word->Documents->Open($resultPath);
        // Convert to PDF file format
        // (OutputFileName, ExportFormat, OpenAfterExport, OptimizeFor, Range, From, To, Item, IncludeDocProps, KeepIRM, CreateBookmarks, DocStructureTags, BitmapMissingFonts, UseISO19005_1, FixedFormatExtClassPtr)
        $word->ActiveDocument->ExportAsFixedFormat($resultfilepath, 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
        $word->Quit(false);
        // Close object
        unset($word);
        // Get .pdf file contents
        $fileopen = file_get_contents($resultfilepath, true);
        // Convert file contents to base64 to embed in iframe
        $data = base64_encode($fileopen);
        // Unlink/delete .docx file and .pdf file to prevent data buildup
        unlink($resultfilepath);
        unlink($resultPath);
        // Revert back the execution time to 60
        ini_set('max_execution_time', 60);
        return response()->json($data);
    }

    public function generateProvIncomeCounterCheckExcel(Request $request) {
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

        if ($request->pdf_B == 1) {
            $startDate = date('F j, Y', strtotime($request->checkStartDate));
            $endDate = date('F j, Y', strtotime($request->checkEndDate));
            $nextYear = Date('Y', strtotime($request->startDate));

            $startDateRange = Date('Y-m-d', strtotime($request->checkStartDate));
            $endDateRange = Date('Y-m-d', strtotime($request->checkEndDate));
            
            $landTaxInfo = LandTaxInfo::select('rentals.*', 'rentals.name AS rental_name', 'land_tax_accounts.nature', 'barangays.*', 'municipalities.*', 'land_tax_infos.*', DB::raw('sum(land_tax_accounts.amount) as totalAmount'))
            ->where([['land_tax_accounts.account', $request->searchAccountTitles], ['land_tax_infos.status', '<>', 'Cancelled'], ['land_tax_infos.role', 0]])
            ->whereBetween('land_tax_infos.report_date', [$startDateRange, $endDateRange])
            ->orWhereBetween('role_created', [$nextYear.'-01-01', $nextYear.'-01-31'], ['land_tax_infos.role', 2])
            ->whereIn('land_tax_infos.submission_type', ['Revenue Collection', 'Cash Collection', 'OPAG Collection' ,'PVET Collection', 'PHO Collection' , 'Memo Collection'])
            ->orderBy('report_date', 'asc')
            ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
            ->leftJoin('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id')
            ->leftJoin('barangays', 'barangays.id', 'land_tax_infos.barangay_id')
            ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id')
            ->groupBy('serial_number')
            ->distinct()
            ->get();
            
            $occurences = count($landTaxInfo);

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('storage/ReportsTemplate/CounterCheckReport.xlsx'));
            $worksheet = $spreadsheet->getSheetByName('A');
            $row = 7;

            $worksheet->setCellValue('A5', $startDate.' - '.$endDate);
            $worksheet->setCellValue('A'.$row, $request->searchAccountTitles);
            $worksheet->mergeCells('A'.$row.':F'.$row);

            foreach ($landTaxInfo as $data) {
                $worksheet->setCellValue('A'.($row+1), $data->serial_number);
                $worksheet->setCellValue('B'.($row+1), Date('M j, Y', strtotime($data->report_date)));

                if ($data->client_type_id == '2' || $data->client_type_id == '3' || $data->client_type_id == '14') {
                    if ($data->business_name != null && $data->owner != null) {
                        $worksheet->setCellValue('C'.($row+1), $data->business_name.' By: '.$data->owner);
                    } else if ($data->business_name != null && $data->owner == null) {
                        $worksheet->setCellValue('C'.($row+1), $data->business_name);
                    } else if ($data->business_name == null && $data->owner != null) {
                        $worksheet->setCellValue('C'.($row+1), $data->owner);
                    }
                    
                } else if ($data->client_type_id == '4') {
                    $worksheet->setCellValue('C'.($row+1), $data->barangay_name .', '. $data->municipality);
                } else if ($data->client_type_id == '5') {
                    $worksheet->setCellValue('C'.($row+1), 'Municipal Government of '. $data->municipality);
                } else if ($data->client_type_id == '6' || $data->client_type_id == '7') {
                    if ($data->trade_name_permittees != null && $data->permittee != null) {
                        $worksheet->setCellValue('C'.($row+1), $data->trade_name_permittees.' By: '.$data->permittee);
                    } else if ($data->trade_name_permittees != null && $data->permittee == null) {
                        $worksheet->setCellValue('C'.($row+1), $data->trade_name_permittees);
                    } else if ($data->trade_name_permittees == null && $data->permittee != null) {
                        $worksheet->setCellValue('C'.($row+1), $data->permittee);
                    }
                } else if ($data->client_type_id == '9') {
                    $worksheet->setCellValue('C'.($row+1), $data->rental_name);
                } else if ($data->client_type_id == '10' || $data->client_type_id == '11') {
                    if ($data->trade_name_permit_fees != null && $data->proprietor != null) {
                        $worksheet->setCellValue('C'.($row+1), $data->trade_name_permit_fees.' By: '.$data->proprietor);
                    } else if ($data->trade_name_permit_fees != null && $data->proprietor == null) {
                        $worksheet->setCellValue('C'.($row+1), $data->trade_name_permit_fees);
                    } else if ($data->trade_name_permit_fees == null && $data->proprietor != null) {
                        $worksheet->setCellValue('C'.($row+1), $data->proprietor);
                    }
                } else if ($data->client_type_id == '12' || $data->client_type_id == '13') {
                    if ($data->bidders_business_name == null) {
                        $worksheet->setCellValue('C'.($row+1), $data->owner_representative);
                    } else if ($data->owner_representative == null) {
                        $worksheet->setCellValue('C'.($row+1), $data->bidders_business_name);
                    } else {
                        $worksheet->setCellValue('C'.($row+1), $data->bidders_business_name.' By: '.$data->owner_representative);
                    }
                } else {
                    if ($data->client_type_radio == "Individual") {
                        if ($data->middle_initial == null) {
                            $worksheet->setCellValue('C'.($row+1), $data->last_name.', '.$data->first_name);
                        } else {
                            $worksheet->setCellValue('C'.($row+1), $data->last_name.', '.$data->first_name.' '.$data->middle_initial);
                        }
                        
                    } else if ($data->client_type_radio == "Company") {
                        $worksheet->setCellValue('C'.($row+1), $data->company);
                    } else if ($data->client_type_radio == "Spouse") {
                        $worksheet->setCellValue('C'.($row+1), $data->spouses);
                    }
                }

                $worksheet->setCellValue('D'.($row+1), str_replace(array("\r\n","&nbsp;"), array("</w:t><w:br/><w:t xml:space='preserve'>", " "), strip_tags($data->receipt_remarks)));
                $worksheet->setCellValue('E'.($row+1), $data->nature);
                $worksheet->setCellValue('F'.($row+1), $data->totalAmount);

                $row++;
            }

            $spreadsheet->getActiveSheet()->getStyle('C8:E'.$row)->getAlignment()->setWrapText(true);

            $worksheet->mergeCells('A'.($row+2).':F'.($row+2));
            $worksheet->setCellValue('A'.($row+2), '    Total Transactions: '.$occurences);
            $worksheet->mergeCells('A'.($row+3).':E'.($row+3));
            $worksheet->setCellValue('F'.($row+3), '=SUM(F8:F'.$row.')');
            $worksheet->setCellValue('A'.($row+3), '    Total for '.$request->searchAccountTitles);

            $worksheet->getStyle('A7:F'.($row+3))->getFont()->setBold(true);
            $worksheet->getStyle('A8:E'.$row)->applyFromArray($centerAlign);
            $worksheet->getStyle('F8:F'.($row+3))
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $worksheet->getStyle('A6:F'.($row+3))->applyFromArray($borderedStyleArray);

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
            $writer->save(public_path('storage/ReportsTemplate/AccountsDailyCounterCheckReport.xlsx'));
            return response()->download(public_path('storage/ReportsTemplate/AccountsDailyCounterCheckReport.xlsx'))->DeleteFileAfterSend(true);

        } else if ($request->pdf_B == 2) { 
            
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
            ->where([['land_tax_infos.status', '<>', 'Cancelled'], ['land_tax_infos.deleted_at', null]])
            ->whereBetween('report_date', [$request->piYear.'-01-01', $request->piYear.'-'.$request->piMonthStart.'-31'])
            ->groupBy('land_tax_accounts.acc_title_id')
            ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
            ->get();
            
            $monthlyCollectionAcc = LandTaxInfo::select('land_tax_accounts.acc_title_id', 'land_tax_infos.role', 'serial_number', DB::raw('SUM(prov_share) AS prov'), DB::raw('SUM(land_tax_accounts.amount) AS total'))
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


            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('storage/ReportsTemplate/CounterCheckAllReport.xlsx'));
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
            $worksheet->setCellValue($columnStart.'8', 'FOR THE MONTH OF '.$startMonth.', '.$request->piYear);

            $counter = 0;
            $share = 0;
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

                    $worksheet->setCellValue('J'.$row, 'AMOUNT');
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
                                    // Monthly Collection
                                    foreach ($monthlyCollectionAcc as $month) {
                                        if ($titles->id == $month->acc_title_id) {
                                            if ($titles->title_name == 'Hospital Fees') {
                                                $worksheet->setCellValue('J'.($row+4), $month->total);
                                                if ($startMonth == 'JANUARY') {
                                                    $monthHosTotal = $worksheet->getCell('J'.($row+3))->getCalculatedValue();
                                                }
                                            } else if ($titles->title_name == 'Tax on Sand, Gravel & Other Quarry Prod.') {
                                                foreach ($monthlyCollectionSandGravel as $sgMonthly) {
                                                    $share += $sgMonthly->prov_share;
                                                }
                                                $worksheet->setCellValue('J'.($row+3), $share);
                                            } else {
                                                $worksheet->setCellValue('J'.($row+3), $month->total);
                                                foreach ($getIncomeType as $type) {
                                                    if ($titles->id == $type->acc_title_id) {
                                                        $worksheet->setCellValue('J'.($row+3), $month->total-$type->total);
                                                    }
                                                }
                                            }

                                            if ($titles->title_name == 'Rent Income') {
                                                $worksheet->setCellValue('J'.($row+3), '');
                                            }
                                        }
                                    }

                                    // Total
                                    
                                    if ($startMonth == 'JANUARY') {
                                        $janTotal = $worksheet->getCell('J'.($row+3))->getCalculatedValue();
                                    }

                                    $startCostSales = 0.00;
                                    $monthlyCostSales = 0.00;

                                    if ($titles->title_name == 'Other Service Income (General Fund-Proper)') {
                                        $monthly = $worksheet->getCell('J'.($row+3))->getCalculatedValue();
                                        
                                        // Start of Collection
                                        foreach ($getDistrictHospitalsStart as $startDH) {
                                            $startCostSales = $startDH->prof_fees*0.05;
                                        }

                                        // Monthly Collection
                                        foreach ($getDistrictHospitalsMonthly as $monthlyDH) {
                                            $monthlyCostSales = $startDH->prof_fees*0.05;
                                            $worksheet->setCellValue('J'.($row+3), $monthlyCostSales+$monthly);
                                        }
                                        if ($startMonth == 'JANUARY') {
                                            $siTotal = $worksheet->getCell('J'.($row+3))->getCalculatedValue();
                                        }
                                    }

                                    if ($titles->title_name == 'Sales Revenue') {
                                        $worksheet->setCellValue('J'.($row+3), '');
                                    }
                                    
                                    // Subtitles
                                    foreach ($getSubTitles as $sub) {
                                        if ($titles->id == $sub->title_id) {
                                            $worksheet->setCellValue('C'.($row+4), $sub->subtitle);

                                            // Monthly Collection
                                            foreach ($monthlyCollectionSub as $monthlySub) {
                                                if ($sub->id == $monthlySub->sub_title_id) {
                                                    $worksheet->setCellValue('J'.($row+4), $monthlySub->total);
                                                    foreach ($getIncomeType as $type) {
                                                        if ($sub->id == $type->sub_title_id) {
                                                            $worksheet->setCellValue('J'.($row+4), $monthlySub->total-$type->total);
                                                        }
                                                    }
                                                }
                                            }

                                            // Total
                                            if ($startMonth == 'JANUARY') {
                                                $subTotal = $worksheet->getCell('J'.($row+4))->getCalculatedValue();
                                            }
                                            
                                            if ($sub->subtitle == 'Drugs and Medicines-5 District Hospitals') {
                                                $row++; 
                                                $worksheet->setCellValue('D'.($row+4), 'Sales');
                                                $worksheet->getStyle('D'.($row+4))->getFont()->setSize(21);
                                                
                                                $worksheet->setCellValue('D'.($row+5), 'Less: Cost of Sale');
                                                $worksheet->getStyle('D'.($row+5))->getFont()->setSize(21);
                                                $worksheet->getStyle('E'.($row+2).':J'.($row+3))->applyFromArray($borderedStyleArray);
                                                $row++;

                                                // Monthly Collection
                                                foreach ($getDistrictHospitalsMonthly as $monthlyDH) {
                                                    $worksheet->setCellValue('J'.($row+4), $monthlyDH->cost_sales);
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
                                        }
                                        
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
                                        
                                        //Actual Collection Current month Subtotal
                                        $worksheet->setCellValue('J'.($row+2), '=SUM(J12:J'.($row+2).')');
                                        $monthlyActualCollTax = $worksheet->getCell('J'.($row+2))->getCalculatedValue();
                                        
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
                                    //Actual Collection Current month Subtotal
                                    $worksheet->setCellValue('J'.($row+2), '=SUM(H'.($row-32).':H'.($row+2).')');
                                    $monthlyActualCollNonTax = $worksheet->getCell('J'.($row+2))->getCalculatedValue();
                                    $worksheet->getStyle('B'.($row+2).':J'.($row+2))->getFont()->setBold(true);
                                    $worksheet->getStyle('A'.($row+2).':D'.($row+2))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                                    $worksheet->getStyle('A'.($row+2).':D'.($row+2))->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                                    $worksheet->getStyle('E'.($row+2).':J'.($row+2))->applyFromArray($borderedStyleArray);
                                    $row++;
                                }
                            } else if ($acc->acc_category_settings == 'Special Education Fund (SEF)') {
                                //Actual Collection Current month Subtotal
                                $worksheet->setCellValue('J'.($row+2), '=SUM(J'.($row-2).':J'.($row+1).')');
                                $monthlyActualCollSef = $worksheet->getCell('J'.($row+2))->getCalculatedValue();
                                $worksheet->getStyle('B'.($row+2).':J'.($row+2))->getFont()->setBold(true);
                                $worksheet->getStyle('A'.($row+2).':D'.($row+2))->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000000'));
                                $worksheet->getStyle('E'.($row+2).':J'.($row+2))->applyFromArray($borderedStyleArray);
                            } else {
                                //Actual Collection Current month Subtotal
                                $worksheet->setCellValue('J'.($row+2), '=SUM(J'.($row-2).':J'.($row+1).')');
                                $monthlyActualCollTrustFund = $worksheet->getCell('J'.($row+1))->getCalculatedValue();
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
                        $grandMonthlyActualColl = $monthlyActualCollTax+$monthlyActualCollNonTax;
                        $worksheet->setCellValue('J'.$row, $grandMonthlyActualColl);
                        
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
            
            $worksheet->setBreak('A64', \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);
            $worksheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(9,10);


            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
            $writer->save(public_path('storage/ReportsTemplate/AccountsDailyCounterCheckReport.xlsx'));
            return response()->download(public_path('storage/ReportsTemplate/AccountsDailyCounterCheckReport.xlsx'))->DeleteFileAfterSend(true);
        } else {
            $startDate = Date('Y-m-d',strtotime('-1 day', strtotime($request->checkStartDate)));
            $endDate = Date('Y-m-d',strtotime($request->checkEndDate));
            $dayBefore = Date('Y-m-d',strtotime('-2 day', strtotime($request->checkEndDate)));
            
            $dateFormat = Date('F d, Y', strtotime($request->counterCheckReportNumber));
            // Check here if range here if selected date range is out of range. Prompt a 403 page 
            $allColumns = [];
            $allRows = [];
            $allSum = [];
            $grandTotal = '=';

            $endDateTS = Date('Y-m-d',strtotime('+1 day', strtotime($request->checkStartDate)));
            $beforeDateTS = Date('Y-m-d',strtotime('-1 day', strtotime($request->checkStartDate)));

            $day = Date('D', strtotime($beforeDateTS));

            $landTaxInfo = LandTaxInfo::select('rentals.*', 'rentals.name AS rental_name', 'barangays.*', 'municipalities.*', 'land_tax_infos.*')
            ->where('land_tax_accounts.acc_category_id', 1)
            ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
            ->whereIn('land_tax_infos.submission_type', ['Revenue Collection', 'Cash Collection', 'OPAG Collection' ,'PVET Collection', 'PHO Collection', 'Memo Collection'])
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
            $locationArray = [];
            $locationArrayB = [];
            $amusementShareArray = [];

            $getAccTitles = LandTaxInfo::where('land_tax_accounts.acc_category_id', 1)
            ->select('account_titles.id', 'account_titles.title_name', DB::raw('SUM(amount) AS sum'))
            ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
            ->where('land_tax_accounts.sub_title_id', null)
            ->whereIn('land_tax_infos.submission_type', ['Revenue Collection', 'Cash Collection', 'OPAG Collection' ,'PVET Collection', 'PHO Collection', 'Memo Collection'])
            ->join('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
            ->join('account_titles', 'land_tax_accounts.acc_title_id', 'account_titles.id')
            ->groupBy('account_titles.id', 'account_titles.title_name')
            ->get();

            $subTitlesColumns = [];

            $getSubTitles = LandTaxInfo::where('land_tax_accounts.acc_category_id', 1)
            ->select('account_subtitles.id', 'account_subtitles.subtitle', DB::raw('SUM(amount) AS sum'))
            ->whereIn('land_tax_infos.submission_type', ['Revenue Collection', 'Cash Collection', 'OPAG Collection' ,'PVET Collection', 'PHO Collection', 'Memo Collection'])
            ->whereBetween('land_tax_infos.report_date', [$startDate, $endDate])
            ->join('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
            ->join('account_subtitles', 'land_tax_accounts.sub_title_id', 'account_subtitles.id')
            ->groupBy('account_subtitles.id', 'account_subtitles.subtitle')
            ->get();



            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('storage/ReportsTemplate/CounterCheckAllReport.xlsx'));
            $worksheet = $spreadsheet->getSheetByName('A');
            $row = 10;

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
            // $worksheet->setCellValue('C7', $getReportOffcierA->name.' - '.$getReportOffcierA->position);
            $worksheet->getStyle('C7')->getFont()->setBold(true);
            $startRow = $columnStart;
            $worksheet->mergeCells('C9'.':'.chr(ord($columnStart) - 1).'9');
            $worksheet->setCellValue('C9',"General Fund-Proper");

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

                        foreach ($accTitlesColumns as $accTitle) {
                            if (isset($accTitle[$tmp]) == true) {
                                $worksheet->setCellValue($accTitle[$tmp].$row, $provincialShare);
                                break;
                            }
                        }

                        $allSum[$tmp] = $allSum[$tmp];
                        
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
                    
                    foreach ($subTitlesColumns as $subtitleCol) {
                        if (isset($subtitleCol[$tmp]) == true) {
                            $allSum[$tmp] = $allSum[$tmp] + $subTitle->total;
                            $worksheet->setCellValue($subtitleCol[$tmp].$row, $subTitle->total);
                            break;
                        }
                    }
                }
                
                $worksheet->setCellValue($columnStart.$row, '=SUM(C'.$row.':'.$letters.$row.')' );
                
                $row++;
            }

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
            $writer->save(public_path('storage/ReportsTemplate/CounterCheckAllExcelReport.xlsx'));
            return response()->download(public_path('storage/ReportsTemplate/CounterCheckAllExcelReport.xlsx'))->DeleteFileAfterSend(true);
        }
    }
}
