<?php

namespace App\Http\Controllers;

use App\SupplierPayment;
use Illuminate\Http\Request;
use Gate;
use DB;
use Validator;

class SupplierPaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
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
        // $payments = DB::table('customer_payments')->get();

        //$projects = DB::table('Projects')->where('id','=',$payment->project_id)->pluck('title')->first()
        $payments = DB::table('supplier_payments')
            ->leftJoin('suppliers', 'supplier_payments.supplier_id', '=', 'suppliers.id')
            ->select('supplier_payments.id', 'suppliers.id as supplier_id', 'suppliers.name', 'supplier_payments.paid',
                'supplier_payments.payable', 'supplier_payments.created_at','supplier_payments.payable')
            ->get();


        return view('payments/supplierpayments', compact('payments'));
    }
    public function insert(Request $request)
    {

        if ($request->ajax()) {
            $rules = array(
                'supplier_id.*' => 'required',
                'paid_amount.*' => 'required',
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }
 
            $supplier_id = $request['supplier_id'];
            $paid_amount = $request['paid_amount'];

            // $receivable = DB::table()
            // dd($received_amount);

            for ($count = 0; $count < count($paid_amount); $count++) {
                //  return response()->json($item_id[$count]);
                $obj = new SupplierPayment([
                    'paid' => $paid_amount[$count],
                    'supplier_id' => $supplier_id[$count],
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = DB::table('suppliers')->get();
        return view('payments/add_supplier_payment', ['suppliers' => $suppliers]);
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
     * @param \App\supplier_payments $supplier_payments
     * @return \Illuminate\Http\Response
     */
    public function show(supplier_payments $supplier_payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\supplier_payments $supplier_payments
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier_payments $supplier_payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\supplier_payments $supplier_payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'paid_amount' => 'required',
        ]);

        $payments = SupplierPayment::find($id);
        $payments->paid = $request->input('paid_amount');

        if ($payments->save()) {
            return redirect()->back()->with('success', "Payment Updated successfully");
        } else {
            return redirect()->back()->with('message', "Payment is not Updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\supplier_payments $supplier_payments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SupplierPayment::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Payment Deleted Succuessfully.');
    }
}
