<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use DB;
use Validator;
use Gate;

class ItemController extends Controller
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
        $items = DB::table('items')
        ->leftjoin('suppliers','suppliers.id','=','items.supplier_id')
        ->select('items.id','items.name','items.purchase_rate','items.selling_rate','items.unit','suppliers.id as supplier_id','suppliers.name as supplier_name')
        ->get();
        $suppliers = DB::table('suppliers')->get();
        return view('items/index', compact('items','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function insert(Request $request)
    {

        if ($request->ajax()) {
            $rules = array(
                'name.*' => 'required',
                'purchase_rate.*' => 'required',
                'unit.*' => 'required',
                'supplier_id.*' => 'required',
                'selling_rate.*' => 'required'
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $name = $request['name'];
            $supplier_id = $request['supplier_id'];
            $purchase_rate = $request['purchase_rate'];
            $selling_rate = $request['selling_rate'];
            $unit = $request['unit'];
            // $rate = $request->rate

            //$insert_data = array();
            for ($count = 0; $count < count($name); $count++) {
                //  return response()->json($item_id[$count]);
                $obj = new Item([
                    'name' => $name[$count],
                    //DB::table('items')->where('name','=',  $name[$count])->pluck('id')->first(),
                    'purchase_rate' => $purchase_rate[$count],
                    'selling_rate' => $selling_rate[$count],
                    'unit' => $unit[$count],
                    'supplier_id' => DB::table('suppliers')->where('name', '=', $supplier_id)->pluck('id')->first(),

                ]);

                //dd($obj);
                $obj->save();
            }

            // DB::table('order_details')->insert($data);
            return response()->json([
                    'success' => 'Data Added successfully.']
            );
        }
    }


    public function create()
    {

        $suppliers = DB::table('suppliers')->get();
        return view('items/create', ['suppliers' => $suppliers]);

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
     * @param \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'item_name' => 'required',
            'supplier_id' => 'required',
            'purchase_rate' => 'required',
            'selling_rate' => 'required',
            'unit' => 'required',
        ]);

        $items = Item::find($id);

        $items->name = $request->input('item_name');
        $items->supplier_id = $request->input('supplier_id');
        $items->purchase_rate = $request->input('purchase_rate');
        $items->selling_rate = $request->input('selling_rate');
        $items->unit = $request->input('unit');
        if ($items->save()) {
            return redirect()->back()->with('success', "Order Updated successfully");
        } else {
            return redirect()->back()->with('message', "Order is not Updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $request_count = DB::table('material_requests')->where('item_id', '=', $id)->count();
        $orders = DB::table('order_details')->where('item_id', '=', $id)->count();
        if ($orders <= 0) {
            if ($request_count <= 0) {
                Item::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Item Deleted Succuessfully.');

            } else {
                return redirect()->back()->with('message', 'Request Exists. Please delete Material Request from project first');
            }
        } else {
            return redirect()->back()->with('message', 'Orders Exists. Please delete Orders from project first');
        }


    }
}
