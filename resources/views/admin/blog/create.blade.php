@extends('admin.layouts.app')

@section('content')
<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" id="form-posts">
    <div class="row">
        <div class="col-md-8">
            @include('errors.errors')
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Add Post</h4>
                    <div class="material-datatables">
                        @csrf
                            <div class="form-group label-floating">
                            <label class="control-label">
                                    Title
                                    <small>*</small>
                            </label>
                            <input class="form-control"
                                    name="title"
                                    type="text"
                                    required="true"
                                    value="{{ old('title') }}"
                            />
                            </div>
                            <div class="form-group label-floating">
                            <label class="control-label">
                                    Teaser
                                    <small>*</small>
                            </label>
                            <input class="form-control"
                                    name="teaser"
                                    type="text"
                                    required="true"
                                    value="{{ old('teaser') }}"
                            />
                            </div>
                            <div class="form-group">
                            <label>Description</label>
                            <div class="form-group ">
                                <label class="control-label"> </label>
                                <textarea name="description" 
                                id="description" class="form-control"  required rows="20">{{ old('description') }}</textarea>
                            </div>
                            </div>
                            <div class="form-footer text-right">
                                <button type="submit" class="btn btn-rose btn-round btn-group  btn-fill">Submit</button>
                            </div>
                    </div>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-6 -->
        <div class="col-md-4">
            <div class="card">
            <div class="card-header text-center">
                <h4 class="card-title">Image</h4>
                </div>
                <div class="card-content">
                <div class="">
                        <div id="m_image"  class="uploadloaded_image text-center mb-3">
                            <div class="upload-text"> 
                            <a class="activate-file" href="#">
                                <img src="{{ asset('store/img/upload_icon.png') }}">
                                <b>Add Image </b> 
                            </a>
                            </div>
                            <div id="remove_image" class="remove_image hide">
                            <a class="delete_image" href="#">Remove</a>
                            </div>
                            <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="product_image"  />
                            <input type="hidden" data-msg="Uplaod" class="file_upload_input stored_image" id="stored_image" name="image">
                        </div>
                </div>    
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-6 -->
        <div class="col-md-4">
            <label>Tags</label>
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
                                        <input name="attribute_id[]" value="{{  $children->id }}" type="checkbox">
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
    </div> <!-- end row -->
</form>
@endsection

@section('page-scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop

@section('inline-scripts')

$(document).ready(function() {
    let activateFileExplorer = 'a.activate-file';
    let delete_image = 'a.delete_image';
    var main_file = $("input#file_upload_input");
    Img.initUploadImage({
        url:'/admin/upload/image?folder=blog',
        activator: activateFileExplorer,
        inputFile: main_file,
    });
    Img.deleteImage({
        url:'/admin/delete/image?folder=blog&model=Information',
        activator: delete_image,
        inputFile: main_file,

    });
    CKEDITOR.replace('description',{
        height: '400px'
    })
});

@stop





