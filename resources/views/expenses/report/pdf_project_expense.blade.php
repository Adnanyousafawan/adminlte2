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
        <!-- /.col -->
      </div>
    </div>
  <body>
   
    <div class="container">
          <h3>List of Expenses from {{$searchingVals['from']}} to {{$searchingVals['to']}}</h3></div>
       <table id="example2" role="grid">
          <?php
              $expense_total = 0;
              $temp = 0;
              $lcheck = 0;
              $subtotal = 0;
              ?>
            <thead>
              <tr role="row">
                <th style="background-color: #708090;" width="20%">Expense Number</th>
                <th style="background-color: #708090;" width="20%">Name</th>
                <th style="background-color: #708090;" width="25%">Description</th>
                <th style="background-color: #708090;" width="15%">Expense</th>
                <th style="background-color: #708090;" width="20%">Date</th>             
              </tr>
            </thead>
            <tbody>
              
            @foreach ($expenses as $expense)
                 @if($temp != 0)
                  @if($lcheck !=  $expense['expense_number'])
                  <tr class="blank_row">
                  <td style="background-color: #778899;" colspan="3">Expense Total</td> 
                  <td style="background-color: #DCDCDC; "colspan="1">{{ $expense_total }}</td>
                  <td style="background-color: #778899;" colspan="1"></td> 

                   {{ $expense_total = 0 }}
                  </tr>
                 
                  @endif
                  @endif
                <tr role="row" class="odd">
                  @if($expense['expense_number'] % 2 == 0) 
                  @if($lcheck != $expense['expense_number'])
                  <td style="background-color: #D3D3D3;">{{ $expense['expense_number'] }}</td>
                  @endif
                  @if($lcheck == $expense['expense_number'])
                  <td style="background-color: #D3D3D3; text-align: center;" >-</td>
                  @endif

                  <td  style="background-color: #D3D3D3;">{{ $expense['name'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $expense['description'] }}</td>
                  <td  style="background-color: #D3D3D3;">{{ $expense['expense'] }}</td>
                
                  {{ $total =  $expense['expense'] }} 
                  {{ $subtotal = $total + $subtotal }}
                  {{ $expense_total = $total + $expense_total }}
                  <td  style="background-color: #D3D3D3;">{{ $expense['created_at'] }}</td>
                  {{  $lcheck = $expense['expense_number'] }}
                  {{ $temp++ }}

                  @endif 

                  @if($expense['expense_number'] % 2 == 1) 
                  {{-- <tr class="blank_row">
                      <td colspan="3"></td>
                  </tr>
                  @if($count2 == 0)
                  <p style="background-color: #708090;" colspan="5">Invoive Total</p> 
                  <p style="background-color: #D3D3D3; "colspan="2">{{ $invoice_total }}</p><br>
                  
                       $invoice_total = 0;
                       $count2++;
                   
                   @endif        --}}
                  @if($lcheck != $expense['expense_number'])
                  <td style="background-color: #A9A9A9;">{{ $expense['expense_number'] }}</td>
                  @endif
                  @if($lcheck == $expense['expense_number'])
                  <td style="background-color: #A9A9A9; text-align: center;" >-</td>
                  @endif

                  <td style="background-color: #A9A9A9;">{{ $expense['name'] }}</td>
                  <td style="background-color: #A9A9A9;">{{ $expense['description'] }}</td>
                  <td style="background-color: #A9A9A9;">{{ $expense['expense'] }}</td>
               
                  {{ $total =  $expense['expense'] }} 
                  {{ $subtotal = $total + $subtotal }}
                  {{ $expense_total = $total + $expense_total }}

                  <td style="background-color: #A9A9A9;">{{ $expense['created_at'] }}</td>
                  {{ $lcheck = $expense['expense_number'] }}
                  {{ $temp++ }}
                   @endif
              </tr>
               @if($temp != 0)
                  @if($searchingVals['last_expense'] ==  $expense['id'])
                  <tr class="blank_row">
                  <td style="background-color: #778899;" colspan="3">Expense Total</td> 
                  <td style="background-color: #DCDCDC; "colspan="1">{{ $expense_total }}</td>
                  <td style="background-color: #778899;" colspan="1"></td> 

                   {{ $expense_total = 0 }}
                  </tr>
                  <tr class="blank_row">
                    <td colspan="5"></td>
                  </tr>
                 
                  @endif
                  @endif

            @endforeach   
            </tbody>
            <tfoot> 
              <tr> 
                <th style="background-color: #708090;" colspan="3">Subtotal</th> 
                <td style="background-color: #D3D3D3; "colspan="2">{{ $subtotal}}</td> 
              </tr> 
               </tfoot> 
          </table>
          
    </div>
  </body>
</html>