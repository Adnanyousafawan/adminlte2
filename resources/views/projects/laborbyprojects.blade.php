@extends('adminlte::page')
@section('title', 'Labor by Projects')

@include('projects.laborbyprojects.Labor_At_Projects')


@section('content')
    @yield('bootstrap_jquery')
    @yield('error_logs')
    @yield('breadcrumbs')


    <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12 col-xl-12 col-xl-offset-0 col-md-offset-0 col-lg-offset-0">
            <h3 for="search_area">Search Project</h3>
            <div id="search_area" style="padding: 30px; background-color: rgb(53, 124, 165);">
                <form action="/search_project" method="get">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <input type="search" name="search_title" id="search_title"
                                       placeholder="Search By Title" class="form-control">
                            </div>

                            <div class="col-sm-3">
                                <input type="search" name="search_contractor" id="search_contractor"
                                       placeholder="Search By Contractor" class="form-control">
                            </div>

                            <div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-btn-primary ">Search</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <div class="box" style="margin-bottom: 20px;">
                <div class="box-header with-border">
                    <h3 class="box-title">Labor at Projects</h3>
                </div>
                <!-- /.box-header -->
                @yield('labor_by_projects')
            </div>

        </div>
    </div>

@stop
