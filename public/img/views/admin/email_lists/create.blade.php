@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-10">
        @include('admin.errors.errors')
        <div class="card">
            <form id="" action="{{ route('lists.store') }}" method="post">
                @csrf
                <div class="card-content">
                    <h4 class="card-title">Email Lists</h4>
                    <div class="form-group label-floating">
                        <label class="control-label">
                            Name<small>*</small>
                        </label>
                        <input class="form-control"
                                name="name"
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
  
@stop





