@extends('adminlte::page')
@section('title', 'AdminLTE')

@section('content_header')
    <h1>Add Project</h1>
@stop
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
            <form method="post" action="{{ route('projects.create') }}" role="form" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="form-group">

                        <label for="title">Project Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                               placeholder="Project Title">
                    </div>
                    <div class="form-group">
                        <label for="area">Project Location</label>
                        <input type="text" class="form-control" name="area" id="area"
                               placeholder="Project Location">
                    </div>
                    <div class="form-group">
                        <label for="plot_size">Project Size</label>
                        <input type="text" class="form-control" name="plot_size" id="plot_size"
                               placeholder="Project plot size">
                    </div>

                    <div class="form-group">
                        <label for="floor">Project Floors</label>
                        <input type="text" class="form-control" name="floor" id="floor"
                               placeholder="Enter number of floors">
                    </div>

                    <div class="form-group">
                        <label for="city">Project City</label>
                        <input type="text" class="form-control" name="city" id="city"
                               placeholder="Project City">
                    </div>
                    <div class="form-group">
                        <label for="assigned_to">Select Contractor</label>
                        <select class="form-control" id="assigned_to" name="assigned_to">
                            <option>Contractor 1</option>
                            <option>Contractor 2</option>
                            <option>Contractor 3</option>
                            <option>Contractor 4</option>
                            <option>Contractor 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estimated_completion_time">Estimated Completion Time</label>
                        <select class="form-control" id="estimated_completion_time" name="estimated_completion_time">
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
                               placeholder="Estimated budget cost(in Millions)">
                    </div>
                    <div class="form-group">
                        <label for="description">Add Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5">

                        </textarea>
                    </div>

                    <div class="custom-file form-group">
                        <label class="contract_image " for="contract_image">Upload Contract</label>
                        <input type="file" class="form-control custom-file-input" id="contract_image"
                               name="contract_image">
                    </div>

                    <button type="submit" class="btn btn-block btn-primary btn-xs form-control">Add Project</button>
                </div>
            </form>
        </div>
    </div>

@stop