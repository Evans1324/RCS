<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SerialSG;
use App\Models\LandTaxInfo;
use Illuminate\Support\Facades\DB;

class SerialSGController extends Controller
{
    public function insertSerialSGData(Request $request)
    {
        $check = SerialSG::where('start_serial_sg', $request->startSerialSG)->first();
        if ($check) {
            $deliveryReceipts = SerialSG::find($check->id);
            $deliveryReceipts->start_serial_sg = $request->startSerialSG;
            $deliveryReceipts->booklets = $request->bookletAmount;
            $deliveryReceipts->end_serial_sg = $request->endSerialSG;
            $deliveryReceipts->serial_sg_type = $request->sgType;
            $deliveryReceipts->save();
            $message = 'Sucessfully Added';
        } else {
            $deliveryReceipts = new SerialSG;
            $deliveryReceipts->start_serial_sg = $request->startSerialSG;
            $deliveryReceipts->booklets = $request->bookletAmount;
            $deliveryReceipts->end_serial_sg = $request->endSerialSG;
            $deliveryReceipts->serial_sg_type = $request->sgType;
            $deliveryReceipts->save();
            $message = 'Sucessfully Added';
        }
        return back()->withInput()->with('Message', $message);
    }

    public function deleteSerialSGData(Request $request) 
    {
        $serialSG = new SerialSG;
        $deletedData = $serialSG::where('id',$request->serialSGID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }

    public function getCurrentDeliveryReceipts()
    {
        $sgQuery = SerialSG::select('start_serial_sg', 'end_serial_sg', 'serial_sg_type', 'status')
        ->where('status', 'Active')
        ->orderBy('id', 'asc')
        ->first();
        $currentDR = LandTaxInfo::where([['dr_number', '>=', $sgQuery->start_serial_sg], ['dr_number', '<=', $sgQuery->end_serial_sg]])
        ->orderBy('serial_number', 'desc')
        ->limit(1)
        ->first();
        return $currentDR;
    }

    public function sgDeliveryReceipts(Request $request)
    {
        $sgQuery = SerialSG::select('start_serial_sg AS value', 'end_serial_sg', 'serial_sg_type', 'status')
        ->where([['status', 'Active'], ['start_serial_sg', 'like', '%'.$request->term.'%']])
        ->orderBy('id', 'asc')
        ->get();
        return $sgQuery;
    }

    public function getCurrentSeriesSG(Request $request) 
    {
        $serialSG = DB::table('serial_s_g_s')
        ->select('*', DB::raw('CONCAT(start_serial_sg," - ", end_serial_sg) AS delReceipt'))
        ->where([['status', 'Active'], ['serial_s_g_s.id', $request->id]])
        ->first();
        // dd($serialSG);
        $currentOnDeckSG = LandTaxInfo::where([['dr_number', '>=', $serialSG->start_serial_sg], ['dr_number', '<=', $serialSG->end_serial_sg]])
        ->orderBy('dr_number', 'desc')
        ->limit(1)
        ->first();
        // dd($serialSG->start_serial_sg);
        if ($currentOnDeckSG != null) {
            if ($currentOnDeckSG->dr_number == $serialSG->end_serial_sg) {
                $currentOnDeckSG = 'Serial Error';
            } else {
                $currentOnDeckSG = $currentOnDeckSG->dr_number+50;
            }
        } else {
            $currentOnDeckSG = $serialSG->start_serial_sg;
        }
        
        return $currentOnDeckSG;
    }

}
