@extends('adminlte::page')
@section('title', 'AdminLTE')

<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

<link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
<link rel="stylesheet" href="/css/jquery.dataTables.css">
{{-- <link rel="stylesheet" href="/css/jquery.dataTables.css"> --}}
{{-- <link rel="stylesheet" href="/images"> --}}
<script src="/js/jquery-3.4.1.js"></script>
<script src="/js/jquery.dataTables.js"></script>

{{-- 
<link rel="stylesheet" href="/js/jquery-3.4.1.js">
<link rel="stylesheet" href="/js/jquery.dataTables.js"> --}}
{{-- <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 --}}

{{-- 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
</head>
{{-- <style type="text/css">
table.datatable.dataTable.no-footer.fixedHeader-floating {
top: 0px;
width: 100% !important;
display: block;
overflow-x: auto;
}
</style> --}}
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
 
{{-- 

<script type="text/javascript">
function myFunction(x) 
{
  if (x.matches) 
  { // If media query matches

    }
    
   // document.body.style.backgroundColor = "yellow";
  } 
  else 
  {


  // document.body.style.backgroundColor = "pink";
  }
var x = window.matchMedia("(max-width: 750px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes

</script>
 --}}
{{-- <style type="text/css">
    @media (max-width: 850px) 
    {

        .screen{
            width: 96%;
            margin: 0 auto;
            margin-left: 2%;
            background: #eee;
            margin-top: 10px;
        }
    }
    @media (min-width: 851px) 
    {
        .screen{
            width: 80%;
            margin: 0 auto;
            margin-left: 3%;
            background: #eee;
            margin-top: 10px;
        }
    }
    
</style> --}}


<div class="box-body" id="screen" style="/*max-width: 94%; margin-left: 3%; margin-top: 1%; */padding: 0px; background-color: #f4f4f487;">
    <div class="box box-body" style=" background-color: #f4f4f487; padding: 0px;">
        <div class="box-header">
            <h3><span class="col-xs-6 col-sm-6 col-md-5 col-lg-5 col-xl-5 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-xl-offset-1" style="margin-bottom: 10px; padding: 0px;">Labor Details</span></h3>
        </div>
       
        <div class="row" style="padding: 0px;">
            {{-- <div class="row" style="margin-top: 30px;"> --}}
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xl-offset-1 col-md-offset-1 col-lg-offset-1">
                <div class="box" style="margin-bottom: 20px;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Labor at Projects</h3>
                    </div>
                            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin table-bordered table-dark table-striped">
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
                        <td><div class="sparkbar" data-color="#00a65a" data-height="20">111</div></td>
                        <td><div class="label label-warning col-md-8">10,000</div></td>
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
                </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Requests</a>
            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 2 of 2 entries</div>
                    </div>
            </div>
            </div><!-- /.box-footer -->
            </div><!-- /.box -->
            </div>

<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  col-xl-4" style="padding: 0px;">
        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12" >
           <div class="box" style="margin-top: 0px;">
            <div class="box-header">
              <h2 class="box-title">Total Labor</h2>
               <span class="info-box-number label label-primary pull-right" style="margin-top: 0px;">112</span>
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
               <span class="info-box-number label label-warning pull-right" style="margin-top: 0px;">80</span>
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
               <span class="info-box-number label label-success pull-right" style="margin-top: 0px;">32</span>
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
               <span class="info-box-number label label-danger pull-right" style="margin-top: 0px;">20,0000</span>
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
               <span class="info-box-number label label-info pull-right" style="margin-top: 0px;">20</span>
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


            {{-- <div class="box-body">
                <div class="row">
                    <div class="col-sm-8">

                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-primary  form-control" href="{{ route('labors.create') }}">Add new Labor</a>
                    </div>
                </div>
            </div> --}}
        {{--
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
 --}}

 <div class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1" style="padding: 5px;">
            <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                <div class="box-header with-border ">
                    <h4><span class="box-title col-md-8">Labor Record</span></h4>
                    <div class="box-tools pull-right">
                       <a type="links" {{-- href="{{ route('labors.create') }}" --}}  data-toggle="modal" data-target="#applicantADDModal" class="btn btn-primary pul-right">Add Labor</a>
                    </div>  
                </div>
        <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
            <table class="table no-margin table-bordered table-striped labor">
                <thead>
             
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
                            <td style="max-width: 95px; min-width: 30">
                            <a type="links" href="{{ route('labors.edit', ['id' => $labor->id]) }}" style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                            <a type="links" data-toggle="modal" data-target="#applicantDeleteModal" style="color: red; margin-left: 3px;  margin-top: 0px;">Delete</a></td>
                        </tr> 

                                    <div id="applicantDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="min-width:40%; align-content: center; text-align: center;">
                                    <div class="modal-content">
                                        <form class="row" method="POST"
                                                  action="{{ route('labors.destroy', ['id' => $labor->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <form action="{{ route('labors.destroy', ['id' => $labor->id]) }}" method="POST" class="remove-record-model">
                                               {{ method_field('delete') }}
                                               {{ csrf_field() }}

                                        <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delete Applicant Record</h4>
                                        </div>
                                        <div class="modal-body">
                                                <strong><b><h3>Are You Sure? You Want Delete This Record?</h3></b></strong>
                                                <input type="hidden", name="applicant_id" id="app_id">
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button>
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

  <!-- /.box-header -->
               {{--  <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped no-margin table-bordered ">
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
                                        <td class="info">lb0000{{ $labor->id }}</td>
                                        <td class="active">{{ $labor->name }}</td>
                                        <td class="info">PR000011</td>
                                        <td class="warning">23</td>
                                        <td class="warning">{{ $labor->rate }}</td>
                                        <td class="danger">25000</td>
                                        <td style="max-width: 95px; min-width: 30">
                                            <a type="links" href="{{ route('labors.edit', ['id' => $labor->id]) }}"
                                             style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                                            <a type="button" data-toggle="modal" data-target="#applicantDeleteModal"style="color: red; margin-left: 3px;  margin-top: 0px;">Delete</a>
                                        </td>
                                    </tr>
                                    
                                </tbody>

                                    <div id="applicantDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="min-width:40%; align-content: center; text-align: center;">
                                    <div class="modal-content">
                                        <form class="row" method="POST"
                                                  action="{{ route('labors.destroy', ['id' => $labor->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <form action="{{ route('labors.destroy', ['id' => $labor->id]) }}" method="POST" class="remove-record-model">
                                               {{ method_field('delete') }}
                                               {{ csrf_field() }}

                                    <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title text-center" id="custom-width-modalLabel" >Delete Applicant Record</h4>
                                    </div>
                                            <div class="modal-body">
                                                <strong><b><h3>Are You Sure? You Want Delete This Record?</h3></b></strong>
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
                    
                </div> --}}
                <!-- /.box-body -->
               {{--  <div class="box-footer clearfix">
                   
                   
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
                </div> --}}





{{--______________________________________________________________   This is EDIT MODAL CODE  ______________________________ --}}

                                    

                                    <div id="applicantADDModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="min-width:70%; align-content: center; text-align: center;">
                                    <div class="modal-content">

                                  {{--   <form class="row" method="POST"
                                                  action="{{ route('labors.destroy', ['id' => $labor->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <form action="{{ route('labors.destroy', ['id' => $labor->id]) }}" method="POST" class="remove-record-model">
                                               {{ method_field('delete') }}
                                               {{ csrf_field() }}

 --}}
                                    <form method="post" action="{{ route('labors.store') }}" enctype="">
                                    @csrf
                                    <div class="modal-header">
                                                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">×</button>
                                                 <strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add Labor</h3></strong>
                                    </div>
<div class="modal-body">
  
<div style=" width: 100%;">
        
<div class="row" style="margin-top: 5px; margin-left: 1%;">
       <div class="col-md-3  col-lg-offset-1 col-xl-offset-1 col-md-offset-1col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-0 col-lg-3 col-xl-3">
          <!-- Profile Image -->
          <div class="">
            <div class="box-body box-profile">
                <head><h4>Upload Labor CNIC</h4></head>
                <hr>
             <img class="img-fluid img-responsive"  style="min-width: 100%; min-height: 200px;">
              <hr>
              <div class="form-group">
              <input type="file" class="btn btn-primary col-md-12 col-xs-12" id="cont_image"
                               name="cont_image" required>
            </div>
          </div>
      </div>
  </div>

    <div class="col-md-8 col-sm-10 col-xs-offset-1 col-sm-offset-0 col-xs-10 col-lg-8 col-xl-8" style="/*max-width: 70%;*/ padding-bottom: 30px;">
        <div>
        {{-- <div class="box-header">
            <h2 class="text-center">Add Labor</h2>
        </div> --}}
        <div class="box-body">
            
                <div class="col-lg-9 col-lg-offset-2">
                    <div class="form-group">
                        <label for="name">Labor Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Labor Name" name="name">

                    </div>
                    <div class="form-group">
                        <label for="cnic">Labor CNIC</label>
                        <input type="text" class="form-control" id="cnic" placeholder="Labor CNIC" name="cnic">
                    </div>
                    <div class="form-group">
                        <label for="phone">Labor Contact</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" maxlength="14" class="form-control" placeholder="Contact Number"
                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                   data-mask="" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Labor Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Home Address"
                               name="address">
                    </div>
                    <div class="form-group">
                        <label for="city">Labor City</label>
                        <input type="text" class="form-control" id="city" placeholder="Home City" name="city">
                    </div>
                    <div class="form-group">
                        <label for="rate">Labor Price</label>
                        <input type="text" class="form-control" id="rate" placeholder="Labor Rate(per Day)"
                               name="rate">
                    </div>
                     <div class="form-group">
                        <label for="project_id">Project ID</label>
                        <input type="number" class="form-control" id="project_id" placeholder="Proect ID"
                               name="project_id" required>
                    </div>
                  

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-top: 20px;">Add Labor</button>
                </div>
        </div>
    </div>








</div>
</div>
</form>
</div>
</div>
</div>
{{-- 
                                                <strong><b><h3>Are You Sure? You Want Delete This Record?</h3></b></strong>
                                                <input type="hidden", name="applicant_id" id="app_id"> --}}
{{-- <div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary waves-effect" >Add Labor</button>
</div> --}}
 {{-- <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button> --}}


{{-- _____________________________________________________END of ADD LABOR ________________________________________________--}}

</div>
</div>  
</div>


<script type="text/javascript">


    $('.labor').DataTable({
        select:true,
        "order": [[0, "asc"]],
        //"scrollY"  : "380px",
        "scrollCollapse": true,
        "paging"   : true,
        "bProcessing" : true,
        // fixedHeader: {
        //     header: false,
        //     // headerOffset: 100,
        //     },
            //scrollX: true,
            // scrollY: true
    });

//     $('.dataTables_scrollBody').scroll(function(){
// $('.fixedHeader-floating').scrollLeft($(this).scrollLeft());
// });


// function myFunction(x) 
// {
//   if (x.matches) 
//   { // If media query matches
    
//      $('.labor').DataTable({
//         select:true,
//         "order": [[0, "asc"]],
//         "scrollY"  : "380px",
//         "scrollCollapse": true,
//         "paging"   : true,
//         "bProcessing" : true,
//         fixedHeader: {
//             header: true,
//             headerOffset: 45,
//             },
//             scrollX: true
//     });
//    // document.body.style.backgroundColor = "yellow";
//   } 
//   else 
//   {

//  $('.labor').DataTable({
//         select:true,
//         "order": [[0, "asc"]],
//         "scrollY"  : "380px",
//         "scrollCollapse": true,
//         "paging"   : true,
//         "bProcessing" : true,

//         // fixedHeader: {
//         //     header: false,
//         //     headerOffset: 100,
//         //     },
//             // scrollX: true,
//             // scrollY: true
//     });

//   // document.body.style.backgroundColor = "pink";
//   }
// }
// var x = window.matchMedia("(max-width: 750px)")
// myFunction(x) // Call listener function at run time
// x.addListener(myFunction) // Attach listener function on state changes
</script>

@stop

