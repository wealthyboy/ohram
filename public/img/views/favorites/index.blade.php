@extends('layouts.app')
 
@section('content')
  
   <!--Content-->
    <section class="pb-4 mt-1">                
        <div class="container">
            <div class="row">
                <div class="col-12  text-center">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-link">
                        <div class="container d-flex justify-content-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="category.html#">Wishlist</a></li>
                                <li class="breadcrumb-item active" aria-current="page">M</li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title"></h1>
                    
                </div>
            </div>

        <div id="full-bg"  class="full-bg">
            <div class="signup--middle">
                <div class="loading">
                    <div class="loader"></div>
                </div>
                <img src="{{ $system_settings->logo_path() }}" height="110" width="80" alt="The Luxury sale Logo">
            </div>        
        </div>
        <favorite-index  />
        
         
        </div>
    </section>
    <!--End Content-->
@endsection



