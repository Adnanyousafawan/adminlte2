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
        $projects = DB::table('projects')->get();
        return view('expenses/allexpenses', compact('expenses', 'projects'));
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

            if ($request['project_id'] == 0) {
                $others = 1;
                $project_id = null;
            } else {
                $others = 0;
                $project_id = $request['project_id'];
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

            for ($count = 0; $count < count($name); $count++) {
                $obj = new MiscellaneousExpense([
                    'name' => $name[$count],
                    'description' => $description[$count],
                    'project_id' => $project_id,
                    'expense' => $expenses[$count],
                    'others' => $others,
                    'expense_number' => $expense_number,
                ]);

                $obj->save();
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
            $projects = DB::table('projects')->get();
        }
        if (Gate::allows('isManager')) {
            $projects = DB::table('projects')->where('projects.assigned_by', '=', Auth::user()->id)->get();
        }
        return view('expenses/create', compact('projects'));
    }

    public function destroy($id)
    {
        MiscellaneousExpense::where('id', $id)->delete();
        return redirect()->intended('expenses')->with('success', 'Record Successfully Deleted.');
    }
}
