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
                ->select('visit_refer_in_out_number','visit_hn','patient_firstname','patient_lastname','visit_begin_visit_time',
                'visit_refer_in_out_summary_diagnosis','visit_refer_in_out_refer_hospital','visit_office_name1','visit_have_refer','refer_cause_description')
                ->leftJoin('t_visit', 't_visit.t_visit_id', '=', 't_visit_refer_in_out.t_visit_id')
                ->leftJoin('t_patient', 't_patient.patient_hn', '=', 't_visit_refer_in_out.visit_refer_in_out_hn')
                ->leftJoin('b_visit_office', 'b_visit_office.b_visit_office_id', '=', 't_visit_refer_in_out.visit_refer_in_out_refer_hospital')
                ->leftJoin('f_refer_cause', 'f_refer_cause.f_refer_cause_id', '=', 't_visit.f_refer_cause_id')
                ->where('f_visit_refer_type_id', 1)
                ->where('record_date_time', 'like', '%'.$id.'%')
                ->where('f_visit_status_id', 3)
                ->where('visit_have_refer', 1)
                ->orderBy('visit_refer_in_out_number', 'desc')
                ->get();
        return response()->json($list);
    }
}
