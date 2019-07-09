@extends('adminlte::page')
@section('title', 'Add Project')


@include('common')
@yield('meta-tags')
@section('content')
    @yield('error_logs')
    @yield('breadcrumbs')
    @yield('bootstrap_jquery')



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
                    class="col-md-7 col-md-offset-0 col-xs-10 col-xs-offset-1 col-lg-7 col-lg-offset-0 col-sm-10 col-sm-offset-1">
                    <div class="box box-primary" {{-- style="max-width: 90%; margin-left: 5%; --}}>
                        <div class="box-body">
                            <div class="col-md-9 col-md-offset-2">
                                <div class="box-header">
                                    <h2 class="text-center">Add Project Details</h2>
                                </div>

                                <div class="form-group">
                                    <label for="title">Project Title <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title"
                                           pattern="[A-Za-z0-9\w]{3,150}"
                                           title="Minimum 3 letter word required for Title"
                                           placeholder="Project Title" required>
                                </div>

                                <div class="form-group">
                                    <label for="area">Project Location <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="area" id="area"
                                           pattern="[A-Za-z0-9\w]{3,150}"
                                           title=" Minimum 3 letters word is required"

                                           placeholder="Project Location" required>
                                </div>

                                <div class="form-group">
                                    <label for="city">Project City <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="city" id="city"
                                           pattern="[A-Za-z0-9\w]{3,100}"
                                           title=" Minimum 3 letters word is required"
                                           placeholder="Project City" required>
                                </div>

                                <div class="form-group">
                                    <label for="plot_size">Project Size <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="plot_size" id="plot_size"
                                           pattern="[A-Za-z0-9\w]{1,50}"
                                           title=" Minimum 1 letters required"
                                           placeholder="Project plot size" required>
                                </div>

                                <div class="form-group">
                                    <label for="floor">Project Floors <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="floor" id="floor"
                                           pattern="[A-Za-z0-9\w]{1,10}"
                                           title=" Minimum 1 letters required"
                                           placeholder="Enter number of floors" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Customer Name <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="name" placeholder="Customer Name"
                                           name="name" pattern="[A-Za-z0-9\w]{2,50}"
                                           title="Minimum 2 letters required for Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="cnic">Customer CNIC <span style="color: red;">*</span></label>
                                    <input type="text"  class="form-control" id="cnic"
                                           placeholder="Customer CNIC"
                                           name="cnic" maxlength="13" pattern="[0-9]{13}" title="Enter 13 digit CNIC Number. Example: ( 3434359324554 )"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Customer Contact <span style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" maxlength="11" class="form-control"
                                               placeholder="Contact Number"
                                               pattern="[0-9]{11}" title="Enter 11 Digit Number. Example:(03330234334)"
                                               id="phone" name="phone" required>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="address">Home Address <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           pattern="[A-Za-z0-9\w]{4,100}"
                                           title=" Minimum 5 letters word required"
                                           placeholder="Home Address" required>
                                </div>

                                <div class="form-group">
                                    <label for="assigned_to">Select Contractor <span
                                            style="color: red;">*</span></label>
                                    <select class="form-control" id="assigned_to" name="assigned_to" required="">
                                        @foreach($contractors as $contractor)
                                            <option>{{ $contractor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="estimated_completion_time">Estimated Completion Time <span
                                            style="color: red;">*</span></label>
                                    <select class="form-control" id="estimated_completion_time"
                                            name="estimated_completion_time" required>
                                        <option>1 year</option>
                                        <option>2 year</option>
                                        <option>3 year</option>
                                        <option>4 year</option>
                                        <option>5 year</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="estimated_budget">Estimated Budget <span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="estimated_budget" id="estimated_budget"
                                           class="form-control"
                                           pattern="[0-9]{4,100}"
                                           title=" Minimum 4 digit number required"
                                           placeholder="Home Address" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Add Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5"
                                              pattern="[0-9]{4,250}"
                                              title=" Minimum 4 digit number">
                        </textarea>
                                </div>

                                <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Project
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
