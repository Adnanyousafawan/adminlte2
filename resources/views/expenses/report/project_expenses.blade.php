@extends('reports.base')
@section('action-content')

<style type="text/css">
  .blank_row
{
    height: 10px !important;
    background-color: #FFFFFF;
}
 
      td, th {
        border: solid 2px;
        padding: 10px 5px;
        text-align: center;
      }
      tr {
        text-align: center;
      }
</style>
    <!-- Main content -->
<div class="row">
<div class="box" style="width: 100%;">
  <div class="box-header">
    <div class="row"> 
        <div class="col-md-4"> 
          <h3 class="box-title">List of Poject Expense</h3>
        </div>
        <div class="row pull-right" style="margin-right: 2%;">
            
            <form class="form-horizontal" role="form" method="POST" action="{{ route('expensereport.pdf') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$searchingVals['from']}}" name="from" />
                <input type="hidden" value="{{$searchingVals['to']}}" name="to" />
                <input type="hidden" value="{{ $val = $searchingVals['proj'] }}" name="project_id" />
                <button type="submit" class="btn btn-info">
                  Export to PDF
                </button>
            </form>
        </div>
    </div>  
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row"> 
        <div class="col-md-6"></div> 
        <div class="col-sm-6"></div> 
      </div>
      <form method="POST" action="{{ route('expensereport.search') }}">
         {{ csrf_field() }}

         @component('reports.search', ['title' => 'Search'])
         <div class="form-group">
          <label for="project">Projects</label>
         <select class="form-control" id="project" name="project">
          <option disabled selected value> -- select an option -- </option>
          @foreach($projects as $project)
          <option>{{ $project }}</option>
          @endforeach
         </select>
          </div>
          <hr>
          @component('reports.two-cols-date-search-row', ['items' => ['From', 'To'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['from'] : '', isset($searchingVals) ? $searchingVals['to'] : '']])
          @endcomponent
         @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-md-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
             <?php
              $expense_total = 0;
              $temp = 0;
              $lcheck = 0;
              $subtotal = 0;
              ?>
            <thead>
             <tr role="row">
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Expense Number</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Name</th>
                <th width = "25%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Description</th>
                <th width = "15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Expense</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Date</th>
              </tr>
            </thead>
            <tbody>
        
            @foreach ($expenses as $expense)
             @if($temp != 0)
                  @if($lcheck !=  $expense->expense_number)
                  <tr class="blank_row">
                  <td style="background-color: #778899;" colspan="3">Expense Total</td> 
                  <td style="background-color: #DCDCDC; "colspan="1">{{ $expense_total }}</td>
                  <td style="background-color: #778899;" colspan="1"></td> 

                   <?php $expense_total = 0; ?>
                  </tr>

                 
                  @endif
                  @endif
                <tr role="row" class="odd">
                  @if($expense->expense_number % 2 == 0) 
                {{--   
                  <tr class="blank_row">
                      <td colspan="5" style="background-color: #708090;" >Invoive Total</td>
                      <td style="background-color: #D3D3D3; "colspan="2"></td>
                   
                  </tr>
 --}}
              

                  <td  style="background-color: #D3D3D3;">{{ $expense->expense_number }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $expense->name }}</td>

                  <td  style="background-color: #D3D3D3;">{{ $expense->description }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $expense->expense }}</td>
                 
                  <?php
                  $total =  $expense->expense; 
                  $subtotal = $total + $subtotal; 
                  $expense_total = $total + $expense_total; 
                  $lcheck = $expense->expense_number;
                  $temp++;
                    ?>
                  <td  style="background-color: #D3D3D3;">{{ Carbon\Carbon::parse($expense->created_at)->format('d/M/Y') }}</td>
                   @endif 
                    

                     @if($expense->expense_number % 2 == 1) 
{{-- 
                      <tr class="blank_row">
                      <td colspan="5" style="background-color: #708090;" >Invoive Total</td>
                      <td style="background-color: #D3D3D3; "colspan="2"></td>
                      </tr> --}}
                   @if($lcheck != $expense->expense_number)
                  <td style="background-color: #A9A9A9;">{{ $expense->expense_number }}</td>
                  @endif
                  @if($lcheck == $expense->expense_number)
                  <td style="background-color: #A9A9A9; text-align: center;" >-</td>
                  @endif
  
                  
                  <td style="background-color: #A9A9A9;">{{ $expense->name }}</td>
                  <td style="background-color: #A9A9A9;">{{ $expense->description }}</td>
                  <td style="background-color: #A9A9A9;">{{ $expense->expense }}</td>
                
                 
                <?php
                  $total =  $expense->expense; 
                  $subtotal = $total + $subtotal; 
                  $expense_total = $total + $expense_total; 
                  $lcheck = $expense->expense_number;
                  $temp++;
                    ?>
                  <td style="background-color: #A9A9A9;">{{ Carbon\Carbon::parse($expense->created_at)->format('d/M/Y') }}</td>
                  
                  {{-- <td style="background-color: #A9A9A9;">{{ $order->created_at->toRfc850String() }}</td> --}}
                   @endif  

              </tr>
               @if($temp != 0)
                  @if($searchingVals['last_expense'] ==  $expense->id)
                  <tr class="blank_row">
                  <td style="background-color: #778899;" colspan="3">Expense Total</td> 
                  <td style="background-color: #DCDCDC; "colspan="1">{{ $expense_total }}</td>
                  <td style="background-color: #778899;" colspan="1"></td> 

                   <?php $expense_total = 0 ?>
                  </tr>
                  <tr class="blank_row">
                    <td colspan="5"></td>
                  </tr>
                 
                  @endif
                  @endif
            @endforeach
            </tbody>
            <tfoot>
            <tr role="row">
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Expense Number</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Name</th>
                <th width = "25%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Description</th>
                <th width = "15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Expense</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Date</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{-- {{count($expense)}} of {{count($expense)}}  --}}entries</div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
</div>
    {{-- </section> --}}
    <!-- /.content -->
  
@endsection