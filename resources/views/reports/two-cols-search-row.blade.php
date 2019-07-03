<div class="row">
  @php
    $index = 0;
  @endphp
  
    <div class="col-md-6">
      <div class="form-group">
          @php
           
          @endphp
          <label for="" class="col-sm-3 control-label"></label>
          <div class="col-sm-9">
            <input value="{{isset($oldVals) ? $oldVals[$index] : ''}}" type="text" class="form-control" name="project_id" id="project_id" placeholder="">
          </div>
      </div>
    </div>
  @php
    $index++;
  @endphp
 
</div>
