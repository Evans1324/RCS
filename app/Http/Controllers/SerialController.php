<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serial;
use App\Models\LandTaxInfo;
use Illuminate\Support\Facades\DB;

class SerialController extends Controller
{
    public function insertSerialData(Request $request) {

        $serialData = new Serial;
        $enteredSeries = DB::table('serials')->select('start_serial', 'end_serial')->where('status', 'Active')->get();
        
        if (count($enteredSeries) == 0) {
            $startSerialAssigned = $request->startOfSerial;
            $endSerialAssigned = $request->endOfSerial;
        } else {
            foreach ($enteredSeries as $series) {
                // dump($request->startOfSerial .' - '. $series->start_serial .' | '. $series->end_serial .' - '. $request->endOfSerial);
                if ($request->startOfSerial >= $series->start_serial && $series->end_serial <= $request->endOfSerial) {
                    $startSerialAssigned = $request->startOfSerial;
                    $endSerialAssigned = $request->endOfSerial;
                } else if ($request->endOfSerial >= $series->start_serial && $request->startOfSerial <= $series->end_serial) {
                    $message = 'Entered series is within an existing series';
                    return back()->withInput()->with('Message', $message);
                } else if ($request->startOfSerial == $series->start_serial || $series->end_serial == $request->endOfSerial) {
                    $message = 'Entered duplicate value';
                    return back()->withInput()->with('Message', $message);
                } else {
                    $startSerialAssigned = $request->startOfSerial;
                    $endSerialAssigned = $request->endOfSerial;
                }
            }
        }
        
        $check = DB::table('serials')->select('*')->where('id', $request->serialID)->first();
        if($check) {
            $series = Serial::find($check->id);
            $series->start_serial = $startSerialAssigned;
            $series->end_serial = $endSerialAssigned;
            $series->form = $request->serialForm;
            $series->assigned_office = $request->assignedOffice;
            $series->unit = $request->serialUnit;
            $series->fund_id = $request->serialFund;
            $series->mun_id = $request->serialMunicipality;
            $series->acc_officer_id = $request->accountableOfficer;
            $series->save();
            $message = 'Sucessfully Updated';
        } else {
            $duplicate = DB::table('serials')->select('*')->where('start_serial', $startSerialAssigned)->first();
            if ($duplicate) {
                $message = 'Series already exists';
            } else {
                $series = new Serial;
                $series->start_serial = $startSerialAssigned;
                $series->end_serial = $endSerialAssigned;
                $series->form = $request->serialForm;
                $series->assigned_office = $request->assignedOffice;
                $series->unit = $request->serialUnit;
                $series->fund_id = $request->serialFund;
                $series->mun_id = $request->serialMunicipality;
                $series->acc_officer_id = $request->accountableOfficer;
                $series->save();
                $message = 'Sucessfully Added';
            }
        }
        return back()->withInput()->with('Message', $message);
    }

    public function deleteSerialData(Request $request) 
    {
        $serialData = new Serial;
        $deletedData = $serialData::where('id',$request->serialID)->forceDelete();
        return back()->with('Message', 'Successfully Deleted');
    }

    public function getCurrentSerial(Request $request) {
        if ($request->id == 0) {
            return 'No series assigned';
        } else {
            $ip = request()->ip();
            if ($request->taxColReceiptType == 'Land Tax Collection') {
                $serials = DB::table('access_p_c_s')
                ->select('serials.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
                ->where([['assigned_ip', $ip], ['process_type', 'Land Tax Collection'], ['serials.id', $request->id]])
                ->join('serials', 'access_p_c_s.serial_id', 'serials.id')
                ->join('posts', 'serials.fund_id', 'posts.id')
                ->orderBy('serial_id', 'desc')
                ->limit(1)
                ->first();
            } else {
                $serials = DB::table('serials')
                ->select('serials.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
                ->where([['unit', 'Pad'], ['serials.id', $request->id], ['serials.status', 'Active']])
                ->join('posts', 'serials.fund_id', 'posts.id')
                ->orderBy('serials.id', 'desc')
                ->limit(50)
                ->first();
            }
            
            $currentSerial = LandTaxInfo::where([['serial_number', '>=', $serials->start_serial], ['serial_number', '<=', $serials->end_serial]])
            ->orderBy('serial_number', 'desc')
            ->limit(1)
            ->first();
            
            if ($currentSerial != null) {
                if ($currentSerial->serial_number == $serials->end_serial) {
                    $currentSerial = 'Serial Error';
                } else {
                    $currentSerial = $currentSerial->serial_number+1;
                }
            } else {
                $currentSerial = $serials->start_serial;
            }
            return $currentSerial;
        }
    }

    public function getCurrentSerialCash(Request $request) {
        $ip = request()->ip();
        if ($request->taxColReceiptType == 'Land Tax Collection') {
            $serials = DB::table('access_p_c_s')
            ->select('serials.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
            ->where([['assigned_ip', $ip], ['process_type', 'Land Tax Collection'], ['serials.id', $request->id]])
            ->join('serials', 'access_p_c_s.serial_id', 'serials.id')
            ->join('posts', 'serials.fund_id', 'posts.id')->orderBy('serial_id', 'desc')->limit(1)->first();
        } else {
            $serials = DB::table('serials')
            ->select('serials.*', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
            ->where([['unit', 'Pad'], ['serials.id', $request->id], ['assigned_office', 'Cash']])
            ->join('posts', 'serials.fund_id', 'posts.id')->orderBy('serials.id', 'desc')->limit(50)->first();
        }
        
        $currentSerial = LandTaxInfo::where([['serial_number', '>=', $serials->start_serial], ['serial_number', '<=', $serials->end_serial]])
        ->orderBy('serial_number', 'desc')
        ->limit(1)
        ->first();
        
        if ($currentSerial != null) {
            if ($currentSerial->serial_number == $serials->end_serial) {
                $currentSerial = 'Serial Error';
            } else {
                $currentSerial = $currentSerial->serial_number+1;
            }
        } else {
            $currentSerial = $serials->start_serial;
        }
        
        return $currentSerial;
    }

    public function updateSerialStatus(Request $request) {
        $series = Serial::find($request->id);
        if ($request->seriesUpdate == 'Completed') {
            $series->status = 'Completed';
            
        }
        $series->save();
        

        $message = 'Serial Status Updated';
        return $message;
    }
    
}
