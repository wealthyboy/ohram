@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="text-right">
                <a href="{{ route('promos.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                        <i class="fa fa-plus"></i>
                            Add Promo
                    </a>
                    <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-promo').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                        <i class="material-icons">close</i>
                        Delete Promo
                    </a>

                </div>
                <div class="card-content">
                
                    <h4 class="card-title">Promo</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('promos.destroy',['promo'=>1]) }}" method="post" enctype="multipart/form-data" id="form-promo">
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
                                    <th>Backgorund</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($promos as $promo)
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="{{ $promo->id }}" name="selected[]" >
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ $promo->background_color }}
                                        <ul>
                                                @foreach($promo->promo_texts as $promo_text) 
                                                    <li>
                                                        {{ $promo_text->promo }}
                                                        <span><a href="{{ route('edit_promo_text',['id'=>$promo_text->id]) }}"><i class="fa fa-pencil"></i> Edit</a></span>
                                                        <span><a href="{{ route('delete_promo_text',['id'=>$promo_text->id]) }}"><i class="fa fa-trash"></i> delete</a></span>
                                                    </li>
                                                @endforeach
                                            </ul> 
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('create_promo_text',['id'=>$promo->id]) }}" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="Edit">
                                                <i class="fa fa-plus"></i>
                                                Add Text
                                            </a>
                                            <a href="{{ route('promos.edit',['promo'=>$promo->id]) }}" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="Edit">
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
$(document).ready(function() {});
@stop





