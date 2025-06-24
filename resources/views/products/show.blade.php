@extends('layouts.app')
@section('content')
<div class="top-notice text-white bg--primary">
    <div class="container text-center">
        <h5 class="d-inline-block mb-0 "><b class="color--light"><i class="fas fa-shipping-fast"></i>
                Fast international shipping available</b></h5>
    </div><!-- End .container -->
</div>

<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item bold"><a href="/products/{{ $category->slug }}"><small>{{ title_case($category->name) }}</small></a></li>
            <li class="breadcrumb-item active" aria-current="page"><small>{{ $product->product_name }}</small></li>
        </ol>
    </div>
</nav>

<div class="container-fluid ">
    <div>
    </div>
</div><!-- End .container -->
@endsection


@section('inline-scripts')



@stop