@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')

<div class="box box-primary" style="padding-bottom: 85px;">
            <div class="box-header">
              <h2 class="text-center">Add Labor</h2>
            </div>
<div class="box-body">
	<div class="col-lg-8 col-lg-offset-2">
                <div class="form-group has-feedback">
                  <label for="lab_name">Labor Name</label>
                  <input type="text" class="form-control" id="cont_name" placeholder="Labor Name">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group">
                  <label for="lab_cnic">Labor CNIC</label>
                  <input type="text" class="form-control" id="cont_cnic" placeholder="Labor CNIC">
                </div>
               <div class="form-group">
                	<label for="lab_contact">Labor Contact</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" placeholder="Contact Number" data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']" data-mask="" id="lab_contact">
                </div>
                </div>
                <div class="form-group">
                  <label for="lab_city">Labor Address</label>
                  <input type="text" class="form-control" id="lab_city" placeholder="Home Address">
                </div>
                <div class="form-group">
                  <label for="lab_city">Labor City</label>
                  <input type="text" class="form-control" id="lab_city" placeholder="Home City">
                </div>
                <div class="form-group">
                  <label for="lab_price">Labor Price</label>
                  <input type="text" class="form-control" id="lab_price" placeholder="Labor Price(per Day)">
                </div>

                     <div class="form-group">
                  <label for="cont_picture">Upload Picture</label>
                  <input type="file" id="cont_picture">
                </div> 
                <button type="button" class="btn btn-block btn-primary btn-xs">Add Labor</button>
              

                
</div>
</div>
</div>
@stop