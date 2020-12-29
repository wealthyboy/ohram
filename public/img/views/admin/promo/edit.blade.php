@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10">
        @include('admin.errors.errors')
        <div class="card">
            <form id="" action="{{ route('promos.update',['promo' =>  $promo->id ]) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="card-content">
                    <h4 class="card-title">Promo</h4>
                        <div class="form-group label-floating">
                        <label class="control-label">
                            Color<small>*</small>
                        </label>
                        <input class="form-control"
                            name="background_color"
                            type="text"
                            value="{{ $promo->background_color }}"
                            required="true"
                            />
                    </div> 
                    <div class="col-md-6">
                                <legend>  
                                Enable\Disable
                                </legend>
                                <div class="togglebutton">
                                <label>
                                <input {{ $promo->make_live == 1 ? 'checked' : '' }} name="make_live"  value="1" type="checkbox">
                                Yes/No

                                </label>
                        </div>
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
	});
@stop





