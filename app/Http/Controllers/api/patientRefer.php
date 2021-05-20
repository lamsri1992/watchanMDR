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
                ->table('t_visit')
                ->select('t_visit_refer_in_out.visit_refer_in_out_number','t_visit.visit_hn','t_patient.patient_firstname','t_patient.patient_lastname',
                't_visit_refer_in_out.record_date_time','t_visit_refer_in_out.visit_refer_in_out_summary_diagnosis',
                't_visit_refer_in_out.visit_refer_in_out_summary_treatment','t_visit_refer_in_out.visit_refer_in_out_refer_hospital',
                'b_visit_office.visit_office_name1','b_service_point.b_service_point_id','b_service_point.service_point_description')
                ->leftJoin('t_visit_service', 't_visit_service.t_visit_id', '=', 't_visit.t_visit_id')
                ->leftJoin('t_patient', 't_patient.patient_hn', '=', 't_visit.visit_hn')
                ->leftJoin('t_visit_refer_in_out', 't_visit_refer_in_out.t_visit_id', '=', 't_visit.t_visit_id')
                ->leftJoin('b_service_point', 'b_service_point.b_service_point_id', '=', 't_visit_service.b_service_point_id')
                ->leftJoin('b_visit_office', 'b_visit_office.b_visit_office_id', '=', 't_visit.b_visit_office_id_refer_out')
                ->where('f_visit_refer_type_id', 1)
                ->where('b_service_point.b_service_point_id', 2409144269314)
                ->where('record_date_time', 'like', '%'.$id.'%')
                ->get();
        return response()->json($list);
    }
}
