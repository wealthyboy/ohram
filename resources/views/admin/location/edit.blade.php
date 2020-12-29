
@extends('admin.layouts.app')

@section('content')
<div class="row">
        <div class="col-md-10">
            @include('errors.errors')
            <div class="card">
                <form id="" action="{{ route('location.update',['location'=>$location->id]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="card-content">
                        <h4 class="card-title">Edit </h4>
                        <div class="form-group label-floating">
                            <label class="control-label">
                              Name
                                <small>*</small>
                            </label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{ $location->name }}"
                                   required="true"
                             />
                        </div>
                        <div class="form-group ">
                            <label class="control-label"></label>
                            <select name="parent_id" class="form-control">
                            <option  value="">--Choose One--</option>
                                @foreach($locations as $loc)
                                   @if($location->parent_id ==  $loc->id )
                                        <option class="" value="{{ $loc->id }}" selected="selected">{{ $loc->name }} </option>                                        
                                        @include('includes.children_options',['obj'=>$location,'space'=>'&nbsp;&nbsp;'])
                                    @else
                                        <option class="" value="{{ $loc->id }}" >{{ $loc->name }} </option>
                                        @include('includes.children_options',['model' => $location,'obj'=>$location,'space'=>'&nbsp;&nbsp;'])
                                    @endif
                                @endforeach
                            </select>
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






