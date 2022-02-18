
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ isset( $page_title) ?  $page_title .' |  '.config('app.name') : 'Ohram' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta name="keywords" content="{{ isset($system_settings->meta_tag_keywords) ? $system_settings->meta_tag_keywords : 'cleanse,detox,flattummy,flattummy tea ng,slimming tea' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="https://ohram.org/">

    <!-- Favicone Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <link rel="apple-touch-icon" href="/img/favicon.png">

    <!-- CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/css/theme.css" rel="stylesheet" type="text/css" />
    <link href="/css/skins/skin-default.css" rel="stylesheet" type="text/css" />
    @yield('page-css')
    <link href="/css/custom.css?version={{ str_random(6) }}" rel="stylesheet" type="text/css" />
    <meta property="og:site_name" content="Ohram Co">
    <meta property="og:url" content="https://ohram.org/">
    <meta property="og:title" content=" Ohram - Cleanse &amp; Debloat or Cut The Cals">
    <meta property="og:type" content="website">
    <meta property="og:description" content="From detox teas to meal replacement protein shakes, our babes do it all. Get back on track, reduce bloating, and flatten that tummy!">
    <meta property="og:image:alt" content="">
    <meta name="twitter:site" content="@ohramofficial">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Ohram - Cleanse &amp; Debloat or Cut The Cals">
    <meta name="twitter:description" content="From detox teas to meal replacement protein shakes, our babes do it all. Get back on track, reduce bloating, and flatten that tummy!">
    <script>
      Window.auth = {!! auth()->check()  ? auth()->user() : 'null' !!}
    </script>
</head>

<body>

