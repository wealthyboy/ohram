@extends('admin.layouts.app')

@section('content')

<div class="row">
        <div class="col-md-12">
               <div class="text-right">
        
                    <a href="{{ route('banners.create') }}" rel="tooltip" title="Add New" class="btn btn-primary btn-simple btn-xs">
                        <i class="material-icons">add</i>
                        Add Banner
                    </a>

                    <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-primary btn-simple btn-xs" onclick="confirm('Are you sure?') ? $('#form-banner').submit() : false;"><i class="fa fa-trash-o"></i>
                    Delete
                    </button>

                </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                
                <div class="card-content">
                    <h4 class="card-title">Banners</h4>
                    <form action="{{ route('banners.destroy',['banner' => 1]) }}" method="post" id="form-banner">
                      @csrf
                      @method('DELETE')
                   <div class="table-responsive">
                        <table class="table table-shopping">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <div class="checkbox">
                                            <label>
                                                <input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox" name="optionsCheckboxes" >
                                            </label>
                                        </div>
                                    </th>
                                    <th>Image</th>
                                    <th class="th-description">Title</th>
                                    <th class="th-description">Link</th>
                                    <th class="text-right">Sort Order</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($banners))
                                @foreach($banners as $banner)

                                <tr>
                                    <td>
                                   
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $banner->id }}" name="selected[]" >
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="img-container">
                                            <img src="{{ $banner->image }}" alt="...">
                                        </div>
                                    </td>
                                    <td class="td-name">
                                        <a href="#">{{ $banner->title }}</a>
                                    </td>
                                    <td>
                                       {{  $banner->link }}
                                    </td>
                                    <td>
                                        {{ $banner->sort_order }}   
                                    </td>
                                    <td class="td-actions">
                                        <a href="{{ route('banners.edit',['banner'=>$banner->id])  }}" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">dvr</i> Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif    
                               
                              
                              
                               
                            </tbody>
                        </table>
                    </div>
                  
               </form>
                  
                </div>
            </div>
        </div>
       
    </div>

@endsection

@section('inline-scripts')
@stop

@section('pagespecificscripts')
   <script src="{{ asset('adset/js/jasny-bootstrap.min.js') }}"></script>
@stop





