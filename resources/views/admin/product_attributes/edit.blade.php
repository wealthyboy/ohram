
@extends('admin.layouts.app')
@section('content')
@section('pagespecificstyles')
<link href="{{ asset('store/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
@stop
<div class="row">
    <div class="col-md-10">
        @include('errors.errors')
        <div class="card">
            <form id="" action="{{ route('attributes.update',['attribute'=>$attr->id]) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="card-content">
                    <h4 class="card-title">Edit</h4>
                    <div class="form-group label-floating">
                        <label class="control-label">
                            Name
                            <small>*</small>
                        </label>
                        <input class="form-control"
                            name="name"
                            type="text"
                            value="{{ $attr->name }}"
                            required="true"
                        />
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">
                            Sort Order
                            <small>*</small>
                        </label>
                        <input class="form-control"
                            name="sort_order"
                            type="text"
                            value="{{ $attr->sort_order }}"
                        />
                    </div>
                    <div class="form-group label-floating">
                            <label class="control-label">
                                Hex Code
                                <small>*</small>
                            </label>
                            <input class="form-control  colorpicker"
                                name="color_code"
                                type="text"
                                value="{{ $attr->color_code }}"

                                
                            />
                        </div>
                    <div class="form-group ">
                        <label class="control-label"></label>
                        <select name="parent_id" class="form-control">
                        <option  value="">--Choose One--</option>
                            @foreach($product_attributes as $product_attribute)
                                @if($attr->parent_id == $product_attribute->id)
                                    <option class="" value="{{  $product_attribute->id }}" selected="selected">{{ $product_attribute->name }} </option>
                                @else
                                    <option class="" value="{{  $product_attribute->id }}">{{ $product_attribute->name }}  </option>
                                    @include('includes.product_attr',['product_attribute'=>$product_attribute])
                                @endif
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label class="control-label"></label>
                        <select name="type" required="true" class="form-control">
                            <option  value="" selected="">--Choose Type--</option>
                            <option  value="both" >Both</option>
                            <option  value="category" >Category</option>
                        </select>
                    </div>
                    <h4 class="info-text">Upload Image Here</h4>
                    <div class="">
                        <div id="m_image"  class="uploadloaded_image text-center mb-3">
                            <div class="upload-text {{ $attr->image !== null  ?  'hide' : '' }}"> 
                                    
                                    <a class="activate-file" href="#">
                                    <img src="{{ asset('store/img/upload_icon.png') }}">
                                    <b>Add Image </b> 
                                    </a>
                            </div>
                            <div id="remove_image" class="remove_image {{ $attr->image !== null  ?  '' : 'hide' }}">
                                <a class="delete_image" data-id="{{ $attr->id }}" href="#">Remove</a> 
                            </div>

                            <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="_image"  />
                            <input type="hidden"  class="file_upload_input  stored_image" value="{{ $attr->image }}" name="image">
                            @if ( $attr->image )
                                <img id="stored_image" class="img-thumnail" src="{{ $attr->image }}" alt="">
                            @endif
                            
                        </div>
                    </div>
                    <div class="form-footer text-right">
                        <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
   <script src="{{ asset('store/js/bootstrap-colorpicker.min.js') }}"></script>
@stop
@section('inline-scripts')
$(document).ready(function() {		
});
@stop






