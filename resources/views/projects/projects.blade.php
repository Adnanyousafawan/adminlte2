@extends('adminlte::page')
@section('title', 'All Projects')

@include('projects.DataTables.All_Projects')

@section('content')
    @yield('bootstrap_jquery')
    @yield('error_logs')
    @yield('breadcrumbs')

    <div class="row">
        @yield('project_datatable')
    </div>
    @yield('datatable_script')


@stop

