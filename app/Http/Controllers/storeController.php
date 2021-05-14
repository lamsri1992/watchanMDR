<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use DB;

class storeController extends Controller
{
    public function index()
    {
        $data = DB::connection('mysql')->table('tracking_list')
                ->leftJoin('track_status', 'track_status.t_stat_id', '=', 'tracking_list.list_status')
                ->get();
        return view('store.index', ['data'=>$data]);
    }

    function show($id)
    {
        $data = DB::connection('mysql')->table('tracking_list')
                ->leftJoin('track_status', 'track_status.t_stat_id', '=', 'tracking_list.list_status')
                ->where('list_vn', $id)
                ->first();
        return view('store.show', ['data'=>$data]);
    }

    public function upload(Request $request)
    {
        // Upload Files
        $file  = $request->file('fileUpload');
        $vn = $request->get('vn');
        $fileName = $vn.".pdf";
        $path = public_path('MDR/'.$vn.'/Charts');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
            $file->move(public_path('MDR/'.$vn.'/Charts'), $fileName);
            // Update File Path
            DB::connection('mysql')->table('tracking_list')->where('list_vn', $vn)->update(
                [
                    'list_path' => $fileName
                ]
            );
        }
        return back()->with("success","อัพโหลดเวชระเบียน VN: ".$vn." เรียบร้อยแล้ว");
    }
}
