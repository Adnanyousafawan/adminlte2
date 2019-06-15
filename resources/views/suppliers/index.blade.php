@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box" style="background-color:rgb(236, 240, 245);">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8">

                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-primary  form-control" href="{{ route('suppliers.create') }}">Add new User</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <h3 for="search_area">Search Supplier</h3>
                <div id="search_area" style="padding: 30px; background-color: rgb(53, 124, 165);">
                    <form action="/search_supplier" method="get">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <input type="search" name="search_name" id="search_name"
                                           placeholder="Search By Name" class="form-control">
                                </div>

                                <div class="col-sm-3">
                                    <input type="search" name="search_materil" id="search_material"
                                           placeholder="Search By Material" class="form-control">
                                </div>

                                <div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-btn-primary ">Search</button>
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

                <h3 class="box-title" for="table_all">List of All Suppliers</h3>
                <div id="table_all" class="dataTables_wrapper form-inline dt-bootstrap"
                     style="background-color:rgb(247, 248, 249); padding: 10px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                   aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="Name: activate to sort column descending"
                                        aria-sort="ascending">Name
                                    </th>
                                    <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">
                                        Address
                                    </th>
                                    <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="Phone#: activate to sort column ascending">
                                        Phone#
                                    </th>
                                    <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1"
                                        aria-label="Material: activate to sort column ascending">Material
                                    </th>
                                    <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">
                                        Price
                                    </th>
                                    <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Action: activate to sort column descending" aria-sort="ascending">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr role="row" class="odd">
                                        <td>{{ $supplier->name }}</td>
                                        <td class="hidden_xs">{{ $supplier->address }}</td>
                                        <td class="hidden-xs">{{ $supplier->phone_number }}</td>
                                        <td class="hidden-xs">{{ $supplier->material }}</td>
                                        <td class="hidden-xs">{{ $supplier->price }}</td>
                                        <td style="background-color: rgb(236, 240, 245);">
                                            <form class="row" method="POST"
                                                  action="{{ route('suppliers.destroy', ['id' => $supplier->id]) }}"
                                                  onsubmit="return confirm('Are you sure?')">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <a href="{{ route('suppliers.edit', ['id' => $supplier->id]) }}"
                                                   class="btn btn-warning col-xs" style="margin-left: 5px;">
                                                    Edit
                                                </a>
                                                <button type="submit" class="btn btn-danger col-xs"
                                                        style="margin-left: 5px; margin-top: 5px;">
                                                    Delete
                                                </button>
                                                <a href="{{ route('suppliers.edit', ['id' => $supplier->id]) }}"
                                                   class="btn btn-primary col-xs"
                                                   style="margin-left: 5px; margin-top: 5px;">
                                                    View
                                                </a>
                                            </form>
                                        </td>
                                    </tr></tbody>
                                @endforeach

                                <tfoot>
                                <tr>
                                <tr role="row">
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="Name: activate to sort column descending"
                                        aria-sort="ascending">Name
                                    </th>
                                    <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">
                                        Address
                                    </th>
                                    <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="Phone#: activate to sort column ascending">
                                        Phone#
                                    </th>
                                    <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1"
                                        aria-label="Material: activate to sort column ascending">Material
                                    </th>
                                    <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">
                                        Price
                                    </th>
                                    <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                        aria-label="Action: activate to sort column descending" aria-sort="ascending">
                                        Action
                                    </th>

                                </tr>
                                </tr>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1
                                to {{count($suppliers)}} of {{count($suppliers)}} entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                {{ $suppliers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
@stop
