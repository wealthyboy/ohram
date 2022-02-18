@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-reviews').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                <i class="material-icons">close</i> Delete
            </a>
        </div>
    </div>
    <form class="form-horizontal"  action="/admin/page/banner" method="POST">
        @csrf
        <input type="hidden" name="page_name" value="reviews" />
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Images Only</h4>
                </div>
                <div class="card-content">
                    <div class="">
                        <div id="m_image"  class="uploadloaded_image text-center mb-3">
                        <div class="upload-text {{ $review_image !== null  ?  'hide' : '' }}"> 
                            <a class="activate-file" href="#">
                                <img src="{{ asset('store/img/upload_icon.png') }}">
                                <b>Add  Image </b> 
                            </a>
                            </div>
                            <div id="remove_image" class="remove_image {{ $review_image !== null  ?  '' : 'hide' }}">
                                <a class="delete_image" data-url="url" href="#">Remove</a> | <a  class="activate-file"  href="#">Change</a> 
                            </div>
                            @if ( $review_image )
                               <img id="stored_image" class="img-thumnail" src="{{ $review_image->image }}" alt="">
                             @endif
                            <input accept="image/*"  class="upload_input" data-msg="Upload  your image" type="file" id="file_upload_input" name="product_image"  />
                            <input type="hidden"  class="file_upload_input  stored_image" value="{{ null !== $review_image ? $review_image->image : '' }}" name="image">
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
                                value="{{ optional($review_image)->x_pos }}"
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
                                value="{{ optional($review_image)->y_pos }}"
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Reviews</h4>
                <div class="toolbar">
                    <!--  Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <form action="{{ route('reviews.destroy',['review'=>1]) }}" method="post" enctype="multipart/form-data" id="form-reviews">
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
                                    <th>Product Name</th>
                                    <th>Author Name</th>
                                    <th>Rating</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review) 
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="{{ $review->id }}" name="selected[]" >
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ $review->title }}</td>
                                        <td>{{ optional($review->product)->product_name }} </td>
                                        <td>{{ optional($review->user)->name }}</td>
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ $review->description }}</td>
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

@section('pagespecificscripts')
<script src="/asset/js/jquery.datatables.js"></script>
@stop


@section('inline-scripts')
$(document).ready(function() {
	$('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        responsive: true,
        language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
        }
    });
    
    let activateFileExplorer = 'a.activate-file';
    let delete_image = 'a.delete_image';
    var main_file = $("input#file_upload_input");
    Img.initUploadImage({
        url:'/admin/upload/image?folder=reviews',
        activator: activateFileExplorer,
        inputFile: main_file,
    });
    Img.deleteImage({
        url:'/admin/delete/image?folder=reviews',
        activator: delete_image,
    });
});
@stop







