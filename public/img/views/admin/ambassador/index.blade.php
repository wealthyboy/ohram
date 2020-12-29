@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
        <div class="text-right">
      
                <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-amb').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                    <i class="material-icons">close</i>
                    Remove
                </a>

            </div>
        </div>

        

        <div class="col-md-12">
            <div class="card">
        
                <div class="card-content">
                    
                    
                    <h4 class="card-title">Ambassadors</h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ '' }}" method="post" enctype="multipart/form-data" id="form-amb">
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
                                    <th>Fullname </th>
                                    <th>IG</th>
                                    <th>Status</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @if($ambassadors->count())
                                @foreach($ambassadors as $ambassador) 
                                    <tr>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="{{ $ambassador->id }}" name="selected[]" >
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            {{  $ambassador->full_name }}
                                        </td>
                                        <td><a href="{{ route('ambassadors.show',['ambassador'=>$ambassador->id]) }}">{{ $ambassador->instagram_handle }}</a></td>
                                        <td>{{ $ambassador->unique_code }}</td>
                                        <td class="td-actions ">
                                        
                                        </td>
                                    </tr>
                               @endforeach  
                               @else
                                    <tr>
                                        <td>
                                            No ambassordors yet
                                        </td>
                                    </tr>
                               @endif
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
<script src="{{ asset('asset/js/jquery.datatables.js') }}"></script>
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
});
@stop







