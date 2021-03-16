<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AccountController extends Controller
{
    public function index()
    {
        $data = DB::connection('mysql')->table('users')
                ->get();
        return view('users.index', ['data'=>$data]);
    }

    function addUser(Request $request)
    {
        $hash_pass = password_hash($request->get('password'), PASSWORD_DEFAULT);

        if($request->get('permission') == 1 ){ $perm_name = 'ผู้ดูแลระบบ'; }
        if($request->get('permission') == 2 ){ $perm_name = 'งานเภสัชกรรม'; }
        if($request->get('permission') == 3 ){ $perm_name = 'กลุ่มการแพทย์'; }
        if($request->get('permission') == 4 ){ $perm_name = 'งานเวชระเบียน'; }
        if($request->get('permission') == 5 ){ $perm_name = 'ผู้ใช้งานทั่วไป'; }
        
        DB::connection('mysql')->table('users')->insert(
            [
                'name' => $request->get('name'),
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'permission_id' => $request->get('permission'),
                'permission' => $perm_name,
                'password' => $hash_pass
            ]
        );
        return back()->with("success","เพิ่มบัญชีผู้ใช้งานสำเร็จ");
    }
}
