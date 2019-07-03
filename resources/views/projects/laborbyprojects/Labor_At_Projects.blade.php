@include('common')
@yield('datatable_stylesheets')

@section('labor_by_projects')

    <div class="box-body">
        <div class="table-responsive">
            <table class="table no-margin table-bordered table-striped project">
                <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Title</th>
                    <th>Labor</th>
                    <th>Cost</th>
                    <th>Contractor</th>
                </tr>
                </thead>
                <tbody>
                @foreach($labor_by_projects as $lproject)
                    <tr>
                        <td><a href=" {{ route('projects.view', ['id' => $lproject->id])   }}"
                               type="links">0000{{ $lproject->id }}</a></td>
                        <td>{{ $lproject->title }}</td>

                        <td>
                            <div class="sparkbar" data-color="#00a65a"
                                 data-height="20">{{DB::table('labors')->where('project_id','=',$lproject->id)->count('id') }}</div>
                        </td>
                        <td>
                            <div
                                class="label label-warning col-md-8 col-md-offset-2">{{ 1000 * DB::table('labors')->where('project_id','=',$lproject->id)->count('id')  }}</div>
                        </td>
                        <td>Contractor
                            {{-- {{ DB::table('projects')->where('assigned_to','=', $contractors->id ) }} --}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->

@endsection
