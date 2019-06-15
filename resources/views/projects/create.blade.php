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
        <form method="post" action="{{ route('projects.store') }}" role="form" enctype="multipart/form-data">
            @csrf
            <div class="col-md-3 col-md-offset-1 col-xs-offset-1 col-xs-10">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <head><h4>Upload Contract</h4></head>
                        <hr>
                        <img class="img-fluid img-responsive" style="min-width: 100%; min-height: 200px;">
                        <hr>
                        <div class="form-group">
                            <input type="file" class="btn btn-primary col-md-12 col-xs-12" id="contract_image"
                                   name="contract_image">
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="box box-primary col-md-7 col-md-offset-0 col-xs-10 col-xs-offset-1" {{-- style="max-width: 90%; margin-left: 5%; --}}>
                <div class="box-body">
                    <div class="col-md-9 col-md-offset-2">
                        <div class="box-header">
                            <h2 class="text-center">Add Project Details</h2>
                        </div>

                        <div class="form-group">
                            <label for="title">Project Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Project Title" required>
                        </div>

                        <div class="form-group">
                            <label for="area">Project Location</label>
                            <input type="text" class="form-control" name="area" id="area"
                                   placeholder="Project Location" required>
                        </div>

                        <div class="form-group">
                            <label for="city">Project City</label>
                            <input type="text" class="form-control" name="city" id="city"
                                   placeholder="Project City" required>
                        </div>

                        <div class="form-group">
                            <label for="plot_size">Project Size</label>
                            <input type="text" class="form-control" name="plot_size" id="plot_size"
                                   placeholder="Project plot size" required>
                        </div>

                        <div class="form-group">
                            <label for="floor">Project Floors</label>
                            <input type="text" class="form-control" name="floor" id="floor"
                                   placeholder="Enter number of floors" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Customer Name"
                                   name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="cnic">Customer CNIC</label>
                            <input type="text" class="form-control" id="cnic" placeholder="Customer CNIC"
                                   name="cnic" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Customer Contact</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="number" maxlength="14" class="form-control"
                                       data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask=""
                                       id="phone" name="phone" required>
                                {{-- <input type="number" maxlength="14" class="form-control" placeholder="+092-3330416263"
                                       data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                       data-mask="" id="phone" name="phone" required> --}}
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="address">Home Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Home Address" required>
                        </div>

                        <div class="form-group">
                            <label for="assigned_to">Select Contractor</label>
                            <select class="form-control" id="assigned_to" name="assigned_to">
                                @foreach($contractors as $contractor)
                                    <option>{{ $contractor->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estimated_completion_time">Estimated Completion Time</label>
                            <select class="form-control" id="estimated_completion_time"
                                    name="estimated_completion_time">
                                <option>1 year</option>
                                <option>2 year</option>
                                <option>3 year</option>
                                <option>4 year</option>
                                <option>5 year</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estimated_budget">Estimated Budget</label>
                            <input type="text" name="estimated_budget" id="estimated_budget" class="form-control"
                                   placeholder="Estimated budget cost(in Millions)" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Add Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5">
                        </textarea>
                        </div>
                        {{--   <div class="custom-file form-group">
                              <label class="contract_image " for="contract_image">Upload Contract</label>
                              <input type="file" class="form-control custom-file-input" id="contract_image"
                                     name="contract_image">
                          </div> --}}

                        <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Project</button>
                    </div>
                </div>
            </div>
    </div>
    </form>

@stop
