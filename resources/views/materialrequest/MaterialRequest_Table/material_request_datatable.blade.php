@section('matrial_request_table')
                     

                                <div class="table-responsive" style="margin-top: 10px; padding: 10px;">
                                    <table class="table no-margin table-bordered table-striped project">
                                        <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Project ID</th>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Requested by</th>
                                            <th>Instructions</th>
                                            @can('isAdmin')
                                            <th>Seen</th>
                                            @endcan 
                                            <th>Status</th>
                                           
                                            <th style="max-width: 20px;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                         @foreach ($materialrequests as $materialrequest)
                                            <tr>
                                                <td>MR0000{{ $materialrequest->id }}</td>
                                                <td>{{ $materialrequest->title }}</td>
                                                <td>{{ $materialrequest->item_name }}</td>
                                                <td>{{ $materialrequest->quantity }}</td>
                                                <td>{{ $materialrequest->contractor_name }}</td>
                                                <td>{{ $materialrequest->instructions }}</td>
                                                @can('isAdmin')
                                                <td>@if($materialrequest->seen==1)
                                                 
                                                   <div class="label label-success col-md-12">Seen</div>
                                                @endif
                                                @if($materialrequest->seen==0)
                                                 
                                                   <div class="label label-warning col-md-12">Not Seen</div>
                                                @endif
                                            </td>
                                             @endcan
                                                    <td>{{ $materialrequest->status_name }}</td>
                                                     <td style="max-width: 20px;">
                                                        <a type="links" data-toggle="modal" data-target="#EditModal-{{ $materialrequest->id }}"><i class="fa fa-edit col-md-offset-4"></i></a>

                                                   {{--  <div class="btn-group">
                                                         <button class="btn btn-sm btn-success" type="button">Action</button> 
                                                     <button data-toggle="dropdown"
                                                               class="btn btn-success dropdown-toggle" type="button">
                                                        <span class="caret"></span>
                                                          <span class="sr-only">Toggle Dropdown</span>
                                                       </button>

                                                        <ul role="menu" class="dropdown-menu">
                                                           
                                                            <li><a type="links" data-toggle="modal" data-target="#EditModal-{{ $materialrequest->id }}"><i class="fa fa-edit"></i>Edit</a></li> 
 --}}

                                                        {{-- 
                                                            <li><a type="links" data-toggle="modal"
                                                                   data-target="#DeleteModal-{{ $materialrequest->id }}"> <i
                                                                        class="fa fa-remove"></i>Delete</a></li> --}}
{{--                                                         </ul>

                                                    </div> --}}
                                                    {{--   <a type="links" href="{{ route('projects.view', ['id' => $project->id]) }}"
                                                         style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">View</a>

                                                      <a type="links" href="{{ route('projects.edit', ['id' => $project->id]) }}"
                                                         style="margin-left: 3px; margin-top: 0px; color: #f0ad4e;">Edit</a>
                                                      <a type="links" data-toggle="modal" data-target="#applicantDeleteModal-{{ $project->id }}"
                                                         style="color: red; margin-left: 3px;  margin-top: 0px;">Delete</a> --}}

                                                </td>
                                               
                                              {{--   @can('isManager')
                                                <td>
                                                @if($materialrequest->request_status_id == 3)
                                                <form method="POST" id="actionform">
                                                
                                                    <a type="submit" id="reject" name="reject" class="glyphicon glyphicon-remove" style="color: red; margin-right: 10px"></a>
                                                    <a type="submit" name="accept" id="accept" class="glyphicon glyphicon-ok" style="color: green;" ></a>
                                                </form>
                                                    @endif
                                                    @if($materialrequest->request_status_id == 2)
                                                        {{ $materialrequest->request_status_id  }}
                                                        <a type="links" href="" class=" glyphicon glyphicon-edit pull-right" style="color: red;"></a>
                                                    @endif
                                                      @if($materialrequest->request_status_id == 1)
                                                        {{ $materialrequest->request_status_id  }}
                                                        <a type="links" href="" class=" glyphicon glyphicon-ok pull-right" style="color: green;"></a>
                                                    @endif

                                                </td>


                                                @endcan --}}

                                            </tr>
 
        {{-- ______________________________EdiT  Modal ______________________________________________--}}

                                            <div id="EditModal-{{ $materialrequest->id }}" class="modal fade"
                                                 tabindex="-4" role="dialog"
                                                 aria-labelledby="custom-width-modalLabel" 
                                                 style="display: none;">
                                                <div class="modal-dialog"
                                                     style="min-width:40%; align-content: center; text-align: center;">
                                                    <div class="modal-content">
                                                            <form
                                                                action=" {{ route('requests.update', ['id' => $materialrequest->id]) }}"
                                                                method="POST" enctype="multipart/form-data" >
                                                                {{method_field('PATCH')}}                                                          
                                                                {{-- @method('PATCH') --}}
                                                                @csrf 
                                                                
                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true">×
                                                                    </button>
                                                                    <h4 class="modal-title text-center"
                                                                        id="custom-width-modalLabel">Edit Material Request
                                                                        </h4>
                                                                </div>
                                                                <div class="row">
                                                                <div class="modal-body">
                                                                    <div class="col-md-10 col-md-offset-1 form-group ">
                                                                    <label class="form-control" for="project">Project:</label> 
                                                                    <p id="project">{{ $materialrequest->title }}</p>
                                                                      <label class="form-control" for="contractor">Contractor:</label> 
                                                                    <p id="contractor">{{ $materialrequest->contractor_name }}</p>
                                                                      <label class="form-control" for="item">Item:</label> 
                                                                    <p id="item">{{ $materialrequest->item_name }}</p>
                                                                      <label class="form-control" for="quantity">Quantity:</label> 
                                                                    <p id="quantity">{{ $materialrequest->quantity }}</p>
                                                                      <label class="form-control" for="instructions">Instruction:</label> 
                                                                    <p id="instructions">{{ $materialrequest->instructions }}</p>
                                                                    
                                                                    </div>

                                                                     <div class="col-md-10 col-md-offset-1 form-group" style="margin-bottom: 20px;">
                                                                    <label class="radio-inline"><input type="radio" name="optradio" value="1" <?php if($materialrequest->request_status_id==1){echo "checked";}?>  >Approved</label>
                                                                    <label class="radio-inline"><input type="radio" name="optradio" value="2" <?php if($materialrequest->request_status_id==2){echo "checked";}?>>Reject</label>
                                                                    <label class="radio-inline"><input type="radio" name="optradio" value="3" <?php if($materialrequest->request_status_id==3){echo "checked";}?>>Pending</label>
                                                                    </div>
            
                                                                    </div>
                                                                  {{-- <input type="hidden", name="requests_id" id="req_id"> --}}
                                                                 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-default waves-effect"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="links" href="{{ route('requests.update',['id'=>$materialrequest->id]) }}"
                                                                            class="btn btn-primary">
                                                                        Save
                                                                    </button>
                                                                     <input type="hidden" id="requests_id" name="material_id" value="0">
                                                                </div>
                                                    </form>
                                                 
                                                </div>
                                            </div>
                                            </div>


                                            {{-- ______________________________Delete Modal ______________________________________________--}}

                                       {{--      <div id="DeleteModal-{{ $materialrequest->id }}" class="modal fade"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="custom-width-modalLabel" aria-hidden="true"
                                                 style="display: none;">
                                                <div class="modal-dialog"
                                                     style="min-width:40%; align-content: center; text-align: center;">
                                                    <div class="modal-content">
                                                        <form class="row" method="POST"
                                                              action="{{ route('requests.destroy', ['id' => $materialrequest->id]) }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}">
                                                            <form
                                                                action=" {{ route('requests.destroy', ['id' => $materialrequest->id]) }}"
                                                                 method="POST" class="remove-record-model">
                                                                {{ method_field('delete') }}
                                                                {{ csrf_field() }}

                                                                <div class="modal-header">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-hidden="true">×
                                                                    </button>
                                                                    <h4 class="modal-title text-center"
                                                                        id="custom-width-modalLabel">Delete Material Request
                                                                        </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <strong><b><h3>Are You Sure? <br>You Want Delete
                                                                                This Record?
                                                                            </h3></b></strong>
                                                                    <input type="hidden" , name="applicant_id"
                                                                           id="app_id">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                            class="btn btn-default waves-effect"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger waves-effect remove-data-from-delete-form">
                                                                        Delete
                                                                    </button>
                                                                </div>
 --}}
                                @endforeach
                                </tbody>
                                </table>
                            </div>
              @endsection

@section('script_datatable')

@endsection