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
              <h2 class="text-center">Add Supplier</h2>
            </div>
<div class="box-body" >
	<div class="col-lg-8 col-lg-offset-2">
    <form method="post" action="{{ route('suppliers.store') }}">
                <div class="form-group">
                  @csrf
                  <label for="sup_name">Supplier Name</label>
                  <input type="text" class="form-control" id="sup_name" placeholder="Supplier Name" name="sup_name">
                </div>
                <div class="form-group">
                  <label for="sup_inic">Supplier INIC</label>
                  <input type="text" class="form-control" id="sup_inic" placeholder="Supplier INIC" name="sup_inic">
                </div>
                <<div class="form-group">
                  <label for="sup_contact">Supplier Contact</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" placeholder="Contact Number" data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']" data-mask="" id="sup_contact" name="sup_contact">
                </div>
                </div>
                <div class="form-group">
                  <label for="sup_address">Address</label>
                  <input type="text" class="form-control" id="sup_address" placeholder="Home Address" name="sup_address">
                </div>
                <div class="form-group">
                  <label for="sup_city">City</label>
                  <input type="text" class="form-control" id="sup_city" placeholder="Home City" name="sup_city">
                </div>

                <div class="form-group">
                <label>Select Material Type</label>
                <select class="form-control" id="sup_material" name="sup_material" name="sup_material">
                    <option>Material 1</option>
                    <option>Material 2</option>
                    <option>Material 3</option>
                    <option>Material 4</option>
                    <option>Material 5</option>
                </select>
                </div>
                  <div class="form-group">
                  <label for="mat_price">Material Price</label>
                  <input type="text" class="form-control" id="mat_price" placeholder="Material Price(per single entity)" name="mat_price">
                </div>
              <div class="form-group">
                  <label for="mat_picture">Upload Picture</label>
                  <input type="file" id="mat_picture" name="mat_picture">
                </div> 
                <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Supplier</button>
         </div>
       </form>
     </div>     
     </div>
@stop