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
use App\Models\sgMothlyCollection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class sgMonthlyController extends Controller
{
    public function checkNextMunicipality($current) 
    {
        if ($current == 'Atok') {
            return 'Bakun';
        } elseif ($current == 'Bakun') {
            return 'Bokod';
        } elseif ($current == 'Bokod') {
            return 'Buguias';
        }elseif ($current == 'Buguias') {
            return 'Itogon';
        }elseif ($current == 'Itogon') {
            return 'Kabayan';
        }elseif ($current == 'Kabayan') {
            return 'Kapangan';
        }elseif ($current == 'Kapangan') {
            return 'Kibungan';
        }elseif ($current == 'Kibungan') {
            return 'La Trinidad';
        }elseif ($current == 'La Trinidad') {
            return 'Mankayan';
        }elseif ($current == 'Mankayan') {
            return 'Sablan';
        }elseif ($current == 'Sablan') {
            return 'Tuba';
        }elseif ($current == 'Tuba') {
            return 'Tublay';
        } else {
            return false;
        }
    }

    public function checkPrevMunicipality($current) 
    {
        if ($current == 'Tublay') {
            return 'Tuba';
        } elseif ($current == 'Tuba') {
            return 'Sablan';
        } elseif ($current == 'Sablan') {
            return 'Mankayan';
        }elseif ($current == 'Mankayan') {
            return 'La Trinidad';
        }elseif ($current == 'La Trinidad') {
            return 'Kibungan';
        }elseif ($current == 'Kibungan') {
            return 'Kapangan';
        }elseif ($current == 'Kapangan') {
            return 'Kabayan';
        }elseif ($current == 'Kabayan') {
            return 'Itogon';
        }elseif ($current == 'Itogon') {
            return 'Buguias';
        }elseif ($current == 'Buguias') {
            return 'Bokod';
        }elseif ($current == 'Bokod') {
            return 'Bakun';
        }elseif ($current == 'Bakun') {
            return 'Atok';
        } else {
            return false;
        }
    }

    public function checkLastMunicipality($current) 
    {
        if ($current == 'Bakun') {
            return ['Atok'];
        } elseif ($current == 'Bokod') {
            return ['Atok', 'Bakun'];
        }elseif ($current == 'Buguias') {
            return ['Atok', 'Bakun', 'Bokod'];
        }elseif ($current == 'Itogon') {
            return ['Atok', 'Bakun', 'Bokod', 'Buguias'];
        }elseif ($current == 'Kabayan') {
            return ['Atok', 'Bakun', 'Bokod', 'Buguias', 'Itogon'];
        }elseif ($current == 'Kapangan') {
            return ['Atok', 'Bakun', 'Bokod', 'Buguias', 'Itogon', 'Kabayan'];
        }elseif ($current == 'Kibungan') {
            return ['Atok', 'Bakun', 'Bokod', 'Buguias', 'Itogon', 'Kabayan', 'Kapangan'];
        }elseif ($current == 'La Trinidad') {
            return ['Atok', 'Bakun', 'Bokod', 'Buguias', 'Itogon', 'Kabayan', 'Kapangan', 'Kibungan'];
        }elseif ($current == 'Mankayan') {
            return ['Atok', 'Bakun', 'Bokod', 'Buguias', 'Itogon', 'Kabayan', 'Kapangan', 'Kibungan', 'La Trinidad'];
        }elseif ($current == 'Sablan') {
            return ['Atok', 'Bakun', 'Bokod', 'Buguias', 'Itogon', 'Kabayan', 'Kapangan', 'Kibungan', 'La Trinidad', 'Mankayan'];
        }elseif ($current == 'Tuba') {
            return ['Atok', 'Bakun', 'Bokod', 'Buguias', 'Itogon', 'Kabayan', 'Kapangan', 'Kibungan', 'La Trinidad', 'Mankayan', 'Sablan'];
        } elseif ($current == 'Tublay') {
            return ['Atok', 'Bakun', 'Bokod', 'Buguias', 'Itogon', 'Kabayan', 'Kapangan', 'Kibungan', 'La Trinidad', 'Mankayan', 'Sablan', 'Tuba'];
        } else {
            return false;
        }
    }

    public function generateMonthlyReportSG(Request $request)
    {
        $today = date('Y-m-d'); 
        $currentMonth = date('m');
        $currentYear = $request->sgYear;
        $startMonth = strtoupper(date('F', mktime(0, 0, 0, $request->sgMonthStart, 10)));
        $startMonthPascal = date('F', mktime(0, 0, 0, $request->sgMonthStart, 10));
        $endMonth = strtoupper(date('F', strtotime("-1 month", mktime(0, 0, 0, $request->sgMonthStart, 10)))); // Also used for last months data
        $lastMonth = $request->sgMonthStart-1;

        //Queries
        $duplicateSerial = LandTaxInfo::select('land_tax_accounts.amount', 'land_tax_accounts.info_id', 'land_tax_infos.serial_number', 'land_tax_infos.id')
        ->where('land_tax_infos.id', '=', 'land_tax_accounts.info_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->get();
        
        // $dataLastMonth = LandTaxInfo::select('land_tax_accounts.account', 'land_tax_infos.client_type_id', DB::raw('SUM(land_tax_accounts.amount) AS sum'));
        $dataLastMonth = LandTaxInfo::select('rentals.*', 'land_tax_accounts.*', 'land_tax_infos.*', DB::raw('SUM(land_tax_accounts.amount) AS sum'))
        ->where([['land_tax_accounts.nature', '<>', 'Certification Fee'], ['land_tax_accounts.account', 'Tax on Sand, Gravel & Other Quarry Prod.']])
        ->whereIn('client_type_id', [1, 2, 3, 5, 6, 7])
        ->whereMonth('land_tax_infos.report_date', '=', $lastMonth)
        ->whereYear('land_tax_infos.report_date', '=', $currentYear)
        ->orderBy('land_tax_accounts.info_id', 'asc')
        ->groupBy('land_tax_infos.client_type_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id')
        ->get();

        $dataInAMonth = LandTaxInfo::select('rentals.*', 'barangays.*', 'municipalities.*', 'land_tax_accounts.*', 'land_tax_infos.*', DB::raw('SUM(land_tax_accounts.amount) AS sum'))
        ->where([['land_tax_accounts.nature', '<>', 'Certification Fee'], ['land_tax_accounts.account', 'Tax on Sand, Gravel & Other Quarry Prod.'], ['land_tax_infos.submission_type', 'Revenue Collection']])
        ->whereIn('client_type_id', [1, 2, 3, 5, 6, 7])
        ->whereMonth('land_tax_infos.report_date', '=', $request->sgMonthStart)
        ->whereYear('land_tax_infos.report_date', '=', $currentYear)
        // ->orderBy('land_tax_infos.report_date', 'asc')
        // ->orderBy('municipalities.municipality', 'asc')
        // ->orderBy('barangays.barangay_name', 'asc')
        // ->orderBy('land_tax_accounts.info_id', 'asc')
        ->groupBy('land_tax_infos.id')
        ->leftJoin('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id') 
        ->leftJoin('barangays', 'barangays.id', 'land_tax_infos.barangay_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id')
        ->get();

        $percentage = 0.00;
        $dailyTotal = 0.00;
        $date = '';
        foreach ($dataInAMonth as $data) {
            if ($data->report_date != $date) {
                if ($date === '') {
                    $date = $data->report_date;
                    $dailyTotal = $data->prov_share+$data->mun_share+$data->bar_share+$data->special_share;
                } else {
                    $dailyTotal = $dailyTotal+$data->prov_share+$data->mun_share+$data->bar_share+$data->special_share;
                    $dailyPercentage = $dailyTotal*0.3;
                    $percentage = $percentage+$dailyPercentage;
                    $date = $data->report_date;
                    $dailyTotal = 0.00;
                }
            } else {
                $dailyTotal = $dailyTotal+$data->prov_share+$data->mun_share+$data->bar_share+$data->special_share;
            }
        }

        $dataInAMonthCalc = LandTaxInfo::select('rentals.*', 'barangays.*', 'municipalities.*', 'land_tax_accounts.*', 'land_tax_infos.*', DB::raw('SUM(land_tax_accounts.amount) AS sum'))
        ->where([['land_tax_accounts.nature', '<>', 'Certification Fee'], ['land_tax_accounts.account', 'Tax on Sand, Gravel & Other Quarry Prod.'], ['land_tax_infos.submission_type', 'Revenue Collection']])
        ->whereIn('client_type_id', [1, 2, 3, 5, 6, 7])
        ->whereMonth('land_tax_infos.report_date', '=', $request->sgMonthStart)
        ->whereYear('land_tax_infos.report_date', '=', $currentYear)
        ->orderBy('land_tax_infos.report_date', 'asc')
        ->orderBy('municipalities.municipality', 'asc')
        ->orderBy('barangays.barangay_name', 'asc')
        ->orderBy('land_tax_accounts.info_id', 'asc')
        ->groupBy('land_tax_infos.id')
        ->leftJoin('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id') 
        ->leftJoin('barangays', 'barangays.id', 'land_tax_infos.barangay_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id')
        ->get();

        $dataInAMonthSharing = LandTaxInfo::select('barangays.*', 'municipalities.*', 'land_tax_accounts.*', 'land_tax_infos.*', 'land_tax_infos.serial_number', 'prov_share AS prov_sum', 'mun_share AS mun_sum', 'bar_share AS bar_sum', 'special_share AS special_sum')
        ->where([['land_tax_accounts.nature', '<>', 'Certification Fee'], ['land_tax_accounts.account', 'Tax on Sand, Gravel & Other Quarry Prod.'], ['land_tax_infos.submission_type', 'Revenue Collection'], ['land_tax_infos.status', 'Printed']])
        ->whereIn('client_type_id', [1, 2, 3, 5, 6, 7])
        ->whereMonth('land_tax_infos.report_date', '=', $request->sgMonthStart)
        ->whereYear('land_tax_infos.report_date', '=', $currentYear)
        ->orderBy('municipalities.municipality', 'asc')
        ->orderBy('barangays.barangay_name', 'asc')
        ->orderBy('land_tax_accounts.info_id', 'asc')
        ->orderBy('land_tax_infos.id')
        ->groupBy('land_tax_infos.serial_number')
        ->leftJoin('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id') 
        ->leftJoin('barangays', 'barangays.id', 'land_tax_infos.barangay_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->get();
        
        $daysTaxPenalty = LandTaxInfo::select('land_tax_infos.report_date')
        ->where([['land_tax_accounts.nature', '<>', 'Certification Fee'], ['land_tax_accounts.account', 'Tax on Sand, Gravel & Other Quarry Prod.'], ['land_tax_infos.submission_type', 'Revenue Collection']])
        ->whereIn('client_type_id', [1, 2, 3, 5, 6, 7])
        ->whereMonth('land_tax_infos.report_date', '=', $request->sgMonthStart)
        ->whereYear('land_tax_infos.report_date', '=', $currentYear)
        ->orderBy('land_tax_infos.report_date', 'asc')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->distinct('land_tax_infos.report_date')
        ->get();

        $deliveryReceiptsData = LandTaxInfo::select('serial_s_g_s.booklets', 'municipalities.*', 'land_tax_accounts.*', 'land_tax_infos.*', DB::raw('SUM(land_tax_accounts.amount) AS sum'))
        ->where([['land_tax_accounts.nature', '<>', 'Certification Fee'], ['land_tax_accounts.account', 'Tax on Sand, Gravel & Other Quarry Prod.'], ['land_tax_infos.submission_type', 'Revenue Collection']/*, ['land_tax_infos.sharing_status', 'on']*/])
        ->whereIn('client_type_id', [6, 7])
        ->whereMonth('land_tax_infos.report_date', '=', $request->sgMonthStart)
        ->whereYear('land_tax_infos.report_date', '=', $currentYear)
        ->orderBy('municipalities.municipality', 'asc')
        ->orderBy('land_tax_accounts.info_id', 'asc')
        ->groupBy('land_tax_infos.id')
        ->leftJoin('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id')
        ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
        ->leftJoin('serial_s_g_s', 'serial_s_g_s.id', 'land_tax_infos.dr_id')
        ->get();
        
        $getPreparedByOffcier = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'cert_officers.id')
        ->where('cert_officers.id', $request->reportOfficerCol)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();

        $getPreparedByOffcierB = DB::table('cert_officers')
        ->select('cert_officers.*', 'officers.*', 'positions.*', 'cert_officers.id')
        ->where('cert_officers.id', $request->reportOfficerColB)
        ->join('officers', 'cert_officers.officer_id', 'officers.id')
        ->join('positions', 'cert_officers.position_id', 'positions.id')
        ->first();

        $monthyCollections = DB::table('sg_mothly_collections')
        ->where('collection_month', $lastMonth)
        ->select('*')
        ->get();

        $monthyCollectionsArray = [];
        
        foreach ($monthyCollections as $key=>$coll) {
            if ($key == count($monthyCollections)-2) { // Total Balance
                $totalBalanceMonitoring = $coll->monitoring_total;
                $totalBalanceProvincial= $coll->provincial_total;
                $totalBalanceDpwh = $coll->dpwh_total;
                $totalBalanceIndustrial = $coll->industrial_total;
                $totalBalanceCommercial = $coll->commercial_total;
            }
            if ($key == count($monthyCollections)-1) { // Prov Share
                $provShareMonitoring = $coll->monitoring_total;
                $provShareProvincial= $coll->provincial_total;
                $provShareDpwh = $coll->dpwh_total;
                $provShareIndustrial = $coll->industrial_total;
                $provShareCommercial = $coll->commercial_total;
            }
        }

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
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('storage/ReportsTemplate/SandAndGravelMonthly.xlsx'));
        $worksheet = $spreadsheet->getSheetByName('A');
        
        
        $columnStart = 'A';
        if ($startMonth == 'JANUARY') {
            $worksheet->setCellValue($columnStart.'9', 'FOR THE PERIOD JANUARY');
            $worksheet->setCellValue($columnStart.'12', '');
            $worksheet->setCellValue($columnStart.'13', '');
        } else {
            $worksheet->setCellValue($columnStart.'9', 'FOR THE PERIOD JANUARY-'.$startMonth.' '.$currentYear);
            $worksheet->setCellValue($columnStart.'12', 'Collections as of '.$endMonth.' '.$currentYear);
            $worksheet->setCellValue($columnStart.'13', "Prov'l share as of ".$endMonth.' '.$currentYear);
        }
        $worksheet->getStyle('A12:A13')->applyFromArray($verticalLeft);
        $worksheet->setCellValue($columnStart.'14', $startMonth);

        $monitoringVal = 0;
        $projectsVal = 0;
        $nationalVal = 0;
        $municipalVal = 0;
        $industrialVal = 0;
        $commercialVal = 0;

        $monitoringRes = 0;
        $projectsRes = 0;
        $nationalRes = 0;
        $municipalRes = 0;
        $industrialRes = 0;
        $commercialRes = 0;

        $totalColumn = [];

        foreach ($dataLastMonth as $last) {
            if ($request->sgMonthStart == 1) {
                if ($last->client_type_id == '1') {
                    $monitoringCollection = null;
                    $monitoringShare = null;
                    $worksheet->setCellValue('D12', $monitoringCollection);
                    $monitoringVal = $worksheet->getCell('D12')->getCalculatedValue();
                    $monitoringRes = $monitoringShare;
                    $worksheet->setCellValue('D13', $monitoringRes);
                }
    
                if ($last->client_type_id == '2') {
                    $provincialCollection = null;
                    $provincialShare = null;
                    $worksheet->setCellValue('E12', $provincialCollection);
                    $projectsVal = $worksheet->getCell('E12')->getCalculatedValue();
                    $projectsRes = $provincialShare;
                    $worksheet->setCellValue('E13', $projectsRes);
                }
                
                if ($last->client_type_id == '3') {
                    $dpwhCollection = null;
                    $dpwhShare = null;
                    $worksheet->setCellValue('F12', $dpwhCollection);
                    $nationalVal = $worksheet->getCell('F12')->getCalculatedValue();
                    $nationalRes = $dpwhShare;
                    $worksheet->setCellValue('F13', $nationalRes);
                }
    
                if ($last->client_type_id == '5') {
                    $mun_barCollection = null;
                    $mun_barShare = null;
                    $worksheet->setCellValue('I12', $mun_barCollection);
                    $municipalVal = $worksheet->getCell('I12')->getCalculatedValue();
                    $municipalRes = $mun_barShare;
                    $worksheet->setCellValue('I13', $municipalRes);
                }
    
                if ($last->client_type_id == '6') {
                    $industrialCollection = null;
                    $industrialShare = null;
                    $worksheet->setCellValue('G12', $industrialCollection);
                    $industrialVal = $worksheet->getCell('G12')->getCalculatedValue();
                    $industrialRes = $industrialShare;
                    $worksheet->setCellValue('G13', $industrialRes);
                }
    
                if ($last->client_type_id == '7') {
                    $commercialCollection = null;
                    $commercialShare = null;
                    $worksheet->setCellValue('H12', $commercialCollection);
                    $commercialVal = $worksheet->getCell('H12')->getCalculatedValue();
                    $commercialRes = $commercialShare;
                    $worksheet->setCellValue('H13', $commercialRes);
                }
            } else {
                if ($last->client_type_id == '1') {
                    $monitoringCollection = $totalBalanceMonitoring;
                    $monitoringShare = $provShareMonitoring;
                    $worksheet->setCellValue('D12', $monitoringCollection);
                    $monitoringVal = $worksheet->getCell('D12')->getCalculatedValue();
                    $monitoringRes = $monitoringShare;
                    $worksheet->setCellValue('D13', $monitoringRes);
                }
    
                if ($last->client_type_id == '2') {
                    $provincialCollection = $totalBalanceProvincial;
                    $provincialShare = $provShareProvincial;
                    $worksheet->setCellValue('E12', $provincialCollection);
                    $projectsVal = $worksheet->getCell('E12')->getCalculatedValue();
                    $projectsRes = $provincialShare;
                    $worksheet->setCellValue('E13', $projectsRes);
                }
                
                if ($last->client_type_id == '3') {
                    $dpwhCollection = $totalBalanceDpwh;
                    $dpwhShare = $provShareDpwh;
                    $worksheet->setCellValue('F12', $dpwhCollection);
                    $nationalVal = $worksheet->getCell('F12')->getCalculatedValue();
                    $nationalRes = $dpwhShare;
                    $worksheet->setCellValue('F13', $nationalRes);
                }
    
                if ($last->client_type_id == '5') {
                    $mun_barCollection = $monthyCollections[0]->mun_bar_total;
                    $mun_barShare = $monthyCollections[1]->mun_bar_total;
                    $worksheet->setCellValue('I12', $mun_barCollection);
                    $municipalVal = $worksheet->getCell('I12')->getCalculatedValue();
                    $municipalRes = $mun_barShare;
                    $worksheet->setCellValue('I13', $municipalRes);
                }
    
                if ($last->client_type_id == '6') {
                    $industrialCollection = $totalBalanceIndustrial;
                    $industrialShare = $provShareIndustrial;
                    $worksheet->setCellValue('G12', $industrialCollection);
                    $industrialVal = $worksheet->getCell('G12')->getCalculatedValue();
                    $industrialRes = $industrialShare;
                    $worksheet->setCellValue('G13', $industrialRes);
                }
    
                if ($last->client_type_id == '7') {
                    $commercialCollection = $totalBalanceCommercial;
                    $commercialShare = $provShareCommercial;
                    $worksheet->setCellValue('H12', $commercialCollection);
                    $commercialVal = $worksheet->getCell('H12')->getCalculatedValue();
                    $commercialRes = $commercialShare;
                    $worksheet->setCellValue('H13', $commercialRes);
                }
            }
            
        }
        $worksheet->setCellValue('J12', '=SUM(D12:I12)');
        $lastTotal = $worksheet->getCell('J12')->getCalculatedValue();
        $worksheet->setCellValue('J13', '=SUM(D13:I13)');
        $lastShare = $worksheet->getCell('J13')->getCalculatedValue();

        $row = 15;
        $monShareTotal = 0.00;
        $provShareTotal = 0.00;
        $nationalShareTotal = 0.00;
        $industrialShareTotal = 0.00;
        $commercialShareTotal = 0.00;
        $extractionShareTotal = 0.00;
        foreach($dataInAMonth as $data) {
            $months = date('m', strtotime($data->report_date));
            $days = date('d', strtotime($data->created_at));
            
            $worksheet->setCellValue($columnStart.$row, $days);
            $worksheet->setCellValue(chr(ord($columnStart) + 1).$row, $data->serial_number);

            if ($data->client_type_id == '1') {
                $cancelledAmount = 0.00;
                if ($data->status == 'Cancelled') {
                    $cancelledAmount = $data->prov_share-$cancelledAmount;
                }
                $monShareTotal += $data->prov_share;
                $worksheet->setCellValue('D'.$row, $data->sum);
                array_push($totalColumn, $data->sum);
            }

            if ($data->client_type_id == '2') {
                $cancelledAmount = 0.00;
                if ($data->status == 'Cancelled') {
                    $cancelledAmount = $data->prov_share;
                }
                $provShareTotal += $data->prov_share-$cancelledAmount;
                $worksheet->setCellValue('E'.$row, $data->sum);
                array_push($totalColumn, $data->sum);
            }

            if ($data->client_type_id == '3') {
                $cancelledAmount = 0.00;
                if ($data->status == 'Cancelled') {
                    $cancelledAmount = $data->prov_share;
                }
                $nationalShareTotal += $data->prov_share-$cancelledAmount;
                $worksheet->setCellValue('F'.$row, $data->sum);
                array_push($totalColumn, $data->sum);
            }

            if ($data->client_type_id == '5') {
                $worksheet->setCellValue('I'.$row, $data->sum);
                array_push($totalColumn, $data->sum);
            }

            if ($data->client_type_id == '6') {
                $cancelledAmount = 0.00;
                if ($data->status == 'Cancelled') {
                    $cancelledAmount = $data->prov_share;
                }
                $industrialShareTotal += $data->prov_share-$cancelledAmount;
                $worksheet->setCellValue('G'.$row, $data->sum);
                array_push($totalColumn, $data->sum);
            }

            if ($data->client_type_id == '7') {
                $cancelledAmount = 0.00;
                if ($data->status == 'Cancelled') {
                    $cancelledAmount = $data->prov_share;
                }
                $commercialShareTotal += $data->prov_share-$cancelledAmount;
                $worksheet->setCellValue('H'.$row, $data->sum);
                array_push($totalColumn, $data->sum);
            }

            foreach ($totalColumn as $totalCol) {
                $worksheet->setCellValue('J'.$row, $totalCol);
            }
            
            if ($data->status == 'Cancelled') {
                $worksheet->setCellValue('D'.$row, 0.00);
                $worksheet->setCellValue('E'.$row, 0.00);
                $worksheet->setCellValue('F'.$row, 0.00);
                $worksheet->setCellValue('G'.$row, 0.00);
                $worksheet->setCellValue('H'.$row, 0.00);
                $worksheet->setCellValue('I'.$row, 0.00);
                $worksheet->setCellValue('J'.$row, 0.00);
            }

            if ($data->status == 'Cancelled') {
                $worksheet->setCellValue('C'.$row, 'Cancelled');
                $worksheet->mergeCells('D'.$row.':J'.$row);
                $worksheet->setCellValue('D'.$row, '');
            } else {
                if ($data->client_type_id == '2' || $data->client_type_id == '3' || $data->client_type_id == '14') {
                    if ($data->business_name != null && $data->owner != null) {
                        $worksheet->setCellValue('C'.$row, $data->business_name.' By: '.$data->owner);
                    } else if ($data->business_name != null && $data->owner == null) {
                        $worksheet->setCellValue('C'.$row, $data->business_name);
                    } else if ($data->business_name == null && $data->owner != null) {
                        $worksheet->setCellValue('C'.$row, $data->owner);
                    }
                    
                } else if ($data->client_type_id == '4') {
                    $worksheet->setCellValue('C'.$row, $data->barangay_name .', '. $data->municipality);
                } else if ($data->client_type_id == '5') {
                    $worksheet->setCellValue('C'.$row, 'Municipal Government of '. $data->municipality);
                } else if ($data->client_type_id == '6' || $data->client_type_id == '7') {
                    if ($data->trade_name_permittees != null && $data->permittee != null) {
                        $worksheet->setCellValue('C'.$row, $data->trade_name_permittees.' By: '.$data->permittee);
                    } else if ($data->trade_name_permittees != null && $data->permittee == null) {
                        $worksheet->setCellValue('C'.$row, $data->trade_name_permittees);
                    } else if ($data->trade_name_permittees == null && $data->permittee != null) {
                        $worksheet->setCellValue('C'.$row, $data->permittee);
                    }
                } else if ($data->client_type_id == '9') {
                    $worksheet->setCellValue('C'.$row, $data->rental_name);
                } else if ($data->client_type_id == '10' || $data->client_type_id == '11') {
                    if ($data->trade_name_permit_fees != null && $data->proprietor != null) {
                        $worksheet->setCellValue('C'.$row, $data->trade_name_permit_fees.' By: '.$data->proprietor);
                    } else if ($data->trade_name_permit_fees != null && $data->proprietor == null) {
                        $worksheet->setCellValue('C'.$row, $data->trade_name_permit_fees);
                    } else if ($data->trade_name_permit_fees == null && $data->proprietor != null) {
                        $worksheet->setCellValue('C'.$row, $data->proprietor);
                    }
                } else if ($data->client_type_id == '12' || $data->client_type_id == '13') {
                    if ($data->bidders_business_name == null) {
                        $worksheet->setCellValue('C'.$row, $data->owner_representative);
                    } else if ($data->owner_representative == null) {
                        $worksheet->setCellValue('C'.$row, $data->bidders_business_name);
                    } else {
                        $worksheet->setCellValue('C'.$row, $data->bidders_business_name.' By: '.$data->owner_representative);
                    }
                } else {
                    if ($data->client_type_radio == "Individual") {
                        if ($data->middle_initial == null) {
                            $worksheet->setCellValue('C'.$row, $data->last_name.', '.$data->first_name);
                        } else {
                            $worksheet->setCellValue('C'.$row, $data->last_name.', '.$data->first_name.' '.$data->middle_initial);
                        }
                        
                    } else if ($data->client_type_radio == "Company") {
                        $worksheet->setCellValue('C'.$row, $data->company);
                    } else if ($data->client_type_radio == "Spouse") {
                        $worksheet->setCellValue('C'.$row, $data->spouses);
                    }
                }
            }
            //Total
            // $worksheet->setCellValue('J'.$row, '=SUM(D'.$row.':J'.$row.')' );
            //Total 
            $row++;
        }

        $worksheet->getStyle("A10:J".$row)->applyFromArray($borderedStyleArray);
        $worksheet->getStyle('B15:C'.$row)->applyFromArray($verticalLeft);
        $worksheet->getStyle('D15:J'.$row)->applyFromArray($verticalRight);
        $worksheet->getStyle('A15:A'.$row)->applyFromArray($centerAlign);
        $spreadsheet->getActiveSheet()->getStyle('C15:C'.$row)->getAlignment()->setWrapText(true);

        $worksheet->mergeCells('A'.($row).':C'.($row));
        $worksheet->setCellValue('A'.$row, 'COLLECTION for '.$startMonth);

        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), 'COLLECTION as of '.$startMonth);

        $worksheet->mergeCells('A'.($row+2).':C'.($row+2));
        $worksheet->setCellValue('A'.($row+2), "TOTAL PROV'L SHARE for " .$startMonth);

        $worksheet->mergeCells('A'.($row+3).':C'.($row+3));
        $worksheet->setCellValue('A'.($row+3), "TOTAL PROV'L SHARE as of ".$startMonth);

        $worksheet->getStyle('A'.$row.':C'.($row+3))->applyFromArray($verticalLeft);

        // Monitoring Penalties
        $worksheet->setCellValue('D'.$row, '=SUM(D15'.':D'.$row.')' );
        $monitoringTotal = $worksheet->getCell('D'.$row)->getCalculatedValue();
        $monitoringGrandTotal = $monitoringTotal + $monitoringVal;
        $worksheet->setCellValue('D'.($row+1), $monitoringGrandTotal);
        $monitorProvShare = $monShareTotal;
        $worksheet->setCellValue('D'.($row+2),  $monitorProvShare);
        $monitoringProvShareTotal = $monitoringRes+$monitorProvShare;
        $worksheet->setCellValue('D'.($row+3), $monitoringProvShareTotal);

        //Provincial Projects
        $worksheet->setCellValue('E'.$row, '=SUM(E15'.':E'.$row.')' );
        $projectsTotal = $worksheet->getCell('E'.$row)->getCalculatedValue();
        $projectsGrandTotal = $projectsTotal + $projectsVal;
        $worksheet->setCellValue('E'.($row+1), $projectsGrandTotal);
        $projectsProvShare = $provShareTotal;
        $worksheet->setCellValue('E'.($row+2),  $projectsProvShare);
        $projectsProvShareTotal = $projectsRes+$projectsProvShare;
        $worksheet->setCellValue('E'.($row+3), $projectsProvShareTotal);

        //National National
        $worksheet->setCellValue('F'.$row, '=SUM(F15'.':F'.$row.')' );
        $nationalTotal = $worksheet->getCell('F'.$row)->getCalculatedValue();
        $nationalGrandTotal = $nationalTotal + $nationalVal;
        $worksheet->setCellValue('F'.($row+1), $nationalGrandTotal);
        $nationalProvShare = $nationalShareTotal;
        $worksheet->setCellValue('F'.($row+2),  $nationalRes);
        $nationalProvShareTotal = $nationalRes+$nationalProvShare;
        $worksheet->setCellValue('F'.($row+3), $nationalProvShareTotal);

        //S&G Permittees Industrial
        $worksheet->setCellValue('G'.$row, '=SUM(G15'.':G'.$row.')' );
        $industrialTotal = $worksheet->getCell('G'.$row)->getCalculatedValue();
        $industrialGrandTotal = $industrialTotal + $industrialVal;
        $worksheet->setCellValue('G'.($row+1), $industrialGrandTotal);
        $industrialProvShare = $industrialShareTotal;
        $worksheet->setCellValue('G'.($row+2),  $industrialProvShare);
        $industrialProvShareTotal = $industrialRes+$industrialProvShare;
        $worksheet->setCellValue('G'.($row+3), $industrialProvShareTotal);

        //S&G Permittees Commercial
        $worksheet->setCellValue('H'.$row, '=SUM(H15'.':H'.$row.')' );
        $commercialTotal = $worksheet->getCell('H'.$row)->getCalculatedValue();
        $commercialGrandTotal = $commercialTotal + $commercialVal;
        $worksheet->setCellValue('H'.($row+1), $commercialGrandTotal);
        $commercialProvShare = $commercialShareTotal;
        $worksheet->setCellValue('H'.($row+2),  $commercialProvShare);
        $commercialProvShareTotal = $commercialRes+$commercialProvShare;
        $worksheet->setCellValue('H'.($row+3), $commercialProvShareTotal);

        //Municipal Barangay Remittance
        $worksheet->setCellValue('I'.$row, '=SUM(I15'.':I'.$row.')' );
        $municipalTotal = $worksheet->getCell('I'.$row)->getCalculatedValue();
        $municipalGrandTotal = $municipalTotal + $municipalVal;
        $worksheet->setCellValue('I'.($row+1), $municipalGrandTotal);
        $municipalProvShare = $municipalTotal*0.3;
        $worksheet->setCellValue('I'.($row+2),  $municipalProvShare);
        $municipalProvShareTotal = $municipalRes+$municipalProvShare;
        $worksheet->setCellValue('I'.($row+3), $municipalProvShareTotal);
        
        $check = DB::table('sg_mothly_collections')->select('*')->where([['collection_month', $request->sgMonthStart], ['collection_year', $currentYear]])->orderBy('collection_type')->get();
        if(count($check)>0) {
            if ($request->sgMonthStart == 1) {
                $data = [
                    [
                        'monitoring_total'=> 0.00,
                        'provincial_total' => 0.00,
                        'dpwh_total' => 0.00,
                        'industrial_total' => 0.00,
                        'commercial_total' => 0.00,
                        'mun_bar_total' => 0.00,
                        'collection_month' => 0,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Collection"
                    ],
                    [   
                        'monitoring_total' => 0.00,
                        'provincial_total' => 0.00,
                        'dpwh_total' => 0.00,
                        'industrial_total' => 0.00,
                        'commercial_total' => 0.00,
                        'mun_bar_total' => 0.00,
                        'collection_month' => 0,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Share"
                    ],
                    [
                        'monitoring_total'=> $monitoringGrandTotal,
                        'provincial_total' => $projectsGrandTotal,
                        'dpwh_total' => $nationalGrandTotal,
                        'industrial_total' => $industrialGrandTotal,
                        'commercial_total' => $commercialGrandTotal,
                        'mun_bar_total' => $municipalGrandTotal,
                        'collection_month' => $request->sgMonthStart,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Collection"
                    ],
                    [   
                        'monitoring_total' => $monitoringProvShareTotal,
                        'provincial_total' => $projectsProvShareTotal,
                        'dpwh_total' => $nationalProvShareTotal,
                        'industrial_total' => $industrialProvShareTotal,
                        'commercial_total' => $commercialProvShareTotal,
                        'mun_bar_total' => $municipalProvShareTotal,
                        'collection_month' => $request->sgMonthStart,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Share"
                    ]
                ];
            } else {
                $data = [
                    [
                        'monitoring_total'=> $monitoringGrandTotal,
                        'provincial_total' => $projectsGrandTotal,
                        'dpwh_total' => $nationalGrandTotal,
                        'industrial_total' => $industrialGrandTotal,
                        'commercial_total' => $commercialGrandTotal,
                        'mun_bar_total' => $municipalGrandTotal,
                        'collection_month' => $request->sgMonthStart,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Collection"
                    ],
                    [   
                        'monitoring_total' => $monitoringProvShareTotal,
                        'provincial_total' => $projectsProvShareTotal,
                        'dpwh_total' => $nationalProvShareTotal,
                        'industrial_total' => $industrialProvShareTotal,
                        'commercial_total' => $commercialProvShareTotal,
                        'mun_bar_total' => $municipalProvShareTotal,
                        'collection_month' => $request->sgMonthStart,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Share"
                    ]
                ];
            }
            sgMothlyCollection::where('id', $check[0]->id)->update($data[0]);
            sgMothlyCollection::where('id', $check[1]->id)->update($data[1]);
        } else {
            if ($request->sgMonthStart == 1) {
                
                $data = [
                    [
                        'monitoring_total'=> 0.00,
                        'provincial_total' => 0.00,
                        'dpwh_total' => 0.00,
                        'industrial_total' => 0.00,
                        'commercial_total' => 0.00,
                        'mun_bar_total' => 0.00,
                        'collection_month' => 0,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Collection"
                    ],
                    [   
                        'monitoring_total' => 0.00,
                        'provincial_total' => 0.00,
                        'dpwh_total' => 0.00,
                        'industrial_total' => 0.00,
                        'commercial_total' => 0.00,
                        'mun_bar_total' => 0.00,
                        'collection_month' => 0,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Share"
                    ],
                    [
                        'monitoring_total'=> $monitoringGrandTotal,
                        'provincial_total' => $projectsGrandTotal,
                        'dpwh_total' => $nationalGrandTotal,
                        'industrial_total' => $industrialGrandTotal,
                        'commercial_total' => $commercialGrandTotal,
                        'mun_bar_total' => $municipalGrandTotal,
                        'collection_month' => $request->sgMonthStart,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Collection"
                    ],
                    [   
                        'monitoring_total' => $monitoringProvShareTotal,
                        'provincial_total' => $projectsProvShareTotal,
                        'dpwh_total' => $nationalProvShareTotal,
                        'industrial_total' => $industrialProvShareTotal,
                        'commercial_total' => $commercialProvShareTotal,
                        'mun_bar_total' => $municipalProvShareTotal,
                        'collection_month' => $request->sgMonthStart,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Share"
                    ]
                ];
            } else {
                $data = [
                    [
                        'monitoring_total'=> $monitoringGrandTotal,
                        'provincial_total' => $projectsGrandTotal,
                        'dpwh_total' => $nationalGrandTotal,
                        'industrial_total' => $industrialGrandTotal,
                        'commercial_total' => $commercialGrandTotal,
                        'mun_bar_total' => $municipalGrandTotal,
                        'collection_month' => $request->sgMonthStart,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Collection"
                    ],
                    [   
                        'monitoring_total' => $monitoringProvShareTotal,
                        'provincial_total' => $projectsProvShareTotal,
                        'dpwh_total' => $nationalProvShareTotal,
                        'industrial_total' => $industrialProvShareTotal,
                        'commercial_total' => $commercialProvShareTotal,
                        'mun_bar_total' => $municipalProvShareTotal,
                        'collection_month' => $request->sgMonthStart,
                        'collection_year' => $currentYear,
                        'collection_type' => "Prov. Share"
                    ]
                ];
            }
            sgMothlyCollection::insert($data);
        }

        //Total
        $worksheet->setCellValue('J'.$row, '=SUM(J15'.':J'.$row.')' );
        $collection = $worksheet->getCell('J'.$row)->getCalculatedValue();
        $totalCollection = $lastTotal+$collection;
        $worksheet->setCellValue('J'.($row+1), $totalCollection);
        $worksheet->setCellValue('J'.($row+2), '=SUM(D'.($row+2).':I'.($row+2).')');
        $worksheet->setCellValue('J'.($row+3), '=SUM(D'.($row+3).':I'.($row+3).')');

        $worksheet->getStyle("A10:J".($row+3))->applyFromArray($borderedStyleArray);
        $worksheet->getStyle('B15:C'.($row-1))->applyFromArray($verticalLeft);
        $worksheet->getStyle('D15:J'.($row-1))->applyFromArray($verticalRight);
        $worksheet->getStyle('A15:A'.($row-1))->applyFromArray($centerAlign);
        $worksheet->getStyle('A'.($row).':J'.($row+3))->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('C15:C'.($row-1))->getAlignment()->setWrapText(true);
        
        $row += 4;
        $worksheet->mergeCells('A'.($row+1).':J'.($row+1));
        $worksheet->setCellValue('A'.($row+1), "SUMMARY OF SAND AND GRAVEL TAX COLLECTION");
        $worksheet->getStyle('A'.($row+1).':A'.($row+1))->applyFromArray($centerAlign);
        $worksheet->getStyle('A'.($row+1).':A'.($row+1))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($row+1).':J'.($row+1))->getFont()->setUnderline(true);
        $worksheet->getStyle('A'.($row+1).':A'.($row+1))->getFont()->setSize(14);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':J'.($row+1));
        $worksheet->setCellValue('A'.($row+1), $startMonth.' '.date("1", strtotime($today)).'-'.date("t", strtotime($startMonth)).', '.$currentYear);
        $worksheet->getStyle('A'.($row+1).':A'.($row+1))->applyFromArray($centerAlign);
        $worksheet->getStyle('A'.($row+1).':A'.($row+1))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($row+1).':J'.($row+1))->getFont()->setUnderline(true);
        $worksheet->getStyle('A'.($row+1).':A'.($row+1))->getFont()->setSize(14);

        $row += 2;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), '    Monitoring -penalties');
        $worksheet->setCellValue('E'.($row+1), '=SUM(D15'.':D'.($row-8).')');
        $monitoringValue = $worksheet->getCell('E'.($row+1))->getCalculatedValue();
        $monitoringCalc = $monShareTotal;
        $worksheet->setCellValue('F'.($row+1), $monitoringCalc);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), 'Projects');
        $worksheet->getStyle('A'.($row+1))->getFont()->setUnderline(true);
        $worksheet->getStyle('A'.($row+1).':A'.($row+1))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), "    -Provincial Project (Prov'l Contractors)");
        $worksheet->setCellValue('E'.($row+1), '=SUM(E15'.':E'.($row-10).')');
        $provincialValue = $worksheet->getCell('E'.($row+1))->getCalculatedValue();
        $provincialCalc = $provShareTotal;
        $worksheet->setCellValue('F'.($row+1), $provincialCalc);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), "    -National Projects (DPWH-CAR/ Nat'l Agencies)");
        $worksheet->setCellValue('E'.($row+1), '=SUM(F15'.':F'.($row-12).')');
        $nationalValue = $worksheet->getCell('E'.($row+1))->getCalculatedValue();
        $nationalCalc = $nationalShareTotal;
        $worksheet->setCellValue('F'.($row+1), $nationalCalc);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), 'Sand and Gravel Permittees');
        $worksheet->getStyle('A'.($row+1).':A'.($row+1))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), "    -Industrial");
        $worksheet->setCellValue('E'.($row+1), '=SUM(G15'.':G'.($row-13).')');
        $industrialValue = $worksheet->getCell('E'.($row+1))->getCalculatedValue();
        $industrialCalc = $industrialShareTotal;
        $worksheet->setCellValue('F'.($row+1), $industrialCalc);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), "    -Commercial");
        $worksheet->setCellValue('E'.($row+1), '=SUM(H15'.':H'.($row-14).')');
        $commercialValue = $worksheet->getCell('E'.($row+1))->getCalculatedValue();
        $commercialCalc = $commercialShareTotal;
        $worksheet->setCellValue('F'.($row+1), $commercialCalc);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), 'Sub-total');
        $worksheet->setCellValue('E'.($row+1), '=SUM(E'.($row-6).':E'.$row.')');
        $worksheet->setCellValue('F'.($row+1), '=SUM(F'.($row-6).':F'.$row.')');
        $subTotalValue = $worksheet->getCell('F'.($row+1))->getCalculatedValue();
        $worksheet->getStyle('E'.($row+1).':F'.($row+1))->getFont()->setUnderline(true);
        $worksheet->getStyle('A'.($row+1).':F'.($row+1))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), "Add: Municipal/ Brgy.Remittances");
        $worksheet->setCellValue('F'.($row+1), '=SUM(I15'.':I'.($row-16).')');
        $munBarValue = $worksheet->getCell('F'.($row+1))->getCalculatedValue();
        $worksheet->getStyle('F'.($row+1))->getFont()->setUnderline(true);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 1;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), 'TOTAL');
        $worksheet->setCellValue('F'.($row+1), $subTotalValue+$munBarValue);
        $worksheet->getStyle('F'.($row+1))->getFont()->setUnderline(true);
        $worksheet->getStyle('A'.($row+1).':F'.($row+1))->getFont()->setBold(true);
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $row += 2;
        $worksheet->mergeCells('A'.($row+1).':C'.($row+1));
        $worksheet->setCellValue('A'.($row+1), "Prepared by:");
        $worksheet->getStyle('A'.($row+1).':C'.($row+1))->applyFromArray($verticalLeft);

        $worksheet->mergeCells('F'.($row+3).':H'.($row+3));
        $worksheet->setCellValue('F'.($row+3), "Noted by:");
        $worksheet->getStyle('F'.($row+3).':H'.($row+3))->applyFromArray($verticalLeft);
        
        $row += 1;
        $worksheet->mergeCells('B'.($row+1).':D'.($row+1));
        $worksheet->setCellValue('B'.($row+1), $getPreparedByOffcier->name);
        $worksheet->getStyle('B'.($row+1).':B'.($row+1))->getFont()->setBold(true);
        $worksheet->getStyle('B'.($row+1).':B'.($row+1))->applyFromArray($centerAlign);
        
        $worksheet->mergeCells('F'.($row+3).':H'.($row+3));
        $worksheet->setCellValue('F'.($row+3), $getPreparedByOffcierB->name);
        $worksheet->getStyle('F'.($row+3).':F'.($row+3))->getFont()->setBold(true);
        $worksheet->getStyle('F'.($row+3).':F'.($row+3))->applyFromArray($centerAlign);

        $row += 1;
        $worksheet->mergeCells('B'.($row+1).':D'.($row+1));
        $worksheet->setCellValue('B'.($row+1), $getPreparedByOffcier->position);
        $worksheet->getStyle('B'.($row+1).':B'.($row+1))->applyFromArray($centerAlign);

        $worksheet->mergeCells('F'.($row+3).':H'.($row+3));
        $worksheet->setCellValue('F'.($row+3), $getPreparedByOffcierB->position);
        $worksheet->getStyle('F'.($row+3).':F'.($row+3))->applyFromArray($centerAlign);

        $worksheet->getStyle('D12:J'.$row)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        
        // Sheet B
        $worksheet = $spreadsheet->getSheetByName('B');
        $row = 10;
        $worksheet->setCellValue('A'.($row-1), $startMonth.' '.date("1", strtotime($today)).'-'.date("t", strtotime($startMonth)).', '.$currentYear);
        $worksheet->getStyle('A'.($row-1))->getFont()->setUnderline(true);
        $worksheet->getStyle('A'.($row-1))->getFont()->setBold(true);
        
        $previousMunicipality = $dataInAMonth[0]->municipality;
        $previousBarangay = $dataInAMonth[0]->barangay_name;
        $currentMunicipality = $currentBarangay = '';
        $municipalityFlag = true;
        $barangayFlag = true;
        $subTotalFlag = false;
        $sharingFlag = false;
        $specialFlag1 = false;
        $specialFlag2 = false;
        $provincialShare = 0;
        $municipalShare = 0;
        $barangayShare = 0;
        $specialShare = 0;
        $tempShare = 0;
        $specialIndex = 0;
        $removeIndex = 0;
        $removeValue = 0;
        $lessValue = 0;
        $subTotalShare = 0;
        $specialKey = 0;
        $totals = [];
        $brgyTotals = [];
        $grandSubTotals = [];
        $tubaArray = [];
        $tubaBarangay = ['Tabaan Sur', 'Tabaan Norte', 'San Pascual', 'Nangalisan', 'Camp 4', 'Camp 3', 'Camp 1'];
        $sum = 0;

        $tempArray = [];
        $tempMaxKey = 0;
        $supposedlyNext = '';
        $supposedlyPrev = '';
        $municipalities = Municipalities::select(DB::raw('GROUP_CONCAT(municipality) as names'))->orderBy('municipality', 'asc')->get();
        $municipalities = explode(',', $municipalities[0]->names);
        
        foreach($dataInAMonthSharing as $key=>$dataB) {
            $currentMunicipality = $dataB->municipality;
            $currentBarangay = $dataB->barangay_name;
            if ($key == 0) {
                $lastMuns = $this->checkLastMunicipality($currentMunicipality);
                if ($lastMuns) {
                    foreach($lastMuns as $last) {
                        $worksheet->setCellValue('A'.++$row, $last);
                        $worksheet->setCellValue('B'.$row,'-');
                        $worksheet->setCellValue('C'.$row,'-');
                        $worksheet->setCellValue('D'.$row,'-');
                        $worksheet->setCellValue('E'.$row,'-');
                        $worksheet->setCellValue('F'.$row,'-');
                    }
                }
            }

            if ($currentMunicipality == $previousMunicipality) {
                if ($currentBarangay != $previousBarangay) {
                    $barangayFlag = true;
                }
            } else {
                $previousMunicipality = $currentMunicipality;
                $municipalityFlag = true;
                $barangayFlag = true;
                $supposedlyNext = $this->checkNextMunicipality($previousMunicipality);
                $supposedlyPrev = $this->checkPrevMunicipality($previousMunicipality);
            }
            
            if ($municipalityFlag) {
                $subTotalFlag = true;
                $row++;
                $municipalityFlag = false;
                $worksheet->setCellValue('A'.$row, $currentMunicipality);
                array_push($totals, ['row'=>$row, 'provincialShare'=>$provincialShare, 'municipalShare'=>$municipalShare]);
                $municipalShare = 0;
                $provincialShare = 0;
                $subTotalShare = 0;
            } else {
                $municipalityFlag = false;
            }
            // dump($currentMunicipality.' - '.$previousMunicipality.' - '.$currentBarangay.' - '.$previousBarangay.' - '.$provincialShare.' - '.$municipalShare);
            if ($dataB->sharing_status == 'on') {
                $sharingFlag = true;
            }
            
            if ($barangayFlag) {
                // if ($previousBarangay == 'Tabaan Sur') {
                //     $specialFlag2 = true;
                // }

                if ($specialFlag1) {
                    foreach ($brgyTotals as $key=>$brgyTotal) {
                        if ($brgyTotal['row'] == $specialIndex) {
                            $brgyTotals[$key]['barangayShare'] += $barangayShare;
                        }
                    }
                    $specialFlag1 = false;
                }

                if ($currentMunicipality == 'Tuba') {
                    array_push($tubaArray, $row+1);
                }
                $barangayFlag = false;
                $worksheet->setCellValue('B'.($row+1), $currentBarangay);
                array_push($brgyTotals, ['row'=>$row, 'barangayShare'=>$barangayShare] );
                $barangayShare = 0;
                $row++;
            } else {
                // $worksheet->setCellValue('B'.($row+1), $currentBarangay);
            }

            
            $previousBarangay = $currentBarangay;
            $barangayShare += $dataB->bar_sum;
            $specialShare += $dataB->special_sum+$lessValue;

            $provincialShare += $dataB->prov_sum;
            $municipalShare += $dataB->mun_sum;
            $subTotalShare += ($dataB->prov_sum+$dataB->mun_sum+$dataB->bar_sum);

            if ($key < count($dataInAMonthSharing)-1) {
                if ($key == count($dataInAMonthSharing)-1) {
                    if ($key != 0) {
                        $worksheet->setCellValue('A'.++$row, '  Sub - Total');
                        $worksheet->getStyle('A'.$row.':J'.$row)->getFont()->setBold(true);
                        array_push($grandSubTotals, ['row'=>$row, 'subTotalShare'=>$subTotalShare+$specialShare]);
                    } else {
                        if ($currentMunicipality != $dataInAMonthSharing[$key+1]['municipality']) {
                            $worksheet->setCellValue('A'.++$row, '  Sub - Total');
                            $worksheet->getStyle('A'.$row.':J'.$row)->getFont()->setBold(true);
                            array_push($grandSubTotals, ['row'=>$row, 'subTotalShare'=>$subTotalShare+$specialShare]);
                        }
                    }
                } else {
                    if ($currentMunicipality != $dataInAMonthSharing[$key+1]['municipality']) {
                        if ($key != 0 && $subTotalFlag == true && ($currentMunicipality != 'Tublay' || $supposedlyPrev == 'Tuba')) {
                            if ($currentMunicipality != 'Tuba') {
                                
                                $worksheet->setCellValue('A'.++$row, '  Sub - Total');
                                $worksheet->getStyle('A'.$row.':J'.$row)->getFont()->setBold(true);
                                array_push($grandSubTotals, ['row'=>$row, 'subTotalShare'=>$subTotalShare+$specialShare]);
                            } else {
                                $worksheet->setCellValue('A'.++$row, '  Sub - Total');
                                $worksheet->getStyle('A'.$row.':J'.$row)->getFont()->setBold(true);
                                array_push($grandSubTotals, ['row'=>$row, 'subTotalShare'=>$subTotalShare+$specialShare]);
                            }
                        } else {
                            // if ($currentMunicipality == 'Atok') {
                            //     $worksheet->setCellValue('A'.++$row, '  Sub - Total');
                            //     $worksheet->getStyle('A'.$row.':J'.$row)->getFont()->setBold(true);
                            //     array_push($grandSubTotals, ['row'=>$row, 'subTotalShare'=>$subTotalShare+$specialShare]);
                            // }
                            $worksheet->setCellValue('A'.++$row, '  Sub - Total');
                            $worksheet->getStyle('A'.$row.':J'.$row)->getFont()->setBold(true);
                            array_push($grandSubTotals, ['row'=>$row, 'subTotalShare'=>$subTotalShare+$specialShare]);
                        }
                    }
                    
                    if ($supposedlyNext != $dataInAMonthSharing[$key+1]['municipality'] && $supposedlyNext != '') {
                        $startingIndex = array_search($supposedlyNext, (array)$municipalities);
                        $endingIndex = array_search($dataInAMonthSharing[$key+1]['municipality'], (array)$municipalities);
                        for ($i=(int)$startingIndex; $i<$endingIndex; $i++) {
                            $worksheet->setCellValue('A'.++$row, $municipalities[$i]);
                            $worksheet->setCellValue('B'.$row,'-');
                            $worksheet->setCellValue('C'.$row,'-');
                            $worksheet->setCellValue('D'.$row,'-');
                            $worksheet->setCellValue('E'.$row,'-');
                            $worksheet->setCellValue('F'.$row,'-');
                        }
                    }
                }
            }
            
            if ($key == count($dataInAMonthSharing)-1) {
                $worksheet->setCellValue('A'.++$row, '  Sub - Total');
                $worksheet->getStyle('A'.$row.':J'.$row)->getFont()->setBold(true);
                array_push($grandSubTotals, ['row'=>$row, 'subTotalShare'=>$subTotalShare]);

                $tempMaxKey = $row;
                $municipalityFlag = false;
                array_push($totals, ['row'=>$row, 'provincialShare'=>$provincialShare, 'municipalShare'=>$municipalShare]);
                $barangayFlag = false;
                array_push($brgyTotals, ['row'=>$row, 'barangayShare'=>$barangayShare, 'specialShare'=>$specialShare] );
                // $worksheet->setCellValue('A'.++$row, '  Sub - Total');
                // $worksheet->getStyle('A'.$row.':J'.$row)->getFont()->setBold(true);
                // array_push($grandSubTotals, ['row'=>$row, 'subTotalShare'=>$subTotalShare+$specialShare]);

                if ($currentMunicipality == 'Tuba') {
                    $row++;
                    $worksheet->setCellValue('A'.($row), 'Tublay');
                    $worksheet->setCellValue('B'.($row),'-');
                    $worksheet->setCellValue('C'.($row),'-');
                    $worksheet->setCellValue('D'.($row),'-');
                    $worksheet->setCellValue('E'.($row),'-');
                    $worksheet->setCellValue('F'.($row),'-');
                }
            }
        }
        
        $tempVal = 0;
        foreach ($brgyTotals as $key=>$brgyTotal) {
            // dump($brgyTotal['row'].' - '.$brgyTotal['barangayShare']);
            if ($removeIndex != 0) {
                if ($brgyTotal['row'] == $removeIndex) {
                    $tempVal = $brgyTotal['barangayShare'];
                }
            }
            
            if ($brgyTotal['row'] == $specialIndex) {
                $brgyTotals[$key]['barangayShare'] = $brgyTotals[count($brgyTotals)-1]['specialShare'];
            }
        }
        
        if ($removeIndex != 0) {
            foreach ($brgyTotals as $key=>$brgyTotal) {
                if ($brgyTotal['row'] == $removeIndex+1) {
                    $brgyTotals[$key]['barangayShare'] += $tempVal;
                }
            }
        }
        
        $grandTotal = 0;
        $grandTotalBar = 0;
        foreach ($totals as $key=>$total) {
            if ($key == 0) {
            } else {
                $worksheet->setCellValue('C'.$totals[$key-1]['row'], $total['provincialShare']);
                $worksheet->setCellValue('D'.$totals[$key-1]['row'], $total['municipalShare']);
                $worksheet->setCellValue('F'.$totals[$key-1]['row'], $total['provincialShare']+$total['municipalShare']);
                $grandTotal += $total['provincialShare']+$total['municipalShare'];
            }
        }
        
        foreach ($brgyTotals as $key=>$total) {
            if ($key == 0) {
                
            } else {
                $worksheet->setCellValue('E'.($brgyTotals[($key-1)]['row']+1), $total['barangayShare']);
                $worksheet->setCellValue('F'.($brgyTotals[($key-1)]['row']+1), $total['barangayShare']);
                $grandTotalBar += $total['barangayShare'];
            }
        }
        
        foreach ($grandSubTotals as $key=>$subTotal) {
            $worksheet->setCellValue('F'.($grandSubTotals[($key)]['row']), $subTotal['subTotalShare']);
            // if ($key == count($grandSubTotals)-2) {
            //     $worksheet->setCellValue('F'.($grandSubTotals[($key)]['row']), $subTotal['subTotalShare']-$removeValue);
            // }
            
        }

        if ($removeIndex > 0) {
            $worksheet->removeRow($removeIndex);
        }

        rsort($tubaArray);
        foreach ($tubaBarangay as $barangay) {
            foreach($tubaArray as $tubaRow) {
                if ($worksheet->getCell('B'.$tubaRow)->getCalculatedValue() == $barangay){
                    if ($worksheet->getCell('B'.$tubaRow) == 'Tabaan Sur') {
                        $worksheet->setCellValue('E'.($tubaRow), $specialShare+$worksheet->getCell('E'.$tubaRow)->getCalculatedValue());
                        $worksheet->setCellValue('F'.($tubaRow), $specialShare+$worksheet->getCell('F'.$tubaRow)->getCalculatedValue());
                    } else {
                        $worksheet->insertNewRowBefore($tubaRow+1);
                        $worksheet->setCellValue('B'.($tubaRow+1), 'Tabaan Sur');
                        $worksheet->setCellValue('E'.($tubaRow+1), $specialShare);
                        $worksheet->setCellValue('F'.($tubaRow+1), $specialShare);
                    }
                    break 2;
                }
            }
        }
        
        $worksheet->setCellValue('C'.($row+2), '=SUM(C11:C'.($row).')');
        $worksheet->setCellValue('D'.($row+2), '=SUM(D11:D'.($row).')');
        $worksheet->setCellValue('E'.($row+2), '=SUM(E11:E'.($row).')');
        $worksheet->getStyle('C11:F'.($row+2))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        
        $worksheet->setCellValue('F'.($row+2), '=SUM(C'.($row+2).':E'.($row+2).')');
        // $worksheet->setCellValue('F'.($row+1), $grandTotal+$grandTotalBar);
        $worksheet->setCellValue('A'.($row+2), '    SHARING FOR '. strtoupper($startMonth).' '.strtoupper($currentYear));
        $worksheet->getStyle('A'.($row+2).':F'.($row+2))->getFont()->setBold(true);
        $worksheet->getStyle("A11:F".($row+2))->applyFromArray($borderedStyleArray);

        $worksheet->mergeCells('A'.($row+3).':B'.($row+3));
        $worksheet->setCellValue('A'.($row+3), 'Prepared by:');

        $worksheet->mergeCells('D'.($row+5).':E'.($row+5));
        $worksheet->setCellValue('D'.($row+5), 'Noted by:');

        $worksheet->mergeCells('A'.($row+4).':B'.($row+4));
        $worksheet->setCellValue('A'.($row+4), 'MARY JANE P. LAMPACAN');
        $worksheet->getStyle('A'.($row+4))->applyFromArray($centerAlign);
        $worksheet->getStyle('A'.($row+4))->getFont()->setBold(true);

        $worksheet->mergeCells('D'.($row+6).':E'.($row+6));
        $worksheet->setCellValue('D'.($row+6), 'IMELDA I. MACANES');
        $worksheet->getStyle('D'.($row+6))->applyFromArray($centerAlign);
        $worksheet->getStyle('D'.($row+6))->getFont()->setBold(true);

        $worksheet->mergeCells('A'.($row+5).':B'.($row+5));
        $worksheet->setCellValue('A'.($row+5), 'Local Revenue Collection Officer IV');
        $worksheet->getStyle('A'.($row+5))->applyFromArray($centerAlign);

        $worksheet->mergeCells('D'.($row+7).':E'.($row+7));
        $worksheet->setCellValue('D'.($row+7), 'Provincial Treasurer');
        $worksheet->getStyle('D'.($row+7))->applyFromArray($centerAlign);

        //Report C
        $worksheet = $spreadsheet->getSheetByName('C');
        $row = 13;
        $munTotals = [];

        $worksheet->setCellValue('G8', $startMonthPascal.' '.date("1", strtotime($today)).' - '.$startMonthPascal.' '.date("t", strtotime($startMonth)).', '.$currentYear);
        $worksheet->setCellValue('A'.($row-1), $startMonth);

        $provincialShare = 0;
        
        foreach ($daysTaxPenalty as $keya=>$data) {
            $reportDays = date('d', strtotime($data->report_date));
            $dataInAMonthTaxPenalty = LandTaxInfo::select('land_tax_infos.municipality_id', DB::raw('SUM(land_tax_accounts.amount) AS sum'))
            ->where([['land_tax_accounts.nature', '<>', 'Certification Fee'], ['land_tax_accounts.account', 'Tax on Sand, Gravel & Other Quarry Prod.'], ['land_tax_infos.submission_type', 'Revenue Collection'], ['land_tax_infos.status', '<>', 'Cancelled']])
            ->whereIn('client_type_id', [1, 2, 3, 5, 6, 7])
            ->where('land_tax_infos.report_date', '=', $data->report_date)
            ->orderBy('land_tax_infos.report_date', 'asc')
            ->groupBy('land_tax_infos.municipality_id')
            ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
            ->get();

            $provincialShareData = LandTaxInfo::select('land_tax_infos.serial_number', 'prov_share')
            ->where([['land_tax_accounts.nature', '<>', 'Certification Fee'], ['land_tax_accounts.account', 'Tax on Sand, Gravel & Other Quarry Prod.'], ['land_tax_infos.submission_type', 'Revenue Collection'], ['land_tax_infos.status', '<>', 'Cancelled']])
            ->whereIn('client_type_id', [1, 2, 3, 5, 6, 7])
            ->where('land_tax_infos.report_date', '=', $data->report_date)
            ->orderBy('land_tax_infos.report_date', 'asc')
            ->distinct('land_tax_infos.serial_number')
            ->leftJoin('municipalities', 'municipalities.id', 'land_tax_infos.municipality_id') 
            ->leftJoin('barangays', 'barangays.id', 'land_tax_infos.barangay_id')
            ->leftJoin('land_tax_accounts', 'land_tax_accounts.info_id', 'land_tax_infos.id')
            ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id')
            ->get();
            
            $dailyShare = 0;
            foreach ($provincialShareData as $provData) {
                $dailyShare = $provData->prov_share+$dailyShare;
            }

            $worksheet->setCellValue('A'.$row, $reportDays);
            $worksheet->getStyle('A'.$row)->applyFromArray($centerAlign);
            $worksheet->setCellValue('B'.$row, $dailyShare);

            foreach($dataInAMonthTaxPenalty as $tax) {
                if ($tax->municipality_id == 1) {
                    $worksheet->setCellValue('C'.$row, $tax->sum);
                }
    
                if ($tax->municipality_id == 2) {
                    $worksheet->setCellValue('D'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 3) {
                    $worksheet->setCellValue('E'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 4) {
                    $worksheet->setCellValue('F'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 5) {
                    $worksheet->setCellValue('G'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 6) {
                    $worksheet->setCellValue('H'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 7) {
                    $worksheet->setCellValue('I'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 8) {
                    $worksheet->setCellValue('J'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 9) {
                    $worksheet->setCellValue('K'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 10) {
                    $worksheet->setCellValue('L'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 11) {
                    $worksheet->setCellValue('M'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 12) {
                    $worksheet->setCellValue('N'.$row, $tax->sum);
                }

                if ($tax->municipality_id == 13) {
                    $worksheet->setCellValue('O'.$row, $tax->sum);
                }
                $worksheet->setCellValue('P'.$row, '=SUM(C'.$row.':O'.$row.')');
            }
            $row++;
        }
        $worksheet->getStyle("A10:P".$row)->applyFromArray($borderedStyleArray);
        $worksheet->setCellValue('A'.$row, 'Total '.$startMonthPascal.' '.date("1", strtotime($today)).'-'.date("t", strtotime($startMonth)));
        $worksheet->getStyle('A'.$row)->getAlignment()->setWrapText(true);

        $worksheet->setCellValue('B'.$row, '=SUM(B13:B'.$row.')');
        $worksheet->setCellValue('C'.$row, '=SUM(C13:C'.$row.')');
        $worksheet->setCellValue('D'.$row, '=SUM(D13:D'.$row.')');
        $worksheet->setCellValue('E'.$row, '=SUM(E13:E'.$row.')');
        $worksheet->setCellValue('F'.$row, '=SUM(F13:F'.$row.')');
        $worksheet->setCellValue('G'.$row, '=SUM(G13:G'.$row.')');
        $worksheet->setCellValue('H'.$row, '=SUM(H13:H'.$row.')');
        $worksheet->setCellValue('I'.$row, '=SUM(I13:I'.$row.')');
        $worksheet->setCellValue('J'.$row, '=SUM(J13:J'.$row.')');
        $worksheet->setCellValue('K'.$row, '=SUM(K13:K'.$row.')');
        $worksheet->setCellValue('L'.$row, '=SUM(L13:L'.$row.')');
        $worksheet->setCellValue('M'.$row, '=SUM(M13:M'.$row.')');
        $worksheet->setCellValue('N'.$row, '=SUM(N13:N'.$row.')');
        $worksheet->setCellValue('O'.$row, '=SUM(O13:O'.$row.')');
        $worksheet->setCellValue('P'.$row, '=SUM(P13:P'.$row.')');
        $worksheet->getStyle('A'.$row.':P'.$row)->getFont()->setBold(true);
        $worksheet->getStyle('B13:P'.$row)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        
        $worksheet->mergeCells('A'.($row+2).':B'.($row+2));
        $worksheet->setCellValue('A'.($row+2), 'Prepared by:');
        $worksheet->getStyle('A'.($row+2))->applyFromArray($verticalLeft);

        $worksheet->mergeCells('I'.($row+4).':J'.($row+4));
        $worksheet->setCellValue('I'.($row+4), 'Noted by:');
        $worksheet->getStyle('I'.($row+4))->applyFromArray($verticalLeft);

        $worksheet->mergeCells('A'.($row+3).':D'.($row+3));
        $worksheet->setCellValue('A'.($row+3), 'MARY JANE P. LAMPACAN');
        $worksheet->getStyle('A'.($row+3))->applyFromArray($centerAlign);
        $worksheet->getStyle('A'.($row+3))->getFont()->setBold(true);

        $worksheet->mergeCells('I'.($row+5).':K'.($row+5));
        $worksheet->setCellValue('I'.($row+5), 'IMELDA I. MACANES');
        $worksheet->getStyle('I'.($row+5))->applyFromArray($centerAlign);
        $worksheet->getStyle('I'.($row+5))->getFont()->setBold(true);

        $worksheet->mergeCells('A'.($row+4).':D'.($row+4));
        $worksheet->setCellValue('A'.($row+4), 'Local Revenue Collection Officer IV');
        $worksheet->getStyle('A'.($row+4))->applyFromArray($centerAlign);

        $worksheet->mergeCells('I'.($row+6).':K'.($row+6));
        $worksheet->setCellValue('I'.($row+6), 'Provincial Treasurer');
        $worksheet->getStyle('I'.($row+6))->applyFromArray($centerAlign);

        //Report D
        $worksheet = $spreadsheet->getSheetByName('D');
        $row = 12;
        $initialMunicipality = '';

        $worksheet->setCellValue('A8', 'DELIVERY RECEIPTS ISSUED FOR THE PERIOD '.$startMonth.', '.$currentYear);
        foreach($deliveryReceiptsData as $rec) {
            if ($rec->municipality != $initialMunicipality) {
                $worksheet->setCellValue('A'.$row, $rec->municipality);
                $initialMunicipality = $rec->municipality;
            }
            
            if ($rec->trade_name_permittees != null && $rec->permittee != null) {
                $worksheet->setCellValue('B'.$row, $rec->trade_name_permittees.' by: '.$rec->permittee);
            } else if ($rec->trade_name_permittees != null && $rec->permittee == null) {
                $worksheet->setCellValue('B'.$row, $rec->trade_name_permittees);
            } else if ($rec->trade_name_permittees == null && $rec->permittee != null) {
                $worksheet->setCellValue('B'.$row, $rec->permittee);
            }

            if ($rec->client_type_id == 7) {
                $worksheet->setCellValue('C'.$row, $rec->booklets);
                $worksheet->setCellValue('E'.$row, str_replace(',', '', $rec->total_amount));
            } else if ($rec->client_type_id == 6) {
                $worksheet->setCellValue('D'.$row, $rec->booklets);
                $worksheet->setCellValue('F'.$row, str_replace(',', '', $rec->total_amount));
            }
            $worksheet->setCellValue('G'.$row, '=SUM(E'.$row.':F'.$row.')');
            $row++;
        }
        
        $worksheet->setCellValue('A'.($row+1), 'SUB-TOTAL');

        $worksheet->setCellValue('A'.($row+2), 'COST OF Delivery Receipts');
        $worksheet->getStyle('A'.($row+2))->getAlignment()->setWrapText(true);
        $worksheet->setCellValue('A'.($row+3), 'TOTAL');
        
        $worksheet->mergeCells('A'.($row+5).':B'.($row+5));
        $worksheet->setCellValue('A'.($row+5), 'Prepared by:');
        $worksheet->getStyle('A'.($row+5))->applyFromArray($verticalLeft);
        
        $worksheet->mergeCells('A'.($row+6).':B'.($row+6));
        $worksheet->setCellValue('A'.($row+6), 'MARY JANE P. LAMPACAN');
        $worksheet->getStyle('A'.($row+6))->applyFromArray($centerAlign);
        $worksheet->getStyle('A'.($row+6))->getFont()->setBold(true);

        $worksheet->mergeCells('A'.($row+7).':B'.($row+7));
        $worksheet->setCellValue('A'.($row+7), 'Local Revenue Collection Officer IV');
        $worksheet->getStyle('A'.($row+7))->applyFromArray($centerAlign);

        $worksheet->setCellValue('C'.($row+1), '=SUM(C12:C'.($row+2).')');
        $worksheet->setCellValue('D'.($row+1), '=SUM(D12:D'.($row+2).')');
        $worksheet->setCellValue('E'.($row+1), '=SUM(E12:E'.($row+2).')');
        $worksheet->setCellValue('F'.($row+1), '=SUM(F12:F'.($row+2).')');
        $worksheet->setCellValue('G'.($row+1), '=SUM(G12:G'.$row.')');

        $worksheet->setCellValue('C'.($row+3), '=SUM(C12:C'.$row.')');
        $worksheet->setCellValue('D'.($row+3), '=SUM(D12:D'.$row.')');
        $worksheet->setCellValue('E'.($row+3), '=SUM(E12:E'.$row.')');
        $worksheet->setCellValue('F'.($row+3), '=SUM(F12:F'.$row.')');
        $worksheet->setCellValue('G'.($row+3), '=SUM(G12:G'.$row.')');

        $worksheet->getStyle("A10:G".($row+3))->applyFromArray($borderedStyleArray);
        $worksheet->getStyle('E10:G'.($row+3))
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save(public_path('storage/ReportsTemplate/SandAndGravelMonthlyReport.xlsx'));
        return response()->download(public_path('storage/ReportsTemplate/SandAndGravelMonthlyReport.xlsx'))->DeleteFileAfterSend(true);
    }
}
