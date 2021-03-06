<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('discharge_list', 'api\ListApiController');
Route::apiResource('drug_list', 'api\DrugApiController');
Route::apiResource('top10icd', 'api\DashboardApi');
Route::apiResource('ipdadmit', 'api\DashboardApiAdmit');
Route::apiResource('patient', 'api\patientList');
Route::apiResource('history', 'api\patientHistory');
Route::apiResource('visit', 'api\patientVisit');
Route::apiResource('refer', 'api\patientRefer');