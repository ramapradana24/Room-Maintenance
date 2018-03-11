<?php

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

Route::get('/', 'Auth\LoginController@showloginform');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::resource('scheduling', 'SchedulingController');
Route::resource('complaint', 'ComplaintController');
Route::resource('defect', 'DefectController');
Route::get('/inventory/{id}', 'InventoryRoomController@inventory');
Route::get('/scheduling/{scheduling}/maintain', 'SchedulingController@maintain');
Route::get('/notification/{notification}', 'NotificationController@show_notification');
Route::get('/notification/{notification}/unseen', 'NotificationController@unseen_notif');
Route::get('/notification/{notification}/update', 'NotificationController@update_notif');
Route::get('/notification/{notification}/loadlast', 'NotificationController@load_last');
Route::put('/scheduling/{scheduling}/maintain', 'SchedulingController@maintain_update');
Route::get('/defect/{defect}/fixit', 'DefectController@fixit');
Route::put('/defect/{defect}/fixing', 'DefectController@fixing');
Route::get('/complaint/{defect}/fixit', 'ComplaintController@fixit');
Route::post('/report', 'ReportController@index');
Route::put('/complaint/{defect}/fixing', 'ComplaintController@fixing');
Route::get('/notification', 'NotificationController@index');
