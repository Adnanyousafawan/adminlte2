@extends('adminlte::page')
@section('title', 'All Projects')

@include('projects.laborbyprojects.Labor_At_Projects')
@include('projects.DataTables.All_Projects')
@section('content')

    @yield('bootstrap_jquery')
    @yield('error_logs')
    @yield('breadcrumbs')


    <div class="box-body" id="screen"
         style="/*max-width: 94%; margin-left: 3%; margin-top: 1%; */padding: 0px; background-color: #f4f4f487;">
        <div class="box box-body" style=" background-color: #f4f4f487; padding: 0px;">
            <div class="box-header">
                <h3><span
                        class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                        style="margin-bottom: 10px; padding: 0px;">Projects Details</span></h3>
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

                        @yield('labor_by_projects')

                        <div class="box-footer clearfix">
                            <a href="{{ route('projects.labor_by_projects')}}"
                               class="btn btn-sm btn-default btn-flat pull-right">View All
                                Labors By Projects</a>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                        {{-- Showing 1 to 2 of 2 entries --}}
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-footer -->
                        {{--
                             <div class="box-body">
                                 <div class="table-responsive">
                                     <table class="table no-margin table-bordered  table-striped">
                                         <thead>
                                         <tr>
                                             <th>Project ID</th>
                                             <th>Title</th>
                                             <th>Labor</th>
                                             <th>Cost</th>
                                             <th>Contractor</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                             @foreach($labor_at_projects as $lproject)
                                         <tr>
                                             <td><a href="pages/examples/invoice.html" type="links">PR00{{ $lproject->id }}</a></td>
                                             <td>{{ $lproject->title }}</td>

                                             <td>
                                                 <div class="sparkbar" data-color="#00a65a" data-height="20">{{DB::table('labors')->where('project_id','=',$lproject->id)->count('id') }}</div>
                                             </td>
                                             <td>
                                                 <div class="label label-warning col-md-8">{{ 1000 * DB::table('labors')->where('project_id','=',$lproject->id)->count('id')  }}</div>
                                             </td>
                                             <td>Contractor
                                                 </td>
                                         </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div><!-- /.table-responsive -->
                             </div><!-- /.box-body -->
                             <div class="box-footer clearfix">
                                 <a href="{{ route('labors.index')}}" class="btn btn-sm btn-default btn-flat pull-right">View All
                                     Labors</a>
                                 <div class="row">
                                     <div class="col-sm-5">
                                         <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                             Showing 1 to 2 of 2 entries
                                         </div>
                                     </div>
                                 </div>
                             </div><!-- /.box-footer -->

      --}}

                    </div><!-- /.box -->
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  col-xl-4" style="padding: 0px;">
                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="box" style="margin-top: 0px; ">
                            <div class="box-header">
                                <h2 class="box-title">Total Labor</h2>
                                <span class="info-box-number label label-primary pull-right"
                                      style="margin-top: 0px; font-size: 16px;">{{DB::table('labors')->count('id') }}</span>
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
                                      style="margin-top: 0px; font-size: 16px;">{{DB::table('labors')->where('status_id','=','1')->count('id') }}</span>
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
                        <div class="box">
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
                        <div class="box">
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
                </div>
            </div>
            <!-- /.col -->

            @yield('project_datatable')

        </div>
    </div>

    @yield('datatable_script')


@stop

