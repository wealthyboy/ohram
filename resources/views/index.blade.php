@extends('layouts.app')
 
@section('content')

<div class="top-notice text-white bg--gray">
    <div class="container-fluid text-center">
        <div class="row">
            
            <div class="col-12">
                <h5 class="d-inline-block text-uppercase mb-0"><b><i class="fas fa-money-check"></i>
                    USE OHRAMXMAS and get 10% off when you shop over 250k</b>
                </h5>
            </div>

        </div>
        
    </div><!-- End .container -->
</div>

<div class="container-fliud ">
    <div  class="row align-items-start">
        @foreach( $banners as $banner )
            <div class="{{ $banner->col }} pr-1 mb-1 position-relative text-center">
                <div class="banner-box">
                    <a class="portfolio-thumb" href="{{ $banner->link }}">
                        <img src="{{ $banner->image }}" alt="" />
                    </a>
                </div>
                <div class="shop-title text-center  position-absolute">
                    <h1 class="title color--light">{{  $banner->title }} </h1>
                    <a href="{{ $banner->link }}" class="btn btn-block btn-sm btn-primary text--light bold">Shop Now</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@if ($posts->count()) 


    <div class="blog-section p-3  pt-5 pb-5 bg--gray">
        <h1 class=" text-center">OHRAM BLOG</h1>
        <div class="blog-slider owl-carousel owl-theme dots-top ">
            @foreach($posts as $post)
                <div class="blog inner-quickview inner-icon text-center bg--light">
                    <div class="img-container">
                        <a title="{{  $post->title }}" href="{{ route('blog.show',['blog'=> $post->slug]) }}" class="blog-img-link blog">
                            <img  title="{{  $post->title }}" src="{{ $post->image }}" alt="{{  $post->title }}" />
                        </a>
                    </div>
                    <div class="blog-details p-3">
                        <p class="info text-center">
                            <i class="fab fa-clock-o"></i><span>{{ $post->created_at->diffForHumans() }}</span>
                        </p>
                        <div class="tag text-center color--primary mb-1">
                            @foreach($post->attributes as $tag)
                               <a class="color--primary" href="/blog/tag/{{ $tag->id }}"><i class="fa fa-tags"></i> {{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <h4 class=" text-center pb-5">
                           <a title="{{  $post->title }}" href="{{ route('blog.show',['blog'=> $post->slug]) }}" class="">
                                {{ $post->title }}
                            </a> 
                        </h4>
                    </div><!-- End .product-details -->
                </div>
            @endforeach

            
        </div><!-- End .products-slider -->
    </div><!-- End .blog-section -->

@endif




@if ($reviews->count()) 

<div class="products-section p-3  pt-5 pb-5 ">
    <h1 class=" text-center">CUSTOMER REVIEWS</h1>

    <div class="reviews-slider owl-carousel owl-theme dots-top">
        @foreach($reviews as $review)

        <div class="reviews-details  border inner-quickview inner-icon">
            <div  class="img-container">
                <a href="/reviews">
                    <img title="{{ $review->title }}" src="{{ $review->img() }}" alt="{{ $review->title }} ">
                </a>
            </div>
            <div class="reviews-item-content p-3">
                
                <div class="text-center">
                    <h4 class="blog-title text-uppercase color--primary mt-4">{{ optional($review->user)->name }} </h4>
    
                    <h5 class="text-uppercase mt-n3"> {{ optional($review->product)->product_name }}</h5>
                </div>
                
                <div class="blog-description-content text-center">
                    <p>{{ str_limit($review->description, 100, '....') }}</p>
                </div>
                <p class="info text-center">
                    <i class="fa fa-clock-o"></i><span>{{ $review->created_at->diffForHumans() }}</span>
                </p>
            </div>
            
        </div>
        @endforeach
    </div><!-- End .products-slider -->
    <div class="review-more-button mt-3">
        <div class="justifiy-content-center  text-center">
            <a href="/reviews" class="btn btn--lg btn--primary bold h-font">Read More</a>
        </div>
    </div>
</div><!-- End .products-section -->

   
@endif
    






    
   
@endsection
@section('page-scripts')
@stop
@section('inline-scripts')
@stop

