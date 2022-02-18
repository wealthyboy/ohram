@extends('admin.layouts.app')
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="text-right">
        
      </div>
   </div>
   <div class="col-md-4">
      <div class="card">
         <div class="card-content">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Order Details</h3>
               </div>
               <table class="table">
                  <tbody>
                     <tr>
                        <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Store"><i class="fa fa-shopping-cart fa-fw"></i></button></td>
                        <td><a href="" target="_blank">{{  Config('app.name') }}</a></td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Date Added" class="btn btn-info btn-xs"><i class="fa fa-calendar fa-fw"></i></button></td>
                        <td>{{ $order->created_at }}</td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Payment Method" class="btn btn-info btn-xs"><i class="fa fa-credit-card fa-fw"></i></button></td>
                        <td>{{ $order->payment_type }}</td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Shipping Method" class="btn btn-info btn-xs"><i class="fa fa-truck fa-fw"></i></button></td>
                        <td>Shipping : {{ optional($order->shipping)->parent->name }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="card">
         <div class="card-content">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-user"></i> Customer Details</h3>
               </div>
               <table class="table">
                  <tbody>
                     <tr>
                        <td style="width: 1%;"><button data-toggle="tooltip" title="Customer" class="btn btn-info btn-xs"><i class="fa fa-user fa-fw"></i></button></td>
                        <td> <a href="" target="_blank">{{ $order->user->fullname() }}</a></td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="E-Mail" class="btn btn-info btn-xs"><i class="fa fa-envelope-o fa-fw"></i></button></td>
                        <td><a href="">{{ $order->user->email }}</a></td>
                     </tr>
                     <tr>
                        <td><button data-toggle="tooltip" title="Telephone" class="btn btn-info btn-xs"><i class="fa fa-phone fa-fw"></i></button></td>
                        <td>{{ $order->user->phone_number }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="card">
         <div class="card-content">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title"><i class="fa fa-cog"></i> Options</h3>
               </div>
               <table class="table">
                  <tbody>
                     <tr>
                        <td>Invoice</td>
                        <td id="invoice" class="text-right">{{ $order->invoice  }}</td>
                        <td style="width: 1%;" class="text-center"><button disabled="disabled" class="btn btn-success btn-xs"><i class="fa fa-refresh"></i></button>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
         </div>
         <div class="card-content">
            <h4 class="card-title">Address</h4>
            <div class="table-responsive">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <td style="width: 50%;" class="text-left">Shipping Address</td>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                     <td  class="text-left" data-link-style="text-decoration:none; color:#67bffd;"> {{ optional(optional($order)->address)->first_name }} {{ optional(optional($order)->address)->last_name }}  <br />{{ optional($order->address)->address }}<br /> {{ optional($order->address)->city }} &nbsp;<br /> {{ optional(optional($order->address)->address_state)->name }},{{ optional(optional($order->address)->address_country)->name }}&nbsp;</td>

                     </tr>
                  </tbody>
               </table>
               <div>
               <h2>Items</h2>
               <table class="table table-shopping">
                  <thead>
                     <tr>
                        <th class="text-center"></th>
                        <th>Product</th>
                        <th class="th-description">Variations</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ( $order->ordered_products as $order_product )
                     <tr>
                        <td>
                           <div class="img-container">
                              <img src="{{ optional($order_product->product_variation)->image  }} " alt="...">
                           </div>
                           <div class="form-group label-floating">
                             <input type="hidden" class="p-v-id" value="{{ $order_product->id }}" />
                              <select  class="form-control mt-3 update_status" name="order_status[{{ $order_product->id }}]" id="">
                                 <option value="" >Choose Status</option>
                                 @foreach($statuses as $status)
                                   @if ($status == $order_product->status)
                                       <option value="{{ $status }}" selected>{{ $status }}</option>
                                    @else
                                      <option value="{{ $status }}">{{ $status }}</option>
                                    @endif
                                 @endforeach
                              </select>
                           </div>
                        </td>
                        <td class="td-name">
                           <a href="">{{  optional(optional($order_product->product_variation)->product)->product_name }}</a>
                           <br><small></small>
                        </td>
                        <td>
                           @if (null !== $order_product->product_variation)
                              @foreach( $order_product->product_variation->product_variation_values  as $v)
                                 {{ $v->attribute->name .','}}
                              @endforeach
                           @else
                              -----
                           @endif

                        </td>
                      
                        <td class="td-number text-right">
                           {{  $order->currency }}{{  $order_product->order_price   }}
                        </td>
                        <td class="td-number">
                           {{ $order_product->quantity }}
                        </td>
                        <td class="td-number">
                           <small>{{  $order->currency }}</small>{{ $order_product->total   }}
                        </td>
                        
                     </tr>
                     @endforeach                               
                  </tbody>
               </table>
               <table class="table ">
                  <tfoot>
                     <tr>
                        <td colspan="6" class="text-right">Sub-Total</td>
                        <td class="text-right"><small>{{ $order->currency }}</small>{{ number_format($sub_total)  }}</td>
                     </tr>
                     <tr>
                        <td colspan="6" class="text-right">Coupon</td>
                        <td class="text-right"> {{ $order->isCouponForAmb() }}  &nbsp; {{  $order->coupon ?  $order->coupon.'  -%'.$order->voucher()->amount . 'off'  : '---' }}</td>
                     </tr>
                     <tr>
                        <td colspan="6" class="text-right">Shipping</td>
                        <td class="text-right"><small>{{ $order->currency }}</small>{{ optional($order->shipping)->price }}</td>
                     </tr>
                     <tr>
                        <td colspan="6" class="text-right">Total</td>
                        <td class="text-right">{{ $order->currency }}{{  $order->get_total() }}</td>
                     </tr>
                  </tfoot>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end row -->
@endsection
@section('inline-scripts')

$(".update_status").on('change',function(e){
      let self = $(this)
      if(self.val() == '') return;

      let value = self.parent().find(".p-v-id").val()
      var payLoad = { ordered_product_id: value,status: self.val()}
      $.ajax({
         type: "POST",
         url: "/admin/update/ordered_product/status",
         data: payLoad,
      }).done(function(response){
         console.log(response)
      })
})
@stop

