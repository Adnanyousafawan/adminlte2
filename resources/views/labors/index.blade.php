@extends('adminlte::page')
@section('title', 'Labor Details')
@include('common')

@section('content')
    @yield('meta_tags')
    @yield('error_logs')
    @yield('breadcrumbs')


    <div class="box-body" id="screen"
         style="/*max-width: 94%; margin-left: 3%; margin-top: 1%; */padding: 0px; background-color: #f4f4f487;">
        <div class="box box-body" style=" background-color: #f4f4f487; padding: 0px;">
            <div class="box-header">
                <h3><span
                        class="col-xs-6 col-sm-6 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                        style="margin-bottom: 10px; padding: 0px;">Labor Details</span></h3>
            </div>


            <div class="row" style="padding: 0px;">
                {{-- <div class="row" style="margin-top: 30px;"> --}}
                <div
                    class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xl-offset-1 col-md-offset-1 col-lg-offset-1">
                    <div class="box" style="margin-bottom: 20px;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Labor By Projects</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin table-bordered table-striped">
                                    <tr>
                                        <th>Project ID</th>
                                        <th>Title</th>
                                        <th>Labor</th>
                                        <th>Cost</th>
                                        <th>Contractor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($labor_by_projects as $lproject)
                                        <tr>
                                            <td><a href=" {{ route('projects.view', ['id' => $lproject->id])   }}"
                                                   type="links">0000{{ $lproject->id }}</a></td>
                                            <td>{{ $lproject->title }}</td>
                                            <td>
                                                <div
                                                    class="label label-warning col-md-12">{{ 1000 * DB::table('labors')->where('project_id','=',$lproject->id)->count('id')  }}</div>
                                            </td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a"
                                                     data-height="20">2000
                                                </div>
                                            </td>
                                            <td>{{ $lproject->contractor_name }}
                                                {{-- {{ DB::table('projects')->where('assigned_to','=', $contractors->id ) }} --}}</td>

                                        </tr>
                                    @endforeach

                                    {{-- @yield('labor_by_projects') --}}
                                </table>
                            </div>
                        </div>

                        <div class="box-footer clearfix">
                            <a href="{{ route('projects.labor_by_projects')}}"
                               class="btn btn-sm btn-primary pull-right">View All
                                Labors By Projects</a>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                        {{-- Showing 1 to 2 of 2 entries --}}
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                </div>


                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  col-xl-4" style="padding: 0px;">
                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="box" style="margin-top: 0px;">
                            <div class="box-header">
                                <h2 class="box-title">Total Labor</h2>
                                <span class="info-box-number label label-primary pull-right"
                                      style="margin-top: 0px; font-size: 16px;">112</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-12 col-md-12 col-sm-12  col-lg-12 col-xl-12">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Working Labor</h2>
                                <span class="info-box-number label label-warning pull-right"
                                      style="margin-top: 0px; font-size: 16px;">80</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>

                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Available Labor</h2>
                                <span class="info-box-number label label-success pull-right"
                                      style="margin-top: 0px; font-size: 16px;">32</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Total Cost</h2>
                                <span class="info-box-number label label-danger pull-right"
                                      style="margin-top: 0px; font-size: 16px;">20,0000</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">Total Projects</h2>
                                <span class="info-box-number label label-info pull-right"
                                      style="margin-top: 0px; font-size: 16px;">20</span>
                            </div>
                            <!-- /.box-header -->
                            <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                        </div>
                        <!-- /.info-box-content -->
                        <!-- /.info-box -->
                    </div>
                </div>


            </div>
            <!-- /.col -->
            <div
                class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                style="padding: 5px;">
                <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                    <div class="box-header with-border ">
                        <h4><span class="box-title col-md-8">Labor Record</span></h4>
                        <div class="box-tools pull-right">
                            <a type="links" {{-- href="{{ route('labors.create') }}" --}}  data-toggle="modal"
                               data-target="#applicantADDModal" class="btn btn-primary pul-right">Add Labor</a>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                        <table class="table no-margin table-bordered table-striped project">
                            <thead>
                            <tr>

                                <th>Labor ID</th>
                                <th>Name</th>
                                <th>Project Id</th>
                                <th>Present</th>
                                <th>Labor Rate</th>
                                <th>Cost</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($labors as $labor)
                                <tr>
                                    <td>lb0000{{ $labor->id }}</td>
                                    <td>{{ $labor->name }}</td>
                                    <td>PR0000{{ $labor->project_id}}</td>
                                    <td>23</td>
                                    <td>{{ $labor->rate }}</td>
                                    <td>25000</td>
                                    <td>

                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-success btn-sm" type="button">
                                                Action
                                            </button>
                                            <button data-toggle="dropdown"
                                                    class="btn btn-success btn-sm dropdown-toggle"
                                                    type="button">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>

                                            <ul role="menu" class="dropdown-menu">

                                                <li><a href="{{ route('labors.edit', ['id' => $labor->id]) }}"><i
                                                            class="fa fa-edit"></i>Edit</a></li>

                                                <li><a type="links" data-toggle="modal"
                                                       data-target="#applicantDeleteModal-{{ $labor->id }}"><i
                                                            class="fa fa-remove"></i>Delete</a></li>
                                            </ul>

                                        </div>

                                    </td>
                                </tr>

                                <div id="applicantDeleteModal-{{ $labor->id }}" class="modal fade" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center; text-align: center;">
                                        <div class="modal-content">
                                            <form class="row" method="POST"
                                                  action="{{ route('labors.destroy', ['id' => $labor->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                {{-- <form action="{{ route('labors.destroy', ['id' => $labor->id]) }}"
                                                      method="POST" class="remove-record-model"> --}}
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×
                                                    </button>
                                                    <h4 class="modal-title text-center"
                                                        id="custom-width-modalLabel">Delete Labor Record</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <strong><b><h3>Are You Sure? <br>You Want Delete This Record?
                                                            </h3></b></strong>
                                                    <input type="hidden" , name="applicant_id" id="app_id">
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
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{--____________________________   This is ADD MODAL CODE  ______________________________ --}}


            <div id="applicantADDModal" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="min-width:70%; align-content: center;">
                    <div class="modal-content">
                        <form method="post" action="{{ route('labors.store') }}" enctype="">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close pull-right" data-dismiss="modal"
                                        aria-hidden="true">x
                                </button>
                                <strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add
                                        Labor</h3></strong>
                            </div>
                            <div class="modal-body">

                                <div style=" width: 100%; margin-bottom: 10px;">

                                    <div class="row">
                                        <div
                                            class="col-sm-12  col-sm-offset-0 col-xs-12 col-lg-10 col-xl-10 col-lg-offset-1 col-xl-offset-1 col-md-10 col-md-offset-1"
                                            style="/*max-width: 70%;*/ padding-bottom: 30px;">
                                            <div>
                                                <div class="box-body">

                                                    <div class="col-lg-9 col-lg-offset-2">
                                                        <div class="form-group">
                                                            <label for="name">Name <span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="name"
                                                                   name="name"
                                                                   pattern="[A-Za-z0-9\w]{2,50}"
                                                                   title="Minimum 2 letters required for Name"
                                                                   placeholder="Name" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="cnic">CNIC <span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" maxlength="13" pattern="[0-9]{13}"
                                                                   class="form-control"
                                                                   id="cnic"
                                                                   name="cnic" placeholder="CNIC"
                                                                   title="Enter !3 digit CNIC Number. Example: ( 3434359324554 )"
                                                                   required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="address">Address <span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="address"
                                                                   name="address"
                                                                   pattern="[A-Za-z0-9\w]{4,100}"
                                                                   title=" Minimum 4 letters required"
                                                                   placeholder="Home Address" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="phone">Contact <span
                                                                    style="color: red;">*</span></label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                                <input type="text" maxlength="11" class="form-control"
                                                                       placeholder="Contact Number"
                                                                       pattern="[0-9]{11}"
                                                                       title="Enter 11 Digit Number. Example:(03330234334)"
                                                                       id="phone" name="phone" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="city">City<span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="city"
                                                                   placeholder="Home City"
                                                                   name="city" pattern="[A-Za-z0-9\w]{4,100}"
                                                                   title=" Minimum 4 letters required" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="rate">Labor Rate <span
                                                                    style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="rate"
                                                                   placeholder="Labor Rate(per Day)"
                                                                   name="rate" pattern="[0-9]{3,100}"
                                                                   title=" Minimum 3 digit number required" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="project_id">Project ID<span style="color: red;">*</span></label>
                                                            <select class="form-control" id="project_id"
                                                                    name="project_id" required>
                                                                @foreach($projects as $project)
                                                                    <option>{{ $project->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                        <button type="submit"
                                                                class="btn btn-block btn-primary btn-xs form-control"
                                                                style="margin-top: 20px;">Add Labor
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('datatable_stylesheets')
    @yield('datatable_script')

@stop

