<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class patientHistory extends Controller
{
    public function show($id)
    {
        $list = DB::connection('pgsql')
                ->table('t_visit')
                ->select('t_patient.patient_pid','t_patient.patient_hn','t_patient.patient_firstname','t_patient.patient_lastname',
                't_visit.visit_begin_visit_time','t_visit.visit_diagnosis_notice','t_visit.visit_dx','t_visit.visit_patient_age',
                'f_emergency_status.emergency_status_description','f_visit_service_type.visit_service_type_description','f_trama_status.description',
                't_visit.f_visit_status_id')
                ->leftJoin('t_patient', 't_patient.patient_hn', '=', 't_visit.visit_hn')
                ->leftJoin('f_emergency_status', 'f_emergency_status.f_emergency_status_id', '=', 't_visit.f_emergency_status_id')
                ->leftJoin('f_visit_service_type', 'f_visit_service_type.f_visit_service_type_id', '=', 't_visit.f_visit_service_type_id')
                ->leftJoin('f_trama_status', 'f_trama_status.f_trama_status_id', '=', 't_visit.f_trama_status_id')
                ->where('t_patient.patient_hn', $id)
                ->where('t_visit.f_visit_type_id', 0)
                ->where('t_visit.f_visit_status_id', 3)
                ->where('t_visit.f_visit_service_type_id', 4)
                ->limit(5)
                ->get();
        return response()->json($list);
    }
}
