<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
