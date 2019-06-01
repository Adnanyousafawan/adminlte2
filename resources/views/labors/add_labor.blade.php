
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
                        <label for="lab_name">Labor Name</label>
                        <input type="text" class="form-control" id="lab_name" placeholder="Labor Name" name="lab_name"required>

                    </div>
                    <div class="form-group">
                        <label for="lab_cnic">Labor CNIC</label>
                        <input type="text"  maxlength="15" class="form-control" id="lab_cnic" placeholder="Labor CNIC" name="lab_cnic"required>
                    </div>
                    <div class="form-group">
                        <label for="lab_contact">Labor Contact</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" maxlength="14" class="form-control" placeholder="Contact Number"
                                   data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                   data-mask="" id="lab_contact" name="lab_phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lab_address">Labor Address</label>
                        <input type="text" class="form-control" id="lab_address" placeholder="Home Address"
                               name="lab_address"required>
                    </div>
                    <div class="form-group">
                        <label for="lab_city">Labor City</label>
                        <input type="text" class="form-control" id="lab_city" placeholder="Home City" name="lab_city" required>
                    </div>
                    <div class="form-group">
                        <label for="lab_rate">Labor Price</label>
                        <input type="text" class="form-control" id="lab_rate" placeholder="Labor Rate(per Day)"
                               name="lab_rate" required>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control" style="margin-top: 20px;">Add Labor</button>
                </div>
            </form>
        </div>
    </div>
@stop