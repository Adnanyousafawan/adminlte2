@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')


<div class="box-body" style="padding-bottom: 85px; max-width: 96%; margin-left: 2%;">
<div class="row">
	 <div class="box-header">
            <h2 class="text-center"> </h2>
     </div>
		<div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="Project Image">

              <h3 class="profile-username text-center">Project Title</h3>

              <p class="text-muted text-center">Location</p>
       
 <strong><i class="fa fa-book margin-r-5"></i>Project Details</strong>


              <p class="text-muted">
                This project is ownership of CUSTOMER NAME
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Phase</strong>

              <p>
                <span class="label label-danger"></span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              

              <a href="#" class="btn btn-primary btn-block"><b>Edit</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>


    <div class="row">
    	<div class="box-body">
        <div class="col-md-2 col-sm-6 col-xs-12">
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
        <div class="col-md-2 col-sm-6 col-xs-12">
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
        <div class="col-md-2 col-sm-6 col-xs-12">
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


 <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Orders Details</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Site Id</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Bricks</td>
                                <td><span class="label label-success">Shipped</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">PR1111</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                <td>Cement</td>
                                <td><span class="label label-warning">Pending</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">PR2222</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>Rod</td>
                                <td><span class="label label-danger">Delivered</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">PR3333</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>Sand</td>
                                <td><span class="label label-info">Processing</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00c0ef" data-height="20">PR2222</div>
                                </td>
                            </tr>

                            <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Cement</td>
                                <td><span class="label label-success">Shipped</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">PR4555</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
    </div>
</div>

 <div class="col-lg-2">
          <div class="box box-primary">
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
                  <b>Contractor</b> <a class="pull-right">Hamza</a>
                </li>
                <li class="list-group-item">
                  <b>Number of Workers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Current Phase</b> <a class="pull-right">5</a>
                </li>
                <li class="list-group-item">
                  <b>Contractor</b> <a class="pull-right">Hamza</a>
                </li>
                <li class="list-group-item">
                  <b>Number of Workers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Current Phase</b> <a class="pull-right">5</a>
                </li>
                <li class="list-group-item">
                  <b>Contractor</b> <a class="pull-right">Hamza</a>
                </li>
              </ul>
            </div> <!-- /.box-body --> 
          </div><!-- /.box --> 
      </div>
        


</div>


           <!-- About Me Box -->
       



</div><!-- /.row -->


        <!-- /.col -->
</div>





@stop