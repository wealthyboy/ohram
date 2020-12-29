@extends('admin.layouts.app')

@section('content')

<style>
  .categories .categories {
     margin-left: 20px;
  }
</style>

<div class="row">
       

        <div class="col-md-6">
            @include('errors.errors')
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Add Location</h4>
                    <div class="toolbar">
                        <!--Here you can write extra buttons/actions for the toolbar  -->
                    </div>
                    <div class="material-datatables">
                    <form action="{{ route('location.store') }}" method="post" enctype="multipart/form-data" id="form--location">
                        @csrf

                        <div class="form-group label-floating">
                            <label class="control-label">
                                Name
                                <small>*</small>
                            </label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   required="true"
                            />
                        </div>
                        <div class="form-group ">
                            <label class="control-label"></label>
                            <select name="parent_id" class="form-control">
                            <option  value="">--Choose One--</option>
                                @foreach($locations as $location)
                                    <option class="" value="{{ $location->id }}" >{{ $location->name }} </option>
                                    @include('includes.children_options',['obj'=>$location,'space'=>'&nbsp;&nbsp;'])
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-round  btn-fill">Submit</button>
                        </div>
                        </form>
                    </div>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-6 -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Country/State</h4>
                        <div  class="checkbox col-md-6 text-left">
                            <label>
                                <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" > Select All
                            </label>
                        </div>
                        <div  class="col-md-6 text-right">
                            <a href="javascript:void(0)" onclick="confirm('Are you sure?') ? $('#form-location').submit() : false;" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                <i class="material-icons">close</i> Delete
                            </a>
                        </div> 
                        <div class="clearfix"></div> 
                        <form action="{{ route('location.destroy',['location'=>1]) }}" method="post" enctype="multipart/form-data" id="form-location">
                        @csrf
                        @method('DELETE')
                        <div class="material-datatables">
                            @foreach($locations as $location)
                                <div class="parent" value="{{ $location->id }}">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="{{ $location->id }}" name="selected[]" >
                                        {{ $location->name }}  <a href="{{ route('location.edit',['location'=>$location->id]) }}"><i class="fa fa-pencil"></i> Edit</a> 
                                    </label>
                                </div>   
                                @include('includes.children',['obj'=>$location,'space'=>'&nbsp;&nbsp;','model' => 'location','url' => 'location'])
                            </div>
                            @endforeach  
                        </div>
                    </form>
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-6 -->
    </div> <!-- end row -->




@endsection


@section('inline-scripts')

$(document).ready(function() {
    
});



@stop





