@extends('adminlte::page')
@section('title', 'AdminLTE')
@include('common')
@section('content')
    @yield('meta_tags')
    @yield('error_logs')
    @yield('breadcrumbs')

    <div class="box box-primary" style="padding-bottom: 85px;">
        <div class="box-header">
            <h2 class="text-center">Update Project</h2>
        </div>
        <div class="box-body">
            <form method="post" action="{{ route('projects.update', ['id' => $projects->id]) }}" role="form"
                  enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row">

                    <div
                        class="col-md-3 col-md-offset-0 col-xl-3 col-xl-offset-0 {{-- col-lg-offset-1 col-xl-offset-1  col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-0 col-lg-3 col-xl-3 --}}">
                        <!-- Profile Image -->

                        <div class="user-profile col-md-offset-1">
                            <div class="img-div">
                                <img  class="profile-user-img img-responsive" src="/storage/{{$projects->contract_image}}"
                                 alt="" style="min-width: 250px; min-height: 200px; max-height: 200px; max-width: 260px; "></div>
                            <br>
                            <div class="form-group">
                                <input type="file" name="contract_image"
                                       class="btn btn-default btn-sm profile-picture-uploader" id="contract_image"> {{-- data-toggle="modal" data-target="#uploadprofilepicture"  class="btn btn-default btn-sm profile-picture-uploader" id="cont_image"
                                                                   name="cont_image"--}}
                            </div>
                        </div>
                    </div>


    <div class="col-md-7 col-md-offset-1 col-sm-7 col-sm-offset-1 col-lg-7 col-lg-offset-1"> 
                    <div class="col-lg-12 col-lg-offset-0">

                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Project Title <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="title" id="title"
                                   value="{{ $projects->title }}"
                                   placeholder="Project Title" pattern="[A-Za-z0-9\w].{3,150}"
                                           title="Minimum 4 letter word required for Title" required="alert-danger" >
                            @if ($errors->has('title'))
                                <span class="help-block">
                            <strong style="color: red; float: right;">{{ $errors->first('title') }}</strong>
                          </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('area') ? ' has-error' : '' }}">
                            <label for="area">Project Location <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="area" id="area"  pattern="[A-Za-z0-9\w].{3,150}"
                                           title=" Minimum 4 letters word is required" value="{{ $projects->area }}"
                                   placeholder="Project Location">
                            @if ($errors->has('area'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('area') }}</strong>                              
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city">Project City <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="city" id="city" value="{{ $projects->city }}"
                                   placeholder="Project City" pattern="[A-Za-z0-9\w].{3,100}"
                                           title=" Minimum 4 letters word is required" required>
                            @if ($errors->has('city'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('city') }}</strong>                              
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('plot_size') ? ' has-error' : '' }}">
                            <label for="plot_size">Plot Size <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="plot_size" id="plot_size"
                                   value="{{ $projects->plot_size }}"
                                   placeholder="Project plot size"
                                    pattern="[A-Za-z0-9\w].{1,50}"
                                           title=" Minimum 2 letters required" required>
                            @if ($errors->has('plot_size'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('plot_size') }}</strong>                              
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('floor') ? ' has-error' : '' }}">
                            <label for="floor">Project Floors <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="floor" id="floor"
                                   value="{{ $projects->floor }}"
                                   placeholder="Enter number of floors"  pattern="[A-Za-z0-9\w].{0,10}"
                                           title=" Minimum 1 letters required" required>
                            @if ($errors->has('floor'))
                                <span class="help-block">
                            <strong style="color: red; float: right;">{{ $errors->first('floor') }}</strong>                              
                            </span>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Customer Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Customer Name"
                                   value="{{ $customer->name }}"
                                   name="name"  pattern="[A-Za-z0-9\w].{2,50}"
                                           title="Minimum 3 letters required for Name" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('cnic') ? ' has-error' : '' }}">
                            <label for="cnic">Customer CNIC <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" placeholder="CNIC" id="cnic" name="cnic" onkeypress="return isNumber(event)" onpaste="return false;"
                                 maxlength="13" pattern="[0-9].{12,13}"  title="Enter 13 digit CNIC Number. Example: ( 3434359324554 )" 
                                   value="{{ $customer->cnic }}" required>
                            @if ($errors->has('cnic'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('cnic') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone">Customer Contact <span style="color: red;">*</span></label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="Contact Number" id="phone" name="phone" onkeypress="return isNumber(event)" onpaste="return false;" maxlength="11" pattern="[0-9].{10}" title="Enter 11 Digit Number. Example:(03330234334)"
                                value="{{ $customer->phone }}" required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address">Home Address <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ $customer->address }}"
                                   placeholder="Home Address" pattern="[A-Za-z0-9\w].{4,100}"
                                           title=" Minimum 5 letters word required" required>
                            @if ($errors->has('address'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('assigned_to') ? ' has-error' : '' }}">
                            <label for="assigned_to">Select Contractor <span style="color: red;">*</span></label>
                            <select class="form-control" id="assigned_to" name="assigned_to" required="">
                                <option default style="color: red;" value="{{ $projects->assigned_to  }}">{{ $current_contractor }}</option>
                                @foreach($contractors as $contractor)
                                    @if($contractor->name != $current_contractor)
                                        <option value="{{ $contractor->id }}">{{ $contractor->name}}</option>
                                    @endif
                                @endforeach

                            </select>
                            @if ($errors->has('assigned_to'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('assigned_to') }}</strong>                              
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('estimated_completion_time') ? ' has-error' : '' }}">
                            <label for="estimated_completion_time">Estimated Completion Time <span style="color: red;">*</span></label>
                            <select class="form-control" id="estimated_completion_time" name="estimated_completion_time"
                                    value="{{ $projects->estimated_completion_time }}" required="">
                            <option default style="color: red;">{{ $projects->estimated_completion_time }}</option>
                                <option>1 year</option>
                                <option>2 year</option>
                                <option>3 year</option>
                                <option>4 year</option>
                                <option>5 year</option>
                            </select>
                            @if ($errors->has('estimated_completion_time'))
                                <span class="help-block">
                                <strong
                                    style="color: red; float: right;">{{ $errors->first('estimated_completion_time') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('estimated_budget') ? ' has-error' : '' }}">
                            <label for="estimated_budget">Estimated Budget <span style="color: red;">*</span></label>
                            <input type="text" name="estimated_budget" id="estimated_budget" class="form-control"
                                   placeholder="Estimated budget cost(in Millions)"
                                   value="{{ $projects->estimated_budget }}" pattern="[0-9]{4,100}"
                                           title=" Minimum 4 digit number required">
                            @if ($errors->has('estimated_budget'))
                                <span class="help-block">
                                <strong
                                    style="color: red; float: right;">{{ $errors->first('estimated_budget') }}</strong>
                                </span>
                            @endif
                        </div>
                           <div class="form-group">
                              <label for="description">Add Description</label>
                              <textarea class="form-control" id="description" name="description" maxlength="200" rows="2" cols="50" pattern="[0-9].{4,200}"
                                              title=" Minimum 5 letter word, Maximum 200 words">{{ $projects->description }}</textarea>
                              @if ($errors->has('description'))
                                      <span class="help-block alert-danger">
                                      <strong>{{ $errors->first('description') }}</strong>
                                      </span>
                              @endif
                          </div>

                        <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Update Project
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@yield('datatable_stylesheets')

<script type="text/javascript">     
    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ( (charCode > 31 && charCode < 48) || charCode > 57) {
        return false;
    }
        return true;
    }
</script>

@stop
