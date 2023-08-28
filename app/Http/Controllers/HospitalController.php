<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hospital;

class HospitalController extends Controller
{
    public function index()
    {
        return view('district_hospital');
    }

    public function hospital(Request $request)
    {
        $request->validate ([
            'inputHospital' => 'required|string|min:5|max:35'
        ]);
        
        
        // $request->acc_category_settings;
        $hospital = new Hospital;
        $duplicate = DB::table('hospitals')->where('hospital_name', $request->inputHospital)->count();
        // dd($duplicate);
        if ($duplicate > 0) {
            $message = 'Category entered already exists';
        } else {
            $hospital::upsert(
                ['id'=>$request->hospitalID, 'hospital_name'=>$request->inputHospital, 'created_at'=>now(), 'updated_at'=>now()],
                ['id'], ['hospital_name']
            );
            $message = 'Succesfully added new category';
        }
        return back()->withInput()->with('Message', $message);
    }

    public function getHospitalDeletedData(Request $request) {
        $hospital = new Hospital();
        $deletedData = $hospital::where('id',$request->hospitalID)->update([
            'deleted_at' => now()
        ]);                                                         
        // $deletedData->delete();
        // dd($request);
        return back()->with('Message', 'Successfully Deleted');
    }
}
