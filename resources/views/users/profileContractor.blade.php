





                    <div class="col-md-4 col-md-offset-1 col-sm-6 col-lg-4 col-lg-offset-1">

                        <div class="box box-primary">
                            <div class="box-body {{-- box-profile --}}">
                                {{--  <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="Project Image">
                    --}}
                                <?php
                                //dd($projects);
                                ?>
                                <h3 class="profile-username text-center"> {{$projects->title }}  </h3>
                                <p class="text-muted text-center"> {{ $projects->area }}  </p>
                                <b><p class="text-muted text-center"> {{ $projects->city }}  </p></b>
                                <hr>
                                <strong><i class="fa fa-book margin-r-5"></i>Customer Name</strong>
                                <p class="text-muted float-right">
                                    {{ $customers->name }}
                                </p>
                                <strong><i class="fa fa-book margin-r-5"></i>Customer Contact</strong>
                                <b><p class="text-muted float-right">
                                        {{ $customers->phone }}
                                    </p>

                                    <strong><i class="fa fa-book"></i>Project Details</strong>
                                    <div class="box-body">

                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>Size</b> <a class="pull-right"> <span
                                                        class="label label-danger"> {{ $projects->plot_size }}   </span></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Number of Floors</b> <a
                                                    class="pull-right">  {{ $projects->floor}}   </a>
                                            </li>

                                            <li class="list-group-item">
                                                <b>Completion Time</b> <a
                                                    class="pull-right"> {{ $projects->estimated_completion_time }}   </a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Assigned To</b> <a
                                                    class="pull-right">  {{ $contractors->name }}  </a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Contact</b> <a class="pull-right"> {{ $contractors->phone }}  </a>
                                            </li>
                                        </ul>
                                        <!-- /.box-body -->
                                        <strong><i class="fa fa-file-text-o "></i> {{ $projects->description }}</strong>

                                        <p></p>
                                    </div>

                                    <a href="{{ route('projects.edit', ['id' => $projects->id]) }}"
                                       class="btn btn-primary btn-block"><b>Edit</b></a>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
