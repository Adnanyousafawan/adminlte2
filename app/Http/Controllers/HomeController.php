<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function createproject()
    {
        return view('projects/create');
    }

    public function addcontractor()
    {
        return view('contractors/add_contractor');
    }

    public function addlabor()
    {
        return view('labors/add_labor');
    }

    public function addmanager()
    {
        return view('managers/add_manager');
    }

     public function addsupplier()
    {
        return view('suppliers/add_supplier');
    }
     public function starter()
    {
        return view('starter');
    }
     public function usermanagement()
    {
        return view('user_management');
    }
}