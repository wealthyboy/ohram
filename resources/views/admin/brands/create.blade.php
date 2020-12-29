@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-10">
            @include('admin.errors.errors')
            <div class="card">
                <form id="" action="{{ route('brands.store') }}" method="post">
                    @csrf
                    <div class="card-content">
                        <h4 class="card-title">Brand</h4>
                        <div class="form-group label-floating">
                            <label class="control-label">
                              Brand<small>*</small>
                            </label>
                            <input class="form-control"
                                   name="brand_name"
                                   type="text"
                                   required="true"
                             />
                        </div>   
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>


@endsection

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



		$('.card .material-datatables label').addClass('form-group');
	});
@stop





