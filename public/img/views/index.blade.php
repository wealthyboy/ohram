@extends('layouts.app')
 
@section('content')


<div class="owl-carousel main-banner-slider owl-theme">
    <div class="item"><img src="https://www.theluxurysale.com/uploads/CZ1oU4wWBYChvVoGYk7pGGCuB1mTKr3u1cLoIg5L.jpeg" /></div>
    <div class="item"><img src="https://www.theluxurysale.com/uploads/CZ1oU4wWBYChvVoGYk7pGGCuB1mTKr3u1cLoIg5L.jpeg" /></div>
</div>


<div class="container-fliud">
    @if ($products->count())
    <div class="home-product-tabs pt-5 pt-md-0">
        <div class="container">
            <ul class="nav nav-tabs mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="featured-products-tab" data-toggle="tab" href="index.html#featured-products" role="tab" aria-controls="featured-products" aria-selected="true">Featured Products</a>
                </li>
            </ul>
            <div class="tab-content m-b-4">
                <div class="tab-pane fade show active" id="featured-products" role="tabpanel" aria-labelledby="featured-products-tab">
                    <div class="tab-products-carousel owl-carousel owl-theme quantity-inputs show-nav-hover nav-outer nav-image-center">
                        @foreach( $products as $product)

                        <div class="product-default inner-quickview inner-icon quantity-input">
                            <figure>
                                <a href="{{ $product->link }}">
                                    <img src="{{ optional($product)->image_to_show }}">
                                </a>
                                
                                @if ($related_product->product->default_percentage_off)
                                    <div class="label-group">
                                        <span class="product-label label-sale">-{{ $related_product->product->default_percentage_off }}%</span>
                                    </div>
                                @endif
                                    <div class="btn-icon-group">
                                        <a href="index.html#" class="btn-icon btn-icon-wish"><i class="icon-heart"></i></a>
                                    </div>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a> 
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
                       
                    </div><!-- End .products-carousel -->
                </div><!-- End .tab-pane -->
                
            </div><!-- End .tab-content -->
        </div><!-- End .container -->
    </div><!-- End .home-product-tabs -->

    @endif

    

    <div class="row mt-2">
        <div class="col-12 text-center">
            <h4 class="text-uppercase">TRENDING</h4>
        </div>
        <div class="col-6 pr-1 text-center">
            <div class="banner-box">
                <a class="portfolio-thumb" href="">
                    <img src="https://www.theluxurysale.com/uploads/VR6VLInbEOUP3EZyGaRSVp5twn7q6i3aW1H2dlfl.jpeg" alt=" Item" />
                </a>
            </div>
            <div class="shop-title text-center d-none d-lg-block position-absolute">
                <h2 class="title color--gray"> ITEMS FOR HER</h2>
                <a href="" class="btn btn-block btn-sm btn-primary text--light bold">Shop Now</a>
            </div>
            <p> <a href="" class=" d-none d-block d-xl-none  d-lg-none bold text-uppercase">Shop for her</a></p>
        </div>
        
        <div class="col-6 pl-1  text-center">
            <div class="banner-box position-relative">
                <a class="portfolio-thumb" href="">
                    <img src="https://www.theluxurysale.com/uploads/YAy3VqK6UwmuDrIycSGttOqkhIOAIDLXcZ71cCg0.jpeg" alt=" Item" />
                </a>
                <div class="shop-title text-center d-none d-lg-block position-absolute">
                    <h2 class="title color--gray"> ITEMS FOR HIM</h2>
                    <a href="" class="btn btn-block btn-sm btn-primary  text--light bold">Shop Now</a>
                </div>
                <p> <a href="" class=" d-none d-block d-xl-none  d-lg-none bold text-uppercase">Shop for him</a></p>

            </div>
        
        </div> 
    </div>


    <div class="row  mt-2 mb-3 no-gutters">
        <div class="col-12 text-center">
            <h4 class="text-uppercase  section-title heading-border ls-20 border-0">Top Brands</h4>
        </div>
        <div class="col-6 col-md-3 pr-1">
            <div class="banner-box">
                <a class="portfolio-thumb-brand" href="">
                    <img src="https://www.theluxurysale.com/uploads/lfvnDbeOiKki7oKPw1E0VnC1zOY63WROThd3tka5.png" alt=" Item" />
                </a>
                <div class="shop-title text-center  position-absolute">
                    <h2 class="title text--light"></h2>
                </div>
            </div>

        </div>
        <div class="col-6 col-md-3 pr-1">
            <div class="banner-box">
                <a class="portfolio-thumb-brand" href="">
                    <img src="https://www.theluxurysale.com/uploads/1D95M3ed0ibXeOxC2EMaevS6G5oRQ6dV9Vl3eBvK.png" alt=" Item" />
                </a>
                <div class="shop-title text-center  position-absolute">
                    <h2 class="title text--light"></h2>
                </div>
            </div>
        </div> 
        <div class="col-6 col-md-3 pr-1">
            <div class="banner-box">
                <a class="portfolio-thumb-brand" href="">
                    <img src="https://www.theluxurysale.com/uploads/dCnyvYWIEZTOUOO63QLXmVaUgWuzmCnfrQaGuAyN.png" alt=" Item" />
                </a>
                <div class="shop-title text-center  position-absolute">
                    <h2 class="title text--light"></h2>
                </div>
            </div>
        </div> 
     
        <div class="col-6 col-md-3 ">
            <div class="banner-box">
                <a class="portfolio-thumb-brand" href="">
                    <img src="https://www.theluxurysale.com/uploads/dgH4YGPQtOpRq5yCPmwBIRXaWjWggQTgA2wPq6Qc.png" alt=" Item" />
                </a>
                <div class="shop-title text-center  position-absolute">
                    <h2 class="title text--light"></h2>
                </div>
            </div>
        </div>
   
        <div class="col-6 col-md-3 ">
            <div class="banner-box">
                <a class="portfolio-thumb-brand" href="">
                    <img src="https://www.theluxurysale.com/uploads/g6GkjDrI6oTqWFpUZbVguAS6469Fr1Ns4H9VvMRr.png" alt=" Item" />
                </a>
                <div class="shop-title text-center  position-absolute">
                    <h2 class="title text--light"></h2>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3 ">
            <div class="banner-box">
                <a class="portfolio-thumb-brand" href="">
                    <img src="https://www.theluxurysale.com/uploads/Ogz2X7BjQ3qRxpJroqlaEPmPmbiwiyQG0AeN81FL.png" alt=" Item" />
                </a>
                <div class="shop-title text-center  position-absolute">
                    <h2 class="title text--light"></h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 ">
            <div class="banner-box">
                <a class="portfolio-thumb-brand" href="">
                    <img src="https://www.theluxurysale.com/uploads/qsVTqoIoo6dtgPnrzrO6bR04i7vafC4DBozYu7lH.png" alt=" Item" />
                </a>
                <div class="shop-title text-center  position-absolute">
                    <h2 class="title text--light"></h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 ">
            <div class="banner-box">
                <a class="portfolio-thumb-brand" href="">
                    <img src="https://www.theluxurysale.com/uploads/StJ6Ern161K4rxXVyJslGZkdQHR0TgmhXVZy22Lx.png" alt=" Item" />
                </a>
                <div class="shop-title text-center  position-absolute">
                    <h2 class="title text--light"></h2>
                </div>
            </div>
        </div>
      

     
    </div>


    <div class="row mt-5 mb-0 pt-5 pb-5 bg--gray">
        <div class="col-12 text-center mb-1">
            <h4 class="text-uppercase  section-title heading-border ls-20 border-0">PREMUIM OFFERS</h4>
        </div>
        <div class="col-6 pr-1 text-center">
            <div class="banner-box">
                <a class="portfolio-interior" href="">
                    <img src="https://www.theluxurysale.com/uploads/iS1QBisJ6V2zYhCV7s48xqm60R9D3ZfIH2Zn5Wkg.jpeg" alt=" Item" />
                </a>
                <div class="shop-title d-none d-lg-block  text-center">
                    <h2 class="title mt-1">INTERIORS</h2>
                     <p>Well designed,premium high end furnitures for interiors </p>
                    <p> <a href="" class="bold text-uppercase">Shop Now  </a></p>
                </div>
                <p> <a href="" class=" d-none d-block d-xl-none  d-lg-none bold text-uppercase">Shop INTERIORS</a></p>

            </div>
        </div>
        
        <div class="col-6 pl-1 text-center">
            <div class="banner-box">
                <a class="portfolio-interior" href="">
                    <img src="https://www.theluxurysale.com/uploads/olttd5xbyx7m9WflrrXVdpQYUwnw7AEplLch1f1B.jpeg" alt=" Item" />
                </a>
                <div class="shop-title  d-none d-lg-block  text-center">
                    <h2 class="title mt-1">SOUNDS & TVS</h2>
                    <p>Premium luxurious sounds & Televisions </p>

                    <p> <a href="" class="bold text-uppercase">Shop Now  </a></p>
                </div>
                <p> <a href="" class=" d-none d-block d-xl-none  d-lg-none bold text-uppercase">Shop SOUNDS & TVS</a></p>

            </div>
        </div> 
 
    </div>
</div><!-- End .container -->


    
   
@endsection
@section('page-scripts')
@stop
@section('inline-scripts')
@stop

