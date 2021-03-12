<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DrugApiController extends Controller
{
    public function index()
    {
        $list = DB::connection('pgsql')
                ->table('t_visit')
                ->select('t_visit.visit_hn','t_visit.visit_vn','t_visit.visit_patient_self_doctor'
                ,'b_employee.employee_firstname','b_employee.employee_lastname','t_visit.visit_bed'
                ,'t_visit.visit_begin_admit_date_time','t_patient.patient_firstname','t_patient.patient_lastname')
                ->leftJoin('b_employee', 'b_employee.b_employee_id', '=', 't_visit.visit_patient_self_doctor')
                ->leftJoin('t_patient', 't_patient.patient_hn', '=', 't_visit.visit_hn')
                ->where('t_visit.f_visit_type_id', '=', 1)
                ->where('t_visit.f_visit_status_id', '=', 1)
                ->where('t_visit.visit_bed', '<>', 'IPD Discharge')
                ->get();
        return response()->json($list);
    }
}
