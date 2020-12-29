@extends('layouts.app')
@section('content')
<div class="top-notice text-white bg--primary">
    <div class="container text-center">
        <h5 class="d-inline-block mb-0 "><b class="color--light"><i class="fas fa-shipping-fast"></i> 
            Fast international  shipping available</b></h5>
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
        <product-show :attributes="{{ $attributes }}"   :product="{{ $product }}" />
    </div>
    @if ( $product->related_products->count() )

    <div class="products-section pt-0">
        <h2 class="">Related Products</h2>

        <div class="products-slider owl-carousel owl-theme dots-top">
            @foreach( $related_products as $related_product)

            <div class="product-default inner-quickview inner-icon">
                <figure>
                    <a href="{{ optional($related_product->product)->link }}">
                        <img src="{{ optional($related_product->product)->image_to_show_m }}">
                    </a>
                    @if (optional($related_product->product)->default_percentage_off)
                    <div class="label-group">
                        <span class="product-label label-sale">-{{ optional($related_product->product)->default_percentage_off }}%</span>
                    </div>
                    @endif
                    
                </figure>
                <div class="product-details text-center">

                    <div class="mx-auto">
                        
                        @if(optional(optional($related_product->product)->colours)->count())
                            <div  class="justify-content-center d-flex mb-1">
                                @foreach(optional($related_product->product)->product->colours as $color)
                                <div   style="border:1px solid #222; height: 15px; width: 15px; border-radius: 50%; background-color: {{ $color->color_code }};" class="mr-1"></div>
                                @endforeach
                            </div>
                        @endif
                        @if(optional($related_product->product)->brand_name)
                            <div  class="product-brand bold">
                               {{ optional($related_product->product)->brand_name }} 
                            </div>
                        @endif

                        <div class="color--primary bold">
                           <a href="{{ optional($related_product->product)->link }}">{{ optional($related_product->product)->product_name  }}</a>
                        </div>

                        
                    </div>
                    <div class="price-box mx-auto mt-1">
                       @if (optional($related_product->product)->default_discounted_price ) 
                            <span class="old-price bold">{{ optional($related_product->product)->currency }}{{ number_format(optional($related_product->product)->converted_price)  }}</span>
                            <span class="product-price bold">{{ optional($related_product->product)->currency }}{{ number_format(optional($related_product->product)->default_discounted_price)  }}</span>
                        @else
                           <span class="product-price bold">{{ optional($related_product->product)->currency }}{{ number_format(optional($related_product->product)->converted_price)  }}</span>
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




