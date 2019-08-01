@include('common')
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
    <?php 
    $paid = 0;
    $temp =0; ?>
    @foreach ($projects as $project)
    <?php 
        $labors = DB::table('labors')->where('project_id','=',$project->id)->get();
    ?>
        @foreach($labors as $labor)
        <?php 
            //$presents =  DB::table('labor_attendances')->where('labor_id','=',$labor->id)->where('status','=',1)->sum('status');
            $attendances = DB::table('labor_attendances')->where('labor_id','=',$labor->id)->where('status','=',1)->where('paid','=',1)->sum('paid');
            $temp = $attendances * $labor->rate;
            $paid = $paid + $temp;
        
        ?>
        @endforeach
                    <tr>
                        <td><a href=" {{ route('projects.view', ['id' => $project->id])   }}"
                               type="links">PR0000{{ $project->id }}</a></td>
                        <td>{{ $project->title }}</td>
                        <td>
                            <div class="sparkbar" data-color="#00a65a"
                                 data-height="20">{{DB::table('labors')->where('project_id','=',$project->id)->count('id') }}</div>
                        </td>
                        <td>
                            <div
                                class="label label-warning col-md-8 col-md-offset-2">{{ $paid }}</div>
                        </td>
                        <td>{{ DB::table('users')->where('id','=',$project->assigned_to)->pluck('name')->first() }}</td>
                          </td>
                    </tr>
               
            @endforeach
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /.box-body -->

@endsection
