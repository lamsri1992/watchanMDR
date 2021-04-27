<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class foodOrderController extends Controller
{
    public function index()
    {
        $data = DB::connection('mysql')->table('order_food')
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
                ->where('order_id', $parm_id)
                ->get();
        return view('food.show', ['list'=>$list,'order'=>$order]);
    }

}
