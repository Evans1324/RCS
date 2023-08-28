<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Form56;

class Form56Controller extends Controller
{
    public function index()
    {
        return view('form_56');
    }

    //To do: query data on PageController 

    public function updateForm56Data(Request $request) {
        
        $request->validate([
            'inputEffectivityYear' => 'required',
            'inputTaxPercentage' => 'required',
            'inputAidFull' => 'required',
            'inputPaidFull' => 'required',
            'inputPenaltyPerMonth' => 'required',
        ]);

        $update = new Form56;
        $record = DB::table('form56s')->where('effectivity_year', $request->inputEffectivityYear)->first();
        if($record == null) {
            $id = null;
        }else {
            $id = $record->id;
        }

        $test = $update::upsert(
            ['id'=>$id, 'effectivity_year'=>$request->inputEffectivityYear,'tax_precentage'=>$request->inputTaxPercentage,'aid_in_full'=>$request->inputAidFull,'paid_in_full'=>$request->inputPaidFull,'penalty_per_month'=>$request->inputPenaltyPerMonth,'created_at'=>now(),'updated_at'=>now()],
            ['id'],['effectivity_year', 'tax_precentage', 'aid_in_full', 'paid_in_full', 'penalty_per_month']
        );
        
        $message = 'Form56 Updated Successfully';
        return back()->withInput()->with('Message', $message);
    }
}
