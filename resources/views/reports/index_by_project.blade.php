@extends('reports.base')
@section('action-content')


<style type="text/css">
  .blank_row
{
    height: 10px !important;
    background-color: #FFFFFF;
}
</style>
    <!-- Main content -->
<div class="row">
<div class="box" style="width: 100%;">
  <div class="box-header">
    <div class="row"> 
        <div class="col-md-4"> 
          <h3 class="box-title">List of orders</h3>
        </div>
        <div class="row pull-right" style="margin-right: 2%;">
            
            <form class="form-horizontal" role="form" method="POST" action="{{ route('projectreport.pdf') }}">
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
      <form method="POST" action="{{ route('projectreport.search') }}">
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
            <thead>
             <tr role="row">
                <th width = "10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Invoice Number</th>
                <th width = "15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Supplier</th>
                <th width = "10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Item</th>
                <th width = "10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Price</th>
                 <th width = "10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Quantity</th>
                <th width = "15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Cost</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Date</th>
              </tr>
            </thead>
            <tbody>
        
            @foreach ($orders as $order)
          
                <tr role="row" class="odd">
                  @if($order->invoice_number % 2 == 0) 
                {{--   
                  <tr class="blank_row">
                      <td colspan="5" style="background-color: #708090;" >Invoive Total</td>
                      <td style="background-color: #D3D3D3; "colspan="2"></td>
                   
                  </tr>
 --}}
                  <td style="background-color: #D3D3D3;">{{ $order->invoice_number }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order->supplier_name }}</td>

                  <td  style="background-color: #D3D3D3;">{{ $order->name }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order->set_rate }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order->quantity }}</td>
                  <?php
                  $total =  $order->set_rate * $order->quantity
                    ?>
                  <td  style="background-color: #D3D3D3;">{{$total}}</td>
                  <td  style="background-color: #D3D3D3;">{{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y') }}</td>
                   @endif 
                    

                     @if($order->invoice_number % 2 == 1) 
{{-- 
                      <tr class="blank_row">
                      <td colspan="5" style="background-color: #708090;" >Invoive Total</td>
                      <td style="background-color: #D3D3D3; "colspan="2"></td>
                      </tr> --}}
              


                  <td style="background-color: #A9A9A9;">{{ $order->invoice_number }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order->supplier_name }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order->name }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order->set_rate }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order->quantity }}</td>
                 
                <?php 
                  $total =  $order->set_rate * $order->quantity;
                
                  ?>
 
                  <td style="background-color: #A9A9A9;">{{ $total }}</td>
                  <td style="background-color: #A9A9A9;">{{ Carbon\Carbon::parse($order->created_at)->format('d/M/Y') }}</td>
                  
                  {{-- <td style="background-color: #A9A9A9;">{{ $order->created_at->toRfc850String() }}</td> --}}
                   @endif 

              </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr role="row">
                <th width = "10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Invoice Number</th>
                <th width = "15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Supplier</th>
                <th width = "10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Item</th>
                <th width = "10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Price</th>
                 <th width = "10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Quantity</th>
                <th width = "15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Cost</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Date</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($orders)}} of {{count($orders)}} entries</div>
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