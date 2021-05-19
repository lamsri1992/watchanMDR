<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class patientRefer extends Controller
{
    public function show($id)
    {
        $list = DB::connection('pgsql')
                ->table('t_visit_refer_in_out')
                ->select('visit_refer_in_out_number','visit_refer_in_out_hn','patient_firstname','patient_lastname','record_date_time',
                'visit_refer_in_out_summary_diagnosis','visit_refer_in_out_summary_treatment','visit_refer_in_out_refer_hospital','visit_office_name1')
                ->leftJoin('t_patient', 't_patient.patient_hn', '=', 't_visit_refer_in_out.visit_refer_in_out_hn')
                ->leftJoin('b_visit_office', 'b_visit_office.b_visit_office_id', '=', 't_visit_refer_in_out.visit_refer_in_out_refer_hospital')
                ->where('f_visit_refer_type_id', 1)
                ->where('record_date_time', 'like', '%'.$id.'%')
                ->get();
        return response()->json($list);
    }
}
