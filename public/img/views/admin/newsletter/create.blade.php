@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-md-10">
        @include('admin.errors.errors')
        <div class="card">
            <form id="" action="" method="post">
                @csrf
                <div class="card-content">
                    <h4 class="card-title">Add Email</h4>
                    <div class="form-group label-floating">
                        <label class="control-label">
                            Email<small>*</small>
                        </label>
                        <input class="form-control"
                                name="email"
                                type="email"
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





