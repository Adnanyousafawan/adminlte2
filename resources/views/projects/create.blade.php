@extends('adminlte::page')
@section('title', 'AdminLTE')

@section('content_header')
    <h1>Add Project</h1>
@stop
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
              <h2 class="text-center">Add Project</h2>
            </div>
<div class="box-body">
	<form method="post" action="{{ route('projects.store') }}">
		<div class="col-lg-8 col-lg-offset-2">
      			<div class="form-group">
                @csrf
                  <label for="proj_title">Project Title</label>
                  <input type="text" class="form-control" name="proj_title" id="proj_title" placeholder="Project Title">
                </div>

                <div class="form-group">
                  <label for="proj_location">Project Location</label>
                  <input type="text" class="form-control" name="proj_location" id="proj_location
                  " placeholder="Project Location">
                </div>
                <div class="form-group">
                  <label for="proj_dimension">Project Dimension</label>
                  <input type="text" class="form-control" name="proj_dimension" id="proj_dimension" placeholder="Project Dimension">
                </div>
                <div class="form-group">
                  <label for="proj_city">Project City</label>
                  <input type="text" class="form-control" name="proj_city" id="proj_city" placeholder="Project City">
                </div>
                <div class="form-group">
                  <label for="cust_name">Customer Name</label>
                  <input type="text" class="form-control" name="cust_name" id="cust_name" placeholder="Customer Name">
                </div>
                <div class="form-group">
                  <label for="cust_CNIC">Customer CNIC</label>
                  <input type="text" class="form-control" name="cust_CNIC" id="cus_CNIC" placeholder="Customer CNIC">
                </div>
                <div class="form-group">
                <label>US phone mask:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="">
                </div>
            
                  <label for="cus_contact">Customer Contact</label>
                  <input type="text" class="form-control" name="cust_contact" id="cust_contact" placeholder="Customer Contact">
                </div>
                <div class="form-group">
                <label>Select Contractor</label>
                <select class="form-control" id="proj_contractor" name="proj_contractor">
                    <option>Contractor 1</option>
                    <option>Contractor 2</option>
                    <option>Contractor 3</option>
                    <option>Contractor 4</option>
                    <option>Contractor 5</option>
                </select>
            </div>
            <div class="form-group">
                <label>Estimated Completion Time</label>
                <select class="form-control" id="proj_completion_time" name="proj_completion_time">
                    <option>1 year</option>
                    <option>2 year</option>
                    <option>3 year</option>
                    <option>4 year</option>
                    <option>5 year</option>
                </select>
            </div>
            <div class="form-group">
               <div class="row">
                <div class="col-xs-5">
                  <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Zip Code">
                </div>
                <div class="col-xs-5">
                  <input type="text" name="proj_cost" id="proj_cost" class="form-control" placeholder="Estimated Cost(in Rupees)">
                </div>
               </div>
              </div>
              <div class="form-group">
			    <label for="proj_description">Add Description</label>
			    <textarea class="form-control" id="proj_description" name="proj_description" rows="5"></textarea>
			  </div>
              <div class="form-group">
                  <label for="upload_contract">Upload Contract</label>
                  <input type="file" id="upload_contract">
              </div> 

            <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Project</button>
        </div>
    </form>
    </div>
</div>
            
@stop