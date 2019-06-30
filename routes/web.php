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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'CustomerController@goBackToHome')->name('redirect-to-main');

Auth::routes(); 

Route::get('/home', 'HomeController@index')->name('home');
//-----------------------------------Items Management------------------------------------//

//Route::resource('item', 'ItemController');
Route::get('items/create', 'ItemController@create')->name('item.create');
Route::post('items/itemDetails/insert', 'ItemController@insert')->name('item.insert');
Route::get('items', 'ItemController@index')->name('items.list');
Route::delete('items/destroy/{id}', 'ItemController@destroy')->name('items.destroy');
//----------------------------------------------------------





//-----------------------------------Expense Management------------------------------------//

Route::get('expenses/create', 'MiscellaneousExpenseController@create')->name('expense.create');
Route::post('expenses/miscellaneousexpenses/insert', 'MiscellaneousExpenseController@insert')->name('expenses.insert');
Route::get('expenses', 'MiscellaneousExpenseController@index')->name('expenses.list');
Route::delete('epenses/destroy/{id}', 'MiscellaneousExpenseController@destroy')->name('expenses.destroy');

//-----------------------------------Customer Management------------------------------------//

Route::get('allcustomers', 'CustomerController@index')->name('customers.list');


//-----------------------------------Order Details Management------------------------------------//

/*
Route::get('orders/recieved','OrderDetailsController@recieved')->name('orders.recieved');
Route::get('orders/cancelled','OrderDetailsController@cancelled')->name('orders.cancelled');
*/

Route::get('orders/create', 'OrderDetailsController@create')->name('order.create');
Route::post('orders/orderdetails/insert', 'OrderDetailsController@insert')->name('order.insert');
Route::get('orders', 'OrderDetailsController@index')->name('orders.list');
Route::get('orders/recieved', 'OrderDetailsController@recieved')->name('orders.recieved');
Route::get('orders/cancelled', 'OrderDetailsController@cancelled')->name('orders.cancelled');
Route::delete('orders/destroy/{id}', 'OrderDetailsController@destroy')->name('orders.destroy');
Route::get('orders/projectorders/{id}', 'OrderDetailsController@projectorders')->name('orders.projectorders');
Route::post('orders/update/{id}', 'OrderDetailsController@update')->name('orders.update');

Route::get('orders/getItems/{id}', 'OrderDetailsController@getItems');

//-----------------------------------Project Management------------------------------------//

//Route::resource('projects', 'ProjectController');
Route::get('/search_project', 'ProjectController@search_project');
Route::get('projects', 'ProjectController@index')->name('projects.index');
Route::get('projects/create', 'ProjectController@create')->name('projects.create');
Route::get('projects/edit/{id}', 'ProjectController@edit')->name('projects.edit');
Route::post('projects/store', 'ProjectController@store')->name('projects.store');
Route::patch('projects/update/{id}', 'ProjectController@update')->name('projects.update');
Route::delete('projects/destroy/{id}', 'ProjectController@destroy')->name('projects.destroy');
Route::get('projects/view/{id}', 'ProjectController@viewuser')->name('projects.view');

//-----------------------------------Project Details Management------------------------------------//

Route::get('projects/pending', 'ProjectController@pending')->name('projects.pending');
Route::get('projects/completed', 'ProjectController@completed')->name('projects.completed');
Route::get('projects/cancelled', 'ProjectController@cancelled')->name('projects.cancelled');
Route::get('projects/current', 'ProjectController@current')->name('projects.current');
Route::get('projects/all', 'ProjectController@all')->name('projects.all');
Route::get('projects/labor_by_projects','ProjectController@labors_by_projects')->name('projects.labor_by_projects');
 
//--------------------------------Project Phase Management------------------------------

Route::get('phases', 'PhaseController@index')->name('phases.index');
Route::get('phases/create', 'PhaseController@create')->name('phases.create');
Route::post('phases/phases/insert', 'PhaseController@insert')->name('phases.insert');
Route::get('phase/edit/{id}', 'PhaseController@edit')->name('phases.edit');
Route::delete('phase/destroy/{id}', 'PhaseController@destroy')->name('phases.destroy');

//-----------------------------ProjectStatus-----------------------------------

Route::get('projectstatus', 'ProjectStatusController@index')->name('projectstatus.index');
Route::get('projectstatus/create', 'ProjectStatusController@create')->name('projectstatus.create');
Route::post('projectstatus/projectstatus/insert', 'ProjectStatusController@insert')->name('projectstatus.insert');
Route::get('projectstatus/edit/{id}', 'ProjectStatusController@edit')->name('projectstatus.edit');
Route::delete('projectstatus/destroy/{id}', 'ProjectStatusController@destroy')->name('projectstatus.destroy');


//__________________________________Material Request_______________________________________

//Route::resource('materialrequest','MaterialRequestController');
Route::get('materialrequest','MaterialRequestController@index')->name('requests.index');
Route::get('materialrequest/approved','MaterialRequestController@approved')->name('requests.approved');
Route::patch('materialrequest/update/{id}', 'MaterialRequestController@update')->name('requests.update');
Route::get('materialrequest/rejected','MaterialRequestController@rejected')->name('requests.rejected');
Route::get('materialrequest/pending','MaterialRequestController@pending')->name('requests.pending');
Route::post('materialrequest/insert','MaterialRequestController@insert')->name('requests.insert');



Route::delete('materialrequest/destroy/{id}', 'MaterialRequestController@destroy')->name('requests.destroy');

//-----------------------------------User Management------------------------------------//

//Route::resource('users', 'UserController');
Route::get('users', 'UserController@all')->name('users.all');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::get('users/manager', 'UserController@manager')->name('users.manager');
Route::get('users/contractor', 'UserController@contractor')->name('users.contractor');
Route::get('users/edit/{id}', 'UserController@edit')->name('users.edit');
Route::post('users/store', 'UserController@store')->name('users.store');
Route::delete('users/destroy/{id}', 'UserController@destroy')->name('users.destroy');
Route::post('users/change_password', 'UserController@changepassword')->name('user.changepassword');
Route::patch('users/update/{id}','UserController@update')->name('users.update');


//-----------------------------------Labor Management--------------------------------------//

Route::resource('labors', 'LaborController');
Route::get('/search_labor', 'LaborController@search_labor');
//Route::get('labors/index', 'LaborController@index')->name('labors.index');
Route::get('/labors/create', 'LaborController@create')->name('labors.create');


//-----------------------------------Supplier Management-----------------------------------//

Route::resource('suppliers', 'SupplierController');
Route::get('/search_supplier', 'SupplierController@search_supplier');
Route::get('suppliers/all', 'SupplierController@index')->name('suppliers.all');
Route::get('user/table', 'HomeController@datatable');

//_______________________________User Management___________________________________//
Route::get('useer', 'HomeController@usermanagement');


//________________________________User Management___________________________________//

Route::get('starter', 'HomeController@starter')->name('starter');
Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('profile/image', 'HomeController@updateImage')->name('profile.image');


