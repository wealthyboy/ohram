@extends('admin.layouts.app')
@section('content')

<div class="row">
<div class="col-md-6">
      <div class="card">
         <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">money</i>
         </div>
         <div class="card-content">
            @include('errors.errors')
            <h4 class="card-title">Add Order</h4>
            <form id="create_order" method="post"  action="{{ route('confirm_order') }}">
               {{ csrf_field() }}
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group label-floating">
                        <label class="control-label">Name</label>
                        <input required="true" type="text" name="first_name" class="form-control" >
                     </div>
                  </div>

                   <div class="col-md-4">
                     <div class="form-group label-floating">
                        <label class="control-label">Last Name</label>
                        <input required="true" type="text" name="last_name" class="form-control" >
                        <input  type="hidden" name="admin" value="admin" class="form-control" >

                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group label-floating">
                        <label class="control-label">Phone</label>
                        <input  number="true" type="text" name="phone_number" class="form-control" >
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group label-floating">
                        <label class="control-label">Email</label>
                        <input type="email" name="email" class="form-control" >
                     </div>
                  </div>

                   <div class="col-md-4">
                     <div class="form-group label-floating">
                        <label class="control-label">Address</label>
                        <input required="true" type="text" name="address" class="form-control" >
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group label-floating">
                        <label class="control-label">City</label>
                        <input required="true" number="true" type="text" name="city" class="form-control" >
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group label-floating">
                        <label class="control-label"></label>
                        <select name="state_id" id="address_state"  required="true" data-msg="Select your state"  class="form-control input-md custom_input">
                            <option selected="selected" value="">Select State</option>

                                @foreach($states as $state)


                                   <option  value="{{ $state->id }}">{{ $state->name }}</option>
         
                                @endforeach
                                
                                </select>                 </div>
                  </div>

                  

                <div class="col-md-12">
                    @if($carts->count())
                        @foreach($carts as $cart)
                        <div class="">
                        Product : {{ $cart->product->product_name }}<br/>
                        Qty: {{ $cart->quantity }}<br/>
                        Price: ₦{{ $cart->price}} <?php ?>  <br/>
