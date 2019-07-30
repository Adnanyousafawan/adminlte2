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
                'suppliers.balance as balance_status', 'supplier_payments.created_at')
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

                $supplier_blnc = DB::table('suppliers')->where('id','=',$supplier_id)->pluck('balance')->first();
                $supplier_blnc = $supplier_blnc + $paid_amount[$count];

                DB::table('suppliers')->where('id','=',$supplier_id)->update([
                        'balance' => $supplier_blnc]);

                $check = DB::table('company_balance')->count();
                if($check != 0)
                {
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc - $paid_amount[$count];
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                        'balance' => $company_balance]);
                }
                else
                {
                    DB::table('company_balance')
                        ->insert([
                        'balance' => 0 ]);
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc - $paid_amount[$count];
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                        'balance' => $company_balance]);
                }
            }

            // DB::table('order_details')->insert($data);
            return response()->json([
                    'success' => 'Supplier payment added successfully.']
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
        $payments = SupplierPayment::find($id);

        $temp = $payments->paid;
        $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
        $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
        $company_balance = $comp_blnc + $temp;

        DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
        'balance' => $company_balance]);

        $supplier_blnc_ID = DB::table('supplier_payments')->where('id','=',$payments->id)->pluck('supplier_id')->first();
        $supplier_blnc = DB::table('suppliers')->where('id','=',$supplier_blnc_ID)->pluck('balance')->first();

        $supplier_balance = $supplier_blnc - $temp;

        DB::table('suppliers')->where('id','=',$supplier_blnc_ID)->update([
                        'balance' => $supplier_balance]);
        SupplierPayment::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Payment Deleted Succuessfully.');
    }
}
