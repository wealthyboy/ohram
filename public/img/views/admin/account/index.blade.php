@extends('admin.layouts.app')
@section('content')

<div class="row">
   <div class="col-md-12">
      <div class="title">
         <h3>Search</h3>
      </div>
      <form action="" method="get" >
      <div class="row">
         <div class="col-md-4">
            <div class="form-group">
               <label class="label-control">From Date</label>
               <input required type="text" name="from_date" class="form-control datepicker" value=""/>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
               <label class="label-control">To Date</label>
               <input type="text" name="to_date" required class="form-control datepicker" value=""/>
            </div>
         </div>
         <div class="col-md-4">
            <button type="submit" class="btn mt-2 btn-primary btn-round mb-2">Submit</button>
         </div>
      </div>

      </form>



   </div>
</div>
</div>
<div class="row">
   <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
         <div class="card-content">
            <p class="category">Today's Sales Total</p>
            <h3 class="card-title">{{ $currency }}{{ number_format($todays_sales->items_total) ?? 0}}</h3>
         </div>
      </div>
   </div>
   <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
         <div class="card-content">
            <p class="category">Items Sold Today</p>
            <h3 class="card-title">{{ $todays_orders->qty ?? 0 }}</h3>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
         <div class="card-content">
            <p class="category">All Products Value</p>
            <h3 class="card-title">{{ $currency }}{{ number_format($total_value) ?? 0 }}</h3>
         </div>
      </div>
   </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
         <div class="card-content">
            <p class="category">All Sales</p>
            <h3 class="card-title">{{ number_format($all_sales->qty) }}</h3>
         </div>
      </div>
   </div>
   <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
         <div class="card-content">
            <p class="category">Sales Total</p>
            <h3 class="card-title">{{ $currency }}{{ number_format($all_sales_value->items_total) }}</h3>
         </div>
      </div>
   </div>
   <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
         <div class="card-content">
            <p class="category"> Remaining Products</p>
            <h3 class="card-title">{{ $remaining_products }}</h3>
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
               </div>
            </div>
            <div class="toolbar">
               <!--  Here you can write extra buttons/actions for the toolbar-->
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

@section('inline-scripts')
$(document).ready(function() {
});
@stop
