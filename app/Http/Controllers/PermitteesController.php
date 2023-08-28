<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SandGravelPermittees;


class PermitteesController extends Controller
{
    public function saveNewPermitteesRevenueTax(Request $request) {
        $insertPermittees = new SandGravelPermittees;
        $insertInfo = $insertPermittees::create(
            ['type'=>$request->type, 'trade_name'=>$request->tradeName, 'permittee'=>$request->permittees, 'permitted_area_municipality'=>$request->mun, 'permitted_area_barangay'=>$request->bar]
        );

        $message = 'Data Saved Succesfuly';
        return back()->withInput()->with('Message', $message);
    }

    public function saveNewPermittees(Request $request) {
        $insertPermittees = new SandGravelPermittees;
        $insertInfo = $insertPermittees::upsert(
            ['id'=>$request->permitteesID, 'type'=>$request->permitteesType, 'trade_name'=>$request->permitteesTradeName, 'permittee'=>$request->permittees, 'permitted_area_municipality'=>$request->permitteesMunicipality, 'permitted_area_barangay'=>$request->permitteesBarangay],
            ['id'],
            ['type', 'trade_name', 'permittee', 'permitted_area_municipality', 'permitted_area_barangay']
        );

        $message = 'Data Saved Succesfuly. Redirectiong to Revenue Collection';
        return \Redirect::route('pages.land_tax_collection');
    }

    public function deletePermittees(Request $request) {
        $delPermittees = new SandGravelPermittees;
        $deletedData = $delPermittees::where('id',$request->permitteesID)->update([
            'deleted_at' => now()
        ]);
        return back()->with('Message', 'Successfully Deleted');
    }
}
