@include('projects.modal')
@section('project_datatable')
    {{-- _________________________________All Projects DataTable_____________________________________--}}
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12 col-md-offset-0 col-lg-offset-0 col-xl-offset-0" style="padding-left: 0px; padding-right: 0px; " 
         >
        <div class="box" style="margin-bottom: 10px; margin-top: 1%; padding-left: 10px; padding-right: 10px;">
            <div class="box-header with-border">
                <div class="row">
                <h4><span class="box-title col-md-8">Project Record</span></h4>
                <div class="box-tools pull-right" style="margin-right: 10px;">
                    <a type="links" data-toggle="modal"
                       data-target="#applicantADDModal" class="btn btn-primary pull-right">Add Project</a>
                </div>
                </div>
                <div class="col-md-offset-0 col-lg-offset-0 col-xl-offset-0" style="margin-top: 10px;">
                    <div class="container" style="padding-left: 0px;">
                        <a class="active" href=" {{ route('projects.notstarted') }}" style="font-size: 18px;">Not Started
                            &nbsp; | &nbsp;</a>
                        <a class="active" href=" {{ route('projects.inprogress') }}" style="font-size: 18px;">In Progress
                            &nbsp; | &nbsp;</a>
                        <a class="active" href=" {{ route('projects.completed') }}" style="font-size: 18px;">Completed
                            &nbsp; | &nbsp;</a>
                        <a class="active" href=" {{ route('projects.stopped') }}" style="font-size: 18px;">Stopped
                            &nbsp; | &nbsp;</a>
                        <a class="active" href=" {{ route('projects.halt') }}" style="font-size: 18px;">Halt&nbsp; | &nbsp;</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="margin-top: 10px; ">
                <table class="table no-margin table-bordered table-striped project">
                    <thead>
                    <tr>
                        {{-- <th style="max-width: 10px;"></th> --}}
                        <th>Project ID</th>
                        <th>Project Title</th>
                        <th>Owner Name</th>
                        <th>Contractor</th>
                        <th>Budget</th>
                        <th>Cost Spent</th>
                        <th style="min-width: 65px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            {{-- <td style="max-width: 10px;"><b>PR-</b></td> --}}
                            <td>0000{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->customer_name }}</td>
                            <td>{{ $project->contractor_name}}</td>
                            <td>{{ $project->budget}}</td>
                            <td>25000</td>
                            <td style="min-width: 65px;">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-success btn-sm" type="button">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle"
                                            type="button">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"><i
                                                    class="fa fa-edit"></i>View</a></li>

                                        <li><a href="{{ route('projects.edit', ['id' => $project->id]) }}"><i
                                                    class="fa fa-edit"></i>Edit</a></li>

                                        <li><a type="links" data-toggle="modal"
                                               data-target="#applicantDeleteModal-{{ $project->id }}"><i
                                                    class="fa fa-remove"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        {{-- ______________________________Delete Modal ______________________________________________--}}

                        <div id="applicantDeleteModal-{{ $project->id }}" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                             style="display: none;">
                            <div class="modal-dialog"
                                 style="min-width:40%; align-content: center; text-align: center;">
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
                                                    id="custom-width-modalLabel">Delete Project Record</h4>
                                            </div>
                                            <div class="modal-body">
                                                @yield('delete_modal')
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
        <div class="modal-dialog" style="min-width:70%; align-content: center; ">
            <div class="modal-content">
                <form method="post" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close pull-right" data-dismiss="modal"
                                aria-hidden="true">x
                        </button>
                        <strong><h3 class="modal-title text-center" id="custom-width-modalLabel">Add
                                Project</h3></strong>
                    </div>
                    <div class="modal-body">
                        @yield('add_form_project')
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
