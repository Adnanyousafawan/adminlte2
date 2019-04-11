@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')
@if ($errors->any())
  <div class="alert alert-danger">
       <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
        </ul>
  </div><br/>
@endif

<div class="box box-primary" style="padding-bottom: 85px;">
            <div class="box-header">
              <h2 class="text-center">Add Labor</h2>
            </div>
<div class="box-body">
  <form method="post" action="{{ route('labors.store') }}">
	<div class="col-lg-8 col-lg-offset-2">
                <div class="form-group">
                @csrf
                  <label for="lab_name">Labor Name</label>
                  <input type="text" class="form-control" id="lab_name" placeholder="Labor Name" name="lab_name">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group">
                  <label for="lab_cnic">Labor CNIC</label>
                  <input type="text" class="form-control" id="lab_cnic" placeholder="Labor CNIC" name="lab_cnic">
                </div>
               <div class="form-group">
                	<label for="lab_contact">Labor Contact</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" placeholder="Contact Number" data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']" data-mask="" id="lab_contact" name="lab_phone">
                </div>
                </div>
                <div class="form-group">
                  <label for="lab_address">Labor Address</label>
                  <input type="text" class="form-control" id="lab_address" placeholder="Home Address" name="lab_address">
                </div>
                <div class="form-group">
                  <label for="lab_city">Labor City</label>
                  <input type="text" class="form-control" id="lab_city" placeholder="Home City" name="lab_city">
                </div>
                <div class="form-group">
                  <label for="lab_rate">Labor Price</label>
                  <input type="text" class="form-control" id="lab_rate" placeholder="Labor Rate(per Day)" name="lab_rate">
                </div>
                  <div class="form-group">
                  <label for="cont_picture">Upload Picture</label>
                  <input type="file" id="cont_picture" name="cont_picture">
                </div>
                 
          <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Labor</button>           
</div>
</form>
</div>
</div>
@stop