<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use DB;
use Gate;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        $customers = DB::table('customers')->get();
        return view('customers/allcustomers', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function goBackToHome()
    {
        $check = DB::table('roles')->get()->count();
        if ($check == 0)
        {
            $date = Carbon::now();
                DB::table('roles')->insert([
                    ['name' => 'Admin','created_at'=> $date , 'updated_at'=> $date],
                    ['name' => 'Manager','created_at'=> $date , 'updated_at'=> $date],
                    ['name' => 'Contractor','created_at'=> $date , 'updated_at'=> $date]
                    ]); 
        }
        $check = DB::table('users')->get()->count();
        if ($check == 0)
        {
            $rollID = DB::table('roles')->where('name','=','Admin')->pluck('id')->first();
            $date = Carbon::now();
                DB::table('users')->insert([
                    ['name' => 'Admin','email'=>'admin@cstms.com','role_id'=>$rollID,'password'=>'$2y$10$UzENq9Ls52fSOPyj2aSONekXSCE3qDPhTEIJxV/fHIVKEHFQp61aO','created_at'=> $date , 'updated_at'=> $date]
                    ]);
        }
        return view('welcome');
    }
}
