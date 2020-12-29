@extends('layouts.app')
@section('content')
<div class="top-notice text-white bg--gray">
    <div class="container text-center">
        <h5 class="d-inline-block mb-0"><b><i class="fas fa-shipping-fast"></i> 
                        Free worldwide shipping</b></h5>
    </div><!-- End .container -->
</div>
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item bold"><a href="/products/{{ $category->slug }}"><small>{{ title_case($category->name) }}</small></a></li>
            <li class="breadcrumb-item active" aria-current="page"><small>{{ $product->product_name }}</small></li>
        </ol>
    </div>
</nav>

<div class="container-fluid">
    <div>
        <product-show :attributes="{{ $attributes }}"   :product="{{ $product }}" />
    </div>
    @if ( $product->related_products->count() )

    <div class="products-section pt-0">
        <h2 class="section-title">Related Products</h2>

        <div class="products-slider owl-carousel owl-theme dots-top">
            @foreach( $related_products as $related_product)

            <div class="product-default inner-quickview inner-icon">
                <figure>
                    <a href="{{ $related_product->product->link }}">
                        <img src="{{ optional($related_product->product)->image_to_show_m }}">
                    </a>
                    @if ($related_product->product->default_percentage_off)
                    <div class="label-group">
                        <span class="product-label label-sale">-{{ $related_product->product->default_percentage_off }}%</span>
                    </div>
                    @endif
                    
                </figure>
                <div class="product-details">
                    <div class="category-wrap">
                        @if($related_product->product->brand_name)
                            <div class="category-list">
                                <a href="{{ $related_product->product->link }}" class="product-category">{{ $related_product->product->brand_name }}</a>
                            </div>
                        @endif
                    </div>
                    <h3 class="product-title">
                        <a href="{{ $related_product->product->link }}">{{ $related_product->product->product_name }}</a>
                    </h3>
                    
                    <div class="price-box">
                        @if ($related_product->product->default_discounted_price ) 
                            <span class="old-price">{{ optional($related_product->product)->currency }}{{ number_format(optional($related_product->product)->converted_price)  }}</span>
                            <span class="product-price">{{ optional($related_product->product)->currency }}{{ number_format(optional($related_product->product)->default_discounted_price)  }}</span>
                        @else
                           <span class="old-price">{{ optional($related_product->product)->currency }}{{ number_format(optional($related_product->product)->converted_price)  }}</span>
                        @endif
                    </div><!-- End .price-box -->
                </div><!-- End .product-details -->
            </div>


            @endforeach
           
        </div><!-- End .products-slider -->
    </div><!-- End .products-section -->

    @endif
    </div><!-- End .container -->
@endsection


@section('inline-scripts')
   


@stop




