<?php

namespace App\Http\Controllers;

use App\labor;
use Illuminate\Http\Request;
use DB;

class LaborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('labors/index');
        // return view('labors/index', compact('labors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labors/add_labor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([ $request, 
            'lab_name' => 'required',
            'lab_cnic' => 'required',
            'lab_phone' => 'required',
            'lab_address' => 'required',
            'lab_city' => 'required',
            'lab_rate' => 'required'
        ]);

        $labors = new Labor([
            'name' => $request->get('lab_name'),
            'cnic' => $request->get('lab_cnic'),
            'phone' => $request->get('lab_phone'),
            'address' => $request->get('lab_address'),
            'city' => $request->get('lab_city'),
            'rate' => $request->get('lab_rate')
        ]);
        $labors->save();

        return redirect('labors/index')->with('success', 'New project has created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $labors = Labor::paginate(10);
        return view('labors.index',compact('labors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\labor  $labor
     * @return \Illuminate\Http\Response
     */
public function search_labor(Request $request)
    {
        //$users = User::all();
        $search = $request->get('search_name');
        $search_phone = $request->get('search_phone');
        if (!is_null($search)) 
        {
            $labors = DB::table('labors')->where('name','like','%'.$search.'%')->paginate(20);
            return view('labors/index', ['labors' => $labors]);
        }
        if (!is_null($search_phone)) 
        {
            $labors = DB::table('labors')->where('phone','like','%'.$search_phone.'%')->paginate(20);
            return view('labors/index', ['labors' => $labors]);
        }
        else
        {
            $labors = Labor::paginate(20);
            return view('labors/index', ['labors' => $labors]);

        }
        
    }

    public function edit($id)
    {
        $labors = Labor::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($labors == null || count($labors) == 0)
         {
            return redirect()->intended('labors/index');
        }
        //$users = User::paginate(10);
        return view('labors/edit', ['labors' => $labors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lab_name' => 'required',
            'lab_address' => 'required',
            'lab_city' => 'required',
            'lab_cnic' => 'required',
            'lab_contact' => 'required',
            'lab_rate' => 'required',
           // 'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);
        $labors = Labor::find($id);
        $labors->name = $request->input('lab_name');
        $labors->address = $request->input('lab_address');
        $labors->city = $request->input('lab_city');
        $labors->cnic = $request->input('lab_cnic');
        $labors->phone = $request->input('lab_contact');
        $labors->rate = $request->input('lab_rate');
            //'role_id' => $request->input('user_role'),
           // 'profile_image'=> $request->input('profile_image')
        $labors->save();
        return redirect()->route('labors.index')->with('success','Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\labor  $labor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Labor::where('id', $id)->delete();
        return redirect()->intended('labors/index');
    }
}
