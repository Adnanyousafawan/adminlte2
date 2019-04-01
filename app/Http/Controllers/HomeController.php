<?php
//setting up git project
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

    public function addproject()
    {
        return view('add_project');
    }

    public function addcontractor()
    {
        return view('add_contractor');
    }

    public function addlabor()
    {
        return view('add_labor');
    }
    public function addmanager()
    {
        return view('add_manager');
    }
     public function addvendor()
    {
        return view('add_vendor');
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
