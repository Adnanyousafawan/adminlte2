 @include('common')

@yield('datatable_stylesheets')
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

      .blank_row
{
    height: 10px;
    background-color: #FFFFFF;
}

.info_box {
  background-color: #778899; 
  list-style-type: none;
  margin: 0;
  padding: 20px;
}

.info_box li {
  display: inline-block;
  font-size: 20px;
  padding: 20px;
}
    </style>
  </head>
   <div class="container">
        <div><h3>{{$searchingVals['proj_name']}}</h3><br>

   </div>
 <div class="info_box">
          <li>
           <b>From</b>
          <address>
            <strong>Construction Site, Inc.</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: {{ Auth::user()->phone }}<br>
            Email: info@almasaeedstudio.com
          </address>
        </li>
       
        <!-- /.col -->
  <li>
          To
          <address>
            <strong>John Doe</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com
          </address>
    </li>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #007612</b><br>
          <br>
          <b>Order ID:</b> 4F3S8J<br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567
        </div>
        <!-- /.col -->
      </div>
    </div>
  <body>
   
    <div class="container">
          <h2>List of Orders from {{$searchingVals['from']}} to {{$searchingVals['to']}}</h2></div>
       <table id="example2" role="grid">
          <?php
              $invoice_total = 0;
              $temp = 0;
              $lcheck = 0;
              $subtotal = 0;

              ?>
            <thead>
              <tr role="row">
                <th style="background-color: #708090;" width="10%">Invoice Number</th>
                <th style="background-color: #708090;" width="15%">Supplier</th>
                <th style="background-color: #708090;" width="15%">Item</th>
                <th style="background-color: #708090;" width="10%">Price</th>
                <th style="background-color: #708090;" width="10%">Quantity</th>
                <th style="background-color: #708090;" width="20%">Total Price</th>
                <th style="background-color: #708090;" width="20%">Date</th>             
              </tr>
            </thead>
            <tbody>
              
            @foreach ($orders as $order)
                 @if($temp != 0)
                  @if($lcheck !=  $order['invoice_number'])
                  <tr class="blank_row">


                  <td style="background-color: #778899;" colspan="5">Invoive Total</td> 
                  <td style="background-color: #DCDCDC; "colspan="2">{{ $invoice_total }}</td>
                   {{ $invoice_total = 0 }}
                  </tr>
                 
                  @endif
                  @endif
                <tr role="row" class="odd">
                  @if($order['invoice_number'] % 2 == 0) 
                   
                  <td style="background-color: #D3D3D3;">{{ $order['invoice_number'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order['supplier_name'] }}</td>
                 
                  <td  style="background-color: #D3D3D3;">{{ $order['name'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order['rate'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order['quantity'] }}</td>
                  {{ $total =  $order['rate'] * $order['quantity'] }} 
                  {{ $subtotal = $total + $subtotal }}
                  {{ $invoice_total = $total + $invoice_total }}
                  <td  style="background-color: #D3D3D3;">{{$total}}</td>
                  <td  style="background-color: #D3D3D3;">{{ $order['created_at'] }}</td>
                  {{  $lcheck = $order['invoice_number'] }}
                  {{ $temp++ }}

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
                  <td style="background-color: #A9A9A9;">{{ $order['name'] }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order['rate'] }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order['quantity'] }}</td>
                  {{ $total =  $order['rate'] * $order['quantity'] }} 
                  {{ $subtotal = $total + $subtotal }}
                  {{ $invoice_total = $total + $invoice_total }}

                  <td style="background-color: #A9A9A9;">{{ $total }}</td>
                  <td style="background-color: #A9A9A9;">{{ $order['created_at'] }}</td>
                  {{ $lcheck = $order['invoice_number'] }}
                  {{ $temp++ }}
                   @endif

              </tr>

            @endforeach   
            </tbody>
            <tfoot> 
              <tr> 
                <th style="background-color: #708090;" colspan="5">Subtotal</th> 
                <td style="background-color: #D3D3D3; "colspan="2">{{ $subtotal}}</td> 
              </tr> 
               </tfoot> 
          </table>
          
    </div>
  </body>
</html>