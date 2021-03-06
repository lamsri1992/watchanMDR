<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'tracking'], function () {
	Route::get('/','OrderListController@index')->name('tracking.index');
	Route::get('/createOrderList', function () { return view('tracking.create'); });
	Route::get('/{id}','OrderListController@show')->name('tracking.show');
    Route::post('/createOrder','OrderListController@createOrder')->name('tracking.createOrder');
    Route::post('/updateTrack','OrderListController@updateTrack')->name('tracking.updateTrack');
    Route::post('/finalTrack','OrderListController@finalTrack')->name('tracking.finalTrack');
    Route::get('/keepChart/{id}','OrderListController@keepChart')->name('tracking.keepChart');
});

Route::group(['prefix' => 'drugOrder'], function () {
	Route::get('/','DrugOrderController@index')->name('drug.index');
	Route::get('/createDrugOrder', function () { return view('drug.create'); });
	Route::get('/{id}','DrugOrderController@show')->name('drug.show');
	Route::get('/discharge/{id}','DrugOrderController@discharge')->name('drug.discharge');
    Route::post('/createOrder','DrugOrderController@createOrder')->name('drug.createOrder');
	Route::post('/uploadFile', 'DrugOrderController@upload');
	Route::post('/messageNote', 'DrugOrderController@messageNote');
	Route::post('/fileDelete', 'DrugOrderController@delete')->name('drug.fileDelete');
});

Route::group(['prefix' => 'foodOrder'], function () {
	Route::get('/','foodOrderController@index')->name('food.index');
	Route::get('/createFoodOrder', function () { return view('food.create'); });
    Route::post('/createOrder','foodOrderController@createOrder')->name('food.createOrder');
    Route::post('/addOrder','foodOrderController@addOrder')->name('food.addOrder');
    Route::post('/bed','foodOrderController@bed')->name('food.bed');
    Route::post('/report','foodOrderController@report')->name('food.report');
	Route::get('/{id}','foodOrderController@show')->name('food.show');
	Route::get('/change/{id}','foodOrderController@change')->name('food.change');
	Route::post('/discharge/{id}','foodOrderController@discharge')->name('food.discharge');
});

Route::group(['prefix' => 'er'], function () {
	Route::get('/ems','erController@ems')->name('er.ems');
	Route::get('/refer','erController@refer')->name('er.refer');
	Route::get('/refer_list','erController@refer_list')->name('er.refer_list');
	Route::get('/create_ems','erController@emsCreate')->name('er.ems_create');
	Route::get('/record_ems','erController@record_ems')->name('er.record_ems');
	Route::get('/update_ems','erController@update_ems')->name('er.update_ems');
	Route::get('/ems/{id}','erController@show_ems')->name('er.ems_show');
	Route::get('/record_refer','erController@record_refer')->name('er.record_refer');
	Route::get('/refer/{id}','erController@show_refer')->name('er.refer_show');
	Route::get('/update_refer','erController@update_refer')->name('er.update_refer');
    Route::get('/report','erController@refer_report')->name('er.refer_report');
});

Route::group(['prefix' => 'search'], function () {
	Route::post('/','MdrController@search');
});

Route::group(['prefix' => 'users'], function () {
	Route::get('/','AccountController@index')->name('users.index');
	Route::post('/addUser','AccountController@addUser');
});

Route::group(['prefix' => 'token'], function () {
	Route::get('/','TokenController@index')->name('token.index');
	Route::post('/addToken','TokenController@addToken');
	Route::get('/{id}','TokenController@show')->name('token.show');
});

Route::group(['prefix' => 'store'], function () {
	Route::get('/','storeController@index')->name('store.index');
	Route::get('/{id}','storeController@show')->name('store.show');
	Route::post('/upload', 'storeController@upload');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::namespace('Auth')->group(function () {
	Route::post('/login','LoginController@login')->name('login');
});
