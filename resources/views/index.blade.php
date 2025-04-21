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





@if ($reviews->count())



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