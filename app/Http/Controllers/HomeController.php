<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MiscellaneousExpense;

use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use View;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Project;
use Gate;
use Charts;


class HomeController extends Controller
{
    use UploadTrait;

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

    public function goBackToHome()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        return view('welcome');
    }

    public function index()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        $check = DB::table('projects')->get()->count();
        if ($check == 0) {
            return view('firstview');
        } else {
            if (Gate::allows('isManager')) {
                //_________________________ Dashboard Boxes Count _____________________________________
                $status_id = DB::table('project_status')->where('name', '=', 'Completed')->pluck('id')->first();
                $completed_projects = DB::table('projects')->where('status_id', '=', $status_id)
                    ->where('assigned_by', '=', Auth::User()->id)->count();
                if ($status_id == 0) {
                    $current_projects = DB::table('projects')->where('status_id', '!=', $status_id)
                        ->where('assigned_by', '=', Auth::User()->id)
                        ->count();
                    $projects = DB::table('projects')->where('assigned_by', '=', Auth::User()->id)->get();
                    //dd($projects);
                    
                    $expense = 0;
                    $expenses = 0;
                    $orders = 0;
                    foreach ($projects as $project) {
                        $expense = DB::table('miscellaneous_expenses')->where('project_id', '=', $project->id)->pluck('expense')->first();
                      
                        if ($expense == 0) {
                            $expense = 0;
                        } else {
                            $expense = $expense + $expenses;
                            $expenses = $expense;
                        }
                    }
                    //dd($expense);
                    $total_contractors = DB::table('users')->where('id', '=', 3)->count();

                    //$completed_projects = DB::table('projects')->where('status_id', '=', $status_id)->count();

                    //_______________________________________________________________________________________
                    $orders = DB::table('order_details')->paginate(5);


                    //_________________________ Monthly Graph _______________________________________________

                    //____________________________ $expense = MiscellaneousExpense::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
        $chart = Charts::database($expense, 'bar', 'highcharts')
            ->title("Expense Details")
            ->elementLabel("Company Expenses")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupByMonth(date('Y'), true);

            //___________________________________________________________

                    //_______________ ____________ Material List _____________________________________________


                    //_______________________________________________________________________________________

                    //____________________________Current Projects___________________________________________


                    //_______________________________________________________________________________________


                    //____________________________Order Details______________________________________________


                    //_______________________________________________________________________________________


                    //____________________________Users Box__________________________________________________

                    // $total_free_contractors = DB::table('users')->where('id','=',3)->count();
                    // $working_contractors =

                    //_______________________________________________________________________________________


                    //DB::table()->where('status_id','=',$status_id)->get()->count();

                    // dd($completed_projects);
                    return view('home', compact('projects', 'total_contractors', 'completed_projects', 'current_projects', 'expenses', 'orders','chart'));
                }
            }
            if (Gate::allows('isAdmin')) {
                $status_id = DB::table('project_status')->where('name', '=', 'Completed')->pluck('id')->first();
                $completed_projects = DB::table('projects')->where('status_id', '=', $status_id)
                    //->where('assigned_by','=',Auth::User()->id)
                    ->count();
                if ($status_id == 0) {
                    $current_projects = DB::table('projects')->where('status_id', '!=', $status_id)
                        //->where('assigned_by','=',Auth::User()->id)
                        ->count();
                    $projects = DB::table('projects')
                        //->where('assigned_by','=',Auth::User()->id)
                        ->get();
                    //dd($projects);
                    //       --------------------------------Need to separate company expense and projects ===========

                    $expenses = DB::table('miscellaneous_expenses')
                        ->where('project_id', '!=', null)
                        ->sum('expense');
                    $temp = 0;
                    $material_profit = 0;
                   $checking = DB::table('order_details')
                   ->leftjoin('items','items.id','=','order_details.item_id')
                   ->select('order_details.quantity','order_details.set_rate','items.purchase_rate')
                   ->get();
                   foreach($checking as $check)
                   {
                        $temp = ($check->set_rate*$check->quantity) - ($check->purchase_rate*$check->quantity);
                        $material_profit = $temp + $material_profit;
                   }
                    $company_expense = DB::table('miscellaneous_expenses')
                        ->where('others', '=', 1)
                        ->sum('expense');

                   $company_balance = $material_profit - $company_expense;
                     //dd($balance);
                   
                    //dd($expense);
                    $total_contractors = DB::table('users')->where('role_id', '=', 3)->count();
                    //$completed_projects = DB::table('projects')->where('status_id', '=', $status_id)->count();
                    //_______________________________________________________________________________________
                    $orders = DB::table('order_details')->paginate(5);

                    //____________________________Users Box__________________________________________________

                    // $total_free_contractors = DB::table('users')->where('id','=',3)->count();
                    // $working_contractors =

                    //_______________________________________________________________________________________
                 $expense = MiscellaneousExpense::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
                        $chart = Charts::database($expense, 'bar', 'highcharts')
                            ->title("Expense Details")
                            ->elementLabel("Project Expense")
                            ->dimensions(1000, 500)
                            ->responsive(true)
                            ->groupByMonth(date('Y'), true);

                        $pie_chart = Charts::create('pie', 'highcharts')
                            ->title('Pie Chart Demo')
                            ->labels(['Company Balance', 'Company Expenses', 'Receivable'])
                            ->values([$company_balance, $company_expense, 50])
                            ->dimensions(1000, 500)
                            ->responsive(true);

                    //DB::table()->where('status_id','=',$status_id)->get()->count();

                    // dd($completed_projects);
                    return view('home', compact('projects', 'total_contractors', 'completed_projects', 'current_projects', 'expenses', 'orders', 'company_balance','company_expense','chart','pie_chart'));
                }
            }
        }
    }
    public function addcontractor()
    {
        return view('contractors/add_contractor')->with('success', 'New Contractor has been added');
    }

    public function addlabor()
    {
        return view('labors/add_labor');
    }

    public function addmanager()
    {
        return view('managers/add_manager');
    }

    public function addsupplier()
    {
        return view('suppliers/add_supplier');
    }

    public function starter()
    {
        return view('starter');
    }

    public function usermanagement()
    {
        return view('user_management');
    }


    public function profile()
    {
        if (Gate::allows('isContractor')) {
            abort(420, 'You Are not Allowed to access this site');
        }
        return view('profile');

    }


    public function updateImage(Request $request)
    {

        $user = User::findOrFail(auth()->user()->id);
        $user->name = Auth::user()->name;

        $request->validate([
            'name' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);


        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('name')) . '-' . time();
            // Define folder path
            $folder = 'images/profile/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            //delete previously stored image
            $this->deleteOne('public', Auth::user()->profile_image);
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;
        }

        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }
}
