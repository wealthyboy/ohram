@extends('layouts.app')
@section('content')



<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-content">
            <div class="col-md-12">
               <div class="text-left">
                  <h4 class="card-title">Sales</h4>
               </div>
               <div class="text-right">
                  <a href="{{ route('orders') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
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
                           <th>Customer</th>
                           <th>Item Name</th>
                           <th>Price</th>
                           <th>Qty</th>
                           <th>Sku</th>
                           <th>Total</th>
                           <th class="disabled-sorting text-right">Date</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($sales as $sale)  
                        <tr>
                           <td>
                              <div class="checkbox">
                                 <label>
                                   <input type="checkbox" value="{{ $sale->id }}" name="selected[]" >
                                 </label>
                              </div>
                           </td>
                           <td>
                             @if(null !== $sale->order)
                              <a href="{{ route('show_orders',['id'=>$sale->order->id]) }}">{{ $sale->order->name }}</a>
                             @endif
    
                           </td>
                           <td><a href="{{ route('show_products',['id'=>$sale->product_id]) }}">{{ $sale->product->product_name }}</a></td>
                           <td>₦{{ $sale->price }}</td>
                           <td>{{ $sale->quantity }}</td>
                           <td>{{ $sale->product->sku }}</td>
                           <td>₦{{ $sale->quantity * $sale->price }}</td>
                           <td class="text-center">
{{                                $sale->created_at
}}                           </td>
                        </tr>
                        @endforeach  
                     </tbody>
                  </table>

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
    demo.initFormExtendedDatetimepickers();
});
@stop
