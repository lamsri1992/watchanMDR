<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class erController extends Controller
{
    public function ems()
    {
        $list = DB::connection('mysql')->table('ems_list')
                ->get();
        return view('er.ems', ['list'=>$list]);
    }

    public function emsCreate()
    {
        $lv = DB::connection('mysql')->table('ems_level_list')->get();
        $tp = DB::connection('mysql')->table('ems_type_list')->get();
        $tl = DB::connection('mysql')->table('ems_transpot_list')->get();
        $pl = DB::connection('mysql')->table('ems_perm_list')->get();
        $ds = DB::connection('mysql')->table('ems_disposition_list')->get();
        return view('er.ems_create', ['lv'=>$lv,'tp'=>$tp,'tl'=>$tl,'pl'=>$pl,'ds'=>$ds]);
    }

    function record_ems(Request $request)
    {
        $create = date("Y-m-d H:i:s");
        DB::connection('mysql')->table('ems_list')->insert(
            [
                'ems_hn' => $request->get('hn'),
                'ems_cid' => $request->get('cid'),
                'ems_pname' => $request->get('pname'),
                'ems_date' => $request->get('date'),
                'ems_time_in' => $request->get('time_in'),
                'ems_time_find' => $request->get('time_find'),
                'ems_no' => $request->get('no'),
                'ems_symptom' => $request->get('symptom'),
                'ems_level' => $request->get('level'),
                'ems_type' => $request->get('type'),
                'ems_transpot' => $request->get('transpot'),
                'ems_perm' => $request->get('perm'),
                'ems_primcare' => $request->get('primcare'),
                'ems_diag' => $request->get('diag'),
                'ems_disposition' => $request->get('disposition'),
                'ems_kpi' => $request->get('kpi'),
                'ems_create' => Auth::user()->id,
                'create_at' => $create
            ]
        );
    }

    function update_ems(Request $request)
    {
        $id = $request->get('ems_id');
        $update = date("Y-m-d H:i:s");
        DB::connection('mysql')->table('ems_list')->where('ems_id', $id)->update(
            [
                'ems_date' => $request->get('date'),
                'ems_time_in' => $request->get('time_in'),
                'ems_time_find' => $request->get('time_find'),
                'ems_no' => $request->get('no'),
                'ems_symptom' => $request->get('symptom'),
                'ems_level' => $request->get('level'),
                'ems_type' => $request->get('type'),
                'ems_transpot' => $request->get('transpot'),
                'ems_perm' => $request->get('perm'),
                'ems_primcare' => $request->get('primcare'),
                'ems_diag' => $request->get('diag'),
                'ems_disposition' => $request->get('disposition'),
                'ems_kpi' => $request->get('kpi'),
                'ems_create' => Auth::user()->id,
                'update_at' => $update
            ]
        );
    }

    public function show_ems($id)
    {
        $parm_id = base64_decode($id);
        $data = DB::connection('mysql')->table('ems_list')
                ->where('ems_id', $parm_id)
                ->first();

        $lv = DB::connection('mysql')->table('ems_level_list')->get();
        $tp = DB::connection('mysql')->table('ems_type_list')->get();
        $tl = DB::connection('mysql')->table('ems_transpot_list')->get();
        $pl = DB::connection('mysql')->table('ems_perm_list')->get();
        $ds = DB::connection('mysql')->table('ems_disposition_list')->get();

        return view('er.ems_show', ['data'=>$data,'lv'=>$lv,'tp'=>$tp,'tl'=>$tl,'pl'=>$pl,'ds'=>$ds]);
    }

    public function refer()
    {
        // $list = DB::connection('mysql')->table('ems_list')
        //         ->get();
        // return view('er.ems', ['list'=>$list]);
        return view('er.refer');
    }

    public function refer_list(Request $request)
    {
         $emplist = DB::connection('mysql')->table('employee')
                    ->get();
        return view('er.refer_list', ['year'=>$request->get('year'),'emplist'=>$emplist]);
    }

}
