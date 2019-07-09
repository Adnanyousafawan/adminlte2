@extends('adminlte::page')
@section('title', 'Add Supplier')
@include('common')

@section('content')
@yield('meta_tags')
@yield('error_logs')
@yield('breadcrumbs')


{{-- <div class="row"> --}}
<div class="col-md-12 col-md-offset-0 col-xs-12 col-xs-offset-0  col-lg-12 col-lg-offset-0 col-sm-12 col-sm-offset-0 col-xl-12 col-xl-offset-0">

<div class="box" style="background-colors: #f4f4f487;">
    <div class="col-md-10 col-md-offset-1 col-xs-12 col-xs-offset-0  col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xl-8 col-xl-offset-2" style="margin-top: 40px;">


    <div class="box box-primary" style="padding-bottom: 20px;">
        <div class="box-header">
            <h2 class="text-center">Add Supplier</h2>
        </div>
        <div class="box-body">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 ">
                <form method="post" action="{{ route('suppliers.store') }}">
                    <div class="form-group">
                        @csrf
                                                                 <div class="form-group">
                        <label for="name">Name <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z0-9\w]{2,50}" title="Minimum 2 letters required for Name" placeholder="Name" required>
                    </div>

    
                    <div class="form-group">
                        <label for="address">Address <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="address" name="address" pattern="[A-Za-z0-9\w]{4,100}" 
                        title=" Minimum 4 letters required" 
                               placeholder="Home Address" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Contact <span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" maxlength="11" class="form-control" placeholder="Contact Number"
                                   pattern="[0-9]{11}" title="Enter 11 Digit Number. Example:(03330234334)" 
                                    id="phone" name="phone" required>
                        </div>
                    </div>
 
                       
                    <div class="form-group">
                        <label for="city">City<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="city" placeholder="Home City" name="city" pattern="[A-Za-z0-9\w]{4,100}" 
                        title=" Minimum 4 letters required" required>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Supplier</button>
            </form>
            </div>
    
        </div>
    </div>
</div>
</div>

</div>


@yield('datatable_stylesheets')
@stop
