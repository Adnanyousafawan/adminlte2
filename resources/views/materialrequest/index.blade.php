@extends('adminlte::page')

@section('title', 'Material Requests')
@include('common')

@include('materialrequest.MaterialRequest_Table.material_request_datatable')

@yield('meta_tags')
 {{-- 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="csrf-token" content="{{csrf_token()}}"> --}}

        {{--    <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
           <script src="/js/jquery-3.4.1.js"></script>
           --}}

@section('content')
  @yield('error_logs')
    @yield('breadcrumbs')

        <div class="box-body" id="screen">
            <div class="box box-body" style=" background-color: #f4f4f487; padding: 2%;">
                <div class="box-header" >
                     <div class="row" style="padding-left:14px; padding-right: 14px;">
                    <h3><span
                            class="col-xs-6 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"
                            style="margin-bottom: 10px; padding: 0px;">Material Requests</span></h3>
                    <div class="box-tools pull-right">
                        <a type="links" href="{{ route('order.create') }}" class="btn btn-primary pull-right">Place
                            Order</a>
                    </div>
                </div>
                   {{-- _________________________________All Material DataTable_____________________________________--}}
                        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"

                            style="padding: 0px; margin-left: 0px;">
                           
                            
                            <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                                <div class="box-header with-border ">
                                    <h4><span class="box-title col-md-8">Material Request Details</span></h4>
                                    <br>
                                     <div class="container">
                                <a class="active" href=" {{ route('requests.index') }}" style="font-size: 20px;">All
                                    &nbsp; | &nbsp; </a>
                                <a class="active" href=" {{ route('requests.approved') }}" style="font-size: 20px;">Approved
                                    &nbsp; | &nbsp; </a>
                                <a class="active" href=" {{ route('requests.rejected') }}" style="font-size: 20px;">Rejected
                                    &nbsp; | &nbsp;</a>
                                 <a class="active" href=" {{ route('requests.pending') }}"  style="font-size: 20px;">Pending</a> 
                            </div>
                                </div>

                @yield('matrial_request_table')


                </div>
            </div>
            </div>
        </div>

<h4 id="result"></h4>
@yield('datatable_stylesheets')
@yield('datatable_script')
@stop
