extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')

    <div class="box-body" style="margin-top: 0px; padding: 0px;">
        <div class="box box-primary" style=" background-color: #f4f4f487; ">
            <div class="row" style=" padding: 20px;">

                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                                 src="../../dist/img/user4-128x128.jpg" alt="Contractor Image">

                            <h3 class="profile-username text-center">Contractor Name</h3>

                            <p class="text-muted text-center">emailn</p>
                            <hr>

                            <strong><i class="fa fa-book margin-r-5"></i>Customer Contact</strong>
                            <p class="text-muted float-right">
                                0433323232323
                            </p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Customer Address</strong>
                            <p class="text-muted float-right">
                                bunglowewhbjdngfcbhej rubidhdbhde
                            </p>
                            <hr>
                            <strong><i class="fa fa-book"></i>Contractor Details</strong>
                            <div class="box-body">

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>ID</b> <a class="pull-right">CC0035</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender</b> <a class="pull-right"> <span
                                                class="label label-danger">Male</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>CNIC</b> <a class="pull-right">32320924567567</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b>Salary</b> <a class="pull-right">50,000</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Projects Done</b> <a class="pull-right">10</a>
                                    </li>
                                </ul>
                                <!-- /.box-body -->
                            </div>

                            <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>


                <div class="col-md-6 col-sm-4 ">
                    <div class="box box-info" style="max-width: 96%; margin-left: 2%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ongoing Project </h3>

                            {{--  <div class="box-tools pull-right">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                             class="fa fa-minus"></i>
                                 </button>
                             </div> --}}
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Project ID</th>
                                        <th>Titile</th>
                                        <th>Status</th>
                                        <th>Workers</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">ID12</a></td>
                                        <td>Bahria</td>
                                        <td><span class="label label-success">In Progress</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">25</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">23233</a></td>
                                        <td>DHA</td>
                                        <td><span class="label label-warning">waiting</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f39c12" data-height="20">0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">23323</a></td>
                                        <td>ANY</td>
                                        <td>
                                            <span class="label label-danger">Not started</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f56954" data-height="20">PR3333</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">ID12</a></td>
                                        <td>Bahria</td>
                                        <td><span class="label label-success">In Progress</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">25</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">23233</a></td>
                                        <td>DHA</td>
                                        <td><span class="label label-warning">waiting</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f39c12" data-height="20">0</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">

                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All
                                Projects</a>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                        Showing 1
                                        to 2 of 2 entries
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        {{--  {{ $projects->links() }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3">
                    <div class="box box-primary" style="max-width: 96%; margin-left: 2%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Current Project</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i>Bahria Town</strong>
                            <p class="text-muted float-right">
                                Lahore, Pakistan
                            </p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Number of Workers</b> <a class="pull-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Current Phase</b> <a class="pull-right">5</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Project Status</b> <a class="pull-right">In Progress</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Floor Number</b> <a class="pull-right">2</a>
                                </li>

                            </ul>
                        </div> <!-- /.box-body -->
                    </div><!-- /.box -->
                </div>


                <div class="col-md-6 col-sm-4 ">
                    <div class="box box-info" style="max-width: 96%; margin-left: 2%;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Completed Project Details</h3>

                            {{--  <div class="box-tools pull-right">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                             class="fa fa-minus"></i>
                                 </button>
                             </div> --}}
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Project ID</th>
                                        <th>Titile</th>
                                        <th>Status</th>
                                        <th>Profit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">ID12</a></td>
                                        <td>Bahria</td>
                                        <td><span class="label label-success">Completed</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">2500</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">23233</a></td>
                                        <td>DHA</td>
                                        <td><span class="label label-success">Completed</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f39c12" data-height="20">0</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">23323</a></td>
                                        <td>ANY</td>
                                        <td>
                                            <span class="label label-success">Completed</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f56954" data-height="20">3300</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">ID12</a></td>
                                        <td>Bahria</td>
                                        <td><span class="label label-success">Completed</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">25000</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">23233</a></td>
                                        <td>DHA</td>
                                        <td><span class="label label-success">Completed</span></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f39c12" data-height="20">0</div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">

                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All
                                Projects</a>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                        Showing 1
                                        to 2 of 2 entries
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        {{--  {{ $projects->links() }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>


            </div> <!-- /.row -->
        {{--
                <div class="col-md-3">
                   <div class="box box-primary border-primary" style="max-width: 96%; margin-left: 2%;">
                    <div class="box-header">
                      <h2 class="box-title">Budget</h2>
                       <span class="info-box-number" style="margin-top: 5px;">102000/RS.</span>
                        <span class="info-box-number" style=" float: right;">102000/RS.</span>
                    </div>
                    /.box-header

                    </div>
                         /.info-box-content
                     /.info-box
                </div>

                /.col
                <div class="col-md-3">
                   <div class="box box-primary border-primary"  style="max-width: 96%; margin-left: 2%;">
                    <div class="box-header">
                      <h2 class="box-title">Total Expenses</h2>
                      <span class="info-box-number" style=" float: right;">102000/RS.</span>
                    </div>
                    /.box-header

                    </div>
                         /.info-box-content
                     /.info-box
                </div>

         <div class="col-md-3">
                   <div class="box box-primary border-primary"  style="max-width: 96%; margin-left: 2%;">
                    <div class="box-header">
                      <h2 class="box-title">Balance</h2>
                       <span class="info-box-number" style=" float: right;">102000/RS.</span>
                        <span class="info-box-number" style="margin-top: 5px;">102000/RS.</span>          </div>
                    ./box-header

                  </div>
                         /.info-box-content
                     /.info-box         </div>
                 /.col
                --}}
        {{--
                fix for small devices only
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="info-box-content">
                            <span class="info-box-text">Total Expense</span>
                            <span class="info-box-number">112020</span>
                        </div>
                        /.info-box-content
                    </div>
                   /.info-box
                </div>
                 /.col
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <div class="info-box-content">
                            <span class="info-box-text">Total Labor</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                         /.info-box-content
                    </div>
                   /.info-box
                </div>
                 /.col

                  --}}




        <!-- About Me Box -->
        </div>

    </div>

    </div><!-- /.row -->




@stop
