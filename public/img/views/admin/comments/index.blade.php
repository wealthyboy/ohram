@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
           <div class="text-right">
            <a href="" rel="tooltip" title="Refresh" class="btn btn-primary btn-simple btn-xs">
                    <i class="material-icons">refresh</i>
                    Refresh
                </a>
            
                <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-posts').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                    <i class="material-icons">close</i>
                    Remove
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Comments</h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar-->
                    </div>
                    <div class="material-datatables">
                    <form action="/admin/comments/1" method="post" id="form-posts">
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
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($posts->comments as $comment) 
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $comment->id }}" name="selected[]" >
                                            </label>
                                        </div>
                                    </td>
                                    <!-- cart-active -->
                                    <!-- cart-sidebar-btn active -->
                                    <td><a target="_blank" href="#">{{ $comment->author }}</a></td>
                                    <td>{{ $comment->body }}</td>
                                    <td>
                                        <a target="_blank" href="#">{{ $comment->email }}</a>
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
});
@stop







