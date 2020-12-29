@extends('admin.layouts.app')
@section('content')


<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-content">
            <div class="col-md-12">
               <div class="text-left">
                  <h4 class="card-title">Orders</h4>
               </div>
               <div class="text-right">
               
               </div>
            </div>
            <div class="toolbar">
               <!-- Here you can write extra buttons/actions for the toolbar  -->
            </div>
            <div class="material-datatables">
            <form action="" method="post" enctype="multipart/form-data" id="form-orders">
                
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
                           <th>Invoice</th>
                           <th>Customer</th>
                           <th>Type</th>
                           <th>Date Added</th>
                           <th>Total</th>
                           <th class="text-right">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                       @foreach ($orders as $order )
                            <tr>
                            <td>
                              <div class="checkbox">
                                 <label>
                                 <input type="checkbox" value="{{ $order->id }}" name="selected[]" >
                                 </label>
                              </div>
                           </td>
                            <td class="text-left">{{ $order->invoice }}</td>
                            <td>{{ $order->user->fullname() }}</td>
                            <td>{{ $order->order_type }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td class="text-left">{{ $order->currency  ?? '₦'}}{{ $order->get_total() }}</td>
                            <td class="td-actions text-center">
                             <span> <a href="{{ route('order.dispatch.note',['id'=>$order->id]) }}" rel="tooltip"   target="_blank" class="btn btn-success btn-simple " data-original-title="" title="Dispatch Note">
                                 <i class="material-icons">dispatch</i>
                              </a></span>
                              <span><a href="{{ route('order.invoice',['id'=>$order->id]) }}" rel="tooltip"   target="_blank" class="btn btn-success btn-simple" data-original-title="" title="Print Invoice">
                                 <i class="material-icons">print</i>
                              </a></span>
                              <span><a href="{{ route('admin.orders.show',['order'=>$order->id]) }}" rel="tooltip" class="btn btn-success btn-simple" data-original-title="" title="View">
                                 <i class="fa fa-eye"></i>
                              </a></span>
                           </td>
                        @endforeach   
                        
                     </tbody>
                  </table>
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
@stop
@section('inline-scripts')
function myprint() {
    window.print();
}
$(document).ready(function() {


$(".add_to_cart").on('click',function(e){
    var self = $(this);
    e.preventDefault();
    $qty = self.data('quantity');
    $product_id = self.data('productid');
    $quantity = self.parent().parent().find('input#quantity').val();
    $discount = self.parent().parent().find('input#discount').val();

    if( $quantity  == ''){
       alert("Please enter a quantity");
       return false;
    }
    
    if($quantity >  $qty){
       alert("Cannot add that amount of quantity");
       return false;
    }

    $("#cart_product_id").val($product_id);
    $("#cart_discount").val($discount);
    $("#cart_quantity").val($quantity);
    $("#add_to_to_cart").attr('action','/add-to-cart/'+$product_id);
    $("#add_to_to_cart").submit();   
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
