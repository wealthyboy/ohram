@extends('admin.layouts.app')

@section('content')

<div class="row">
    <form class="form-horizontal"  action="/admin/page/banner" method="POST">
        @csrf
        <input type="hidden" name="page_name" value="newsletter" />
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Images Only</h4>
                </div>
                <div class="card-content">
                    <div class="">
                        <div id="m_image"  class="uploadloaded_image text-center mb-3">
                        <div class="upload-text {{  optional($newsletter_image)->image  ?  'hide' : '' }}"> 
                            <a class="activate-file" href="#">
                                <img src="{{ asset('store/img/upload_icon.png') }}">
                                <b>Add  Image </b> 
                            </a>
                            </div>
                            <div id="remove_image" class="remove_image {{  optional($newsletter_image)->image  ?  '' : 'hide' }}">
                                <a class="delete_image" data-id="{{ $newsletter_image->id }}" data-url="url" href="#">Remove</a>  
                            </div>
                            @if ( $newsletter_image )
                               <img id="stored_image" class="img-thumnail" src="{{ $newsletter_image->image }}" alt="">
                             @endif
                            <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="product_image"  />
                            <input type="hidden"  class="file_upload_input  stored_image" value="{{ null !== $newsletter_image ? $newsletter_image->image : '' }}" name="image">
                        </div>
                        <div class="form-group label-floating">
                           <label class="control-label">
                                X-pos
                                <small>*</small>
                           </label>
                           <input class="form-control"
                                name="x_pos"
                                type="text"
                                required="true"
                                value="{{ optional($newsletter_image)->x_pos }}"
                           />
                        </div>
                        <div class="form-group label-floating">
                           <label class="control-label">
                                Y-pos
                                <small>*</small>
                           </label>
                           <input class="form-control"
                                name="y_pos"
                                type="text"
                                required="true"
                                value="{{ optional($newsletter_image)->y_pos }}"
                           />
                        </div>
                    
                    </div>    
                </div><!-- end content-->
                <div class="form-footer card-footer text-center">
                    <button type="submit" class="btn btn-rose btn-round btn-group  btn-fill">Submit</a>
                </div>
            </div><!--  end card  -->
        </div> <!-- end col-md-4 -->
    </form>
</div>
@endsection
@section('inline-scripts')
$(document).ready(function() {
    let activateFileExplorer = 'a.activate-file';
    let delete_image = 'a.delete_image';
    var main_file = $("input#file_upload_input");
    Img.initUploadImage({
        url:'/admin/upload/image?folder=banners',
        activator: activateFileExplorer,
        inputFile: main_file,
    });
    Img.deleteImage({
        url:'/admin/delete/image?folder=banners&model=PageBanner',
        activator: delete_image,
        inputFile: main_file,

    });
});
@stop







