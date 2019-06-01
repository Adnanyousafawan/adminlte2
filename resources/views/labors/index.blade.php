@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('header')
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
@endsection
</head>
</html>

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif




{{-- col-md-11 col-md-offset-1 col-sm-11 col-sm-offset-1 col-lg-11 col-lg-offset-1
 --}}
 <div class="box-body " style="max-width: 94%; margin-left: 3%; margin-top: 1%; padding: 0px; background-color: #f4f4f487;" >

  <div class="box box-primary" style=" background-color: #f4f4f487; ">
    <div class="row" style="padding: 20px;">
    <!-- Main content -->
    <h2 class="text-center"><strong><i>Labor Details</i></strong></h2>


<div class="row" style="margin-top: 30px;">
 <div class="col-md-6 col-sm-6 col-lg-6 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
            <div class="box box-primary" style="margin-bottom: 10px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Labor at Projects</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin table-bordered table-striped">
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
                            <tr>
                                <td><a href="pages/examples/invoice.html" type="links">OR9842</a></td>
                                <td>Tulip</td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">111</div>
                                </td>
                                 <td>
                                    <div class="label label-warning col-md-8">10,000</div>
                                </td>
                                <td>ALI</td>

                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                <td>Bahria</td>

                                <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">22</div>
                                </td>
                                <td>
                                    <div class="label label-warning col-md-8">11,000</div>
                                </td>
                                <td>ALI</td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>pindi</td>

                                <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">333</div>
                                </td>
                                <td>
                                    <div class="label label-warning col-md-8">12,000</div>
                                </td>
                                <td>ALI</td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>Sialkot</td>

                                <td>
                                    <div class="sparkbar" data-color="#00c0ef" data-height="20">222</div>
                                </td>
                                <td>
                                    <div class="label label-warning col-md-8">15,000</div>
                                </td>
                                <td>ALI</td>
                            </tr>

                            <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Peshawar</td>

                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">555</div>
                                </td>
                                <td>
                                    <div class="label label-warning col-md-8">110,001</div>
                                </td>
                                <td>ALI</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Requests</a><div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1
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



        <div class="col-md-2 col-sm-4 col-lg-4">
           <div class="box box-primary border-primary">
            <div class="box-header">
              <h2 class="box-title">Total Labor</h2>
               <span class="info-box-number label label-primary pull-right" style="margin-top: 5px;">112</span>
            </div>
            <!-- /.box-header -->
                   <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
            </div>
                <!-- /.info-box-content -->
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2 col-sm-4 col-lg-4">
           <div class="box box-primary border-primary">
            <div class="box-header">
              <h2 class="box-title">Working Labor</h2>
               <span class="info-box-number label label-warning pull-right" style="margin-top: 5px;">80</span>
            </div>
            <!-- /.box-header -->
                   <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
            </div>
                <!-- /.info-box-content -->
            <!-- /.info-box -->
        </div>

        <div class="col-md-2 col-sm-4 col-lg-4">
           <div class="box box-primary border-primary">
            <div class="box-header">
              <h2 class="box-title">Available Labor</h2>
               <span class="info-box-number label label-success pull-right" style="margin-top: 5px;">32</span>
            </div>
            <!-- /.box-header -->
                   <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
            </div>
                <!-- /.info-box-content -->
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-2 col-sm-4 col-lg-4">
           <div class="box box-primary border-primary">
            <div class="box-header">
              <h2 class="box-title">Total Cost</h2>
               <span class="info-box-number label label-danger pull-right" style="margin-top: 5px;">20,0000</span>
            </div>
            <!-- /.box-header -->
                   <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
            </div>
                <!-- /.info-box-content -->
            <!-- /.info-box -->
        </div>
        <div class="col-md-2 col-sm-4 col-lg-4">
           <div class="box box-primary border-primary">
            <div class="box-header">
              <h2 class="box-title">Total Projects</h2>
               <span class="info-box-number label label-info pull-right" style="margin-top: 5px;">20</span>
            </div>
            <!-- /.box-header -->
                   <!-- <span class="info-box-number" style=" float: right;">102000/RS.</span> -->
            </div>
                <!-- /.info-box-content -->
            <!-- /.info-box -->
        </div>
        <!-- /.col -->


            {{-- <div class="box-body">
                <div class="row">
                    <div class="col-sm-8">

                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-primary  form-control" href="{{ route('labors.create') }}">Add new Labor</a>
                    </div>
                </div>
            </div> --}}
            <!-- /.box-header -->
           <div class="box-body" style=" padding-bottom: 0px;">
                <button type="button" class="btn btn-primary col-xs-8 col-xs-offset-2 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2  col-lg-offset-2 col-md-offset-2 " data-target="#search_area"  data-toggle="collapse">
                    <i>Search Labor</i>
            </button>


           </div>

    <div id="search_area" class="collapse col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2 col-sm-8 col-sm-offset-2" style="padding: 30px; background-color: rgb(53, 124, 165);">

        <form action="/search_labor" method="get">
        @csrf
            <div class="row">

                <div class="form-group">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <input type="search" name="search_name" id="search_name"
                        placeholder="Search By Name" class="form-control">
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <input type="search" name="phone_number" id="search_phone"
                        placeholder="Search By Phone" class="form-control">
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <button type="submit" class="btn btn-btn-primary ">Search</button>
                     </div>
                </div>
            </div>
        </form>
    </div>




 <div class="col-md-10 col-sm-10 col-lg-10 col-md-offset-1 col-lg-offset-1 col-sm-offset-1 ">
            <div class="box box-primary" style="margin-bottom: 10px; margin-top: 1%;">

                <div class="box-header with-border ">
                    <strong><i class="box-title col-md-8">Labor Record</i></strong>

                    <div class="box-tools pull-right">


                       <a href="{{ route('labors.create') }}" class="btn btn-primary pul-right">Add Labor</a>


                     </div>
                       {{--  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button> --}}
                    </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Labor ID</th>
                                <th>Name</th>
                                <th>Project Id</th>
                                <th>Present</th>
                                <th>Labor Rate</th>
                                <th>Cost</th>
                                <th style="min-width: 50px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($labors as $labor)
                            <tr>
                                        <td>lb0000{{ $labor->id }}</td>
                                        <td>{{ $labor->name }}</td>
                                        <td>PR000011</td>
                                        <td>23</td>
                                        <td>{{ $labor->rate }}</td>
                                        <td>25000</td>
                                        <td style="max-width: 50px; min-width: 30">
                                            <a type="links" href="{{ route('labors.edit', ['id' => $labor->id]) }}"
                                            class="btn-link" style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">
                                            Edit</a>
                                            <button type="button" class="btn-link" data-toggle="modal" data-target="#applicantDeleteModal"style="color: red; margin-left: 3px;  margin-top: 0px;">
                                             Delete
                                            </button>
                                                {{-- <a href="{{ route('labors.edit', ['id' => $labor->id]) }}"
                                                   class="btn btn-primary col-xs"
                                                   style="margin-left: 5px; margin-top: 5px;">
                                                    View
                                                </a> --}}

                                        </td>
                                    </tr>

                                </tbody>

                                    <div id="applicantDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="min-width:50%; align-content: center; text-align: center;">
                                    <div class="modal-content">
                                        <form class="row" method="POST"
                                                  action="{{ route('labors.destroy', ['id' => $labor->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                   {{--  <form action="{{ route('labors.destroy', ['id' => $labor->id]) }}" method="POST" class="remove-record-model">
                                               {{ method_field('delete') }}
                                               {{ csrf_field() }} --}}

                                    <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title text-center" id="custom-width-modalLabel" >Delete Applicant Record</h4>
                                    </div>
                                            <div class="modal-body">
                                                <strong><b><h2>Are You Sure? You Want Delete This Record?</h2></b></strong>
                                                <input type="hidden", name="applicant_id" id="app_id">
                                    </div>
                                    <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button>
                                    </div>

                                    </form>
                                    </div>
                                    </div>
                                </div>

                                @endforeach
                           </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">

                    {{-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> --}}
                    <div class="row">
                    <div class="col-sm-6">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1
                        to {{count($labors)}} of {{count($labors)}} entries
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="dataTables_paginate paging_simple_numbers pull-right" id="example2_paginate">
                        {{ $labors->links() }}
                    </div>
                </div>

                </div>
                </div>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
    </div>

</div>
</div>
    <!-- /.content -->
@stop
