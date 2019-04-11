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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

//-----------------------------------Project------------------------------------//
Route::resource('projects', 'ProjectController');

//-----------------------------------User------------------------------------//
Route::resource('users', 'UserController');
Route::get('/search', 'UserController@search_user');
Route::get('users/index', 'UserController@index')->name('users.index');

//-----------------------------------Labor--------------------------------------//

Route::resource('labors', 'LaborController');
Route::get('/search', 'LaborController@search_labor');
Route::get('labors/index','LaborController@index')->name('labors.index');






//Route::get('users/index', 'HomeController@userindex')->name('user.index');


Route::get('user/table','HomeController@datatable');

//_______________________________User Management___________________________________//
Route::get('useer', 'HomeController@usermanagement');
//-----------------------------------Manager------------------------------------//
Route::get('managers/addmanager', 'HomeController@addmanager');
Route::resource('managers', 'ManagerController');
//-----------------------------------Contractor---------------------------------//
Route::get('contractors/addcontractor', 'HomeController@addcontractor');
Route::resource('contractors', 'ContractorController');
//-----------------------------------Supplier-----------------------------------//
Route::get('suppliers/addsupplier', 'HomeController@addsupplier');
Route::resource('suppliers', 'SupplierController');


//________________________________User Management___________________________________//


Route::get('starter', 'HomeController@starter')->name('starter');


Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('profile/image', 'HomeController@updateImage')->name('profile.image');


//RESTFUL APIs

Route::post('/api/login', 'APIController@api_login');
Route::post('/api/logout', 'APIController@api_logout');
Route::post('/api/contractors/all', 'APIController@api_all_contractors');
