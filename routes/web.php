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

use App\Customer;
use App\Project;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

//-----------------------------------Project Management------------------------------------//
Route::resource('projects', 'ProjectController');
Route::get('/search_project', 'ProjectController@search_project');
Route::get('projects/index', 'ProjectController@index')->name('projects.index');

//-----------------------------------User Management------------------------------------//

Route::resource('users', 'UserController');
Route::get('/search_user', 'UserController@search_user');
Route::get('users/index', 'UserController@index')->name('users.index');

//-----------------------------------Labor Management--------------------------------------//

Route::resource('labors', 'LaborController');
Route::get('/search_labor', 'LaborController@search_labor');
Route::get('labors/index', 'LaborController@index')->name('labors.index');

//-----------------------------------Supplier Management-----------------------------------//

Route::resource('suppliers', 'SupplierController');
Route::get('/search_supplier', 'SupplierController@search_supplier');
Route::get('suppliers/index', 'SupplierController@index')->name('suppliers.index');

//Route::get('users/index', 'HomeController@userindex')->name('user.index');


Route::get('user/table', 'HomeController@datatable');

//_______________________________User Management___________________________________//
Route::get('useer', 'HomeController@usermanagement');


//-----------------------------------Manager------------------------------------//
Route::get('managers/addmanager', 'HomeController@addmanager');
Route::resource('managers', 'ManagerController');


//-----------------------------------Contractor---------------------------------//
Route::get('contractors/addcontractor', 'HomeController@addcontractor');
Route::resource('contractors', 'ContractorController');


//________________________________User Management___________________________________//


Route::get('starter', 'HomeController@starter')->name('starter');
Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('profile/image', 'HomeController@updateImage')->name('profile.image');


//RESTFUL APIs

Route::post('/api/login', 'APIController@api_login');
Route::post('/api/logout', 'APIController@api_logout');
Route::post('/api/contractors/all', 'APIController@api_all_contractors');
Route::post('/api/projects/all', 'APIController@api_all_projects');
Route::post('/api/projects/list', 'APIController@api_project_list');
Route::post('/api/labors/add', 'APIController@api_add_labor');


//testing queries routes

Route::get('/testing', function () {
    $projects = Project::all();

//    return View::make('testing')->with('projects', $projects);
    return response()->json($projects);
});

Route::get('/api/testing-project-table', function () {
    $projects = Project::all();
    $contractors = DB::table('users')->where('role_id', '=', '3')->get();
    $customers = Customer::all();


//    return View::make('testing')->with(compact('projects', 'contractors', 'customers'));
    return response()->json(compact('projects', 'contractors', 'customers'));
});