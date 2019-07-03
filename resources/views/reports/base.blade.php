@extends('adminlte::page')
@section('content')
@include('common')
<div class="row"> 

<div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-sm-12 col-sm-offset-0 col-col-xs-12 col-xs-offset-0">
    <!-- Content Header (Page header) -->
     @yield('error_logs')
      @yield('breadcrumbs')
  
    @yield('action-content')
    <!-- /.content -->
  </div>
  </div>
@endsection