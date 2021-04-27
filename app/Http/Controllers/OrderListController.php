<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OrderListController extends Controller
{
    function index()
    {
        $data = DB::connection('mysql')->table('tracking_order')
                ->leftJoin('track_status', 'track_status.t_stat_id', '=', 'tracking_order.track_status')
                ->leftJoin('tracking_point', 'tracking_point.point_id', '=', 'tracking_order.track_point')
                ->get();
        $track_all = DB::connection('mysql')->table('tracking_order')
                ->count();
        $track_complete = DB::connection('mysql')->table('tracking_order')
                ->where('track_status', 2)
                ->count();
        $list_all = DB::connection('mysql')->table('tracking_list')
                ->count();
        $list_complete = DB::connection('mysql')->table('tracking_list')
                ->where('list_status', 2)
                ->count();
        $doctor = DB::connection('mysql')->select(DB::raw("SELECT
                (SELECT COUNT(*) FROM tracking_list WHERE list_status = '1' AND list_doctor = 'ประจินต์ เหล่าเที่ยง') AS pj,
                (SELECT COUNT(*) FROM tracking_list WHERE list_status = '1' AND list_doctor = 'นัฐยา กิติกูล') AS nt,
                (SELECT COUNT(*) FROM tracking_list WHERE list_status = '1' AND list_doctor = 'ชาติชาย เชวงชุติรัตน์') AS cc,
                (SELECT COUNT(*) FROM tracking_list WHERE list_status = '1' AND list_doctor = '' ) AS ex"));
        return view('tracking.index', ['data'=>$data,'track_all'=>$track_all,'track_complete'=>$track_complete,'list_all'=>$list_all,'list_complete'=>$list_complete,'doctor'=>$doctor]);
    }

    function show($id)
    {
        $parm_id = base64_decode($id);
        $order = DB::connection('mysql')->table('tracking_order')
                ->leftJoin('track_status', 'track_status.t_stat_id', '=', 'tracking_order.track_status')
                ->where('tracking_order.track_id', $parm_id)
                ->first();
        $list = DB::connection('mysql')->table('tracking_list')
                ->leftJoin('tracking_order', 'tracking_order.track_id', '=', 'tracking_list.track_id')
                ->leftJoin('track_status', 'track_status.t_stat_id', '=', 'tracking_list.list_status')
                ->where('tracking_list.track_id', $parm_id)
                ->get();
        $count =  DB::connection('mysql')->table('tracking_list')
                ->where('tracking_list.track_id', $parm_id)
                ->where('tracking_list.list_status', 1)
                ->count();
        return view('tracking.show', ['order'=>$order , 'list'=>$list, 'count'=>$count]);
    }

    function createOrder(Request $request)
    {
        $data = $request->get('formData');
        $case = count($data);
        // Create Order
        $OrderID = DB::connection('mysql')->table('tracking_order')->insertGetId(['track_case' => $case]);
        $text = "";
        foreach($data as $array){
            DB::connection('mysql')->table('tracking_list')->insert(
                [
                    'list_vn' => $array['visit_vn'],
                    'list_hn' => $array['visit_hn'],
                    'list_patient' => $array['patient_firstname']." ".$array['patient_lastname'],
                    'list_doctor' => $array['employee_firstname']." ".$array['employee_lastname'],
                    'list_discharge' => $array['visit_ipd_discharge_date_time'],
                    'track_id' => $OrderID
                ]
            );
            $text .= "ผู้ป่วย: ".$array['patient_firstname']." ".$array['patient_lastname']."\nหมายเลข HN: ".$array['visit_hn']."\nหมายเลข VN: ".$array['visit_vn']."\nวันที่ Discharge: ".$array['visit_ipd_discharge_date_time']."\n\n";
        }
        // send line message
            $Token = "XsIxstDVzAVfiIGwm9awArboU9B2nBTZQXLJfA0YDWn";
            $message = "มีรายการตามชาร์ทใหม่ ".$case." รายการ\n".$text;
        line_notify($Token, $message);
    }

    function updateTrack(Request $request)
    {
        $id = $request->get('formID');
        $point = $request->get('formData') + 1;
        $update = date("Y-m-d H:i:s");
        DB::connection('mysql')->table('tracking_order')->where('track_id', $id)->update(
            [
                'track_point' => $point,
                'update_at' => $update,
            ]
        );
        if($point <= 2){
            DB::connection('mysql')->table('tracking_list')->where('track_id', $id)->update(
                [
                    'list_start' => $update,
                ]
            );
        }
        if($point == 2){
            $place = 'ตรวจสอบเวชระเบียนเสร็จสิ้น';
        }
        if($point == 3){
            $place = 'เก็บคืนเวชระเบียนเสร็จสิ้น';
        }
        $notify_id = str_pad($id, 4, '0', STR_PAD_LEFT);
        // send line message
        $Token = "XsIxstDVzAVfiIGwm9awArboU9B2nBTZQXLJfA0YDWn";
        $message = "OrderList :: รหัส WCC23736".$notify_id."\n".$place."ดำเนินการเสร็จสิ้น";
        line_notify($Token, $message);
    }

    function finalTrack(Request $request)
    {
        $id = $request->get('formID');
        $point = $request->get('formData') + 1;
        $update = date("Y-m-d H:i:s");
        DB::connection('mysql')->table('tracking_order')->where('track_id', $id)->update(
            [
                'track_point' => $point,
                'update_at' => $update,
                'track_status' => 2,
            ]
        );
    }

    function keepChart($id)
    {
        $parm_id = base64_decode($id);
        $update = date("Y-m-d H:i:s");
        DB::connection('mysql')->table('tracking_list')->where('list_id', $parm_id)->update(
            [
                'list_status' => 2,
                'list_end' => $update,
            ]
        );
        return back()->with("keep","เก็บชาร์ทแล้ว");
    }
}
