<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contractors;

class ContractorsController extends Controller
{
    public function addNewContractors(Request $request) {
        $insertInfo = Contractors::updateOrCreate(
            ['business_name'=>$request->businessName, 'owner'=>$request->owner, 'address'=>$request->address]
        );
        
        $message = 'Data Saved Succesfuly';
        return back()->withInput()->with('Message', $message);
    }

    public function saveNewContractors(Request $request) {
        $check = DB::table('contractors')->select('*')->where('id', $request->contractorsID)->first();
        if($check) {
            $contractors = Contractors::find($check->id);
            $contractors->business_name = $request->businessName;
            $contractors->owner = $request->businessOwner;
            $contractors->position = $request->businessPosition;
            $contractors->address = $request->businessAddress;
            $contractors->contact_number = $request->businessNumber;
            $contractors->save();
            $message = 'Successfully Updated';
        } else {
            $contractors = new Contractors;
            $contractors->business_name = $request->businessName;
            $contractors->owner = $request->businessOwner;
            $contractors->position = $request->businessPosition;
            $contractors->address = $request->businessAddress;
            $contractors->contact_number = $request->businessNumber;
            $contractors->save();
            $message = 'Successfully Saved';
        }
        // return \Redirect::route('pages.land_tax_collection');
        return back()->withInput()->with('Message', $message);
    }

    public function deleteContractors(Request $request) {
        $delContractors = new Contractors;
        $deletedData = $delContractors::where('id',$request->contractorsID)->delete();
        return back()->with('Message', 'Successfully Deleted');
    }

    public function getContractorsData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = $displayContractors = DB::table('contractors')->select('*', 'id', 'business_name AS value', 'business_name AS label', 'owner', 'address');

        if($search!=null){
            $query=$query
            ->where(['business_name','like','%'.$search.'%'])
            ->orWhere(['owner','like','%'.$search.'%'])
            ->orWhere(['position','like','%'.$search.'%'])
            ->orWhere(['address','like','%'.$search.'%'])
            ->orWhere(['contact_number','like','%'.$search.'%']);

        }
        
        if(count($order)!=null){

            $column=$order[0]['column'];
            $dir=$order[0]['dir'];
            $column_name=$columns[intval($column)]['data'];
            $query=$query
            ->orderBy($column_name,$dir);
          }
          else{
            $query=$query
            ->orderBy('contractors.created_at','desc');
          }

        $count=count($query->get());
        $displayTaxData = $query->skip($start)->limit($length)->get();

        $data=[
            "draw"=>$draw,
            "recordsTotal"=> $count,
            "recordsFiltered"=> $count,
            "data"=>$displayTaxData
        ];
        return $data;
    }
}
