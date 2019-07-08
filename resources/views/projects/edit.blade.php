@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')


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

    @if (session('success'))
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('message'))
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <ol class="breadcrumb">
        <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a></li>
        <?php $segments = ''; ?>
        @foreach(Request::segments() as $segment)
            <?php $segments .= '/' . $segment; ?>
            <li>
                <a href="{{ $segments }}">{{$segment}}</a>
            </li>
        @endforeach
    </ol>




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
                        class="col-md-3 col-md-offset-1 col-xl-3 col-xl-offset-1 {{-- col-lg-offset-1 col-xl-offset-1  col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-0 col-lg-3 col-xl-3 --}}">
                        <!-- Profile Image -->

                        <div class="no-profile-picture">
                            <div class="img-div"><img src="https://paksa.pk/public/images/upload.png"
                                                      class="contract_image" alt=""></div>
                            <br>
                            <div class="btn">
                                <input type="file" name="contract_image"
                                       class="btn btn-default btn-sm profile-picture-uploader" id="contract_image"> {{-- data-toggle="modal" data-target="#uploadprofilepicture"  class="btn btn-default btn-sm profile-picture-uploader" id="cont_image"
                                                                   name="cont_image"--}}
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-lg-offset-1">

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="title">Project Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   value="{{ $projects->title }}"
                                   placeholder="Project Title" required="alert-danger">
                            @if ($errors->has('title'))
                                <span class="help-block">
                            <strong style="color: red; float: right;">{{ $errors->first('title') }}</strong>
                          </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="area">Project Location</label>
                            <input type="text" class="form-control" name="area" id="area" value="{{ $projects->area }}"
                                   placeholder="Project Location">
                            @if ($errors->has('area'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('area') }}</strong>                              
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="city">Project City</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{ $projects->city }}"
                                   placeholder="Project City">
                            @if ($errors->has('city'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('city') }}</strong>                              
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="plot_size">Project Size</label>
                            <input type="text" class="form-control" name="plot_size" id="plot_size"
                                   value="{{ $projects->plot_size }}"
                                   placeholder="Project plot size">
                            @if ($errors->has('plot_size'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('plot_size') }}</strong>                              
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="floor">Project Floors</label>
                            <input type="text" class="form-control" name="floor" id="floor"
                                   value="{{ $projects->floor }}"
                                   placeholder="Enter number of floors">
                            @if ($errors->has('floor'))
                                <span class="help-block">
                            <strong style="color: red; float: right;">{{ $errors->first('floor') }}</strong>                              
                            </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Customer Name"
                                   value="{{ $customer->name }}"
                                   name="name">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="cnic">Customer CNIC</label>
                            <input type="text" class="form-control" id="cnic" placeholder="Customer CNIC"
                                   value="{{ $customer->cnic }}"
                                   name="cnic">
                            @if ($errors->has('cnic'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('cnic') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="phone">Customer Contact</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="Contact Number"
                                       value="{{ $customer->phone }}"
                                       data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                       data-mask="" id="phone" name="phone">
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Home Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ $customer->address }}"
                                   placeholder="Home Address">
                            @if ($errors->has('address'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="assigned_to">Select Contractor</label>
                            <select class="form-control" id="assigned_to" name="assigned_to">
                                @foreach($contractors as $contractor)
                                    <option>{{ $contractor->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('assigned_to'))
                                <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('assigned_to') }}</strong>                              
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="estimated_completion_time">Estimated Completion Time</label>
                            <select class="form-control" id="estimated_completion_time" name="estimated_completion_time"
                                    value="{{ $projects->estimated_completion_time }}">
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

                        <div class="form-group">
                            <label for="estimated_budget">Estimated Budget</label>
                            <input type="text" name="estimated_budget" id="estimated_budget" class="form-control"
                                   placeholder="Estimated budget cost(in Millions)"
                                   value="{{ $projects->estimated_budget }}">
                            @if ($errors->has('estimated_budget'))
                                <span class="help-block">
                                <strong
                                    style="color: red; float: right;">{{ $errors->first('estimated_budget') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{--   <div class="form-group">
                              <label for="description">Add Description</label>
                              <textarea class="form-control" id="description" name="description" >
                              </textarea>
                              @if ($errors->has('description'))
                                      <span class="help-block alert-danger">
                                      <strong>{{ $errors->first('description') }}</strong>
                                      </span>
                              @endif
                          </div>

                          <div class="custom-file form-group">
                              <label class="contract_image " for="contract_image">Upload Contract</label>
                              <input type="file" class="form-control custom-file-input" id="contract_image"
                              name="contract_image" value="{{ $projects->contract_image }}">
                              @if ($errors->has('contract_image'))
                                      <span class="help-block">
                                      <strong>{{ $errors->first('contract_image') }}</strong>
                                      </span>
                              @endif
                          </div> --}}

                        <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Update Project
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
