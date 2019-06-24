@extends('adminlte::page')
@section('title', 'All Projects')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap-3.4.1.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.css">
    {{-- <link rel="stylesheet" href="/images"> --}}
    <script src="/js/jquery-3.4.1.js"></script>
    <script src="/js/jquery.dataTables.js"></script>

@section('content')


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
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
     @if (session('message'))
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
    @endif



<div class="col-md-offset-1 col-lg-offset-1 col-xl-offset-1">

<div class="container">
    <a class="active" href=" {{ route('projects.all') }}" style="font-size: 18px;">All &nbsp; | &nbsp; </a> 
    <a class="active" href=" {{ route('projects.current') }}" style="font-size: 18px;">Current Projects &nbsp; | &nbsp;</a>
    <a class="active" href=" {{ route('projects.completed') }}"  style="font-size: 18px;">Completed &nbsp; | &nbsp;</a>
     <a class="active" href=" {{ route('projects.pending') }}"  style="font-size: 18px;">Pending &nbsp; | &nbsp;</a>
    <a class="active" href=" {{ route('projects.cancelled') }}"  style="font-size: 18px;">Cancelled &nbsp; | &nbsp;</a>
  </div>
</div>
            {{-- _________________________________All Projects DataTable_____________________________________--}}
            <div
                class="col-xs-12 col-md-10 col-sm-12 col-lg-10 col-xl-10 col-md-offset-1 col-lg-offset-1 col-xl-offset-1"
                style="padding: 5px;">
                <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
                    <div class="box-header with-border ">
                        <h4><span class="box-title col-md-8">Project Record</span></h4>
                        <div class="box-tools pull-right">
                            <a type="links"  {{-- href="{{ route('projects.create') }}" --}}  data-toggle="modal"
                               data-target="#applicantADDModal" class="btn btn-primary pul-right">Add Project</a>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                        <table class="table no-margin table-bordered table-striped project">
                            <thead>
                                <tr>

                                <th>Project ID</th>
                                <th>Project Title</th>
                                <th>Owner Name</th>
                                <th>Contractor</th>
                                <th>Budget</th>
                                <th>Cost Spent</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($projects as $project)
                                <tr>
                                    <td>PR0000{{ $project->id }}</td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->customer_id }}</td>
                                    <td>{{ $project->assigned_to}}</td>
                                    <td>{{ $project->estimated_budget}}</td>
                                    <td>25000</td>
                                    <td style="max-width: 50px;">
                                        
                    <div class="btn-group">

                    {{-- <button class="btn btn-success" type="button">Action</button> --}}
                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <ul role="menu" class="dropdown-menu">
                      <li><a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"><i class="fa fa-edit"></i>View</a></li>
                       
                        <li><a href="{{ route('projects.edit', ['id' => $project->id]) }}"><i class="fa fa-edit"></i>Edit</a></li>
                                             
                        <li><a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $project->id }}"><i class="fa fa-remove"></i>Delete</a></li>
                                          </ul>

                  </div>
                                      {{--   <a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"
                                           style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">View</a>

                                        <a type="links" href="{{ route('projects.edit', ['id' => $project->id]) }}"
                                           style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                                        <a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $project->id }}"
                                           style="color: red; margin-left: 3px;  margin-top: 0px;">Delete</a> --}}

                            </td>
                            </tr>


