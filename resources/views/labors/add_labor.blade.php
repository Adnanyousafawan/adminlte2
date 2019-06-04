
@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
</html>

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
    
<div class="box box-primary" style="padding-bottom: 50px; max-width: 90%; margin-left: 5%;">
        
<div class="row" style="margin-top: 30px;">
   <form method="post" action="{{ route('labors.store') }}" enctype="">
    @csrf
       <div class="col-md-3 col-md-offset-1 col-xs-offset-1 col-xs-10">
          <!-- Profile Image -->
          <div class="box box-primary">
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

    <div class="box box-primary col-md-7 col-md-offset-0 col-xs-10 col-xs-offset-1" style="padding-bottom: 30px;">
        <div class="box-header">
            <h2 class="text-center">Add Labor</h2>
        </div>
        <div class="box-body">
            
                <div class="col-lg-9 col-lg-offset-2">
                    <div class="form-group">
                        @csrf

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
            </form>
        </div>
    </div>
@stop