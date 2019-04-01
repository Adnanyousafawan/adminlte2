@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')

<div class="box box-primary" style="padding-bottom: 85px;">
            <div class="box-header">
              <h2 class="text-center">Add Vendor</h2>
            </div>
<div class="box-body" >
	<div class="col-lg-8 col-lg-offset-2">
      			
                <div class="form-group">
                  <label for="man_name">Vendor Name</label>
                  <input type="text" class="form-control" id="man_name" placeholder="Manager Name">
                </div>
                <div class="form-group">
                  <label for="man_cnic">Vendor INIC</label>
                  <input type="text" class="form-control" id="man_cnic" placeholder="Manager CNIC">
                </div>
                <div class="form-group">
                	<label for="man_contact">Vendor Contact</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" placeholder="Contact Number" data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']" data-mask="" id="man_contact">
                </div>
                </div>
                <div class="form-group">
                  <label for="man_city">Address</label>
                  <input type="text" class="form-control" id="man_city" placeholder="Home Address">
                </div>
                <div class="form-group">
                  <label for="man_city">City</label>
                  <input type="text" class="form-control" id="man_city" placeholder="Home City">
                </div>

                <div class="form-group">
                <label>Select Material Type</label>
                <select class="form-control">
                    <option>Material 1</option>
                    <option>Material 2</option>
                    <option>Material 3</option>
                    <option>Material 4</option>
                    <option>Material 5</option>
                </select>
                </div>
                  <div class="form-group">
                  <label for="mat_price">Material Price</label>
                  <input type="text" class="form-control" id="mat_price" placeholder="Material Price(per single entity)">
                </div>
              <div class="form-group">
                  <label for="mat_picture">Upload Picture</label>
                  <input type="file" id="mat_picture">
                </div> 
                <button type="button" class="btn btn-block form-control btn-primary btn-xs">Add Vendor</button>
         </div>
     </div>     
     </div>


@stop