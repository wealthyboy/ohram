@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="text-right">
                    <a href="{{ route('brands.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                        <i class="material-icons">add</i> Add
                    </a>
                    <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-permissions').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                        <i class="material-icons">close</i>Delete
                    </a>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Brands</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('brands.destroy',['brand' => 1]) }}" method="post" enctype="multipart/form-data" id="form-permissions">
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

                                    <th>Brand</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($brands as $brand)
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="{{ $brand->id }}" name="selected[]" >
                                                </label>
                                            </div>
                                            </td>
                                            <td>{{ $brand->brand_name }}</td>
                                            <td class="text-right">
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





