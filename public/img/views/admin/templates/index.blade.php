@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="text-right">
                    <a href="{{ route('templates.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                        <i class="material-icons">add</i> Add
                    </a>
                    <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-templates').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                        <i class="material-icons">close</i>Delete
                    </a>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Templates</h4>
                    <div class="toolbar">
                        <!--  Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('templates.destroy',['template' => 1]) }}" method="post" enctype="multipart/form-data" id="form-templates">
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
                               @foreach($templates as $template)
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="{{ $template->id }}" name="selected[]" >
                                                </label>
                                            </div>
                                        </td>
                                        <td><a href="#">{{ $template->name }}</a></td>
                                        <td class="td-actions text-right">               
                                            <a href="{{ route('templates.edit',['template'=>$template->id] ) }}" rel="tooltip" title="EDIT " class="btn btn-primary btn-simple btn-xs">
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





