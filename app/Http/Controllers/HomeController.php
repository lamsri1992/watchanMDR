<?php

namespace App\Http\Controllers;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $num = DB::connection('pgsql')
                ->select(DB::raw("SELECT COUNT(visit_vn) AS admit_num FROM t_visit WHERE f_visit_type_id = '1' AND f_visit_status_id ='1'"));
        return view('dashboard', ['num'=>$num]);
    }
}
