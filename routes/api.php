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

//RESTFUL APIs
Route::post('/login', 'APIController@api_login');
Route::post('/logout', 'APIController@api_logout');
Route::post('/contractors/all', 'APIController@api_all_contractors');
Route::post('/projects/all', 'APIController@api_all_projects');
Route::post('/projects/list', 'APIController@api_project_list');
Route::post('/labors/add', 'APIController@api_add_labor');
Route::post('/projects/ongoing', 'APIController@api_ongoing_projects');
Route::post('/projects/completed', 'APIController@api_completed_projects');
