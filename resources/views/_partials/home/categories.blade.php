<!--Portfolio-->
<section class="mt-1">
    <div class="container-fluid">
            <!--Intro-->
         <div class="row  justify-content-center">
            @foreach( $banners as $banner )
                <div class="portfolio-item-grid    col-12 reduce-gutters {{ $banner->col }} ">
                    <div class="portfolio-box">
                        <a class="portfolio-thumb" href="{{ $banner->link }}">
                            <img src="{{ $banner->image }}" alt="portfolio Item" />
                        </a>
                        @if($banner->title)
                            <div class="portfolio-item-content category animated rollIn  bg--primary">
                                <h1 class="portfolio-title"><a style="color:#ffffff; line-height: 1.3" class="color-light" href="{{ $banner->link }}  ">{{  $banner->title }}</a></h1>
                                <a href="{{ $banner->link }}" class="btn btn-dark h-font btn--lg pt-3 pb-3 pr-5 pl-5 btn--white-alt mt-4">Shop Now</a>

                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>
</section>
 <!--Products Slider-->
 <section class="sec-padding bg--gray">
        <div class="container">
            <div class="page-head">
                <span class="page-sub-title color-primary bold">Trending Items</span>
                <h2 class="page-title text-uppercase  heading-hr-margin">Featured Product</h2>
            </div>
        </div>
        <div class="container">
            <div class="product-item-4 owl-carousel owl-theme product-slider">
                <!--Item-->
                <!--Item-->
            @foreach( $products as $product)
                <div class="item ">
                <div class="product-item  bg--light">
                    <!--Product Img-->
                        <div class="product-item-img no-height">
                            <!--Image-->
                            <a href="{{ $product->link }}" class="product-item-img-link carousel">
                                <img src="{{ optional($product)->image_to_show }}" alt="Buy {{ optional($product)->product_name }}" />
                            </a>
                            <!--Add to Link-->
                            <!-- <div class="add-to-link">
                                <a class="btn btn--primary btn--sm">Add To Cart</a>
                            </div> -->
                            <!--Hover Icons-->
                        </div>
                        <!--Product Content-->
                        <div class="product-item-content">
                            <div class="tag"><a href="{{ $product->link }}">{{ optional($product->brand)->name ?? '' }}</a></div>
                            <a href="{{ $product->link }}" class="product-item-title"><span>{{ optional($product)->product_name }}</span></a>
                            <p class="product-item-price">
                                <span class="product-price-amount">
                                    @if ($product->discount_price )
                                        <del>
                                            <span class="product-price-currency-symbol">
                                                {{ optional($product)->currency }}{{ number_format(optional($product)->converted_price)  }}
                                            </span>
                                        </del>
                                        <ins>
                                            <span class="product-price-currency-symbol">{{ optional($product)->currency }}{{ number_format(optional($product)->discount_price) }}</span>
                                        </ins> 
                                    @else
                                        <ins>
                                            <span class="product-price-currency-symbol">{{ optional($product)->currency }}{{ number_format(optional($product)->converted_price) }}</span>
                                        </ins>
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Item-->
                
            </div>
        </div>
</section>
    <!--Products Slider-->
<!--End Portfolio-->