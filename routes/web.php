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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('project/create', 'HomeController@addproject');

Route::get('addcontractor','HomeController@addcontractor')->name('add_contractor');

//Route::resource('employee-management', 'HomeController');

Route::get('addlabor','HomeController@addlabor')->name('add_labor');

Route::get('addmanager','HomeController@addmanager')->name('add_manager');
Route::get('addvendor','HomeController@addvendor')->name('add_vendor');
Route::get('starter','HomeController@starter')->name('starter');

Route::get('usr','HomeController@usermanagement')->name('user_management');

Route::resource('projects','ProjectController');
