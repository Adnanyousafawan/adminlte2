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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//RESTFUL APIs
Route::post('/login', 'APIController@api_login');
Route::post('/logout', 'APIController@api_logout');
Route::post('/password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
Route::post('/contractors/all', 'APIController@api_all_contractors');
Route::post('/projects/all', 'APIController@api_all_projects');
Route::post('/projects/list', 'APIController@api_project_list');
Route::post('/labors/add', 'APIController@api_add_labor');
Route::post('/projects/ongoing', 'APIController@api_ongoing_projects');
Route::post('/projects/stopped', 'APIController@api_stopped_projects');
Route::post('/projects/completed', 'APIController@api_completed_projects');
Route::post('/projects/assigned', 'APIController@api_assigned_projects');
Route::post('/labors/all', 'APIController@api_all_labors');
Route::post('/project/id', 'APIController@api_project_details');
Route::post('/labor/dialog', 'APIController@api_update_labor_status_dialog');
Route::post('/labor/id', 'APIController@api_update_labor_status');
Route::post('/projects/longpress/dialog', 'APIController@api_projects_longpress_dialog');
Route::post('/projects/longpress/dialog/update', 'APIController@api_projects_longpress_dialog_update');
Route::post('/contractor/profile', 'APIController@api_contractor_profile');
Route::post('/material/request', 'APIController@api_material_request');
Route::post('/material/request/store', 'APIController@api_material_request_store');
Route::post('/projects/labor/attendance', 'APIController@api_projects_labor_attendance');
Route::post('/get/labor/attendance', 'APIController@api_get_labor_attendance');
Route::post('/add/labor/attendance', 'APIController@api_add_labor_attendance');
Route::post('/active/labors', 'APIController@api_active_labors');
Route::post('/not/active/labors', 'APIController@api_not_active_labors');
Route::post('/suspended/labors', 'APIController@api_suspended_labors');
Route::post('/accept/project', 'APIController@api_accept_project');
Route::post('/labors/all/project', 'APIController@api_all_labors_on_project');
Route::post('/active/labors/project', 'APIController@api_active_labors_on_project');
Route::post('/not-active/labors/project', 'APIController@api_not_active_labors_on_project');
Route::post('/suspended/labors/project', 'APIController@api_suspended_labors_on_project');
Route::post('/change/password', 'APIController@api_change_password');
Route::post('/change/picture', 'APIController@api_change_picture');
Route::post('/all/material/requests', 'APIController@api_all_material_requests');
Route::post('/approved/material/requests', 'APIController@api_approved_material_requests');
Route::post('/rejected/material/requests', 'APIController@api_rejected_material_requests');
Route::post('/pending/material/requests', 'APIController@api_pending_material_requests');
Route::post('/password/forgot', 'APIController@api_password_forgot');
Route::post('/update/project/phase', 'APIController@api_update_project_phase');
Route::post('/orders/all', 'APIController@api_orders_all');
Route::post('/orders/pending', 'APIController@api_orders_pending');
Route::post('/orders/received', 'APIController@api_orders_received');
Route::post('/orders/partially-received', 'APIController@api_orders_partially_received');





