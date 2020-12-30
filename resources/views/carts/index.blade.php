@extends('layouts.app')
 
@section('content')
 
<div class="top-notice text-white bg--primary cart-page">
    <div class="container-fluid text-center">
        <div class="row">
            
            <div class="col-12">
                <h5 class="d-inline-block color--light text-uppercase  mb-0"><b><i class="fas fa-money-check"></i>
                USE OHRAMXMAS and get 10% off when you shop over 250k</b>
                </h5>
            </div>
        </div>
        
    </div><!-- End .container -->
</div>


<!--Content-->
   
<section class="bg--gray">          
    <div class="container-fluid">
        <div id="js-loading"  class="full-bg">
            <div class="signup--middle">
                <div class="loading">
                    <div class="loader"></div>
                </div>
                <img src="{{ $system_settings->logo_path() }}" height="110" width="80" alt="The Luxury sale Logo">
            </div>        
        </div>
        <cart-summary  />

    </div>
</section>
    <!--End Content-->
@endsection














