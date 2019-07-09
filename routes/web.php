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

Route::get('search', 'SearchController@search')->name('search.result');

// display records routes
Route::get('orderdetail/{slug}', 'OrderDetailsController@show')->name('orderdetails.show');
Route::get('project/{slug}', 'ProjectController@show')->name('projects.show');
 
// search routes
Route::get('laravelssearch', 'SearchController@index')->name('search.index');

 

Route::get('charts', 'ChartController@index')->name('chart.index');

//-----------------------------------Items Management-- ----------------------------------//

//Route::resource('item', 'ItemController');
Route::get('items/create', 'ItemController@create')->name('item.create');
Route::post('items/itemDetails/insert', 'ItemController@insert')->name('item.insert');
Route::post('items/update/{id}', 'ItemController@update')->name('items.update');
Route::get('items', 'ItemController@index')->name('items.list');
Route::delete('items/destroy/{id}', 'ItemController@destroy')->name('items.destroy');
//----------------------------------------------------------

Route::get('customer-payment/create', 'CustomerPaymentsController@create')->name('customerpayment.create');
Route::post('customer-payment/customerpayment/insert', 'CustomerPaymentsController@insert')->name('customerpayment.insert');
Route::get('customer-payment', 'CustomerPaymentsController@index')->name('customerpayment');
Route::delete('customer-payment/destroy/{id}', 'CustomerPaymentsController@destroy')->name('customerpayment.destroy');
Route::post('customer-payment/update/{id}', 'CustomerPaymentsController@update')->name('customerpayment.update');

Route::get('supplier-payment/create', 'SupplierPaymentsController@create')->name('supplierpayment.create');
Route::post('supplier-payment/supplierpayment/insert', 'SupplierPaymentsController@insert')->name('supplierpayment.insert');
Route::get('supplier-payment', 'SupplierPaymentsController@index')->name('supplierpayment');
Route::delete('supplier-payment/destroy/{id}', 'SupplierPaymentsController@destroy')->name('supplierpayment.destroy');
Route::post('supplier-payment/update/{id}', 'SupplierPaymentsController@update')->name('supplierpayment.update');


Route::get('report', 'ReportController@index')->name('report.daily');
Route::get('report/weekly', 'ReportController@weekly')->name('report.weekly');
Route::get('report/monthly', 'ReportController@monthly')->name('report.monthly');


Route::post('report/search', 'ReportController@search')->name('report.search');
Route::post('report/pdf', 'ReportController@exportPDF')->name('report.pdf');


Route::get('projectreport', 'ProjectReportController@index')->name('projectreport.index');
Route::post('projectreport/search', 'ProjectReportController@search')->name('projectreport.search');
//Route::post('report/excel', 'ReportController@exportExcel')->name('report.excel');
Route::post('projectreport/pdf', 'ProjectReportController@exportPDF')->name('projectreport.pdf');



Route::get('expensereport', 'ExpenseReportController@index')->name('expensereport.index');
Route::post('expensereport/search', 'ExpenseReportController@search')->name('expensereport.search');
//Route::post('report/excel', 'ReportController@exportExcel')->name('report.excel');
Route::post('expensereport/pdf', 'ExpenseReportController@exportPDF')->name('expensereport.pdf');

//-----------------------------------Expense Management------------------------------------//

Route::get('expenses/create', 'MiscellaneousExpenseController@create')->name('expense.create');
Route::post('expenses/miscellaneousexpenses/insert', 'MiscellaneousExpenseController@insert')->name('expenses.insert');
Route::get('expenses', 'MiscellaneousExpenseController@index')->name('expenses.list');
Route::post('expenses/update/{id}', 'MiscellaneousExpenseController@update')->name('expenses.update');
Route::delete('epenses/destroy/{id}', 'MiscellaneousExpenseController@destroy')->name('expenses.destroy');

Route::get('company-expenses', 'MiscellaneousExpenseController@company_expense')->name('company-expenses.list');
Route::post('company-expenses/update/{id}', 'MiscellaneousExpenseController@update_company_expense')->name('company-expenses.update');

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
Route::get('orders/pending', 'OrderDetailsController@pending')->name('orders.pending');
Route::post('orders/cancelorder/{id}', 'OrderDetailsController@cancelorder')->name('orders.cancelorder');

Route::delete('orders/destroy/{id}', 'OrderDetailsController@destroy')->name('orders.destroy');
Route::get('orders/projectorders/{id}', 'OrderDetailsController@projectorders')->name('orders.projectorders');
Route::post('orders/update/{id}', 'OrderDetailsController@update')->name('orders.update');

Route::get('orders/getItems/{id}', 'OrderDetailsController@getItems');

Route::get('orders/show', 'OrderDetailsController@show')->name('orders.show');

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

//Route::get('projects/{id}', 'ProjectController@viewuser')->name('projects');


//-----------------------------------Project Details Management------------------------------------//

Route::get('projects/not-started', 'ProjectController@notstarted')->name('projects.notstarted');
Route::get('projects/completed', 'ProjectController@completed')->name('projects.completed');
Route::get('projects/halt', 'ProjectController@halt')->name('projects.halt');
Route::get('projects/in-progress', 'ProjectController@inprogress')->name('projects.inprogress');
Route::get('projects/all', 'ProjectController@all')->name('projects.all');
Route::get('projects/stopped', 'ProjectController@stopped')->name('projects.stopped');

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
//Route::delete('materialrequest/destroy/{id}', 'MaterialRequestController@destroy')->name('requests.destroy');

//Route::post('materialrequest/test/{id}','MaterialRequestController@tester')->name('test.request');
 
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

Route::get('users/profile/{id}', 'UserController@profile')->name('users.profile'); 


//-----------------------------------Labor Management--------------------------------------//

Route::resource('labors', 'LaborController');
Route::get('/search_labor', 'LaborController@search_labor');
//Route::get('labors/index', 'LaborController@index')->name('labors.index');
Route::get('/labors/create', 'LaborController@create')->name('labors.create');


//-----------------------------------Supplier Management-----------------------------------//

Route::resource('suppliers', 'SupplierController');
Route::get('/search_supplier', 'SupplierController@search_supplier');
Route::get('suppliers', 'SupplierController@index')->name('suppliers.all');
Route::get('user/table', 'HomeController@datatable');

//_______________________________User Management___________________________________//
Route::get('useer', 'HomeController@usermanagement');


//________________________________User Management___________________________________//

Route::get('starter', 'HomeController@starter')->name('starter');
Route::get('profile', 'HomeController@profile')->name('profile');
Route::post('profile/image', 'HomeController@updateImage')->name('profile.image');


