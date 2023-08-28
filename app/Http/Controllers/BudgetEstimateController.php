<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BudgetEstimate;

class BudgetEstimateController extends Controller
{
    public function budgetEstimateField(Request $request) {
        for ($i=0;$i<count($request->accTitlesBudgetID);$i++) {
            $flight = BudgetEstimate::updateOrCreate(
                ['acc_titles_id' => $request->accTitlesBudgetID[$i], 'year' => $request->budgetYearPicker],
                ['amount' => str_replace(',', '', $request->accTitlesBudgetValue[$i])]
            );
        }

        for ($i=0;$i<count($request->subTitlesBudgetID);$i++) {
            $flight = BudgetEstimate::updateOrCreate(
                ['sub_titles_id' => $request->subTitlesBudgetID[$i], 'year' => $request->budgetYearPicker],
                ['amount' => str_replace(',', '', $request->subTitlesBudgetValue[$i])]
            );
        }

        for ($i=0;$i<count($request->subSubTitlesBudgetID);$i++) {
            $flight = BudgetEstimate::updateOrCreate(
                ['sub_subtitles_id' => $request->subSubTitlesBudgetID[$i], 'year' => $request->budgetYearPicker],
                ['amount' => str_replace(',', '', $request->subSubTitlesBudgetValue[$i])]
            );
        }
        return back();
    }

    public function yearlyBudget(Request $request) {
        $dataYear = BudgetEstimate::select('*')
        ->where('year', $request->year)
        ->get();
        return $dataYear;
    }
}
