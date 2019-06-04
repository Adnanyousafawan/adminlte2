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

use App\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;





/*function () {
    return view('welcome');
});
*/
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

//-----------------------------------Project Management------------------------------------//
Route::resource('projects', 'ProjectController');
Route::get('/search_project', 'ProjectController@search_project');
Route::get('projects/index', 'ProjectController@index')->name('projects.index');
Route::get('projects/view', 'ProjectController@viewuser')->name('projects.view');

//-----------------------------------User Management------------------------------------//

Route::resource('users', 'UserController');
Route::get('/search_user', 'UserController@search_user');
Route::get('users/index', 'UserController@index')->name('users.index');

//-----------------------------------Labor Management--------------------------------------//

Route::resource('labors', 'LaborController');
Route::get('/search_labor', 'LaborController@search_labor');
//Route::get('labors/index', 'LaborController@index')->name('labors.index');
Route::get('/labors/index',array('as'=>'viewLabor','uses'=>'LaborController@index'));
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


//testing queries routes

Route::get('/testing', function () {
    $projects = Project::all();

//    return View::make('testing')->with('projects', $projects);
    return response()->json($projects);
});

Route::post('/api/testing-project-table', function () {
    $projects = Project::all();


    $check = [];
    for ($i = 0; $i < $projects->count(); $i++) {

        $contractorID = $projects->pluck("assigned_to")->get($i);
        $customerID = $projects->pluck("customer_id")->get($i);
        $managerID = $projects->pluck("assigned_by")->get($i);
        $phaseID = $projects->pluck("phase_id")->get($i);

        $check[$i] = [
            "id" => DB::table("projects")->pluck("id")->get($i),
            "title" => DB::table("projects")->pluck("title")->get($i),
            "area" => DB::table("projects")->pluck("area")->get($i),
            "city" => DB::table("projects")->pluck("city")->get($i),
            "plot_size" => DB::table("projects")->pluck("plot_size")->get($i),
            "customer" => DB::table('customers')->where('id', '=', $customerID)->get("name")->first(),
            "estimated_completion_time" => DB::table("projects")->pluck("estimated_completion_time")->get($i),
            "estimated_budget" => DB::table("projects")->pluck("estimated_budget")->get($i),
            "floor" => DB::table("projects")->pluck("floor")->get($i),
            "description" => DB::table("projects")->pluck("description")->get($i),
            "contract_image" => DB::table("projects")->pluck("contract_image")->get($i),
            "assigned_to" => DB::table('users')->where('id', '=', $contractorID)->get("name")->first(),
            "assigned_by" => DB::table('users')->where('id', '=', $managerID)->get("name")->first(),
            "status" => DB::table("projects")->pluck("status")->get($i),
            "phase" => DB::table('phases')->where('id', '=', $phaseID)->get("name")->first(),
        ];

    }

//    return View::make('testing')->with(compact('projects', 'contractors', 'customers'));
//    return response()->json(compact('projects', 'contractors', 'customers'));
    return response()->json($check);
});