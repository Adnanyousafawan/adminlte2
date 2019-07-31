 <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      table {
        border-collapse: collapse;
        width: 100%;
      }
      td, th {
        border: solid 2px;
        padding: 10px 5px;
      }
      tr {
        text-align: center;
      }
      .container {
        width: 100%;
        text-align: center;
      }

      /*
      .blank_row
{
    height: 10px !important;
    background-color: #FFFFFF;
}*/
    </style>
  </head>
  <body>
    <div class="container">

        {{-- <div><h3>{{$searchingVals['type']}}</h3><br> --}}
          <h2>List of Orders from {{$searchingVals['from']}} to {{$searchingVals['to']}}</h2></div>
       <table id="example2" role="grid">
            <thead>
              <tr role="row">
                <th style="background-color: #708090;" width="10%">Invoice Number</th>
                <th style="background-color: #708090;" width="15%">Supplier</th>
                <th style="background-color: #708090;" width="5%">Project ID</th>
                <th style="background-color: #708090;" width="10%">Item</th>
                <th style="background-color: #708090;" width="10%">Price</th>
                <th style="background-color: #708090;" width="10%">Quantity</th>
                <th style="background-color: #708090;" width="15%">Total Price</th>
                <th style="background-color: #708090;" width="20%">Date</th>             
              </tr>
            </thead>
            <tbody>
              {{-- 
              
              $invoice_total = 0;
              $count = 0;
              $count2 = 0;
                --}}
                <?php
                $subtotal = 0;
                ?>
            @foreach ($orders as $order)
                <tr role="row" class="odd">
                 
                  @if($order['invoice_number'] % 2 == 0) 
                 {{--   @if($count == 0)
                  <td style="background-color: #708090;" colspan="5">Invoive Total</td> 
                  <td style="background-color: #D3D3D3; "colspan="2">{{ $invoice_total }}</td> <br>
                 
                       $invoice_total = 0;
                       $count++;
                   
                   @endif --}}
                  <td style="background-color: #D3D3D3;">{{ $order['invoice_number'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order['supplier_name'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order['project_id'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order['name'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order['set_rate'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order['quantity'] }}</td>
                  {{ $total =  $order['set_rate'] * $order['quantity'] }} 
                  {{ $subtotal = $total + $subtotal }}
                  {{-- {{ $invoice_total = $subtotal }} --}}
                  <td  style="background-color: #D3D3D3;">{{$total}}</td>
                  <td  style="background-color: #D3D3D3;">{{ Carbon\Carbon::parse($order['created_at'] )->format('d/M/Y') }}</td>
                   @endif 

                  @if($order['invoice_number'] % 2 == 1) 
                  {{-- <tr class="blank_row">
                      <td colspan="3"></td>
                  </tr>
                  @if($count2 == 0)
                  <p style="background-color: #708090;" colspan="5">Invoive Total</p> 
                  <p style="background-color: #D3D3D3; "colspan="2">{{ $invoice_total }}</p><br>
                  
                       $invoice_total = 0;
                       $count2++;
                   
                   @endif        --}}
                  <td style="background-color: #A9A9A9;">{{ $order['invoice_number'] }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order['supplier_name'] }}</td>
                   <td  style="background-color: #A9A9A9;">{{ $order['project_id'] }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order['name'] }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order['set_rate'] }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order['quantity'] }}</td>
                  {{ $total =  $order['set_rate'] * $order['quantity'] }} 
                  {{ $subtotal = $total + $subtotal }}
                  {{-- {{ $invoice_total = $subtotal }} --}}
                  <td style="background-color: #A9A9A9;">{{ $total }}</td>
                  <td style="background-color: #A9A9A9;">{{ Carbon\Carbon::parse($order['created_at'] )->format('d/M/Y') }}</td>
                   @endif
              </tr>
            @endforeach   
            </tbody>
            <tfoot> 
              <tr> 
                <th style="background-color: #708090;" colspan="6">Subtotal</th> 
                <td style="background-color: #D3D3D3; "colspan="2">{{ $subtotal}}</td> 
              </tr> 
               </tfoot> 
          </table>
          
    </div>
  </body>
</html>