@extends('adminlte::page')
@section('title', 'Suppliers')
@include('common')
@section('content')

    @yield('meta_tags')
    @yield('error_logs')
    @yield('breadcrumbs')
<div class="box" style="background-color: #f4f4f487;">
<div class="row" style="margin-top: 5%; padding-bottom: 5%;">
    <div class="row">
                    <div
                        class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1  "
                        style="padding: 0px;">

                        <?php   
                                $number = $total_paid;
                                if ($number < 1000000) {
                                    // Anything less than a million
                                    $format = number_format($number);
                                } else if ($number < 1000000000) {
                                    // Anything less than a billion
                                    $format = number_format($number / 1000000, 2) . 'M';
                                } else {
                                    // At least a billion
                                    $format = number_format($number / 1000000000, 2) . 'B';
                                }
                            ?>
                        <div class="col-xs-12 col-md-3 col-sm-4 col-lg-4 col-xl-12">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Paid <span style="color: green;" class="glyphicon glyphicon-ok-sign"></span></h2>
                                    <span class="info-box-number label label-warning pull-right"
                                          style="margin-top: 0px; font-size: 16px;">{{ abs($format) }}</span>
                                </div>
                                <!-- /.box-header -->
                                <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                            </div>
                            <!-- /.info-box-content -->
                            <!-- /.info-box -->
                        </div>
                         <?php   
                                $number = $total_suppliers_payable;
                                if ($number < 1000000) {
                                    // Anything less than a million
                                    $format = number_format($number);
                                } else if ($number < 1000000000) {
                                    // Anything less than a billion
                                    $format = number_format($number / 1000000, 2) . 'M';
                                } else {
                                    // At least a billion
                                    $format = number_format($number / 1000000000, 2) . 'B';
                                }
                            ?>
                        <div class="col-xs-12 col-md-4 col-sm-4 col-lg-4 col-xl-12">
                            <div class="box">
                                <div class="box-header">
                                  
                                   
                                    <h2 class="box-title">Payable <span style="color: red;" class="glyphicon glyphicon-arrow-down"></span></h2>
                                    
                                    <span class="info-box-number label label-danger pull-right"
                                          style="margin-top: 0px; font-size: 16px;">{{ abs($format) }}</span>
                                </div>
                                <!-- /.box-header -->
                                <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                            </div>
                            <!-- /.info-box-content -->
                            <!-- /.info-box -->
                        </div>
                    {{-- {{     dd($data) }}  --}}
                    <!-- /.col -->
                    <?php   
                                $number = $total_suppliers_balance;
                                if ($number < 1000000) {
                                    // Anything less than a million
                                    $format = number_format($number);
                                } else if ($number < 1000000000) {
                                    // Anything less than a billion
                                    $format = number_format($number / 1000000, 2) . 'M';
                                } else {
                                    // At least a billion
                                    $format = number_format($number / 1000000000, 2) . 'B';
                                }

                                ?>
                        <div class="col-xs-12 col-md-3 col-sm-4 col-lg-4 col-xl-12">
                            <div class="box">
                                <div class="box-header">
                                    <h2 class="box-title">Total Balance <span style="color: green;" class="glyphicon glyphicon-arrow-up"></span></h2>
                                    <span class="info-box-number label label-success pull-right"
                                          style="margin-top: 0px; font-size: 16px;">{{ abs($format) }}</span>
                                </div>
                                <!-- /.box-header -->
                                <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
                            </div>
                            <!-- /.info-box-content -->
                            <!-- /.info-box -->
                        </div>

                    </div>

                </div>
            {{-- _________________________________All Customers DataTable_____________________________________--}}
        <div class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                style="padding: 5px;">

                <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                    <div class="box-header with-border ">
                        <h4><span class="box-title col-md-8">Supplier Record</span></h4>
                    
                    </div>
                    <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                        <table class="table no-margin table-bordered table-striped project">
                            <thead>
                                <tr>

                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Balance</th>
                                <th>Supplies Total</th>
                                <th>Action</th> 
                            </tr>
                            </thead>
                            <tbody>
 
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>Su0000{{ $supplier->id }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->address}}</td>
                                    <td>{{ $supplier->city}}</td>
                                    @if($supplier->balance > 0)
                                        <td>{{ abs($supplier->balance) }} <span style="color: green;" class="glyphicon glyphicon-arrow-up"></span></td>
                                    @endif
                                    @if($supplier->balance < 0)
                                        <td>{{ abs($supplier->balance) }} <span style="color: red;" class="glyphicon glyphicon-arrow-down"></span></td>
                                    @endif
                                    @if($supplier->balance == 0)
                                        <td>0</td>
                                    @endif
                                    <td>{{ $supplier->material_cost}}</td>

                     
                     <td>               {{-- <td style="max-width: 50px;"> --}}
                  <div class="btn-group">
                                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-success btn-sm" type="button">Action<span class="glyphicon glyphicon-triangle-bottom"></span></button>
                            
                                    <ul role="menu" class="dropdown-menu">
                                       
                                        <li><a href="{{ route('suppliers.edit', ['id' => $supplier->id]) }}"><i
                                                    class="fa fa-edit"></i>Edit</a></li>

                                        <li><a type="links" data-toggle="modal"
                                               data-target="#applicantDeleteModal-{{ $supplier->id }}"><i
                                                    class="fa fa-remove"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

{{-- ______________________________Delete Modal ______________________________________________--}}

                                <div id="applicantDeleteModal-{{ $supplier->id }}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center;">
                                        <div class="modal-content" >
                                            <form class="row" method="POST"
                                                  action="{{ route('suppliers.destroy', ['id' => $supplier->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <form action="{{ route('suppliers.destroy', ['id' => $supplier->id]) }}"
                                                      method="POST" class="remove-record-model">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                        <h4 class="modal-title text-center"
                                                            id="custom-width-modalLabel">Delete Supplier Record</h4>
                                                    </div>
                                                      <div class="modal-body text-center">
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
</div>
</div>


{{-- 
<script type="text/javascript">

        $('.project').DataTable({
            select: true,
            "order": [[0, "asc"]],
            //"scrollY"  : "380px",
            "scrollCollapse": true,
            "paging": true,
            "bProcessing": true,
            // fixedHeader: {
            //     header: false,
            //     // headerOffset: 100,
            //     },
            //scrollX: true,
            // scrollY: true
        });

       
</script> --}}
    <!-- /.content -->
     @yield('datatable_stylesheets')
    @yield('datatable_script')
@stop
