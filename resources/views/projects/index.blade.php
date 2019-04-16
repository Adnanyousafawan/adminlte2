@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')

    <!-- Main content -->
     <div class="box-body">
      <div class="box" style="background-color:rgb(236, 240, 245);">
  <div class="box-body">
    <div class="row">
        <div class="col-sm-8">
          
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary  form-control" href="{{ route('projects.create') }}">Add new Project</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
 
  <h3 class="box-title" for="table_all" style="margin-left: 15px;">List of All Project</h3>
  {{-- <h3 for="search_area">Search Project</h3> --}}
  <div id="search_area" style="padding: 15px; background-color: rgb(53, 124, 165);">   
    <form action="/search_project" method="get" style="margin-bottom: 30px;">
    @csrf
      <div class="row" >
        <div class="form-group">
          <div class="col-sm-4">
            <input type="search" name="search_title" id="search_title" placeholder="Search By Title" class="form-control" style="margin: 5px;">
          </div>

          <div class="col-sm-4">
            <input type="search" name="search_customer" id="search_customer" placeholder="Search By Customer" class="form-control" style="margin: 5px;">
          </div>
        
        <div> 
        <div class="col-sm-3">
          <button type="submit" class="btn btn-btn-primary form-control " style=" margin: 5px;" >Search</button> 
      </div>
    </div>

    </div>
 </form>
</div>
    {{--   <form method="POST" action="{{ route('employee-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['First Name', 'Department_Name'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['firstname'] : '', isset($searchingVals) ? $searchingVals['department_name'] : '']])
          @endcomponent
        @endcomponent
      </form> --}}


    <div id="table_all" class="dataTables_wrapper form-inline dt-bootstrap" style="background-color:rgb(247, 248, 249);">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="5%" class="sorting" tabindex="0" aria-controls="example2" rowspan="2" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Title</th>
                <th width="5%" class="sorting" tabindex="0" aria-controls="example2" rowspan="2" colspan="1" aria-label="Email: activate to sort column ascending">Owner Name</th>    
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="2" colspan="1" aria-label="Phone Number: activate to sort column ascending">Location</th>     
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="2" colspan="1" aria-label="Role: activate to sort column ascending">Assigned To</th> 
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="2" colspan="1" aria-label="Role: activate to sort column ascending">Estimated Budget</th>     
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="2" colspan="1" aria-label="Action: activate to sort column descending" aria-sort="ascending">Action</th>
               
              </tr>
            </thead>
            <tbody>
            @foreach ($projects as $project)
                <tr role="row" class="odd">
                  <td>{{ $project->title }}</td>
                  <td>{{ $project->customer_name }}</td>
                  <td class="hidden-xs text-uppercase text-danger">{{ $project->area }}</td>
                  <td class="hidden-xs">{{ $project->assigned_to }}</td>
                  <td class="hidden-xs">{{ $project->estimated_budget }}</td>
                  <td style="background-color: rgb(236, 240, 245);">
                 <form class="row" method="POST" action="{{ route('projects.destroy', ['id' => $project->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <a href="{{ route('projects.edit', ['id' => $project->id]) }}" type="links" {{-- class="btn btn-primary col-xs" --}} style="margin-left: 5px; margin-top: 5px;">
                        View
                        </a>
                        <a href="{{ route('projects.edit', ['id' => $project->id]) }}" style="color: #437FE6; text-decoration: underline;  margin-left: 5px; margin-top: 5px;">
                        Edit
                        </a> 
                        {{-- <a href="{{ route('projects.destroy', ['id' => $project->id]) }}" type="links" onclick="return confirm('Are you sure?')"  class="btn btn-danger col-xs" style="margin-left: 5px; margin-top: 5px;"> 
                          Delete</a>--}} 

                       
                        <button type="submit" class="bg-transparent btn-danger col-xs"  style="margin-left: 5px; margin-top: 5px;">
                          Delete
                        </button>
                    </form>
                  </td>
              </tr> </tbody>
            @endforeach
           
            <tfoot>
              <tr>
                <tr role="row">
                <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Picture</th>
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Name</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>    
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Phone Number: activate to sort column ascending">Number</th>     
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending">Role</th> 
                <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Action: activate to sort column descending" aria-sort="ascending">Action</th>
               
              </tr>
              </tr>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($projects)}} of {{count($projectstotal)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $projects->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
 </div>s
    <!-- /.content -->
@stop
