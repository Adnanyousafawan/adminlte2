@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')


    <div class="box-body" style="margin-top: 0px; padding: 0px;">
        <div class="box box-primary" style=" background-color: #f4f4f487; ">
            <div class="row" style="padding: 20px;">

                <div class="col-md-3 col-sm-7 col-lg-4">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body {{-- box-profile --}}">
                            {{--  <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="Project Image">
                --}}
                            <h3 class="profile-username text-center">Project Title</h3>

                            <p class="text-muted text-center">Location</p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Customer Name</strong>
                            <p class="text-muted float-right">
                                Adnan Yousaf
                            </p>
                            <strong><i class="fa fa-book margin-r-5"></i>Customer Contact</strong>
                            <p class="text-muted float-right">
                                0433323232323
                            </p>
                            <hr>
                            <strong><i class="fa fa-book"></i>Project Details</strong>
                            <div class="box-body">

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Size</b> <a class="pull-right"> <span
                                                class="label label-danger">500 sq/m</span></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Number of Floors</b> <a class="pull-right">5</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Completion Time</b> <a class="pull-right">5 years</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Assigned To</b> <a class="pull-right">Hamza</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Contact</b> <a class="pull-right">+0924567567</a>
                                    </li>
                                </ul>
                                <!-- /.box-body -->
                                <strong><i class="fa fa-file-text-o "></i> Description</strong>

                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim
                                    neque.</p>
                            </div>

                            <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-4 col-sm-7 col-lg-4">
                    <div class="box box-primary" style="margin-bottom: 10px;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Material Requests</h3>

                            <div class="box-tools pull-right">
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-flat pull-left">Place New
                                    Order</a>


                                {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                             class="fa fa-minus"></i>
                                 </button> --}}
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Request ID</th>
                                        <th>Item</th>

                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                        <td>Bricks</td>

                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">111</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                        <td>Cement</td>

                                        <td>
                                            <div class="sparkbar" data-color="#f39c12" data-height="20">2222</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                        <td>Rod</td>

                                        <td>
                                            <div class="sparkbar" data-color="#f56954" data-height="20">333</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                        <td>Sand</td>

                                        <td>
                                            <div class="sparkbar" data-color="#00c0ef" data-height="20">222</div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                        <td>Cement</td>

                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">555</div>
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
                                Requests</a>
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


                <div class="col-md-3 col-lg-4 col-sm-5">
                    <div class="box box-primary" style="">
                        <div class="box-header with-border">
                            <h3 class="box-title">About Project</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

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


                <div class="col-md-2 col-sm-5 col-lg-4">
                    <div class="box box-primary border-primary">
                        <div class="box-header">
                            <h2 class="box-title">Budget</h2>
                            <span class="info-box-number" style="margin-top: 5px;">102000/RS.</span>
                        </div>
                        <!-- /.box-header -->
                        <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                    </div>
                    <!-- /.info-box-content -->
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-2 col-sm-6 col-lg-4">
                    <div class="box box-primary border-primary">
                        <div class="box-header">
                            <h2 class="box-title">Total Expenses</h2>
                            <span class="info-box-number" style="margin-top: 5px;">102000/RS.</span>
                        </div>
                        <!-- /.box-header -->
                        <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                    </div>
                    <!-- /.info-box-content -->
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-2 col-sm-6 col-lg-4">
                    <div class="box box-primary border-primary">
                        <div class="box-header">
                            <h2 class="box-title">Balance</h2>
                            <span class="info-box-number" style="margin-top: 5px;">102000/RS.</span>
                        </div>
                        <!-- /.box-header -->
                        <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                    </div>
                    <!-- /.info-box-content -->
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->


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


                <div class="col-md-8 col-sm-12 col-lg-8 ">
                    <div class="box box-primary" style="margin-bottom: 10px;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Orders Details</h3>

                            <div class="box-tools pull-right">
                                {{--  <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-flat pull-left">Place New Order</a> --}}


                                {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                             class="fa fa-minus"></i>
                                 </button> --}}
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Project Id</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">PR1111</div>
                                        </td>
                                        <td>Bricks</td>
                                        <td>12</td>
                                        <td>12*3=24</td>
                                        <td><span class="label label-success col-md-6">Shipped</span></td>

                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f39c12" data-height="20">PR2222</div>
                                        </td>
                                        <td>Cement</td>
                                        <td>12</td>
                                        <td>12*3=24</td>
                                        <td><span class="label label-warning col-md-6">Pending</span></td>


                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                        <td>
                                            <div class="sparkbar" data-color="#f56954" data-height="20">PR3333</div>
                                        </td>
                                        <td>Rod</td>
                                        <td>12</td>
                                        <td>12*3=24</td>
                                        <td><span class="label label-danger col-md-6"> Delivered</span></td>

                                    </tr>
                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00c0ef" data-height="20">PR2222</div>
                                        </td>
                                        <td>Sand</td>
                                        <td>12</td>
                                        <td>12*3=24</td>
                                        <td><span class="label label-info col-md-6 col-sm-10 col-xs-12 col-lg-12"> Processing</span>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">PR4555</div>
                                        </td>
                                        <td>Cement</td>
                                        <td>12</td>
                                        <td>12*3=24</td>
                                        <td><span
                                                class="label label-success col-md-6 col-sm-10 col-xs-12 col-lg-12 col-12">Shipped</span>
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
                                Orders</a>
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
            </div>


            <!-- About Me Box -->


        </div><!-- /.row -->
    </div>





@stop
