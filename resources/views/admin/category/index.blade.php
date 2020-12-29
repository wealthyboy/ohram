@extends('admin.layouts.app')

@section('content')


<div class="row">
    <div class="col-md-6">
        @include('errors.errors')
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Add Categories</h4>
              
                <div class="material-datatables">
                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data" id="form-category">
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
                                Image link
                            </label>
                            <input class="form-control"
                                name="image_custom_link"
                                type="text"  
                            />
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <div class="form-group ">
                                <label class="control-label"> </label>
                                <textarea name="description" 
                                id="description" class="form-control"  rows="7"></textarea>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label"></label>
                            <select name="parent_id" class="form-control">
                            <option  value="">--Choose One--</option>
                                @foreach($categories as $category)
                                    <option class="" value="{{ $category->id }}" >{{ $category->name }} </option>
                                    @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                                @endforeach
                                
                            </select>
                        </div>
                       <div class="row">
                            <div class="col-md-12">
                               <h3 class="info-text">Upload Image</h3>
                            </div>
               
                            <div class="col-md-6">
                                <div id="m_image"  class="uploadloaded_image text-center mb-3">
                                    <div class="upload-text"> 
                                            <a class="activate-file" href="#">
                                            <img src="{{ asset('backend/img/upload_icon.png') }}">
                                            <b>Banner Image </b> 
                                            </a>
                                    </div>
                                    <div id="remove_image" class="remove_image hide">
                                        <a class="delete_image"  href="#">Remove</a>
                                    </div>
                                    <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="category_image"  />
                                    <input type="hidden"  class="file_upload_input  stored_image" id="stored_image" name="banner_image">
                                </div>
                            </div>

                        </div>


                        <div class="hide">
                            <h3 class="info-text">Filters</h3>
                            <div class="well well-sm" style="height: 350px; background-color: #fff; color: black; overflow: auto;">
                                <ul class="treeview" data-role="treeview">
                                    <li data-icon="" data-caption="">
                                        <ul>
                                        @foreach($product_attributes as $product_attribute)
                                        <li data-caption="Documents">
                                            <div class="checkbox">
                                                <label>
                                                    <input name="attribute_id[]" value="{{ $product_attribute->id }}
                                                    " type="checkbox">
                                                    {{ $product_attribute->name }}
                                            </div>
                                        </li>
                                        @if($product_attribute->children->count())
                                            @foreach($product_attribute->children  as $children)  
                                            <li data-caption="Projects">
                                                <ul>
                                                    <li data-caption="Web">
                                                    <div class="checkbox">
                                                    <label> 
                                                    <input name="attribute_child_id[{{$product_attribute->id}}][]" value="{{  $children->id }}" type="checkbox">
                                                    {{$children->name}}
                                                    </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endforeach
                                        @endif 
                                        @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-round btn-group  btn-fill">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-6 -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Categories</h4>
                    <div  class="checkbox col-md-6 text-left">
                        <label>
                            <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" > Select All
                        </label>
                    </div>
                    <div  class="col-md-6 text-right">
                        <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-categories').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                            <i class="material-icons">close</i> Delete
                        </a>
                    </div> 
                    <div class="clearfix"></div> 

                    <form action="{{ route('category.destroy',['category'=>1]) }}" method="post" enctype="multipart/form-data" id="form-categories">
                    @csrf
                    @method('DELETE')
                    <div class="material-datatables">
                        @foreach($categories as $category)
                            <div class="parent" value="{{ $category->id }}">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="{{ $category->id }}" name="selected[]" >
                                    {{ $category->name }}  
                                    <a href="{{ route('category.edit',['category'=>$category->id]) }}">
                                    <i class="fa fa-pencil"></i> Edit</a> 
                                </label>
                            </div>   
                            @include('includes.children',['obj'=>$category,'space'=>'&nbsp;&nbsp;','model' => 'category','url' => 'category'])
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
    let activateFileExplorer = 'a.activate-file';
    let delete_image = 'a.delete_image';
    var main_file = $("input#file_upload_input");

    Img.initUploadImage({
        url:'/admin/upload/image?folder=category',
        activator: activateFileExplorer,
        inputFile: main_file,
    });

    Img.deleteImage({
        url:'/admin/category/delete/image',
        activator: delete_image,
        inputFile: main_file,
    });
});

@stop





