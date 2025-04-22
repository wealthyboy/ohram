@extends('layouts.app')

@section('content')


<div class="row no-gutters">
    <div class="col-md-6 bg--primary order-last d-none d-lg-block">

        <div class="d-flex justify-content-center align-content-center">

            <div class="sale-content text-center align-content-center  fadeInRight animated">

                <div class="text-uppercase fa-3x position-absolute text-white">Tummy Make over</div>
                <div class="">
                    <h1 class="text-uppercase  sale   sale-text text-white">Sale</h1>
                </div>

                <div class="">
                    <h1 class="text-uppercase  bold fa-2x text-white">From 12% off</h1>
                </div>


                <div class="buttons position-relative ">
                    <a href="https://ohram.org/products/teatox" class="btn btn-raised  btn--lg btn--primary bold h-font mr-2 mb-1">Shop Tea</a>
                </div>
                <div class="buttons  position-relative ">
                    <a href="https://ohram.org/products/weight-loss-gummies" class="btn btn-raised btn--lg btn-raised btn--primary bold h-font mr-2 mb-1">Shop Gummies</a>
                </div>
                <div class="buttons">
                    <a href="https://ohram.org/products/weight-loss-pills" class="btn btn-raised btn--lg btn--primary bold h-font mr-2 mb-1">Shop Loss Pills</a>
                </div>
                <div class="buttons">
                    <a href="https://ohram.org/products/slim-diet-coffee" class="btn  btn-raised btn--lg btn--primary bold h-font mr-2 mb-1">Shop Coffee</a>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-6 order-first">
        <div class="custom-banner">
            <section class="weight-loss-banner">
                <div class="mobile-weight-loss-banner  d-block d-sm-none">
                    <div class="text-uppercase fa-2x  bold text-white">Tummy Make over</div>
                    <div class=" text-center">
                        <h1 class="text-uppercase font-italic sale fa-4x text-white">Sale</h1>
                    </div>
                    <div class="text-center">
                        <h1 class="text-uppercase  bold fa-1x text-white">From 12% off</h1>
                    </div>

                    <div class="buttons  text-center position-relative ">
                        <a href="https://ohram.org/products/weight-loss" class="btn   btn--lg btn--primary bold h-font mr-2 mb-1">Shop Weight Loss</a>
                    </div>
                </div>
        </div>

        </section>
    </div>
</div>
</div>



</div>

@if ($posts->count())

<div class="blog-section p-3  pt-5 pb-5 bg--gray">
    <h1 class=" text-center">OHRAM BLOG</h1>
    <div class="blog-slider owl-carousel owl-theme dots-top">
        @foreach($posts as $post)
        <div class="blog inner-quickview inner-icon text-center bg--light">
            <div class="img-container">
                <a title="{{  $post->title }}" href="{{ route('blog.show',['blog'=> $post->slug]) }}" class="blog-img-link blog">
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

    <div class="review-more-button mt-3">
        <div class="justifiy-content-center  text-center">
            <a href="/blog" class="btn btn--lg btn--primary bold h-font">Read More</a>
        </div>
    </div>
</div><!-- End .blog-section -->

@endif




@if ($reviews->count())

<div class="products-section p-3  pt-5 pb-5 ">
    <h1 class="text-center">CUSTOMER REVIEWS</h1>

    <div class="reviews-slider owl-carousel owl-theme dots-top">
        @foreach($reviews as $review)

        <div class="reviews-details  border inner-quickview inner-icon">
            <div class="img-container">
                <a href="/reviews">
                </a>
            </div>
            <div class="reviews-item-content p-3">

                <div class="text-center">
                    <h4 class="blog-title text-uppercase color--primary mt-4">{{ optional($review->user)->name }} </h4>

                    <h5 class="text-uppercase mt-n3"> {{ optional($review->product)->product_name }}</h5>
                </div>

                <div class="blog-description-content text-center">
                    <p>{{ $review->short_description }}</p>
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
<script src="/js/waypoints.js?version={{ str_random(6) }}"></script>

@stop
@section('inline-scripts')

function changeColor() {
let target = $(".sale")
if (target.hasClass('animated heartBeat')) {
target.removeClass('animated heartBeat')
} else {
target.addClass('animated heartBeat')

}
}
setInterval(changeColor, 1000)


$(function() {
let isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;
if (isMobile) {
$('.weight-loss-banner').addClass('banner-filter')
}
});

@stop