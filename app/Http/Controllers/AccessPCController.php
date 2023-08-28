<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessPC;
use App\Models\Serial;
use Illuminate\Support\Facades\DB;

class AccessPCController extends Controller
{
    public function insertPCData(Request $request) {
        $request->validate ([
            'pcName' => 'required',

        ]);

        $check = DB::table('access_p_c_s')->where('id', $request->accessID)->first();
        if ($check) {
            $accessPc = AccessPC::find($check->id);
            $accessPc->pc_name = $request->pcName;
            $accessPc->assigned_ip = $request->pcAssigned;
            $accessPc->process_type = $request->processType;
            $accessPc->process_form = $request->processForm;
            $accessPc->serial_id = $request->assignedReceipt;
            $accessPc->save();
            $message = 'Sucessfully Updated';
        } else {
            $accessPc = new AccessPC;
            $accessPc->pc_name = $request->pcName;
            $accessPc->assigned_ip = $request->pcAssigned;
            $accessPc->process_type = $request->processType;
            $accessPc->process_form = $request->processForm;
            $accessPc->serial_id = $request->assignedReceipt;
            $accessPc->save();
            $message = 'Sucessfully Added';
        }
        return back()->withInput()->with('Message', $message);
    }

    public function deletePCData(Request $request) 
    {
        $accessPC = new AccessPC;
        $deletedData = $accessPC::where('id',$request->accessID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }

    public function getFormData(Request $request) {
        if ($request->id == 'Land Tax Collection') {
            $displaySerial = Serial::select('serials.id', 'serials.status', 'access_p_c_s.process_type', 'access_p_c_s.assigned_status', 'posts.acc_category_settings', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
            ->whereRaw('unit = "Continuous" AND status = "Active"')
            ->orWhereRaw('assigned_status <> "assigned"')
            ->join('posts', 'serials.fund_id', 'posts.id')
            ->leftJoin('access_p_c_s', 'serials.id', 'access_p_c_s.serial_id')
            ->get();
        } else {
            $displaySerial = Serial::select('serials.*', 'access_p_c_s.process_type', 'posts.acc_category_settings', DB::raw('CONCAT(start_serial,"-", end_serial, " ", unit, " ", acc_category_settings) AS Serial'))
            // ->where('process_type', 'like', '%'.$request->id.'%')
            ->whereRaw('unit = "Pad" AND status = "Active"')
            ->join('posts', 'serials.fund_id', 'posts.id')
            ->leftJoin('access_p_c_s', 'serials.id', 'access_p_c_s.serial_id')
            ->get();
        }
        return $displaySerial;
    }
}
