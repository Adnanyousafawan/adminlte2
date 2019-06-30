@include('projects.modal')
@include('common')
@yield('datatable_stylesheets')

@section('project_datatable')

    {{-- _________________________________All Projects DataTable_____________________________________--}}
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12 col-md-offset-0 col-lg-offset-0 col-xl-offset-0"
         style="padding: 2%; ">
        <div class="box" style="margin-bottom: 10px; margin-top: 1%;">
            <div class="box-header with-border ">
                <h4><span class="box-title col-md-8">Project Record</span></h4>
                <br>
                <div class="col-md-offset-0 col-lg-offset-0 col-xl-offset-0" style="margin-top: 10px;">

                    <div class="container">
                        {{-- <a class="active" href=" {{ route('orders.list') }}" style="font-size: 18px;">All &nbsp; | &nbsp; </a>  --}}
                        <a class="active" href=" {{ route('projects.current') }}" style="font-size: 18px;">Current
                            Projects &nbsp; | &nbsp;</a>
                        <a class="active" href=" {{ route('projects.completed') }}" style="font-size: 18px;">Completed
                            &nbsp; | &nbsp;</a>
                        <a class="active" href=" {{ route('projects.pending') }}" style="font-size: 18px;">Pending
                            &nbsp; | &nbsp;</a>
                        <a class="active" href=" {{ route('projects.cancelled') }}" style="font-size: 18px;">Cancelled
                            &nbsp; | &nbsp;</a>
                    </div>
                </div>
                <div class="box-tools pull-right">
                    <a type="links" {{-- href="{{ route('projects.create') }}" --}}  data-toggle="modal"
                       data-target="#applicantADDModal" class="btn btn-primary pul-right">Add Project</a>
                </div>

            </div>

            <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                <table class="table no-margin table-bordered table-striped project">
                    <thead>
                    <tr>
                        <th style="max-width: 5px;"></th>
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
                            <td style="max-width: 5px;"><b>PR-</b></td>
                            <td>0000{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->customer_id }}</td>
                            <td>{{ $project->assigned_to}}</td>
                            <td>{{ $project->estimated_budget}}</td>
                            <td>25000</td>
                            <td style="max-width: 50px;">

                                <div class="btn-group">

                                    <button class="btn btn-success" type="button">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-success dropdown-toggle"
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

@section('datatable_script')

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

@endsection
