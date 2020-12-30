<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ isset( $page_title) ?  $page_title .' |  '.config('app.name') : 'Ohram' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta name="keywords" content="{{ isset($system_settings->meta_tag_keywords) ? $system_settings->meta_tag_keywords : 'cleanse,detox,flattummy,flattummy tea ng,slimming tea' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="{{ Config('app.url') }}">

    <!-- Favicone Icon -->
    
       <!-- Favicone Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="/favicons/favicon.ico">
    <link rel="icon" href="/favicons/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="/favicons/favicon-96x96.png">
    <link rel="apple-touch-icon" href="/favicons/favicon-96x96.png">

   

    <!-- CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
	<!-- Main CSS File -->
	<link rel="stylesheet" href="/css/style.min.css?version={{ str_random(6) }}">
	<link rel="stylesheet" type="text/css" href="/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="/css/skins/skin-default.css?version={{ str_random(6) }}">
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
		Window.user = {
			user: {!! auth()->check() ? auth()->user() : 0000 !!},
			loggedIn: {!! auth()->check() ? 1 : 0 !!},
			settings: {!! isset($system_settings) ? $system_settings : '' !!},
			token: '{!! csrf_token() !!}'
		}
	</script>
</head>
<body class="">
    
	<div id="app" class="page-wrapper">
		

		<header class="header">
		<div class="header-top">
				<div class="container">
					
					@if( $system_settings->allow_multi_currency)
						<div class="header-left header-dropdowns">
							<div class="header-dropdown ml-4">
								<a href="#">{{ optional($system_settings->currency)->iso_code3 }}</a>
								<div class="header-menu">
									<ul>
									    @foreach($currencies as $currency)
											<li><a href="/currency/{{ $currency->id }}"> {{ $currency->symbol }} {{ $currency->iso_code3 }} </a></li>
										@endforeach
									</ul>
								</div><!-- End .header-menu -->
							</div><!-- End .header-dropown -->
						</div><!-- End .header-left -->
					@endif

					<div class="header-right">
						<span class="separator"></span>
						<div class="social-icons">
							<a href="{{ $system_settings->facebook_link }}" class="social-icon social-facebook icon-facebook" target="_blank"></a>
							<a href="{{ $system_settings->twitter_link }}" class="social-icon social-twitter icon-twitter" target="_blank"></a>
							<a href="{{ $system_settings->instagram_link }}" class="social-icon social-instagram icon-instagram" target="_blank"></a>
						</div><!-- End .social-icons -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div>

			<div class="header-middle mt-2 mb-1">
				<div class="container">
					<div class="header-left w-lg-max ml-auto ml-lg-0">
						<div class="header-icon header-search header-search-inline header-search-category">
							<a href="#" class="search-toggle mr-1" role="button"><i class="icon-search-3 "></i></a>
							<form action="/search" method="get">
								<div class="header-search-wrapper">
									<input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
									<button class="btn icon-search-3 p-0" type="submit"></button>
								</div><!-- End .header-search-wrapper -->
							</form>
						</div><!-- End .header-search -->
					</div><!-- End .header-left -->

					<div class="header-center order-first order-lg-0 ml-0 ml-lg-auto">
						<button class="mobile-menu-toggler" type="button">
							<i class="icon-menu"></i>
						</button>
						<a href="/" class="logo">
							<img src="{{ $system_settings->logo_path() }}" alt="{{ Config('app.name') }} Logo">
						</a>
					</div><!-- End .header-center -->
                    <nav-icon    />

				</div><!-- End .container -->
			</div><!-- End .header-middle -->

			<div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{
				'move': [
					
					
					{
						'item': '.header-icon:not(.header-search)',
						'position': 'end',
						'clone': false
					},
					{
						'item': '.cart-dropdown',
						'position': 'end',
						'clone': false
					}
				],
				'moveTo': '.container',
				'changes': [
					{
						'item': '.header-search',
						'removeClass': 'header-search-inline',
						'addClass': 'header-search-popup ml-auto'
					},
					{
						'item': '.main-nav li.custom',
						'removeClass': 'd-xl-block'
					}
				]
            }">
				<div class="container">
					<nav class="main-nav d-flex w-lg-max justify-content-center">
						<ul class="menu">
							
                            @foreach( $global_categories   as  $category)

                                <li>
                                   <a href="/products/{{ $category->slug }}">{{ $category->name }}</a>
                                   @if ($category->isCategoryHaveMultipleChildren())

                                    <div class="megamenu megamenu-fixed-width">
                                        <div class="row">
										    <div class="col-lg-9">
											    <div class="row">
													@foreach (  $category->children as $children)
													<div class="col-lg-2">
														<a href="/products/{{ $children->slug }}" class="category-heading">{{ $children->name }} </a>
														@if ($children->children->count())
															<ul class="submenu">
																@foreach (  $children->children as $children)
																	<li><a href="/products/{{ $children->slug }}">{{ $children->name }}</a></li>
																@endforeach
															</ul>
														@endif
													</div><!-- End .col-lg-4 -->
													@endforeach
		                                        </div>
		                                    </div>
		                                    
											<div class="col-lg-3">
												@if ($category->image)
													<div class="col-lg-12 p-0">
														<img src="{{ $category->image }}" alt="{{ $category->name }}" class="product-promo">
													</div><!-- End .col-lg-4 -->
												@endif
		                                   </div>
                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu -->
                                    @elseif ( !$category->isCategoryHaveMultipleChildren() && $category->children->count() )
                                        <ul>
                                            @foreach (  $category->children as $children)
                                               <li><a href="/products/{{ $children->slug }}">{{ $children->name }}</a></li>
                                            @endforeach 
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
						</ul>
					</nav>
				</div><!-- End .container -->
			</div><!-- End .header-bottom -->
		</header><!-- End .header -->
        <main class="main">
          @yield('content')
        </main> 

		<footer class="footer">
			<div class="footer-middle">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 col-md-8">
							

							<div class="row pt-3">
                                @foreach($footer_info as $info)
                                    <div class="col-sm-2 col-6 col-lg-2">
                                        <div class="widget">
                                            <h2 class="widget-title">{{ title_case($info->title) }}</h2>
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
                                            
                                        </div><!-- End .widget -->
                                    </div><!-- End .col-sm-6 -->
								@endforeach
								<div class="footer-widget col-lg-4  col-12 mb-lg-0 mb-3">
									<h5 class=" widget-title text-uppercase">Signup for Newsletter</h5>
									<news-letter  />
									<hr/>
								</div>
																
							</div><!-- End .row -->
						</div><!-- End .col-lg-9 -->
					</div><!-- End .row -->
				</div><!-- End .container -->
			</div><!-- End .footer-middle -->

			<section class="footer-widget-area">
                <div class="container">
                    <div class="row">
                        <div class="footer-widget col-5 col-lg-6  mb-lg-0 mb-3">
                        <h5 class=" widget-title  text-uppercase ">Follow Us</h5>
						    <div class="social-icons">
								<a  href="{{ $system_settings->facebook_link }}"><i class="fab fa-facebook-f fa-2x mr-5"></i></a>
								<a  href="{{  $system_settings->instagram_link }}"><i class="fab fa-instagram fa-2x mr-5"></i></a>
								<a  href="{{  $system_settings->twitter_link}} "><i class="fab fa-twitter fa-2x"></i></a>
                            </div>
                        </div>
                        <div class="footer-widget  col-7  col-lg-6 mb-lg-0 mb-3">
                           <h5 class="widget-title text-uppercase">Payments</h5>
                            <ul class="payment-icons  icons">
							    <li class="mastercard">
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
            <section class="footer-bottom-area bg--primary">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p class="">© Copyright <a href="{{ Config('app.url') }}"> {{ Config('app.name') }}</a>   {{ date('Y') }}. All rights reserved.  
							@if ( auth()->check() && auth()->user()->isAdmin() )
							   <a target="_blank" href="/admin" >Go to Admin</a>
							@endif 
							</p>
                            <p class="bold text--light">Our products are not intented to diagnose, treat, prevent or cure any disease. Results may vary for Ohram products.</p>
                        </div>
                       
                    </div>
                </div>
            </section>

			
        </footer>	
    </div><!-- End .page-wrapper -->

	<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

	<div class="mobile-menu-container">
		<div class="mobile-menu-wrapper">
			<span class="mobile-menu-close"><i class="icon-cancel"></i></span>
			<nav class="mobile-nav">
				<ul class="mobile-menu">
				@foreach( $global_categories   as  $category)
				    <li>
						<a href="/products/{{ $category->slug }}">{{ $category->name }}</a>
						@if ($category->isCategoryHaveMultipleChildren())
							<ul>
							    @foreach (  $category->children as $children)

								<li>
								<a href="/products/{{ $category->slug }}" class="category-heading">{{ $children->name }} </a>
								   @if ($children->children->count())
										<ul>
										    @foreach (  $children->children as $children)
                                                <li><a href="/products/{{ $category->slug }}">{{ $children->name }}</a></li>
                                            @endforeach
										</ul>
									@endif
								</li>
								@endforeach
							</ul>
						@elseif ( !$category->isCategoryHaveMultipleChildren() && $category->children->count() )
							<ul>
								@foreach (  $category->children as $children)
									<li><a class="category-heading" href="/products/{{ $category->slug }}">{{ $children->name }}</a></li>
								@endforeach 
							</ul>
						@endif
					</li>
					
				@endforeach
				</ul>
			</nav><!-- End .mobile-nav -->

			<div class="social-icons">
				<a href="" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
				<a href="" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
				<a href="" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
			</div><!-- End .social-icons -->
		</div><!-- End .mobile-menu-wrapper -->
	</div><!-- End .mobile-menu-container -->

	

	<!-- Add Cart Modal -->
	<div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-body add-cart-box text-center">
			<p>Product Added<br></p>
			<h4 id="productTitle"></h4>
			<img src="" id="productImage" width="100" height="100" alt="adding cart image">
			<div class="btn-actions">
				<a href=""><button class="btn-primary" data-dismiss="modal">Continue</button></a>
			</div>
		  </div>
		</div>
	  </div>
	</div>
    <div class="watsapp pt-3">
		<a class="chat-on-watsapp" target="_blank" href="https://wa.me/2348052342221">
		  Need help? Chat with us  <i class="fab fa-whatsapp fa-2x float-right mr-2"></i></a>
	</div>

	<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

	<!-- Plugins JS File -->
	<script src="/js/app.js?version={{ str_random(6) }}" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<!-- Main JS File -->
	<script src="/js/main.min.js?version={{ str_random(6) }}"></script>
	<script src="{{ asset('js/loadProducts.jquery.js') }}"></script> 

    @yield('page-scripts')
    <script type="text/javascript">
        @yield('inline-scripts')
    </script>
</body>
</html>










