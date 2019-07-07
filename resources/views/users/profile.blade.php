@extends('adminlte::page')
@can('isAdmin')
@section('title', 'Users')
@endcan
@can('isManager')
@section('title', 'Contractors')
@endcan
@include('common')
@yield('meta_tags')
@section('content')
@yield('error_logs')
@yield('breadcrumbs') 
 

<div class="box" style="padding: 5%;background-color: #f4f4f487;"> 
<div class="row">
                    <div class="col-md-5 col-md-offset-0 col-sm-5 col-lg-5 col-lg-offset-0">

                        <div class="box box-primary" >
                            <div class="box-body box-profile">
                                 <img style="min-width: 50%; max-width: 50%; min-height: 100px; max-height: 200px; margin-top: 20px; margin-left: 25%;" class=" img-responsive" src="/storage/{{ $users->profile_image }}" alt="User Image">
                                <h3 class="profile-username text-center"> {{ $users->name }}</h3>
                                <p class="text-muted text-center"> {{ $users->role_id }} </p>
                                
                                <hr>
                                <strong><i class="fa fa-book margin-r-5"></i>Address</strong>
                                <b><p style="margin-left: 40px;" class="text-muted float-right">
                                      {{ $users->address }}
                                     </p>
                                </b>
                                    <div class="box-body">

                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>Email</b> <a class="pull-right"> {{ $users->email }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Phone</b> <a
                                                    class="pull-right">   {{ $users->phone }} </a>
                                            </li>

                                            <li class="list-group-item">
                                                 <b>CNIC</b> <a
                                                    class="pull-right"> {{ $users->cnic }} </a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Joining Date</b> <a
                                                    class="pull-right"> {{ $users->created_at }}</a>
                                            </li>
                                        </ul>
                                        <!-- /.box-body -->
                                    </div>
 
                                    <a href="{{ route('users.edit', ['id' => $users->id]) }}"
                                       class="btn btn-primary btn-block"><b>Edit</b></a>
                            </div>
                             <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
<div class="col-md-7 col-sm-7 col-lg-7 col-xs-12" style="height: 250px; margin-bottom: 20px">  
   
               {!! 
                $pie_chart->html() 
                !!}
    </div>
 <div class="col-md-7 col-lg-7 col-sm-7">
                        <div class="box box-primary" style="">
                            <div class="box-header with-border">
                                <h3 class="box-title">Project History</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Current Project</b> <a class="pull-right">5</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Previous Projects</b> <a class="pull-right">In Progress</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Completed Projects</b> <a class="pull-right">2</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Projects Overtime</b> <a class="pull-right">5</a>
                                    </li>


                                </ul>
                            </div> <!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>


 <div class="row" style="padding: 0px;"> 
               

                {{-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  col-xl-4" style="padding: 0px;">
                    <div class="col-xs-12 col-md-12 col-sm-12  col-lg-12 col-xl-12">
                        <div class="box"  style="margin-bottom: 13px;">
                            <div class="box-header">
                                <h2 class="box-title">Working Labor</h2>
                                <span class="info-box-number label label-warning pull-right"
                                      style="margin-top: 0px; font-size: 16px;">{{DB::table('labors')->where('status_id','=','1')->count('id') }}</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>

                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="box"  style="margin-bottom: 13px;">
                            <div class="box-header">
                                <h2 class="box-title">Available Labor</h2>
                                <span class="info-box-number label label-success pull-right"
                                      style="margin-top: 0px; font-size: 16px;">{{DB::table('labors')->where('status_id','=','2')->count('id') }}</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="box"  style="margin-bottom: 13px;">
                            <div class="box-header">
                                <h2 class="box-title">Total Cost</h2>
                                <span class="info-box-number label  label-danger pull-right"
                                      style="margin-top: 0px; font-size: 16px;">{{ 1000 * DB::table('labors')->count('id') + DB::table('miscellaneous_expenses')->sum('expense')  }}</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="box"  style="margin-bottom: 14px;">
                            <div class="box-header">
                                <h2 class="box-title">Total Projects</h2>
                                <span class="info-box-number label label-info pull-right"
                                      style="margin-top: 0px; font-size: 16px;">{{ DB::table('projects')->count('id')}}</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="box"  style="margin-bottom: 14px;">
                            <div class="box-header">
                                <h2 class="box-title">Current Projects</h2>
                                <span class="info-box-number label label-info pull-right"
                                      style="margin-top: 0px; font-size: 16px;">{{ DB::table('projects')->where('status_id','=','1')->count('id')}}</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                </div>
            </div> --}}

 
  {{-- _________________________________All Projects DataTable_____________________________________--}}
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12 col-md-offset-0 col-lg-offset-0 col-xl-offset-0" style="padding-left: 0px; padding-right: 0px; padding: 3%;" 
         >
        <div class="box" style="margin-bottom: 10px; padding-left: 10px; padding-right: 10px;">
            <div class="box-header with-border">
                <div class="row">
                <h4><span class="box-title col-md-8">Project Record</span></h4>
                </div>
            </div>

            <div class="table-responsive" style="margin-top: 10px; ">
                <table class="table no-margin table-bordered table-striped project">
                    <thead>
                    <tr>
                        {{-- <th style="max-width: 10px;"></th> --}}
                        
                        <th>Project ID</th>
                        <th>Project Title</th>
                        <th>Owner Name</th>
                        <th>Status</th>
                        <th>Budget</th>
                        <th>Cost Spent</th>
                        <th style="min-width: 65px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($projects as $project)
                        <tr>
                            {{-- <td style="max-width: 10px;"><b>PR-</b></td> --}}
                            <td>0000{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->customer_id }}</td>
                            <td>{{ $project->status_id}}</td>
                            <td>{{ $project->estimated_budget}}</td>
                            <td>25000</td>
                            <td style="min-width: 65px;">

                                <div class="btn-group">

                                    <button class="btn btn-sm btn-success" type="button">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle"
                                            type="button">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"><i
                                                    class="fa fa-edit"></i>View</a></li>

                                        <li><a href="{{ route('projects.edit', ['id' => $project->id]) }}"><i
                                                    class="fa fa-edit"></i>Edit</a></li>

                                        <li><a type="links" data-toggle="modal"
                                               data-target="#applicantDeleteModal-{{ $project->id }}"><i
                                                    class="fa fa-remove"></i>Delete</a></li>
                                    </ul>

                                </div>
                                {{--   <a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"
                                     style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">View</a>

                                  <a type="links" href="{{ route('projects.edit', ['id' => $project->id]) }}"
                                     style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                                  <a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $project->id }}"
                                     style="color: red; margin-left: 3px;  margin-top: 0px;">Delete</a> --}}

                            </td>
                        </tr>


                        {{-- ______________________________Delete Modal ______________________________________________--}}

                        <div id="applicantDeleteModal-{{ $project->id }}" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                             style="display: none;">
                            <div class="modal-dialog"
                                 style="min-width:40%; align-content: center; text-align: center;">
                                <div class="modal-content">
                                    <form class="row" method="POST"
                                          action="{{ route('projects.destroy', ['id' => $project->id]) }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <form action="{{ route('projects.destroy', ['id' => $project->id]) }}"
                                              method="POST" class="remove-record-model">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×
                                                </button>
                                                <h4 class="modal-title text-center"
                                                    id="custom-width-modalLabel">Delete Project Record</h4>
                                            </div>
                                            <div class="modal-body">
                                                @yield('delete_modal')

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect"
                                                        data-dismiss="modal">Close
                                                </button>
                                                <button type="submit"
                                                        class="btn btn-danger waves-effect remove-data-from-delete-form">
                                                    Delete
                                                </button>
                                            </div>


                                        </form>

                                    </form>

                                </div>
                            </div>
                        </div>

                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>




    {{-- _______________________________________Model Add New PROJECT_______________________________--}}

    <div id="applicantADDModal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="min-width:70%; align-content: center; ">
            <div class="modal-content">

                <form method="post" action="{{ route('projects.store') }}" enctype="multipart/form-data">

                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close pull-right" data-dismiss="modal"
                                aria-hidden="true">x
                        </button>
                        <strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add
                                Project</h3></strong>
                    </div>
                    <div class="modal-body">

                        @yield('add_form_project')

                    </div>


                </form>
            </div>
        </div>
    </div>





                    </div>

                </div>

    {!! Charts::scripts() !!}
 

    {!! $pie_chart->script() !!}

@yield('datatable_stylesheets')
@yield('datatable_script')
@endsection