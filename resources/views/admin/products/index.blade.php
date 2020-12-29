@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
        <div class="text-right">
            <a href="{{ route('products.index') }}" rel="tooltip" title="Refresh" class="btn btn-primary btn-simple btn-xs">
                <i class="material-icons">refresh</i>
                Refresh
            </a>
            <a href="{{ route('products.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">add</i>
                    Add Product
            </a>
            <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-products').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                <i class="material-icons">close</i>
                Remove
            </a>

            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">Filter</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Filter - <small class="category"></small></h4>
                    
                    <form action="{{ route('search_products') }}" method="get">
                        <div class="row">
                           
                            <div class="col-md-10">
                                <div class="form-group label-floating ">
                                    <label class="control-label">Search Products</label>
                                    <input required   type="text" value="{{  old('product_name') }}" name="q" class="form-control" >
                                </div>
                            </div>
                            
                        </div>
                        <input name="search" type="submit" value="search" class="btn btn-rose  btn-round pull-right">
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
        
                <div class="card-content">
                
                    <h4 class="card-title">Products</h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                    <form action="/admin/products/destroy/multiple" method="post" enctype="multipart/form-data" id="form-products">
                        @method('DELETE')
                        @csrf
                
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
                                    <th>Status</th>
                                    <th>Price</th>
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
                                    <!-- cart-active -->
                                    <!-- cart-sidebar-btn active -->
                                    <td>
                                        <div class="img-container">
                                            <img class="" src="{{  $product->image_to_show_m   }}" alt="...">
                                        </div>
                                    </td>
                                    <td><a target="_blank" href="/product/{{ isset($product->categories[0]) ?  $product->categories[0]->slug : '' }}/{{ $product->slug }}">{{ $product->product_name }}</a></td>
                                    <td>{{ $product->allow == 1 ? 'Live' : 'Offline' }}</td>
                                    <td>
                                        <span class="amount">
                                           {{ $system_settings->default_currency->symbol }}{{ $product->display_price() }}
                                        </span> 
                                    </td>
                                    <td class="td-actions ">                     
                                        <a href="{{ route('products.edit',['product'=>$product->id] ) }}" rel="tooltip" title="Edit" class="btn btn-primary btn-simple btn-xs">
                                            <i class="material-icons">edit</i>
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                               @endforeach  
                            </tbody>
                         </table>
                        </form>
                    </div>
                    <div class="pull-right">{{ $products->links() }}</div>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
@endsection
@section('inline-scripts')
$(document).ready(function() {
});
@stop







