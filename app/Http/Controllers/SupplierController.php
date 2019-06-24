<?php

namespace App\Http\Controllers;

use App\supplier;
use Illuminate\Http\Request;
use DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = DB::table('suppliers')->paginate(10);
        return view('suppliers/index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers/add_supplier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([$request,
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        $supplier = new Supplier([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'city' => $request->get('city')
           
        ]);
        $supplier->save();

        return redirect('suppliers/index')->with('success', 'New project has created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $suppliers = Supplier::paginate(20);
        return view('suppliers/index', compact('suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function search_supplier(Request $request)
    {
        //$users = User::all();
        $search = $request->get('search_name');
        $search_material = $request->get('search_material');
        if (!is_null($search)) {
            $suppliers = DB::table('suppliers')->where('name', 'like', '%' . $search . '%')->paginate(10);
            return view('suppliers/index', ['suppliers' => $suppliers]);
        }
        if (!is_null($search_material)) {
            $suppliers = DB::table('suppliers')->where('material', 'like', '%' . $search_material . '%')->paginate(10);
            return view('suppliers /index', ['suppliers' => $suppliers]);
        } else {
            $suppliers = Supplier::paginate(20);
            return view('suppliers/index', ['suppliers' => $suppliers]);
        }
    }

    public function edit($id)
    {
        $suppliers = Supplier::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($suppliers == null || count($suppliers) == 0) {
            return redirect()->intended('/suppliers/index');
        }
        //$users = User::paginate(10);
        return view('suppliers/edit', ['suppliers' => $suppliers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([$request,
            'name' => 'required',
           
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required'
            
        ]);

        $suppliers = Supplier::find($id);
        $suppliers->name = $request->get('name');
        $suppliers->phone_number = $request->get('phone');
        $suppliers->address = $request->get('address');
        $suppliers->city = $request->get('city');
        $suppliers->save();
        return redirect()->route('suppliers.index')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::where('id', $id)->delete();
        return redirect()->intended('suppliers/index');
    }
}
