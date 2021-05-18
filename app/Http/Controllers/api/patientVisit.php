<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class patientVisit extends Controller
{
    public function show($id)
    {
        $list = DB::connection('pgsql')
                ->table('t_visit')
                ->select('t_visit.t_visit_id','t_patient.patient_pid','t_patient.patient_hn','t_patient.patient_firstname','t_patient.patient_lastname',
                't_visit.visit_patient_age','t_visit.visit_begin_visit_time','t_visit.visit_diagnosis_notice','t_visit.visit_dx',
                't_visit_primary_symptom.visit_primary_symptom_main_symptom',
                'f_emergency_status.emergency_status_description','f_visit_service_type.visit_service_type_description','f_trama_status.description',
                't_visit.f_visit_status_id')
                ->leftJoin('t_patient', 't_patient.patient_hn', '=', 't_visit.visit_hn')
                ->leftJoin('t_visit_primary_symptom', 't_visit_primary_symptom.t_visit_id', '=', 't_visit.t_visit_id')
                ->leftJoin('f_emergency_status', 'f_emergency_status.f_emergency_status_id', '=', 't_visit.f_emergency_status_id')
                ->leftJoin('f_visit_service_type', 'f_visit_service_type.f_visit_service_type_id', '=', 't_visit.f_visit_service_type_id')
                ->leftJoin('f_trama_status', 'f_trama_status.f_trama_status_id', '=', 't_visit.f_trama_status_id')
                ->where('t_visit.t_visit_id', $id)
                ->first();
        return response()->json($list);
    }
}
