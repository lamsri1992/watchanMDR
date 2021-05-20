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
                ->select('t_visit_refer_in_out.visit_refer_in_out_number','t_visit.visit_hn','t_patient.patient_firstname','t_patient.patient_lastname',
                't_visit.visit_begin_visit_time','t_visit_refer_in_out.visit_refer_in_out_summary_diagnosis','t_visit_refer_in_out.visit_refer_in_out_refer_hospital',
                'b_visit_office.visit_office_name1','t_visit.visit_have_refer','f_refer_cause.refer_cause_description','t_visit_refer_in_out.t_visit_id',
                't_visit.visit_have_appointment')
                ->leftJoin('t_visit', 't_visit.t_visit_id', '=', 't_visit_refer_in_out.t_visit_id')
                ->leftJoin('t_patient', 't_patient.patient_hn', '=', 't_visit_refer_in_out.visit_refer_in_out_hn')
                ->leftJoin('b_visit_office', 'b_visit_office.b_visit_office_id', '=', 't_visit_refer_in_out.visit_refer_in_out_refer_hospital')
                ->leftJoin('f_refer_cause', 'f_refer_cause.f_refer_cause_id', '=', 't_visit.f_refer_cause_id')
                ->where('f_visit_refer_type_id', 1)
                ->where('t_visit_refer_in_out.record_date_time', 'like', '%'.$id.'%')
                ->where('t_visit.f_visit_status_id', 3)
                ->where('t_visit.visit_have_refer', 1)
                ->where('t_visit.visit_have_appointment', 0)
                ->orderBy('t_visit_refer_in_out.visit_refer_in_out_number', 'desc')
                ->get();
        return response()->json($list);
    }
}
