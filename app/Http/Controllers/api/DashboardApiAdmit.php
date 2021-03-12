<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardApiAdmit extends Controller
{
    public function index()
    {
        $list = DB::connection('pgsql')
                ->select(DB::raw(" select q1.clinic AS clinic_name
                , count(q1.number) AS p_num
                From
                ( select  b_visit_clinic.visit_clinic_description AS clinic 
                , count(t_diag_icd10.diag_icd10_number) AS number 
                , t_diag_icd10.diag_icd10_vn 
                from b_visit_clinic 
                inner join t_diag_icd10 
                on b_visit_clinic.b_visit_clinic_id = t_diag_icd10.b_visit_clinic_id 
                inner join t_visit
                on t_visit.t_visit_id = t_diag_icd10.diag_icd10_vn
                where t_diag_icd10.diag_icd10_active = '1' 
                and t_visit.f_visit_type_id = '1'
                and substring(diag_icd10_diagnosis_date,1,10) between '2563-10-01' and '2564-09-30'
                group by b_visit_clinic.visit_clinic_description
                , t_diag_icd10.diag_icd10_vn ) AS q1 
                group by q1.clinic
                order by count(q1.number)DESC
                "));
        return response()->json($list);
    }
}