<br/>
                        Sub Total: ₦{{ $cart->total}}<br/>
                        <a type="button"  href="/cart/delete/{{ $cart->id }}" rel="tooltip" title="" class="btn btn-simple" data-original-title="Remove item">
                                <i class="material-icons">close</i>Cancel
                            </a>
                        </div>

                        @endforeach
                     @else
                        <p> Cart is empty</p>
                     @endif
                  </div>
               </div>
               @if($carts->count())
                 <button type="submit" class="btn btn-rose btn-round pull-right">Confirm</button>
               @endif
               <div class="clearfix"></div>
            </form>
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="card">
        
         <div class="card-content">
            @include('errors.errors')
            <h4 class="card-title">Receipt</h4>

            <br/>

            <form id="spare_parts" method="post"  action="">
               {{csrf_field() }}
               <div class="row">
                  <div  id="section-to-print" class="col-md-12">
                    @if($order != '')
                    <div class="mb-3"><img src="{{ asset('assets/img/afng_logo_2.png') }}" /></div>
                    <br/>
                    <br/>


                     <div >
                        <div class="pull-left"> <strong>Date: </strong> &nbsp{{ $order->created_at }}</div>
                        <br/>                        
                        <br/>

                         <strong>Invoice No: </strong>  &nbsp{{ $order->inv }}<br/>
 
                        <strong>Name: </strong>   &nbsp{{ $order->name }}<br/>
                        <strong>Phone: </strong>  &nbsp{{ $order->phone }}<br/>
                        <strong>Email:  </strong> &nbsp{{ $order->email }}<br/><br/>

                        @foreach($order->ordered_product as $order_product)
                        <strong> Product Name: </strong>  &nbsp{{ $order_product->product->product_name }}<br/>
                        <strong> Qty: </strong>  &nbsp{{ $order_product->quantity }}<br/>
                        <strong>  Price:  </strong> &nbsp₦{{ number_format($order_product->price) }} 
                            <?php ?>  <br/>
                            <strong> Sku:  </strong> &nbsp{{ $order_product->product->sku }}<br/>
                            <strong>Sub-Total: </strong>  &nbsp₦{{ number_format($order_product->price  * $order_product->quantity) }}<br/>  
                        <br/>
                        @endforeach
                        

                     </div>

                     <br/>

                     <table class="table shopping-cart-table-total">
                       
                        <tr>
                        <td class="alignright"><h4> <strong>TOTAL </strong></h4></td>
                        <td><h4>₦{{ $total->items_total }}</h4></td>
                        </tr>
                    </table>

                    <p> Thanks for your patronage.</p>
                    @else
                       <div> No data </div>
                    @endif
                  </div>
               </div>
                <div class="no-print">
                    @if($order != '')
                        <a type="button" href="{{ route('delete_order') }}" class="pull-left btn btn-rose btn-round pull-right">Refresh</a>
                        <button type="button"  onclick="myprint();" class="pull-right btn btn-rose btn-round pull-right">Print</button>
                    @endif  

                
                </div>

               <div class="clearfix"></div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-content">
            <div class="col-md-12">
               <div class="text-left">
                  <h4 class="card-title">Sales</h4>
               </div>
               <div class="text-right">
                  <a href="" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                  <i class="material-icons">add</i>
                  </a>
                  <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-deal').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                  <i class="material-icons">close</i>
                  </a>
               </div>
            </div>
            <div class="toolbar">
               <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <div class="material-datatables">
            <form id="add_to_cart" action="" method="POST" style="">
            {{ csrf_field() }}


                <table id="datatables" class="table table-striped table-shopping table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>

                                <tr>
                                  <th>
                                  <div class="checkbox">
                                            <label>
                                                <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" >
                                            </label>
                                        </div>
                                   
                                  </th>
                                    <th>Image</th>
 
                                    <th>Name</th>


                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>



                                    <th>Sku</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($products as $product) 
                                <tr>
                                <td>
                                    <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $product->id }}" name="selected[]" >
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="img-container">
                                            <img class="" src="{{  $product->tn_path()   }} " alt="...">
                                        </div>
                                    </td>


                                    <td><a href="{{ route('show_products',['id'=>$product->id]) }}">{{ $product->product_name }}</a></td>

                                      <td>{{ Config('app.currency')}}<?php echo  number_format($product->price)  ?></td>
                                    <td>{{ $product->quantity }}</td>
                                    <td><input   style="width: 60px;" name="quantity" id="quantity" value="" type="number" /></td>
                                    <td>
                                    @if($product->product_images->count())
                                        <div class="ml-3 product-variants-item">
                                            <span class="control-label">Color</span>
                                            <select style="width: 60px;"  id="product_color" class="procuct-color nice" name="product_image_id">
                                            <option selected value="">Select Color</option>
                                                @foreach($product->product_images as $color)
                                                <option  value="{{ $color->id }}">{{ $color->color->color_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                      
                                    </td>
                                    <td>
                                    @if($product->product_image->product_sizes->count())
                                        <div class="product-variants-item">
                                            <span class="control-label">Size</span>
                                            <select style="width: 60px;"  class="nice" id="product_sizes" name="size">
                                            <option selected="selected" value="">Select Size</option>
                                          @foreach($product->product_image->product_sizes as $product_size)
                                          <option  value="{{ $product_size->id }},{{  $product_size->size }}">{{ $product_size->size }} {{ $product_size->quantity >= 1 ? 'In stock' : 'Out of stock | Pre Order'}}</option>
                                          @endforeach
                                            </select>
                                        </div>
                                     @endif
                                    
                                    </td>
                                    <input name="product_id" id="product_id" value="{{ $product->id }}" type="hidden" />

                                   <input name="quantity" id="qty" value="" type="hidden" />
                                    <td>{{ $product->sku }}</td>
                                    <td class="td-actions text-right">
                                    <a data-product-id="{{ $product->id }}" data-quantity="{{ $product->quantity }}" href="#"  rel="tooltip" title="Add to Cart" class="btn btn-danger add_to_cart btn-simple btn-xs">
                                      <i class="material-icons">shopping_cart</i>Add To Cart
                                   </a> 
                                    </td>
                                </tr>

                               @endforeach  
                            </tbody>
                        </table> 
                        <input type="hidden" name="product_id" id="product_id" value="" />

                    </form>

            </div>
         </div>
         <!-- end content-->
      </div>
      <!--  end card  -->
   </div>
   <!-- end col-md-12 -->
</div>
<!-- end row -->
@endsection
@section('pagespecificscripts')
<script src="/assets/js/jquery.datatables.js"></script>

@stop
@section('inline-scripts')
function myprint() {
    window.print();
}
$(document).ready(function() {


    //change color image
$('select#product_color').on('change',function(e) {
    e.preventDefault();
    var self = $(this);
    var d = {'product_image_id': self.val()};
    $.ajax({
        url: '/get/other/images/'+d.product_image_id,
        type: 'post',
        data: d,
            beforeSend: function(xhr){
                // self.prepend('<i class="fa fa-spinner fa-spin"></i>');
            },complete: function(){
                
            },
            success: function(data) {
              //  $.post('/get/other/images/'+d.product_image_id,function(data){
                    $("#color_images").html(data);
                    
                $.post('/get/other/images/sizes/'+d.product_image_id,function(data){
                    $("select#product_sizes").html('').append(data);
                });  
            },
            error: function(data) {
                $('i.fa. fa-spinner.fa-spin').remove();
            }
    });
});

$('select#product_sizes').on('change',function(e) {
    var self = $(this);
    var d = {'variants_price': self.val()};
    $.post('/get/variants/prices/'+d.variants_price,function(data){
       $("span#amount").html('').append(data);
    });    
});



$(".add_to_cart").on('click',function(e){
        var self = $(this);
        e.preventDefault();
        $product_id = self.parent().parent().find('input#product_id').val();
        $quantity =  self.parent().parent().find('input#quantity').val();
    


        var size  =  self.parent().parent().find('select#product_sizes').val();
        var color =  self.parent().parent().find('select#product_color').val();


        
        if(size == '' ){
           alert("Select a Size");
           return false;
        }
        
        else if(color == '' ){
           alert("Choose Color");
           return false;
        }
         else if($quantity == '' || $quantity == 0){
           alert("Enter your quantity");
           return false;
        } else {
          var d = {'admin':1,'product_id':$product_id,'size':size,'product_image_id':color,'quantity':$quantity};        
        //return;        
         $.ajax({
            url: '/add-to-cart',
            type: 'post',
            data: d,
                beforeSend: function(xhr){
                    self.prepend('<i class="fa fa-spinner fa-spin"></i>');
                },complete: function(){
                    $('i.fa.fa-spinner.fa-spin').remove();
                },
                success: function(data) {
                   location.reload()
                    
                },
                error: function(data) {
                    $('i.fa. fa-spinner.fa-spin').remove();
                }
        });
    } 
});




$('#datatables').DataTable({
    "pagingType": "full_numbers",
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    responsive: true,
    language: {
    search: "_INPUT_",
    searchPlaceholder: "Search records",
    }
    });

    $('#cat_sub_cat_id').on('change',function(){
       $name = $(this).find(':selected').data('name');
       $(this).attr('name', $name);
    });
    s.initFormExtendedDatetimepickers();
});
@stop
