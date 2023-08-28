<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReportOfficers;
use App\Models\Officers;
use App\Models\Positions;
use App\Models\Department;
use App\Models\CertOfficers;

class ReportOfficersController extends Controller
{
    public function officerDataInsert (Request $request) 
    {
        $request->validate ([
            'officerName' => 'required',
            'officerPosition' => 'required'
        ]);

        $posCheck = Positions::where('id', $request->officerPositionID)->first();
        if(is_null($posCheck)) {
            $pos = new Positions;
            $pos->position=$request->officerPosition;
            $pos->save();
            $message = 'Data Saved';
        } else {
            $pos = Positions::find($posCheck->id);
            $pos->position=$request->officerPosition;
            $pos->save();
            $message = "Data Updated";
        }
        
        $officerCheck = Officers::where('id', $request->officerNameID)->first();
        if(is_null($officerCheck)) {
            $officer = new Officers;
            $officer->name=$request->officerName;
            $officer->save();
            $message = 'Data Saved';
        } else {
            $officer = Officers::find($officerCheck->id);
            $officer->name=$request->officerName;
            $officer->save();
            $message = "Data Updated";
        }
        
        $deptCheck = Department::where('id', $request->officerDeptID)->first();
        if(is_null($deptCheck)) {
            $dept = new Department;
            $dept->department=$request->officerDepartment;
            $dept->save();
            $message = 'Data Saved';
        } else {
            $dept = Department::find($deptCheck->id);
            $dept->department=$request->officerDepartment;
            $dept->save();
            $message = "Data Updated";
        }
        
        $certCheck = CertOfficers::where([['officer_id', $officer->id], ['position_id', $pos->id], ['department_id', $dept->id]])->first();
        if(is_null($certCheck)) {
            $certOff = new CertOfficers;
            $certOff->officer_id=$officer->id; 
            $certOff->position_id=$pos->id;
            $certOff->department_id=$dept->id;
            $certOff->save();
            $message = 'Data Saved';
        } else {
            $certOff = CertOfficers::find($certCheck->id);
            $certOff->officer_id=$officer->id; 
            $certOff->position_id=$pos->id;
            $certOff->department_id=$dept->id;
            $certOff->save();
            $message = "Data Updated";
        }
        
        return back()->withInput()->with('Message', $message);
    }

    public function officerDataDelete (Request $request)
    {
        $officerData = new CertOfficers;
        $deletedData = $officerData::find($request->officerID);
        // $deletedData->deleted_at=now();
        $deletedData->delete();
        // $deletedData->save();
        return back()->with('Message', 'Successfully Deleted');
    }
}
