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
Route::get('project/create', 'ProjectController@index');



//_______________________________User Management___________________________________//
Route::get('usr', 'HomeController@usermanagement');
//-----------------------------------Manager------------------------------------//
Route::get('managers/addmanager', 'HomeController@addmanager');
Route::resource('managers', 'ManagerController');
//-----------------------------------Contractor---------------------------------//
Route::get('contractors/addcontractor', 'HomeController@addcontractor');
Route::resource('contractors', 'ContractorController');
//-----------------------------------Supplier-----------------------------------//
Route::get('suppliers/addsupplier', 'HomeController@addsupplier');
Route::resource('suppliers', 'SupplierController');
//-----------------------------------Labor--------------------------------------//
Route::get('labors/addlabor', 'HomeController@addlabor');
Route::resource('labors', 'LaborController');
//________________________________User Management___________________________________//


Route::get('starter', 'HomeController@starter')->name('starter');


Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('profile/image', 'HomeController@updateImage')->name('profile.image');


//RESTFUL APIs

Route::post('/api/login', 'APIController@api_login');
Route::post('/api/logout', 'APIController@api_logout');
Route::post('/api/contractors/all', 'APIController@api_all_contractors');
