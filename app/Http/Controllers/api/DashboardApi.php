<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardApi extends Controller
{
    public function index()
    {
        $list = DB::connection('pgsql')
                ->select(DB::raw("select t_diag_icd10.diag_icd10_number,b_icd10.icd10_description,
                count(distinct t_visit.visit_hn) AS p_num,count(distinct t_visit.visit_vn) AS v_num
                from t_visit
                left join t_diag_icd10 on t_visit.t_visit_id = t_diag_icd10.diag_icd10_vn
                left join b_icd10 on b_icd10.icd10_number = t_diag_icd10.diag_icd10_number
                left join f_diag_icd10_type on t_diag_icd10.f_diag_icd10_type_id = f_diag_icd10_type.f_diag_icd10_type_id
                where
                t_diag_icd10.f_diag_icd10_type_id = '1' 
                and t_diag_icd10.diag_icd10_number not like '%O80%'
                and t_diag_icd10.diag_icd10_number not like '%Z%'
                and t_visit.f_visit_status_id <> '4'
                and t_visit.f_visit_type_id = '1'
                and (substring(visit_financial_discharge_time,1,10) between substring('2563-10-01',1,10) and substring('2564-09-30',1,10))
                group by t_diag_icd10.diag_icd10_number,b_icd10.icd10_description,f_diag_icd10_type.diag_icd10_type_description
                order by p_num desc
                limit 10"));
        return response()->json($list);
    }
}
