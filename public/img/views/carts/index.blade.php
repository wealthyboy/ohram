@extends('layouts.app')
 
@section('content')
@include('_partials.home.intro2')

  
   <!--Content-->
    <section class="pb-4 mt-1">                
        <div class="container">
            <div class="row cart-header mt-4 mb-1 pb-1">
                <div class="col-lg-12 col-md-12 col-12">
                    <h3> Your Cart</h3> 
                </div>
            </div>
            @if ($carts->count())
               <cart-summary :sub_total="{{ $sub_total }}" :crts="{{ $carts }}" />
            @else
                <div class="row">
                    <section class="sec-padding-b">
                        <div class="container">
                            <p class="lead">Your cart is empty </p>
                            <p class=""><a href="/">Continue shopping >>></a> </p>
                        </div>
                    </section>
                </div>
            @endif
        </div>
    </section>
    <!--End Content-->
@endsection



