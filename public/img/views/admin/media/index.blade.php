@extends('admin.layouts.app')

@section('content')
<h3>Media</h3>
<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <a href="{{ route('media.index') }}" rel="tooltip" title="Refresh" class="btn btn-primary btn-simple btn-xs">
                <i class="material-icons">refresh</i>
                Refresh
            </a>
        </div>
    </div>
    <form method="POST">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Images Only</h4>
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
                                <a class="delete_image" data-url="url" href="#">Remove</a> | <a  class="activate-file"  href="#">Change</a> 
                            </div>
                            <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="product_image"  />
                            <input type="hidden" data-msg="Uplaod" class="file_upload_input stored_image" id="stored_image" name="image">
                        </div>
                    </div>    
                </div><!-- end content-->
                <div class="form-footer card-footer text-center">
                    <a href="" class="btn btn-rose btn-round btn-group  btn-fill">Submit</a>
                </div>
            </div><!--  end card  -->
        </div> <!-- end col-md-4 -->
    </form>
   <div class="clearfix"></div>
    <div class="mt-4">
        @foreach( $files  as $file)
            <div class="col-md-2">
                <div class="card card-product" data-count="6">
                    <div class="card-image" data-header-animation="true">
                        <a href="{{ asset($file) }}">
                            <img class="img" src="{{ asset($file) }}">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="card-actions">
                            <a href="/admin/delete/upload?image_url={{ $file }}" class="btn btn-danger btn-simple" rel="tooltip" data-placement="bottom" title="" data-original-title="Remove">
                                <i class="material-icons">close</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->
@endsection
@section('inline-scripts')
$(document).ready(function() {

    let activateFileExplorer = 'a.activate-file';
    let delete_image = 'a.delete_image';
    var main_file = $("input#file_upload_input");
    Img.initUploadImage({
        url:'/admin/upload?folder=uploads',
        activator: activateFileExplorer,
        inputFile: main_file,
    });
    Img.deleteImage({
        url:'/admin/delete/upload?folder=uploads',
        activator: delete_image,
    });
});
@stop







