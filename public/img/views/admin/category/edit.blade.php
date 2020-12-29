
@extends('admin.layouts.app')

@section('content')

   <div class="row">
   <form  action="{{ route('category.update',['category' => $cat->id ]) }}" method="post">
       
        <div class="col-md-8">
            @include('errors.errors')
            <div class="card">
                   @csrf
                   @method('PATCH')
                    <div class="card-content">
                        <h4 class="card-title">Edit Category</h4>
                        <div class="form-group label-floating">
                            <label class="control-label">
                              Name
                                <small>*</small>
                            </label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{ $cat->name }}"
                                   required="true"
                             />
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label">
                              Sort Order
                            </label>
                            <input class="form-control"
                                   name="sort_order"
                                   type="text"
                                   value="{{ $cat->sort_order }}"
                             />
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label">
                                Image link
                            </label>
                            <input class="form-control"
                                   name="image_custom_link"
                                   type="text"
                                   value="{{ $cat->image_custom_link }}"      
                            />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div class="form-group ">
                                <label class="control-label"> </label>
                                <textarea name="description" 
                                id="description" class="form-control"  rows="7">{{ $cat->description }}</textarea>
                            </div>
                        </div>


                        <div class="form-group ">
                            <label class="control-label"></label>
                            <select name="parent_id" class="form-control">
                            <option  value="">--Choose One--</option>
                                @foreach($categories as $category)
                                   @if($cat->parent_id ==  $category->id )
                                        <option class="" value="{{ $category->id }}" selected="selected">{{ $category->name }} </option>                                        
                                        @include('includes.children_options',['obj'=>$category,'space'=>'&nbsp;&nbsp;'])

                                    @else
                                        <option class="" value="{{ $category->id }}" >{{ $category->name }} </option>
                                        @include('includes.children_options',['model' => $cat,'obj'=>$category,'space'=>'&nbsp;&nbsp;'])
                                    @endif
                                @endforeach
                                
                            </select>
                        </div>


                        <h4 class="info-text">Upload Image Here</h4>
                            <div class="">
                                <div id="m_image"  class="uploadloaded_image text-center mb-3">
                                    <div class="upload-text {{ $cat->image !== null  ?  'hide' : '' }}"> 
                                         
                                            <a class="activate-file" href="#">
                                            <img src="{{ asset('backend/img/upload_icon.png') }}">
                                            <b>Add Image </b> 
                                            </a>
                                    </div>
                                    <div id="remove_image" class="remove_image {{ $cat->image !== null  ?  '' : 'hide' }}">
                                        <a class="delete_image" data-id="{{ $cat->id }}" href="#">Remove</a> 
                                    </div>

                                    <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="category_image"  />
                                    <input type="hidden"  class="file_upload_input  stored_image" value="{{ $cat->image }}" name="image">
                                    @if ( $cat->image )
                                       <img id="stored_image" class="img-thumnail" src="{{ $cat->image }}" alt="">
                                    @endif
                                    
                                </div>
                            </div>

                            <div class="form-footer text-right">
                                <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                            </div>
                    </div>
            </div>
        </div>
        <div class="col-md-4 ">
        <label>--Filters--</label>
        <div class="well well-sm" style="height: 350px; background-color: #fff; color: black; overflow: auto;">
            <ul class="treeview" data-role="treeview">
                <li data-icon="" data-caption="">
                    <ul>
                    @foreach($product_attributes as $product_attribute)
                    <li data-caption="Documents">
                        <div class="checkbox">
                            <label>
                                <input name="attribute_id[]" value="{{ $product_attribute->id }}" 
                                {{   $cat->check($cat->attributes, $product_attribute->id) ? 'checked' : '' }}          
                                    type="checkbox"
                                >
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
                                <input
                                    {{   $cat->check($cat->attributes , $children->id) ? 'checked' : '' }} 
                                 name="attribute_child_id[{{$product_attribute->id}}][]" value="{{  $children->id }}" type="checkbox">
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
   
    </form>

</div>
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






