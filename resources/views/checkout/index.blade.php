@extends('layouts.checkout')
 
@section('content')
<div class="checkout-overlay ">
    <div class="text fa-2x">Please wait while we process your transaction</div>
</div>
<section class="bg--gray">

    <div id="full-bg"  class="full-bg">
        <div class="signup--middle">
            <div class="loading">
                <div class="loader"></div>
            </div>
            <img src="{{ $system_settings->logo_path() }}" height="110" width="80" alt="Ohram Logo">
        </div>        
    </div>
      
    <checkout-index   :csrf="{{ $csrf }}" />
</section>
@endsection



