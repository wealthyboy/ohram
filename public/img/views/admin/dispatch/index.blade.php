

<!DOCTYPE html>
<html dir="ltr" lang="en">
   <head>
      <meta charset="UTF-8" />
      <title>Shipping</title>
      <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
   
   </head>
   <body>
      <div class="container">
         <div style="page-break-after: always;">
            <h1>Dispatch Note #{{ $order->id }}</h1>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <td colspan="2">Order Details</td>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>
                        <address>
                           <strong>{{ Config('app.name') }}</strong><br />
                           {{ $system_settings->store_address }}
                        </address>
                        <b>Telephone: </b>{{ $system_settings->store_phone }}
<br />
                        <b>E-Mail: </b> {{ $system_settings->store_email }}<br />
                        <b>Web Site:</b> <a href="{{ Config('app.url') }}">{{ Config('app.url') }}</a>
                     </td>
                     <td style="width: 50%;"><b>Date Added</b> {{ $order->created_at }}<br />
                        <b>Order ID:</b> {{ $order->id }}<br />
                     </td>
                  </tr>
               </tbody>
            </table>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <td style="width: 50%;"><b>Shipp To</b></td>
                     <td style="width: 50%;"><b>Contact</b></td>
                  </tr>
               </thead>
               <tbody>
                  <tr> 
                     <td  class="text-left" data-link-style="text-decoration:none; color:#67bffd;"> {{ optional(optional($order)->address)->first_name }} {{ $order->last_name }}  <br />{{ optional($order->address)->address }}<br /> {{ optional($order->address)->city }} &nbsp;<br /> {{ optional(optional($order->address)->address_state)->name }},{{ optional(optional($order->address)->address_country)->name }}&nbsp;</td>
      
                     <td class="text-left"> {{ optional(optional($order)->address)->first_name }} &nbsp;{{ optional(optional($order)->address)->last_name }}  <br />
                        {{ optional($order->user)->email }} <br />{{ optional($order->user)->phone_number }} <br /><br /> <br />
                     </td>
                  </tr>
               </tbody>
            </table>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <td><b>Location</b></td>
                     <td><b>Reference</b></td>
                     <td><b>Product</b></td>
                     <td><b>Product Weight</b></td>
                     <td><b>Model</b></td>
                     <td class="text-right"><b>Quantity</b></td>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td></td>
                     <td> </td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-right"></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </body>

</html>

