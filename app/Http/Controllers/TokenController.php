<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TokenController extends Controller
{
    public function index()
    {
        $data = DB::connection('mysql')->table('token')
                ->get();
        return view('token.index', ['data'=>$data]);
    }

    function addToken(Request $request)
    {        
        DB::connection('mysql')->table('token')->insert(
            [
                'token_name' => $request->get('name'),
                'token_line' => $request->get('line')
            ]
        );
        return back()->with("success","เพิ่ม Line Token สำเร็จ");
    }

    function show($id)
    {
        $parm_id = base64_decode($id);
        $list = DB::connection('mysql')->table('token')
                ->where('token_id', $parm_id)
                ->first();
        return view('token.show', ['list'=>$list]);
    }
}
