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
                    </div>
                </div>
            </div>
            <div
                class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2{{-- col-sm-10 col-xs-offset-1 col-sm-offset-0 col-xs-10 col-lg-8 col-xl-8 --}} "
                style="/*max-width: 70%;*/ padding-bottom: 30px;">
                <div>

                    <div class="box-body">

                        <div class="col-lg-9 col-lg-offset-2">
                                <div class="form-group">
                                <label for="title">Project Title  <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                pattern="[A-Za-z0-9\w]{3,150}" title="Minimum 3 letter word required for Title"
                                       placeholder="Project Title" required>
                            </div>

                            <div class="form-group">
                                <label for="area">Project Location  <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="area" id="area"
                                pattern="[A-Za-z0-9\w]{3,150}" 
                                title=" Minimum 3 letters word is required"

                                       placeholder="Project Location" required>
                            </div>
 
                             <div class="form-group">
                                <label for="city">Project City  <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="city" id="city" pattern="[A-Za-z0-9\w]{3,100}" 
                        title=" Minimum 3 letters word is required"
                                       placeholder="Project City" required>
                            </div>

                            <div class="form-group">
                                <label for="plot_size">Project Size  <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="plot_size" id="plot_size"
                                pattern="[A-Za-z0-9\w]{1,50}" 
                                 title=" Minimum 1 letters required"
                                       placeholder="Project plot size" required>
                            </div>

                            <div class="form-group">
                                <label for="floor">Project Floors  <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="floor" id="floor"
                                pattern="[A-Za-z0-9\w]{1,10}" 
                                 title=" Minimum 1 letters required"
                                       placeholder="Enter number of floors" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Customer Name  <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Customer Name"
                                       name="name" pattern="[A-Za-z0-9\w]{2,50}" title="Minimum 2 letters required for Name" required>
                            </div>

                            <div class="form-group">
                                <label for="cnic">Customer CNIC <span style="color: red;">*</span></label>
                                <input type="text" maxlength="13"  pattern="[0-9]{13}" class="form-control" id="cnic" placeholder="Customer CNIC"
                                       name="cnic" title="Enter 13 digit CNIC Number. Example: ( 3434359324554 )" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Customer Contact <span style="color: red;">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                   <input type="text" maxlength="11" class="form-control" placeholder="Contact Number"
                                   pattern="[0-9]{11}" title="Enter 11 Digit Number. Example:(03330234334)" 
                                    id="phone" name="phone" required>

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="address">Home Address <span style="color: red;">*</span></label>
                                 <input type="text" class="form-control" id="address" name="address" pattern="[A-Za-z0-9\w]{4,100}" 
                        title=" Minimum 5 letters word required" 
                               placeholder="Home Address" required>
                            </div>

                            <div class="form-group">
                                <label for="assigned_to">Select Contractor <span style="color: red;">*</span></label>
                                <select class="form-control" id="assigned_to" name="assigned_to" required="">
                                    @foreach($contractors as $contractor)
                                        <option>{{ $contractor->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="estimated_completion_time">Estimated Completion Time <span style="color: red;">*</span></label>
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
                                <label for="estimated_budget">Estimated Budget  <span style="color: red;">*</span></label>
                                <input type="text" name="estimated_budget" id="estimated_budget" class="form-control"  
                               pattern="[0-9]{4,100}" 
                                title=" Minimum 4 digit number required" 
                               placeholder="Estimated Budget" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Add Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" pattern="[0-9]{4,250}" 
                                title=" Minimum 4 digit number" >
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
