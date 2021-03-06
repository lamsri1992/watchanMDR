<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class foodOrderController extends Controller
{
    public function index()
    {
        $data = DB::connection('mysql')->table('order_food')
                // ->leftJoin('food_order', 'food_order.order_id', '=', 'order_food.food_id')
                ->where('food_status', '=' , NULL)
                ->get();
        return view('food.index', ['data'=>$data]);
    }

    function createOrder(Request $request)
    {
        $json = $request->get('formData');
        $create = date("Y-m-d H:i:s");
        // Check VN
        $data = DB::connection('mysql')->table('order_food')
                ->where('food_vn', $json['visit_vn'])
                ->first();
        if(isset($data)){
            echo "FOUND VN";
        }else{
            DB::connection('mysql')->table('order_food')->insert(
                [
                    'food_hn' => $json['visit_hn'],
                    'food_vn' => $json['visit_vn'],
                    'food_patient' => $json['patient_firstname']." ".$json['patient_lastname'],
                    'food_bed' => $json['visit_bed'],
                    'create_at' => $create
                ]
            );
        }
    }

    function show($id)
    {
        $parm_id = base64_decode($id);
        $list = DB::connection('mysql')->table('order_food')
                ->where('food_id', $parm_id)
                ->first();
        $order = DB::connection('mysql')->table('food_order')
                ->leftJoin('food_list', 'food_list.fl_id', '=', 'food_order.fo_list')
                ->leftJoin('food_type', 'food_type.ft_id', '=', 'food_order.fo_type')
                ->leftJoin('food_status', 'food_status.fs_id', '=', 'food_order.fo_status')
                ->where('order_id', $parm_id)
                ->get();
        $bed = DB::connection('pgsql')->table('b_visit_bed')
                ->select('bed_number')
                ->where('active', 1)
                ->get();
        return view('food.show', ['list'=>$list,'order'=>$order,'bed'=>$bed]);
    }

    function addOrder(Request $request)
    {
        $parm_id = ($request->get('food_id'));
        if($request->get('gridCheck') == 1){
            $type = '7';
            $list = '4';
        }else{
            $type = $request->get('food_type');
            $list = $request->get('food_list');
        }
        DB::connection('mysql')->table('food_order')->insert(
            [
                'order_id' => $parm_id,
                'fo_type' => $type,
                'fo_list' => $list,
                'fo_note' => $request->get('note'),
            ]
        );
        return back()->with("add","???????????????????????????????????????????????? ???????????? : FOD23736".str_pad($parm_id, 4, '0', STR_PAD_LEFT)." ??????????????????");
    }

    function change($id)
    {
        $parm_id = base64_decode($id);
        $data = DB::connection('mysql')->table('food_order')
                ->where('fo_id', $parm_id)
                ->first();
        if($data->fo_status == 1){
            $change = 2;
        }else{
            $change = 1;
        }
        DB::connection('mysql')->table('food_order')->where('fo_id', $parm_id)->update(
            ['fo_status' => $change]
        );
        return back()->with("change","????????????????????????????????? REF : ".$id." ??????????????????");
    }

    function bed(Request $request)
    {
        $id = $request->get('food_id');
        $bed = $request->get('bed');
        $patient = $request->get('patient');
        $update = date("Y-m-d H:i:s");
        DB::connection('mysql')->table('order_food')->where('food_id', $id)->update(
            [
                'food_bed' => $bed,
                'update_at' => $update
            ]
        );
        return back()->with("bed","????????????????????????????????????/???????????? : ".$patient." > > > ".$bed."");
    }

    function report(Request $request)
    {
        $order = DB::connection('mysql')->table('food_order')
                ->leftJoin('order_food', 'order_food.food_id', '=', 'food_order.order_id')
                ->leftJoin('food_list', 'food_list.fl_id', '=', 'food_order.fo_list')
                ->leftJoin('food_type', 'food_type.ft_id', '=', 'food_order.fo_type')
                ->leftJoin('food_status', 'food_status.fs_id', '=', 'food_order.fo_status')
                ->where('fo_date','like' , '%'.$request->get('date_ref').'%')
                ->where('fo_status', 1)
                ->get();
        $rdate = $request->get('date_ref');
        return view('food.report', ['order'=>$order,'rdate'=>$rdate]);
    }

    function discharge($id)
    {
        $parm_id = base64_decode($id);
        $update = date("Y-m-d H:i:s");
        DB::connection('mysql')->table('order_food')->where('food_id', $parm_id)->update(
            [
                'food_status' => 1,
                'update_at' => $update
            ]
        );
        return back()->with("discharge","Discharge : FOD23736".str_pad($parm_id, 4, '0', STR_PAD_LEFT)." ????????????");
    }

}
