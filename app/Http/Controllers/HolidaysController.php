<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Holidays;
use App\Models\LandTaxInfo;

class HolidaysController extends Controller
{
    public function holidaysDataInsert (Request $request)
    {
        $request->validate ([
            'dateOfHoliday' => 'required'
        ]);

        $check = DB::table('Holidays')->select('*')->where('id', $request->dateID)->first();
        if($check) {
            $holidays = Holidays::find($check->id);
            $holidays->date_of_holiday = date('Y-m-d', strtotime($request->dateOfHoliday));
            $holidays->holiday_name = $request->nameOfHoliday;
            $holidays->save();
            $message = 'Successfully Updated';
        } else {
            $holidays = new Holidays;
            $holidays->date_of_holiday = date('Y-m-d', strtotime($request->dateOfHoliday));
            $holidays->holiday_name = $request->nameOfHoliday;
            $holidays->save();
            $message = 'Successfully Saved';
        }
        return back()->withInput()->with('Message', $message);
    }

    public function holidaysDataDelete (Request $request)
    {
        $customerType = new Holidays();
        $deletedData = $customerType::where('id', $request->dateID)->forceDelete();
        return back()->with('Message', 'Successfully Deleted');
    }

    function adjustReportDate(Request $request) {
        $geftAffectedDate = LandTaxInfo::select('report_date')->where('report_date', date('Y-m-d', strtotime($request->affectedDate)))->update(['report_date' => date('Y-m-d', strtotime($request->workingDate)) ]);
    }
}

