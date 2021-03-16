<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use DB;

class DrugOrderController extends Controller
{

    function index()
    {
        $data = DB::connection('mysql')->table('order_drug')
                ->where('drug_status', '=' , NULL)
                ->get();
        return view('drug.index', ['data'=>$data]);
    }

    function show($id)
    {
        $parm_id = base64_decode($id);
        $list = DB::connection('mysql')->table('order_drug')
                ->where('drug_id', $parm_id)
                ->first();
        $note = DB::connection('mysql')->table('order_drug_comment')
                ->where('drug_id', $parm_id)
                ->get();
        return view('drug.show', ['list'=>$list ,'note'=>$note]);
    }

    function createOrder(Request $request)
    {
        $json = $request->get('formData');
        $path = public_path('MDR/'.$json['visit_vn'].'/Order');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
            DB::connection('mysql')->table('order_drug')->insert(
                [
                    'drug_hn' => $json['visit_hn'],
                    'drug_vn' => $json['visit_vn'],
                    'drug_patient' => $json['patient_firstname']." ".$json['patient_lastname'],
                    'drug_doctor' => $json['employee_firstname']." ".$json['employee_lastname'],
                    'drug_bed' => $json['visit_bed']
                ]
            );
        }
    }

    public function upload(Request $request)
    {
        // Upload Files
        $image  = $request->file('vn_file');
        $vn = $request->get('vn_id');
        $fileName = (date('YmdHis'))."_".$vn;
        $image->move(public_path('MDR/'.$vn.'/Order'), $fileName);
        // Get data detail -> send line message
        $data = DB::connection('mysql')->table('order_drug')
                ->where('order_drug.drug_vn', $vn)
                ->first();
        // send line message
        // $Token = "qhtvdJ3vVilU4pkcUlcimaoFCf3AIQa38EvZC9zdxQI";
        // PHAR
        $Token = "6UTdo1OJF6WRHLiTJxsN90vGz2eXewUHI7xZ3SSw1dR";
        $message = "มีรายการสั่งยาใหม่\nหมายเลข HN: ".$data->drug_hn."\nหมายเลข VN: ".$data->drug_vn."\nเตียง/ห้อง: ".$data->drug_bed."
                    \nวันที่สร้าง: ".$data->create_at."\nhttp://172.20.55.10:8000/drugOrder/".base64_encode($data->drug_id)."";
        line_notify($Token, $message);
        
        return back()->with("success","อัพโหลดรายการ VN: ".$vn." เรียบร้อยแล้ว");
    }

    public function delete(Request $request)
    {
        $files = $request->get('files_name');
        $vn = $request->get('files_vn');
        $delete = public_path('MDR/'.$vn.'/Order/'.$files);
        @unlink($delete);
    }

    function discharge($id)
    {
        $parm_id = base64_decode($id);
        $list = DB::connection('mysql')->table('order_drug')
                ->where('drug_id', $parm_id)
                ->first();
        DB::connection('mysql')->table('order_drug')->where('drug_id', $parm_id)->update(
            ['drug_status' => 'Discharge']
        );
        return back()->with("error","Discharge VN: ".$list->drug_vn." เรียบร้อยแล้ว");
    }

    function messageNote(Request $request)
    {
        DB::connection('mysql')->table('order_drug_comment')->insert(
            [
                'dm_note' => $request->note,
                'dm_comment' => $request->comment,
                'drug_id' => $request->drug_id,
            ]
        );
        return back()->with("send","ฝากข้อความเรียบร้อยแล้ว");
    }
}
