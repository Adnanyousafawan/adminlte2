@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')
    {{--

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
        @endif --}}
<ol class="breadcrumb">
    <li><a href="{{ route('home')}}"><i class="fa fa-dashboard"></i>  &nbsp;Dashboard</a></li>
    <?php $segments = ''; ?>
    @foreach(Request::segments() as $segment)
        <?php $segments .= '/'.$segment; ?>
        <li>
            <a href="{{ $segments }}">{{$segment}}</a>
        </li>
    @endforeach
</ol>


    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="box box-primary" style="padding-bottom: 85px;">
        <div class="box-header">
            <h2 class="text-center">Add Project</h2>
        </div>
        <div class="box-body">
            <form method="post" action="{{ route('projects.update', ['id' => $projects->id]) }}" role="form"
                  enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="col-lg-8 col-lg-offset-2">

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="title">Project Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $projects->title }}"
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
                        <input type="text" class="form-control" name="floor" id="floor" value="{{ $projects->floor }}"
                               placeholder="Enter number of floors">
                        @if ($errors->has('floor'))
                            <span class="help-block">
                            <strong style="color: red; float: right;">{{ $errors->first('floor') }}</strong>                              
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="name">Customer Name</label>
                        <input type="text" class="form-control" id=_name" placeholder="Customer Name"
                               value="{{ $projects->customer_name }}"
                               name="name">
                        @if ($errors->has('cust_name'))
                            <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('came') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="cnic">Customer CNIC</label>
                        <input type="text" class="form-control" id="cnic" placeholder="Customer CNIC"
                               value="{{ $projects->customer_cnic }}"
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
                                   value="{{ $projects->customer_phone_number }}"
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
                               value="{{ $projects->customer_address }}"
                               placeholder="Home Address">
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong style="color: red; float: right;">{{ $errors->first('address') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="assigned_to">Select Contractor</label>
                        <select class="form-control" id="assigned_to" name="assigned_to"
                                value="{{ $projects->assigned_to }}">
                            <option>Contractor 1</option>
                            <option>Contractor 2</option>
                            <option>Contractor 3</option>
                            <option>Contractor 4</option>
                            <option>Contractor 5</option>
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

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Update Project</button>
                </div>
            </form>
        </div>
    </div>

@stop
