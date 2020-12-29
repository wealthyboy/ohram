@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
           <div class="text-right">
            <a href="" rel="tooltip" title="Refresh" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">refresh</i>
                    Refresh
                </a>
            <a href="{{ route('posts.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">add</i>
                    Add Post
                </a>
                <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-posts').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                    <i class="material-icons">close</i>
                    Remove
                </a>
            </div>
        </div>
        <form class="form-horizontal"  action="/admin/page/banner" method="POST">
        @csrf
        <input type="hidden" name="page_name" value="blog" />
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Images Only</h4>
                </div>
                <div class="card-content">
                    <div class="">
                        <div id="m_image"  class="uploadloaded_image text-center mb-3">
                        <div class="upload-text  {{  optional($blog_image)->image  ?  'hide' : '' }}"> 
                            <a class="activate-file" href="#">
                                <img src="{{ asset('backend/img/upload_icon.png') }}">
                                <b>Add  Image </b> 
                            </a>
                            </div>
                            <div id="remove_image" class="remove_image {{  optional($blog_image)->image  ?  '' : 'hide' }}">
                                <a class="delete_image"  data-id="{{ $blog_image->id }}" data-url="url" href="#">Remove</a>  
                            </div>
                            @if ( $blog_image )
                               <img id="stored_image" class="img-thumnail" src="{{ $blog_image->image }}" alt="">
                             @endif
                            <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="product_image"  />
                            <input type="hidden"  class="file_upload_input  stored_image" value="{{ null !== $blog_image ? $blog_image->image : '' }}" name="image">
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
                                value="{{ optional($blog_image)->x_pos }}"
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
                                value="{{ optional($blog_image)->y_pos }}"
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
    <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Post</h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar-->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('posts.destroy',['post' => 1]) }}" method="post" id="form-posts">
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
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post) 
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $post->id }}" name="selected[]" >
                                            </label>
                                        </div>
                                    </td>
                                    <!-- cart-active -->
                                    <!-- cart-sidebar-btn active -->
                                    <td><a target="_blank" href="{{ route('blog.show',['blog' => $post->slug ]) }}">{{ $post->title }}</a></td>
                                    <td>{{ $post->name }}</td>
                                    <td>
                                        <a target="_blank" href="/admin/post/{{ $post->id }}/comments">{{ optional($post->comments)->count() }}</a>
                                    </td>
                                    <td class="td-actions ">                     
                                        <a href="{{ route('posts.edit',['post' => $post->id]) }}" rel="tooltip" title="Edit" class="btn btn-primary btn-simple btn-xs">
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
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
@endsection
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
        url:'/admin/delete/image?folder=blog&model=PageBanner',
        activator: delete_image,
        inputFile: main_file,

    });
});
@stop







