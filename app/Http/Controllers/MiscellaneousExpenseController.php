<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\MiscellaneousExpense;
use Validator;
use View;
use Gate;
use Auth;

class MiscellaneousExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isManager')) {
            $expenses = DB::table('miscellaneous_expenses')
                ->leftjoin('projects', 'projects.id', '=', 'miscellaneous_expenses.project_id')
                ->where('projects.assigned_by', '=', Auth::user()->id)
                ->where('miscellaneous_expenses.project_id', '!=', null)
                ->select('miscellaneous_expenses.id', 'projects.title', 'miscellaneous_expenses.project_id', 'miscellaneous_expenses.expense', 'miscellaneous_expenses.name', 'miscellaneous_expenses.description', 'miscellaneous_expenses.created_at')
                ->get();
        }
        if (Gate::allows('isAdmin')) {
            $expenses = DB::table('miscellaneous_expenses')
                ->leftjoin('projects', 'projects.id', '=', 'miscellaneous_expenses.project_id')
                ->where('miscellaneous_expenses.project_id', '!=', null)
                ->select('miscellaneous_expenses.id', 'projects.title', 'miscellaneous_expenses.project_id', 'miscellaneous_expenses.expense', 'miscellaneous_expenses.name', 'miscellaneous_expenses.description', 'miscellaneous_expenses.created_at')
                ->get();
        }
            $project_status_ID = DB::table('project_status')->where('name','=','Completed')->pluck('id')->first();
            $projects = DB::table('projects')->where('status_id','!=',$project_status_ID)->get();

        return view('expenses/allexpenses', compact('expenses','projects' ));
    }

    function company_expense()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isManager')) {
            $expenses = DB::table('miscellaneous_expenses')
                ->leftjoin('projects', 'projects.id', '=', 'miscellaneous_expenses.project_id')
                ->where('projects.assigned_by', '=', Auth::user()->id)
                ->where('miscellaneous_expenses.others', '=', 1)
                ->select('miscellaneous_expenses.id', 'miscellaneous_expenses.project_id', 'miscellaneous_expenses.expense', 'miscellaneous_expenses.name', 'miscellaneous_expenses.description', 'miscellaneous_expenses.created_at')
                ->get();
        }
        if (Gate::allows('isAdmin')) {
            $expenses = DB::table('miscellaneous_expenses')
                ->leftjoin('projects', 'projects.id', '=', 'miscellaneous_expenses.project_id')
                ->where('miscellaneous_expenses.others', '=', 1)
                ->select('miscellaneous_expenses.id', 'miscellaneous_expenses.project_id', 'miscellaneous_expenses.expense', 'miscellaneous_expenses.name', 'miscellaneous_expenses.description', 'miscellaneous_expenses.created_at')
                ->get();
        }

        return view('expenses/company_expense', compact('expenses'));
    }


    function insert(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'name.*' => 'required',
                'project_id*' => 'required',
                'description.*' => 'required',
                'expenses.*' => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $name = $request['name'];
            $description = $request['description'];
            $expenses = $request['expenses'];

            $expense_number = DB::table('miscellaneous_expenses')->pluck('expense_number')->last();
            if ($expense_number == 0) {
                $expense_number = 1000;
            } else {
                $expense_number++;
            }
            if ($request['project_id'] == 0) {
                $others = 1;
                $project_id = null;
            } 
            else {
                $others = 0;
                $project_id = $request['project_id'];
            }
            for ($count = 0; $count < count($name); $count++) {
                $obj = new MiscellaneousExpense([
                    'name' => $name[$count],
                    'description' => $description[$count],
                    'project_id' => $project_id,
                    'expense' => $expenses[$count],
                    'others' => $others,
                    'expense_number' => $expense_number,
                ]);
            
                if($obj->save())
                {
                    if ($request['project_id'] == 0) 
                    {
                        $check = DB::table('company_balance')->count();
                        if($check != 0)
                        {
                            $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                            $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                            $company_balance = $comp_blnc - $expenses[$count];
                            DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                                'balance' => $company_balance]);

                        }
                        else
                        {
                            DB::table('company_balance')
                                ->insert([
                                'balance' =>  $expenses[$count]]);
                        }
                    } 
                    else
                    {
                        $check = DB::table('company_balance')->count();
                        if($check != 0)
                        {
                            $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                            $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                            $company_balance = $comp_blnc - $expenses[$count];
                            DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                                'balance' => $company_balance]);

                        }
                        else
                        {
                            DB::table('company_balance')
                                ->insert([
                                'balance' =>  $expenses[$count]]);
                        }

                    $proj_spent = DB::table('projects')->where('id','=',$request['project_id'])->pluck('project_spent')->first();
                    $project_spent = $proj_spent + $expenses[$count];

                    $proj_balance_available = DB::table('projects')->where('id','=',$request['project_id'])->pluck('project_balance')->first();
                    
                    $proj_balance_available = $proj_balance_available - $expenses[$count];

                    DB::table('projects')->where('id','=',$request['project_id'])->update([
                        'project_spent' => $project_spent, 'project_balance' => $proj_balance_available]); 
                    }
                        }

            }
            return response()->json([
                'success' => 'Data Added successfully.']);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'expense' => 'required',
        ]);

        $expenses = MiscellaneousExpense::find($id);
        $expenses->project_id = $request->input('project_id');
        $expenses->name = $request->input('name');
        $expenses->description = $request->input('description');
        $expenses->expense = $request->input('expense');

        if ($expenses->save()) {
            return redirect()->back()->with('success', "Order Updated successfully");
        } else {
            return redirect()->back()->with('message', "Order is not Updated");
        }
    }
    public function update_company_expense(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'expense' => 'required',
        ]);
        $expenses = MiscellaneousExpense::find($id);

        $expenses->name = $request->input('name');
        $expenses->description = $request->input('description');
        $expenses->expense = $request->input('expense');

        if ($expenses->save()) {
            return redirect()->back()->with('success', "Order Updated successfully");
        } else {
            return redirect()->back()->with('message', "Order is not Updated");
        }
    }

    function create()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        if (Gate::allows('isAdmin')) {
            $project_status_ID = DB::table('project_status')->where('name','!=','Completed')->pluck('id')->first();
            $projects = DB::table('projects')->where('status_id','!=',$project_status_ID)->get();
        }
        if (Gate::allows('isManager')) {
            $project_status_ID = DB::table('project_status')->where('name','!=','Completed')->pluck('id')->first();
            $projects = DB::table('projects')->where('projects.assigned_by', '=', Auth::user()->id)->where('status_id','!=',$project_status_ID)->get();
        }
        return view('expenses/create', compact('projects'));
    }

    public function destroy($id)
    {
        $old_expense =  MiscellaneousExpense::find($id);

                    if ($old_expense->others == 1) 
                    {
                        $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                        $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                        $company_balance = $comp_blnc + $old_expense->expense;
                        DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                                'balance' => $company_balance]);
                    } 
                    else
                    {   
                        $comp_blnc_ID = DB::table('company_balance')->pluck('id')->last();
                        $comp_blnc = DB::table('company_balance')->where('id','=',$comp_blnc_ID)->pluck('balance')->first();
                        $company_balance = $comp_blnc + $old_expense->expense;
                        DB::table('company_balance')->where('id','=',$comp_blnc_ID)->update([
                                'balance' => $company_balance]);

                        $proj_spent = DB::table('projects')->where('id','=',$old_expense->project_id)->pluck('project_spent')->first();
                        $project_spent = $proj_spent - $old_expense->expense;

                        $proj_balance_available = DB::table('projects')->where('id','=',$old_expense->project_id)->pluck('project_balance')->first();
                        $proj_balance_available = $proj_balance_available + $old_expense->expense;;

                        DB::table('projects')->where('id','=',$old_expense->project_id)->update([
                            'project_spent' => $project_spent, 'project_balance' => $proj_balance_available]); 
                    } 
        MiscellaneousExpense::where('id', $id)->delete();
        return redirect()->intended('expenses')->with('success', 'Record Successfully Deleted.');
    }
}
