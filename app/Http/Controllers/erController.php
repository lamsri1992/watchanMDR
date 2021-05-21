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
        $list = DB::connection('mysql')->table('refer_list')
                ->get();
        return view('er.refer', ['list'=>$list]);
    }

    public function refer_list(Request $request)
    {
         $emplist = DB::connection('mysql')->table('employee')
                    ->get();
        return view('er.refer_list', ['year'=>$request->get('year'),'emplist'=>$emplist]);
    }

    function record_refer(Request $request)
    {
        $create = date("Y-m-d H:i:s");
        $arr_select = array();
        foreach($request->get('emp') as $list){
            $arr_select[] = $list;
        }
        $emplist = implode(",", $arr_select);
        DB::connection('mysql')->table('refer_list')->insert(
            [
                'refer_date' => $request->get('date'),
                'refer_employee' => $emplist,
                'refer_no' => $request->get('no'),
                'refer_hn' => $request->get('hn'),
                'refer_patient' => $request->get('pname'),
                'refer_diag_go' => $request->get('diag'),
                'refer_hcode' => $request->get('hcode'),
                'refer_hname' => $request->get('hname'),
                'refer_doctor' => $request->get('doctor'),
                'create_at' => $create
            ]
        );
    }

    public function show_refer($id)
    {
        $parm_id = base64_decode($id);
        $data = DB::connection('mysql')->table('refer_list')
                ->where('refer_id', $parm_id)
                ->first();
        $list_id = $data->refer_employee;
        $emplist = DB::table('employee')
                ->whereRaw('id in ('.$list_id.')')
                ->get();
        return view('er.refer_show', ['data'=>$data,'emplist'=>$emplist]);
    }

    function update_refer(Request $request)
    {
        $id = $request->get('id');
        DB::connection('mysql')->table('refer_list')->where('refer_id', $id)->update(
            [
                'refer_alcohol' => $request->get('alcohol'),
                'refer_diag_back' => $request->get('diag_back'),
                'refer_time_go' => $request->get('time_go'),
                'refer_time_back' => $request->get('time_back')
            ]
        );
        return back()->with("update","บันทึกข้อมูล REF23736".str_pad($id, 4, '0', STR_PAD_LEFT)." สำเร็จ");
    }

}
