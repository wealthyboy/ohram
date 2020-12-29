@extends('layouts.app')
 
@section('content')  
   <!--Content-->
   <div class="top-notice text-white bg--gray">
    <div class="container-fluid text-center">
        <div class="row">
            
            <div class="col-12">
                <h5 class="d-inline-block color--primary text-uppercase  mb-0"><b><i class="fas fa-money-check"></i>
                USE OHRAMXMAS and get 10% off when you shop over 250k</b>
                </h5>
            </div>

        </div>
        
    </div><!-- End .container -->
</div>
<section class="pb-4  vh-100"> 
       

    <section class="breadcrumb no-banner  justify-content-center">
        <div class="breadcrumb-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12  text-center border-bottom">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-link">
                            <div class="container d-flex justify-content-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                                </ol>
                            </div>
                        </nav>
                        <h1 class="breadcrumb-title">Your Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>               
        <div class="container">
            
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



