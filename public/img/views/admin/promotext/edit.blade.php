@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-10">
            @include('admin.errors.errors')
            <div class="card">
                <form id="" action="" method="post">
                   {{ csrf_field() }}
                    <div class="card-content">
                        <h4 class="card-title">Promo Text</h4>
                        

                        <div class="form-group label-floating">
                            <label class="control-label">
                            TEXT  <small>*</small>
                            </label>
                            <input class="form-control"
                                   name="promo"
                                   type="text"
                                   value="{{ $promo_text->promo }}"

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
		$('.card .material-datatables label').addClass('form-group');
	});
@stop





