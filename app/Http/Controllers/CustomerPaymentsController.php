<?php
 
namespace App\Http\Controllers;

use App\CustomerPayment;
use App\CompanyBalance;
use Illuminate\Http\Request;
use Gate;
use DB;
use Validator;
use Auth;
class CustomerPaymentsController extends Controller
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
        // $payments = DB::table('customer_payments')->get();

        //$projects = DB::table('Projects')->where('id','=',$payment->project_id)->pluck('title')->first()
       if(Gate::allows('isAdmin'))
       {
         $payments = DB::table('customer_payments')
            ->leftJoin('projects', 'customer_payments.project_id', '=', 'projects.id')
            ->select('customer_payments.id', 'projects.id as project_id', 'projects.title', 'customer_payments.received', 
                'customer_payments.created_at', 'projects.estimated_budget as budget')
            ->get();
       }
       if(Gate::allows('isManager'))
       {
         $payments = DB::table('customer_payments')
            ->leftJoin('projects', 'customer_payments.project_id', '=', 'projects.id')
            ->where('projects.assigned_by','=',Auth::user()->id)
            ->select('customer_payments.id', 'projects.id as project_id', 'projects.title', 'customer_payments.received', 
                'customer_payments.created_at', 'projects.estimated_budget as budget')
            ->get();
       }
        //dd($expenses);
        return view('payments/customerpayments', compact('payments'));
    }

    public function insert(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'project_id.*' => 'required',
                'received_amount.*' => 'required',
            );

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }
 

            $project_id = $request['project_id'];
            $received_amount = $request['received_amount'];
           

            for ($count = 0; $count < count($received_amount); $count++) {
                //  return response()->json($item_id[$count]);
                $obj = new CustomerPayment([
                    'received' => $received_amount[$count],
                    'project_id' => $project_id[$count],
                ]);
                $obj->save();

                $proj_blnc = DB::table('projects')->where('id','=',$project_id)->pluck('project_balance')->first();
                $project_balance = $proj_blnc + $received_amount[$count];

                DB::table('projects')->where('id','=',$project_id)->update([
                        'project_balance' => $project_balance]);
                $check = DB::table('company_balance')->count();
                
                if($check != 0)
                {
                    $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                    $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                    $company_balance = $comp_blnc + $received_amount[$count];
                    DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                        'balance' => $company_balance]);
                }
                else
                {
                    DB::table('company_balance')
                        ->insert([
                        'balance' =>  $received_amount[$count]]);
                }
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
        if(Gate::allows('isAdmin'))
        {
             $projects = DB::table('projects')->get();
        }
        if(Gate::allows('isManager'))
        {
             $projects = DB::table('projects')->where('assigned_by','=',Auth::user()->id)->get();
        }
        return view('payments/create', ['projects' => $projects]);
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
     * @param \App\customer_payments $customer_payments
     * @return \Illuminate\Http\Response
     */
    public function show(customer_payments $customer_payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\customer_payments $customer_payments
     * @return \Illuminate\Http\Response
     */
    public function edit(customer_payments $customer_payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\customer_payments $customer_payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'received' => 'required',
        ]);
        $temp = 0;
        $proj_blnc = 0;
        $payments = CustomerPayment::find($id);
        if($payments->received > $request->input('received'))
        {
            $temp = $payments->received - $request->input('received');
            $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
            $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
            $company_balance = $comp_blnc - $temp;
            

            $proj_blnc_ID = DB::table('customer_payments')->where('id','=',$id)->pluck('project_id')->first();
            $proj_blnc = DB::table('projects')->where('id','=',$proj_blnc_ID)->pluck('project_balance')->first();
            $diff = $payments->received - $request->input('received');
            $project_balance = $proj_blnc - $diff;

            DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                        'balance' => $company_balance]);
            DB::table('projects')->where('id','=',$proj_blnc_ID)->update([
                        'project_balance' => $project_balance]);

        }
        elseif ($payments->received < $request->input('received')) 
        {
            $temp = $request->input('received') - $payments->received;
            $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
            $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
            $company_balance = $comp_blnc + $temp;
           

            $proj_blnc_ID = DB::table('customer_payments')->where('id','=',$id)->pluck('project_id')->first();
            $proj_blnc = DB::table('projects')->where('id','=',$proj_blnc_ID)->pluck('project_balance')->first();
            $diff = $request->input('received') - $payments->received;
            $project_balance = $proj_blnc + $diff;
            DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                        'balance' => $company_balance]);

            DB::table('projects')->where('id','=',$proj_blnc_ID)->update([
                        'project_balance' => $project_balance]);

        }
        $payments->received = $request->input('received');
        if ($payments->save()) {
            return redirect()->back()->with('success', "Payment Updated successfully");
        } else {
            return redirect()->back()->with('message', "Payment is not Updated");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\customer_payments $customer_payments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $temp = 0;
        $proj_blnc = 0;
        $payments = CustomerPayment::find($id);
        $temp = $payments->received;

        $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
        $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
        $company_balance = $comp_blnc - $temp;
        DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
        'balance' => $company_balance]);

        $proj_blnc_ID = DB::table('customer_payments')->where('id','=',$payments->id)->pluck('project_id')->first();
        $proj_blnc = DB::table('projects')->where('id','=',$proj_blnc_ID)->pluck('project_balance')->first();

        $project_balance = $proj_blnc - $temp;
        DB::table('projects')->where('id','=',$proj_blnc_ID)->update([
                        'project_balance' => $project_balance]);
        CustomerPayment::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Payment Deleted Succuessfully.');
    }
}
