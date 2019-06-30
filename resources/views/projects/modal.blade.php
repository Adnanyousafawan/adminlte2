@section('add_form_project')


    <div style=" width: 100%;">

        <div class="row" style="margin-top: 5px;">


            <div
                class="col-md-3 col-md-offset-4 col-lg-offset-4 col-xl-offset-4  col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-lg-3 col-xl-3"
                style="margin-bottom: 10px;">
                <!-- Profile Image -->

                <div class="no-profile-picture">
                    <div class="img-div"><img src="https://paksa.pk/public/images/upload.png" class="contract_image"
                                              alt=""></div>
                    <br>
                    <div class="btn">
                        <input type="file" name="contract_image" id="contract_image"
                               class="btn btn-default btn-sm profile-picture-uploader">

                        {{--   data-toggle="modal" data-target="#uploadprofilepicture"  class="btn btn-default btn-sm profile-picture-uploader" id="cont_image" name="cont_image"
                    --}}

                    </div>
                </div>
            </div>


            {{--
            <div class="modal fade show" id="uploadprofilepicture" tabindex="-1" role="dialog" aria-labelledby="updater" style="display: block;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <p class="no-margin">You can upload only 1 image file at a time!</p>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="uploadform dropzone no-margin dz-clickable profile-picture-uploader" id="profile-picture-uploader" name="profile-picture-uploader">
                        <div class="dz-default dz-message">
                          <span>Drop your Cover Picture here</span>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default attachtopost" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
             --}}
            {{--                                                 <div class="">
                                                                <div class="box-body">
                                                                    <head><h4>Upload Labor CNIC</h4></head>
                                                                    <hr>
                                                                    <img class="img-fluid img-responsive"
                                                                         style="min-width: 100%; min-height: 200px;">
                                                                    <hr>
                                                                    <div class="form-group">
                                                                        <input type="file"
                                                                               class="btn btn-primary col-md-12 col-xs-12"
                                                                               id="cont_image"
                                                                               name="cont_image" required>
                                                                    </div>
                                                                </div>
                                                            </div> --}}


            <div
                class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2{{-- col-sm-10 col-xs-offset-1 col-sm-offset-0 col-xs-10 col-lg-8 col-xl-8 --}} "
                style="/*max-width: 70%;*/ padding-bottom: 30px;">
                <div>

                    <div class="box-body">

                        <div class="col-lg-9 col-lg-offset-2">
                            <div class="form-group">


                                <label for="title">Project Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                       placeholder="Project Title" pattern="[A-Za-z0-9\w]{5,50}"
                                       title="Minimum 5 letters required for Title" required>
                            </div>

                            <div class="form-group">
                                <label for="area">Project Location</label>
                                <input type="text" class="form-control" name="area" id="area"
                                       placeholder="Project Location" pattern="[A-Za-z0-9\w]{10,100}"
                                       title="Minimum 10 letters required for Location" required>
                            </div>

                            <div class="form-group">
                                <label for="city">Project City</label>
                                <input type="text" class="form-control" name="city" id="city"
                                       placeholder="Project City" pattern="[A-Za-z0-9\w]{5,15}"
                                       title="Minimum 5 & Maximum 15 letters required For City" required>
                            </div>

                            <div class="form-group">
                                <label for="plot_size">Project Size</label>
                                <input type="text" class="form-control" name="plot_size" id="plot_size"
                                       placeholder="Project plot size" pattern="[A-Za-z0-9\w]{5,15}"
                                       title="Minimum 5 & Maximum 15 letters required For Plot Size" required>
                            </div>

                            <div class="form-group">
                                <label for="floor">Project Floors</label>
                                <input type="text" class="form-control" name="floor" id="floor"
                                       placeholder="Enter number of floors" pattern="[A-Za-z0-9\w]{5,15}"
                                       title="Minimum 5 & Maximum 15 letters required for Floor" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Customer Name"
                                       name="name" pattern="[A-Za-z0-9\w]{5,15}"
                                       title="Minimum 5 & Maximum 15 letters required for Name" required>
                            </div>

                            <div class="form-group">
                                <label for="cnic">Customer CNIC</label>
                                <input type="text" maxlength="13" class="form-control" id="cnic"
                                       placeholder="Customer CNIC"
                                       name="cnic" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}"
                                       title="Example:(12345-1234567-1)" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Customer Contact</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" maxlength="11" class="form-control"
                                           pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" title="Example:(03330416263)"
                                           id="phone" name="phone" required>
                                    {{-- <input type="number" maxlength="14" class="form-control" placeholder="+092-3330416263"
                                           data-inputmask="'mask': ['999-999-9999 [x99999]', '+092 99 99 9999[9]-9999']"
                                           data-mask="" id="phone" name="phone" required> --}}
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="address">Home Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="Home Address" required>
                            </div>

                            <div class="form-group">
                                <label for="assigned_to">Select Contractor</label>
                                <select class="form-control" id="assigned_to" name="assigned_to">
                                    @foreach($contractors as $contractor)
                                        <option>{{ $contractor->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="estimated_completion_time">Estimated Completion Time</label>
                                <select class="form-control" id="estimated_completion_time"
                                        name="estimated_completion_time">
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
                                       placeholder="Estimated budget cost(in Millions)" pattern="[0-9]{4,50}"
                                       title="Example:(1000000000)" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Add Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5">
                        </textarea>
                            </div>

                            <button type="submit"
                                    class="btn btn-block btn-primary btn-xs form-control"
                                    style="margin-top: 20px;">Add Project
                            </button>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
    </div>
    </form>
    </div>



    </div>
@endsection