<div id="product-page">  

     <!--Newsletter Popup-->
     <div class="bg--gray" id="newsletter-popup">
        <a class="newsletter-close"><i class="ti-close fa-2x text-light"></i></a>
        <div id="newsletter-window ">
            <div class="newsletter-content-img">
                <img src="{{ optional($news_letter_image)->image }}" alt="ohram news letter logo" />
            </div>
            <div   class="d-none d-lg-block  newsletter-content">
                <div>
                    <h3 class="newsletter-popup-title text-uppercase text-light h-font bold">Sign Up </h3>
                    <h6 class="newsletter-popup-slogen text-light">Sign up for emails to get the scoop on new arrivals, special sales and more.</h6>
                    <sign-up  />

                    <p class="newsletter-popup-info">
                        By Signing up, you agree to receive ohram offers,<br />
                        promotions and other commercial messages. You may unsubscribe at any time.
                    </p>
                    <div class="newsletter-popup-footer">
                        <a href="javascript:void(0)" class="newsletter-close-text bold">No Thanks</a>
                    </div>
                </div>
            </div>
            <!-- for mobile -->
            <div  style="background-image: url({{ optional($news_letter_image)->image }}); margin-top: -25px; background-position: center;   height: 500px; background-size: cover; " class="newsletter-content d-block d-sm-none">
                <div>
                    <h3 class="newsletter-popup-title text-uppercase text-light h-font bold">Sign Up </h3>
                    <h6 class="newsletter-popup-slogen text-light">Sign up for emails to get the scoop on new arrivals, special sales and more.</h6>
                    <sign-up  />
                </div>
                <p class="newsletter-popup-info">
                    By Signing up, you agree to receive ohram offers,<br />
                    promotions and other commercial messages. You may unsubscribe at any time.
                </p>
                <div class="newsletter-popup-footer">
                    <a href="javascript:void(0)" class="newsletter-close-text bold">No Thanks</a>
                </div>
            </div>
        </div>
    </div>
    <!--End Newsletter Popup-->

 
    <!-- Cart Sidebar Menu -->
    <div class="cart-sidebar-menu">
       <cart-side-bar-menu />
    </div>
    <!-- End Cart Sidebar Menu -->

    <!-- Shop Overlay -->
    <div class="shop-overlay"></div>
    <!-- End Shop Overlay -->

    <!-- Site Wraper -->
    <div class="site-wraper">
        
        <!-- Header ('header--dark' or 'header--light', 'header--sticky')-->
            <header id="header" class="header header--sticky" data-header-hover="true">
              <messages />          
            </header>
            <div class="bg--primary"></div>
            <header id="header" class="header header--sticky" data-header-hover="true">
            <!--End Header Topbar-->
            <!--Header Topbar ('topbar--dark') -->
            <div class="header-topbar   border--primary bg--gray">
                <div class="container-fluid">
                    <div class="row">
                        <div class="topbar-left d-none d-lg-block">
                            <div class="topbar-component">
                                <a href="{{ $system_settings->facebook_link }}"><i class="fa fa-facebook-f fa-lg"></i></a>
                            </div>
                            <div class="topbar-component">
                                <a href="{{  $system_settings->twitter_link}} "><i class="fa fa-twitter fa-lg"></i></a>
                            </div>
                            <div class="topbar-component">
                                <a href="{{  $system_settings->instagram_link }}"><i class="fa fa-instagram fa-lg"></i></a>
                            </div>
                            <div class="topbar-component">
                                <a href="mailto:sales@mazaar.com"><i class="fa fa-envelope-o"></i>
                                    <span>{{ $system_settings->store_email }}</span>
                                </a>
                            </div>
                            
                        </div>
                      
                        <div class="topbar-right topbar--dark">
                            @if ( !auth()->check() )
                                <div class="topbar-component">
                                <span class="mr-3"><a href="{{ route('login') }}"><i class="fa fa-lock left" aria-hidden="true"></i>Login</a></span>
                                <span><a href="{{ route('register') }}"> <i class="fa fa-user-plus left" aria-hidden="true"></i>Register</a></span>
                                </div>
                            @else 
                                <div class="topbar-component">
                                    <a href="javascript:void(0)" class=" text-uppercase dropdown--trigger">
                                        <i class="ti-user"></i>  Account
                                    </a>
                                    <!--Dropdown-->
                                    <div class="dropdown--menu dropdown--right">
                                        <ul>
                                            <li><a href="/account"> <i class="fa fa-user-circle mr-1"></i>  Account</a></li>
                                            <li><a href="/orders"> <i class="fa fa-shopping-cart left " aria-hidden="true"></i> Orders</a></li>
                                            <li>
                                                <a class="" href="/logout"
                                                        onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out left " aria-hidden="true"></i> Logout
                                                </a>
                                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--End Dropdown-->
                                </div>
                                @if ( auth()->user()->isAdmin() )
                                   <div class="topbar-component">
                                       <a target="_blank" class="text-uppercase" href="/admin"><span> Go to Admin</span></a>
                                    </div>
                                @endif
                            @endif
                            @if( $system_settings->allow_multi_currency)
                            <div class="topbar-component">
                                    <a href="javascript:void(0)" class=" text-uppercase dropdown--trigger">
                                        <i class="ti-money "></i>  Switch Currency
                                    </a>
                                    <!--Dropdown-->
                                    <div class="dropdown--menu dropdown--right">
                                        <ul>
                                            @foreach($currencies as $currency)
                                               <li><a href="/currency/{{ $currency->id }}"> {{ $currency->symbol }} {{ $currency->iso_code3 }} </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!--End Dropdown-->
                            </div>
                            @endif
 
                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Topbar-->
           
            <!--End Header Topbar-->
            <!--Header Navigation-->
            <nav id="navigation" class="header-nav">
                <div class="container-fluid">
                    <div class="row">
                        <!--Logo-->
                        <div class="site-logo">
                            <a href="/">
                               <img src="{{ $system_settings->logo_path() }}" class="logo-dark" alt=" Store Logo" />
                            </a>
                        </div>
                        <!--End Logo-->

                        <!--Navigation Menu-->
                        <div class="nav-menu">
                            <ul>
                                @foreach( $global_categories   as  $category)
                                    <li class="nav-menu-item text-uppercase">
                                        <a href="/products/{{ $category->slug }}">{{ $category->name }}</a>
                                        @if ($category->children->count())
                                        <!--Dropdown-->
                                            @include('includes.categories',['category' => $category])
                                        <!--End Dropdown-->
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--End Navigation Menu-->

                        <!--Nav Icons-->
                        <div class="nav-icons">
                            <nav-icon    />
                        </div>
                        <!--End Nav Icons-->
                         

                        <!--Search Bar-->
                        <div class="searchbar-menu">
                            <div class="searchbar-menu-inner">
                                <!--Search Bar-->
                                <div class="search-form-wrap">
                                    <form  action="/search" >
                                        <button class="search-icon btn--lg"><i class="ti-search"></i></button>
                                        <input class="search-field input--lg" placeholder="Search here..." value="" name="q" title="Search..." type="search" autocomplete="off" />
                                        <span class="search-close-icon"><i class="ti-close"></i></span>
                                    </form>
                                </div>
                                <!--End Search Bar-->
                                <!--Search Result Bar-->
                                <div class="search-results-wrap">
                                    <div class="search-results-loading">
                                        <span class="fa fa-spinner fa-spin"></span>
                                    </div>
                                    <div class="search-results-text woocommerce">
                                        <ul>
                                            <li>Nothing found</li>
                                        </ul>
                                    </div>
                                </div>
                                <!--End Search Result Bar-->
                            </div>
                        </div>
                        <!--End Search Bar-->
                    </div>
                </div>
            </nav>
            <!--End Header Navigation-->
           </header>
        <!-- End Header -->
        
        <!--Page Body Content -->
        <div class="page-container">
           @yield('content')
        </div>
        <!--End Page Body Content -->

        <!--Footer-->
        <!--Footer-->
        <footer class="footer bg--dark">
            <!--Footer Widget Bar-->
            <section class="footer-widget-area">
                <div class="container">
                    <div class="row">
                       @foreach($footer_info as $info)
                       <div class="footer-widget bold col-sm-4 col-md-4 col-lg-2 col-6 mb-lg-0 mb-4">
                            <h5 class="footer-widget-title  text-uppercase">{{ title_case($info->title) }}</h5>
                                @if($info->children->count())
                                    <ul class="">
                                        @foreach($info->children as $info)
                                            <li>
                                                <a href="{{ $info->link }}">
                                                {{ $info->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                        </div>
                        @endforeach
                        <div class="footer-widget col-lg-4  col-12 mb-lg-0 mb-3">
                            <h5 class="footer-widget-title text-uppercase">Signup for Newsletter</h5>
                            <news-letter  />
                            <hr/>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footer-widget-area">
                <div class="container">
                    <div class="row">
                        <div class="footer-widget col-5 col-lg-6  mb-lg-0 mb-3">
                        <h5 class="footer-widget-title  text-uppercase ">Follow Us</h5>
                            <ul class="social">
                                <li>
                                    <a href="{{ $system_settings->facebook_link }}"><i class="fa fa-facebook-f fa-lg"></i></a>
                                </li>
                                <li>
                                    <a href="{{  $system_settings->instagram_link }}"><i class="fa fa-instagram fa-lg"></i></a>
                                </li>
                                <li>
                                    <a href="{{  $system_settings->twitter_link}} "><i class="fa fa-twitter fa-lg"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-widget  col-7  col-lg-6 mb-lg-0 mb-3">
                           <h5 class="footer-widget-title  text-uppercase">Payments</h5>
                            <ul class="social icons">
                                <li class="">
                                    <img   src="{{ asset('img/business.png') }}" alt="Master card" /> 
                                </li>
                                <li class="visa">
                                    <img  src="{{ asset('img/visa.png') }}" alt="visa card" />
                                </li>
                                <li class="verve">
                                    <img  src="{{ asset('img/verve1.png') }}" alt="verve card" /> 
                                </li>
                              
                            </ul>
                        </div>

                    </div>
                </div>
            </section>
            <!--Footer Copyright Bar-->
            <section class="footer-bottom-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p class="">© Copyright <a href="{{ Config('app.url') }}"> {{ Config('app.name') }}</a>   {{ date('Y') }}. All rights reserved.</p>
                            <p class="bold text--light">Our products are not intented to diagnose, treat, prevent or cure any disease. Results may vary for Ohram products.</p>
                        </div>
                       
                    </div>
                </div>
            </section>
        </footer>
        <!--End Footer-->
        
        <!-- <div data-notify="container" class="col-xs-12 col-sm-12 alert text-center bg--dark color--light bold alert-with-icon animated fadeInDown" role="alert" data-notify-position="bottom-center" style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; bottom: -14px; left: 0px; right: 0px;">
                <button  type="button" class="close"  style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;">      
                    <i class="fa fa-times fa-2x"></i>  
                </button>
                <span data-notify="message">We use cookies </span><a href="#" target="_blank" data-notify="url"></a>
                </div> -->
        </div> 
        <!-- Site Wraper End -->
    </div>

    <!-- JS -->
    <script src="/js/product.js?version={{ str_random(6) }}" type="text/javascript"></script>
    @yield('page-scripts')
    <script src="/js/theme.js?version={{ str_random(6) }}" type="text/javascript"></script>
    <script type="text/javascript">
        @yield('inline-scripts')
    </script>
</body>
</html>














