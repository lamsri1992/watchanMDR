<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MdrController extends Controller
{
    function search(Request $request)
    {
        $result = DB::connection('mysql')->table('tracking_list')
                ->leftJoin('track_status', 'track_status.t_stat_id', '=', 'tracking_list.list_status')
                ->leftJoin('tracking_order', 'tracking_order.track_id', '=', 'tracking_list.track_id')
                ->leftJoin('tracking_point', 'tracking_point.point_id', '=', 'tracking_order.track_point')
                ->where('list_hn', 'like', '%'.$request->keyword.'%')
                ->orWhere('list_vn', 'like', '%'.$request->keyword.'%')
                ->get();
        return view('search.result', ['result'=>$result]);
        // dd($result);
    }
}
