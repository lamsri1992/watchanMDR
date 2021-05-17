<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class patientList extends Controller
{
    public function index()
    {
        $list = DB::connection('pgsql')
                ->table('t_patient')
                ->select('patient_pid','patient_hn','patient_firstname','patient_lastname')
                ->get();
        return response()->json($list);
    }

    public function show($id)
    {
        $list = DB::connection('pgsql')
                ->table('t_patient')
                ->select('patient_pid','patient_hn','patient_firstname','patient_lastname')
                ->where('patient_hn',$id)
                ->first();
        return response()->json($list);
    }
}
