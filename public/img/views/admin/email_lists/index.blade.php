@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="text-right">
                    <a href="{{ route('lists.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                        <i class="material-icons">add</i> Add
                    </a>
                    <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-permissions').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                        <i class="material-icons">close</i>Delete
                    </a>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Email Lists</h4>
                    <div class="toolbar">
                        <!--  Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('lists.destroy',['list' => 1]) }}" method="post" enctype="multipart/form-data" id="form-permissions">
                        @csrf
                        @method('DELETE')
                
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>

                                <tr>
                                    <th>
                                        <div class="checkbox">
                                            <label>
                                                <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" >
                                            </label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($email_lists as $email_list)
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="{{ $email_list->id }}" name="selected[]" >
                                                </label>
                                            </div>
                                        </td>
                                        <td><a href="{{ route('lists.show',['list'=>$email_list->id]) }}">{{ $email_list->name }}</a></td>
                                        <td class="td-actions text-right">  
                                            <a href="/admin/lists/emails/create/{{ $email_list->id }}" rel="tooltip" title="ADD LIST" class="btn btn-primary btn-simple btn-xs">
                                                <i class="material-icons">add</i>
                                                Add 
                                            </a>                   
                                            <a href="{{ route('lists.edit',['list'=>$email_list->id] ) }}" rel="tooltip" title="EDIT " class="btn btn-primary btn-simple btn-xs">
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
});
@stop





