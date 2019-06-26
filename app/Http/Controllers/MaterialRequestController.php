<?php

namespace App\Http\Controllers;

use App\MaterialRequest;
use Illuminate\Http\Request;
use DB;
use Validator;

class MaterialRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materialrequests = DB::table('material_requests')->get()->all();
        return view('materialrequest/index', compact('materialrequests'));
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
     * @param \App\MaterialRequest $materialRequest
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialRequest $materialRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\MaterialRequest $materialRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialRequest $materialRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\MaterialRequest $materialRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialRequest $materialRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\MaterialRequest $materialRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialRequest $materialRequest)
    {
        //
    }
}
