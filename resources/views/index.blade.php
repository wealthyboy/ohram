@extends('layouts.app')

@section('content')

{{-- resources/views/shop.blade.php --}}


<style>
    /* --- tiny custom tweaks ----------------------------- */
    .section-pink {
        background: #f8d9e8;
    }

    /* page strip   */
    .card.rounded-4 {
        border-radius: 1.5rem !important;
    }

    .btn-quick-add {
        background: #c9f586;
        color: #3a0020;
        border-radius: 2rem;
        font-weight: 600;
    }

    .btn-quick-add:hover {
        background: #d8ff9b;
        color: #3a0020;
    }
</style>


<section class="position-relative text-white" style="background: url('/images/banners/weight_loss_in_nigeria.jpeg') center center / cover no-repeat;">
    <!-- Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(178, 237, 232, 0.85); z-index: 1; margin-top: -48px;"></div>


    <div class="container py-5 position-relative" style="z-index: 2;">
        <div class="row align-items-center flex-column-reverse flex-lg-row text-center text-lg-start gy-4">

            <!-- Left Column: Text -->
            <div class="col-lg-6">
                <h4 class="fw-bold text-dark">Natural & Nourishing</h4>
                <h1 class="fw-bold display-2 text-dark">Sip. Slim. Shine.</h1>
                <p class="lead text-dark">
                    A coffee that does more — crafted to help you burn fat, control cravings, and glow from within. Start every morning with wellness in your cup.
                </p>
                <div class="d-flex justify-content-center justify-content-lg-center gap-3 mt-3 flex-wrap">
                    <a href="#purchase" class="btn btn-dark btn-lg rounded px-4 py-2">Purchase</a>
                </div>
            </div>

            <!-- Right Column: Product Image -->
            <div class="col-lg-6 text-center">
                <img src="/images/banners/ohram_tea-removebg-preview.png" class="img-fluid" alt="Product">
            </div>
        </div>
    </div>
</section>













<section class="section-pink  bg--primary  py-5">
    <div class="container">
        <div class="text-center">
            <h1>Trending Now
            </h1>
        </div>
        <div class="row g-4 justify-content-center">

            @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-lg-3 mb-2">
                <div class="card h-100 shadow border-0 rounded-4 position-relative text-center">
                    {{-- optional top-left badge --}}

                    <span class="position-absolute top-0 start-0 translate-middle badge bg-dark text-white fw-semibold rounded-pill">
                        {{ 'test'}}
                    </span>

                    {{-- product image --}}
                    <img src="{{ $product->image_m }}"
                        class="card-img-top p-4" style="object-fit:contain;height:200px;"
                        alt="{{ $product->product_name }}">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark mb-1">{{ $product->product_name }}</h5>
                        <p class="card-text small text-muted mb-3">
                            {{ $product['tag'] }} –
                            <strong>${{ number_format($product->price, 2) }}</strong>
                        </p>

                        {{-- quick-add button --}}
                        <button class="btn btn-quick-add mx-auto px-4 py-2 mb-2">
                            Quick add
                        </button>

                        {{-- view-product link --}}
                        <a href="{{ $product->product_name }}" class="small link-underline link-underline-opacity-0 link-danger">
                            View product
                        </a>

                        {{-- spacer to push content to top on equal-height cards --}}
                        <div class="flex-grow-1"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

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