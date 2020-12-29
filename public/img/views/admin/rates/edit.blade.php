@extends('admin.layouts.app') @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <a href="{{ route('rates.index') }}" rel="tooltip" title="back" class="btn btn-primary btn-simple btn-xs">
                <i class="material-icons">reply</i>
            </a>
        </div>
    </div>
    <div class="col-md-12">

        <div class="card">
            @include('errors.errors')
            <div class="card-content">
                <h4 class="card-title">rates</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar-->
                </div>
                <div class="material-datatables">
                    <form id="" action="{{ route('rates.update',['rate' => $currency_rate->id ]) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="col-lg-4 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">
									<i class="fa fa-dollar"></i>
								</span>
                                <select name="currency1_id" required="true" class="form-control  pull-left" required>
                                <option value="{{ $default->currency_id }}">{{ optional($default->currency)->country }}({{  optional($default->currency)->symbol }})</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">
									<i class="fa fa-dollar"></i>
								</span>
                                <select name="currency2_id" class="form-control  pull-left">
                                    <option value="" name="">Choose Currency</option>
                                    @foreach($currencies as $currency)
                                        @if( $currency_rate->currency2_id == $currency->id)
                                            <option  value="{{ $currency->id }}"  selected>{{ $currency->country }}({{  $currency->symbol }})</option>
                                            @else
                                            <option  value="{{ $currency->id }}" >{{ $currency->country }}({{  $currency->symbol }})</option>
                                        @endif
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">
									<i class="fa fa-dollar"></i>
								</span>
                                <input class="form-control" placeholder="Rate" value="{{ $currency_rate->rate }}" name="rate" id="rate" type="text">
                            </div>
                        </div>
            
    
                        <div class="clearfix"></div>
                        <input value="search" name="search" type="hidden">
                        <div class="form-group text-right">
                            <button type="submit" id="button-filter" class="btn btn-primary btn-round"><i class=""></i> Submit</button>
                        </div>
                </div>
                </form>

            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row -->
@endsection @section('pagespecificscripts')
@stop @section('inline-scripts') $(document).ready(function() { }); @stop