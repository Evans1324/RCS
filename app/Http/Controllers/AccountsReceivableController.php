<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsReceivableController extends Controller
{
    public function getAccountsReceivableData(Request $request) {
        $length=$request->input('length');
        $search=$request->input('search')['value'];
        $order=$request->input('order');
        $start=$request->input('start');
        $draw=$request->input('draw');
        $columns=$request->input('columns');

        $query = DB::table('land_tax_infos')
        ->select('land_tax_infos.id AS main_id', 'rentals.*', 'serials.*', 'access_p_c_s.*', 'access_p_c_s.id AS user_name', 'serial_s_g_s.*', 'municipalities.municipality AS mun_name', 'barangays.barangay_name AS bar_name', 'customer_types.*', 'customer_types.description_type AS client_types', 'land_tax_infos.*', 'land_tax_infos.status', 'land_tax_infos.created_at AS order')
        ->where('land_tax_infos.role', 2)
        ->leftJoin('serials', 'land_tax_infos.series_id', 'serials.id')
        ->leftJoin('access_p_c_s', 'land_tax_infos.user_ip', 'access_p_c_s.id')
        ->leftJoin('municipalities', 'land_tax_infos.municipality_id', 'municipalities.id')
        ->leftJoin('barangays', 'land_tax_infos.barangay_id', 'barangays.id')
        ->leftJoin('customer_types', 'land_tax_infos.client_type_id', 'customer_types.id')
        ->leftJoin('serial_s_g_s', 'land_tax_infos.dr_id', 'serial_s_g_s.id')
        ->leftJoin('rentals', 'land_tax_infos.lot_rental_id', 'rentals.id');

        if($search!=null){
            $query=$query
            ->where([['land_tax_infos.deleted_at', null],['pc_name','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['assigned_ip','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['receipt_type','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['start_serial','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['serial_number','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['owner','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['transact_type','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['certificate','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['municipalities.municipality','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['barangays.barangay_name','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['last_name','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['first_name','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['middle_initial','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['business_name','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['customer_types.description_type','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['sex','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['transact_type','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['bank_name','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['number','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['transact_date','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['bank_remarks','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['receipt_remarks','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['owner','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['spouses','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['company','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['client_type_radio','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['report_date','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.status','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['municipality_id','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['barangay_id','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['series_id','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['receipt_type','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['trade_name_permittees','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['permittee','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['trade_name_permit_fees','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['proprietor','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['bidders_business_name','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['owner_representative','like','%'.$search.'%']])
            ->orWhere([['land_tax_infos.deleted_at', null],['land_tax_infos.created_at','like','%'.$search.'%']]);

        } else {
            $query=$query->where('land_tax_infos.deleted_at', null);
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
            ->orderBy('land_tax_infos.created_at','desc');
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
