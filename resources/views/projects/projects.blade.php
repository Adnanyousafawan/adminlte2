@extends('adminlte::page')
@section('title', 'All Projects')
@include('projects.DataTables.All_Projects')
@include('common')
@yield('meta_tags')
@section('content')
    @yield('bootstrap_jquery')
    @yield('error_logs')
    @yield('breadcrumbs')

    <div class="box-body" id="screen"
         style="/*max-width: 94%; margin-left: 3%; margin-top: 1%; */ background-color: #f4f4f487; padding-left: 3%; padding-right: 3%;">
     
    <div class="row">
        @yield('project_datatable')
    </div>
</div>

    @yield('datatable_stylesheets')
    @yield('datatable_script')

 
@stop

