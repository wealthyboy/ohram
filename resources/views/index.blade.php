@extends('layouts.app')

@section('content')








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