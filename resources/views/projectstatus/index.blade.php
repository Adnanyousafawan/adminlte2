@extends('adminlte::page')
@section('title', 'AdminLTE')

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

<div class="col-md-8 col-xl-8 col-lg-8 col-sm-10 col-xs-12 col-md-offset-2 col-xl-offset-2 col-lg-offset-2 col-sm-offset-1 col-xs-offset-0 " style="margin-bottom: 70px;">

  <div class="box box-primary" style="margin-bottom: 10px;">
    <div class="box-header with-border">
      <h3 class="box-title">Project Status</h3>

      <div class="box-tools pull-right">
        <a href="{{ route('projectstatus.create')}}" class="btn btn-sm btn-primary btn-flat pull-left">Add Project Status</a>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
        <table class="table no-margin">
          <thead>
            <tr>
              <th>Phase ID</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
           @foreach($statuses as $status)
           <tr>
            <td><a>{{ $status->id }}</a></td>
            <td>{{ $status->name }}</td>
            <td style="max-width: 50px;">

              <div class="btn-group">

                {{-- <button class="btn btn-success" type="button">Action</button> --}}
                <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul role="menu" class="dropdown-menu">
                  <li><a href="{{ route('projectstatus.edit', ['id' => $status->id]) }}"><i class="fa fa-edit"></i>Edit</a></li>
                  <li><a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $status->id }}"><i class="fa fa-remove"></i>Delete</a></li>
                </ul>
              </div>
            </td>
          </tr>


          {{-- ______________________________Delete Modal ______________________________________________--}}

          <div id="applicantDeleteModal-{{ $status->id }}" class="modal fade" tabindex="-1" role="dialog"
           aria-labelledby="custom-width-modalLabel" aria-hidden="true"
           style="display: none;">
           <div class="modal-dialog"
           style="min-width:40%; align-content: center; text-align: center;">
           <div class="modal-content">
            <form class="row" method="POST"
            action="{{ route('projectstatus.destroy', ['id' => $status->id]) }}">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <form action="{{ route('projectstatus.destroy', ['id' => $status->id]) }}"
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
<!-- /.table-responsive -->
</div>
<!-- /.box-body -->

</div>
<!-- /.box -->
</div>

@endsection