{{-- ______________________________Delete Modal ______________________________________________--}}

                                <div id="applicantDeleteModal-{{ $project->id }}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                     style="display: none;">
                                    <div class="modal-dialog"
                                         style="min-width:40%; align-content: center;">
                                        <div class="modal-content">
                                            <form class="row" method="POST"
                                                  action="{{ route('projects.destroy', ['id' => $project->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <form action="{{ route('projects.destroy', ['id' => $project->id]) }}"
                                                      method="POST" class="remove-record-model">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×
                                                        </button>
                                                        <h4 class="modal-title text-center"
                                                            id="custom-width-modalLabel">Delete Applicant Record</h4>
                                                    </div>
                                                      <div class="modal-body">
                                                        <strong><b><h3>Are You Sure? <br>You Want Delete This Record?
                                                                </h3></b></strong>
                                                        <input type="hidden" , name="applicant_id" id="app_id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-danger waves-effect remove-data-from-delete-form">
                                                            Delete
                                                        </button>
                                                    </div>
                                                   

                                                </form> 

                                            </form>

                                        </div>
                                    </div>
                                    </div>
                               
                            @endforeach

                        </tbody> 

                    </table>

                    </div>
                </div>
                </div> 
    



            {{-- _______________________________________Model Add New PROJECT_______________________________--}}

                <div id="applicantADDModal" class="modal fade" tabindex="-1" role="dialog"
                     aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" style="min-width:70%; align-content: center; text-align: center;">
                        <div class="modal-content">

                            <form method="post" action="{{ route('projects.store') }}" enctype="">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close pull-right" data-dismiss="modal"
                                            aria-hidden="true">x
                                    </button>
                                    <strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add
                                        Project</h3></strong>
                                </div>


                                <div class="modal-body">

                                    <div style=" width: 100%; margin-left: 1%;">

                                        <div class="row" style="margin-top: 5px;">
                                            <div class="col-md-3 col-md-offset-1 {{-- col-lg-offset-1 col-xl-offset-1  col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-0 col-lg-3 col-xl-3 --}}">
                                                <!-- Profile Image -->

                <div class="no-profile-picture">
                <div class="img-div"><img src="https://paksa.pk/public/images/upload.png" class="user-image" alt=""></div><br>
                <div class="btn">
                    <input type="file" name="cnic" class="btn btn-default btn-sm profile-picture-uploader" id="cnic"> {{-- data-toggle="modal" data-target="#uploadprofilepicture"  class="btn btn-default btn-sm profile-picture-uploader" id="cont_image"
                                                                   name="cont_image"--}}
                                                               </div>
                </div>
            </div>
    



{{-- 
<div class="modal fade show" id="uploadprofilepicture" tabindex="-1" role="dialog" aria-labelledby="updater" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <p class="no-margin">You can upload only 1 image file at a time!</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>    
        <div class="modal-body">             
          <div class="uploadform dropzone no-margin dz-clickable profile-picture-uploader" id="profile-picture-uploader" name="profile-picture-uploader">
            <div class="dz-default dz-message">
              <span>Drop your Cover Picture here</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 --}}
{{--                                                 <div class="">
                                                    <div class="box-body">
                                                        <head><h4>Upload Labor CNIC</h4></head>
                                                        <hr>
                                                        <img class="img-fluid img-responsive"
                                                             style="min-width: 100%; min-height: 200px;">
                                                        <hr>
                                                        <div class="form-group">
                                                            <input type="file"
                                                                   class="btn btn-primary col-md-12 col-xs-12"
                                                                   id="cont_image"
                                                                   name="cont_image" required>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                          

                                            <div
                                                class="col-md-7 col-lg-8 col-md-offset-1 col-lg-offset-0{{-- col-sm-10 col-xs-offset-1 col-sm-offset-0 col-xs-10 col-lg-8 col-xl-8 --}} "
                                                style="/*max-width: 70%;*/ padding-bottom: 30px;">
                                                <div>
                                                    
                                                    <div class="box-body">

                                                        <div class="col-lg-9 col-lg-offset-2">
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
                            <label for="assigned_to pull pull-left">Select Contractor</label>
                            <select class="form-control" id="assigned_to" name="assigned_to">
                               {{--  @foreach($contractors as $contractor)
                                    <option>{{ $contractor->name}}</option>
                                @endforeach --}}
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

                                                            <button type="submit"
                                                                    class="btn btn-block btn-primary btn-xs form-control"
                                                                    style="margin-top: 20px;">Add Project
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                  </div>
  </div>
                            </form>
                        </div>
                    </div>
                </div>


                <script type="text/javascript">


        $('.project').DataTable({
            select: true,
            "order": [[0, "asc"]],
            //"scrollY"  : "380px",
            "scrollCollapse": true,
            "paging": true,
            "bProcessing": true,
            // fixedHeader: {
            //     header: false,
            //     // headerOffset: 100,
            //     },
            //scrollX: true,
            // scrollY: true
        });

       
</script>

@stop

