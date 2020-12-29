@extends('admin.layouts.app')

@section('content')

<style>
  .categories .categories {
     margin-left: 20px;
  }
</style>

<div class="row">
    <div class="col-md-6">
        @include('errors.errors')
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Add Shipping</h4>
                <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar  -->
                </div>
                <div class="material-datatables">
                    <form action="{{ route('shipping.store') }}" method="post" enctype="multipart/form-data" id="form-shipping">
                        @csrf
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Name
                                <small>*</small>
                            </label>
                            <input class="form-control"
                                name="name"
                                type="text"
                                required="true"
                            />
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Sort Order
                            </label>
                            <input class="form-control"
                                name="sort_order"
                                type="number"    
                            />
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Price
                            </label>
                            <input class="form-control"
                                name="price"
                                type="number" 
                            />
                        </div>
                        <div class="form-group">
                            <label class="control-label"></label>
                            <select name="location_id" class="form-control">
                                <option  value="">--Choose One--</option>
                                @foreach($locations as $location)
                                    <optgroup label="{{ $location->name }}">
                                        @include('includes.children_options',['obj'=>$location,'space'=>'&nbsp;&nbsp;'])
                                    </optgroup>
                                @endforeach 
                            </select>
                        </div>
                        <div class="form-group ">
                            <label class="control-label"></label>
                            <select name="parent_id" class="form-control">
                                <option  value="">--Choose One--</option>
                                @foreach($shippings as $shipping)
                                    <option class="" value="{{ $shipping->id }}" >{{ $shipping->name }} </option>
                                    @include('includes.children_options',['obj'=>$shipping,'disabled' => true,'space'=>'&nbsp;&nbsp;'])
                                @endforeach  
                            </select>
                        </div>
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                        </div>
                        </form>
                    </div>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-6 -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-content">
                     <h4 class="card-title">Shipping</h4>
                        <div  class="checkbox col-md-6 text-left">
                            <label>
                                <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" > Select All
                            </label>
                        </div>
                        <div  class="col-md-6 text-right">
                            <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-shippings').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                <i class="material-icons">close</i> Delete
                            </a>
                        </div>  
                        <div class="clearfix"></div>
                        <form action="{{ route('shipping.destroy',['shipping'=>1]) }}" method="post" enctype="multipart/form-data" id="form-shippings">
                        @csrf
                        @method('DELETE')
                        <div class="material-datatables">
                            @foreach($shippings as $shipping)
                                <div class="parent" value="{{ $shipping->id }}">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="{{ $shipping->id }}" name="selected[]" >
                                        {{ $shipping->name }}|{{ $shipping->price }}  <a href="{{ route('shipping.edit',['shipping'=>$shipping->id]) }}"><i class="fa fa-pencil"></i> Edit</a>
                                    </label>
                                </div>   
                                @include('includes.children',['obj'=>$shipping,'space'=>'&nbsp;&nbsp;','model' => 'shipping','url' => 'shipping'])
                            </div>
                        @endforeach  
                    </div>
                </form>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-6 -->
</div> <!-- end row -->
@endsection
@section('inline-scripts')
$(document).ready(function() {
     

});
@stop





