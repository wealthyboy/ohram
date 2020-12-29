<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ isset( $page_title) ?  $page_title .' |  '.config('app.name') : 'The Luxury Sale' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta name="keywords" content="{{ isset($system_settings->meta_tag_keywords) ? $system_settings->meta_tag_keywords : 'cleanse,detox,flattummy,flattummy tea ng,slimming tea' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="{{ Config('app.url') }}">

    <!-- Favicone Icon -->
    
    <link rel="icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">

   

    <!-- CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
	<!-- Main CSS File -->
	<link rel="stylesheet" href="/css/style.min.css">
	<link rel="stylesheet" type="text/css" href="/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="/css/skins/skin-default.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    @yield('page-css')
    <link href="/css/custom.css?version={{ str_random(6) }}" rel="stylesheet" type="text/css" />
    <meta property="og:site_name" content="Ohram Co">
    <meta property="og:url" content="https://theluxurysale.com/">
    <meta property="og:title" content=" theluxurysale">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Online sales of your best brands,buy gucci,versace. etc">
    <meta property="og:image:alt" content="">
    <meta name="twitter:site" content="@theluxurysale">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="theluxurysale - Online sales of your best brands,buy gucci,versace. ">
    <meta name="twitter:description" content="Online sales of your best brands,buy gucci,versace. ">
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
                                <a href="#">USD</a>
                                
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
						<div class="header-dropdown dropdown-expanded mx-2 px-1">
							<div class="header-menu">
								<ul>
									
								</ul>
							</div><!-- End .header-menu -->
						</div><!-- End .header-dropown -->

						<span class="separator"></span>

						<div class="social-icons">
							<a href="{{ $system_settings->facebook_link }}" class="social-icon social-facebook icon-facebook" target="_blank"></a>
							<a href="{{ $system_settings->twitter_link }}" class="social-icon social-twitter icon-twitter" target="_blank"></a>
							<a href="{{ $system_settings->instagram_link }}" class="social-icon social-instagram icon-instagram" target="_blank"></a>
						</div><!-- End .social-icons -->
					</div><!-- End .header-right -->
				</div><!-- End .container -->
			</div><!-- End .header-top -->

			<div class="header-middle">
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
						'item': '.logo',
						'position': 'start',
						'clone': false
					},
					
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
														<a href="/products/{{ $children->slug }}" class="nolink category-heading">{{ $children->name }} </a>
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
							<div class="widget widget-newsletter">
								<h4 class="widget-title m-b-1 pb-2">Subscribe newsletter</h4>
								<div class="row">
									<div class="col-lg-6">
										<p class="pt-2 mb-lg-0">Get all the latest information on Events, Sales and Offers. Sign up for newsletter today.</p>
									</div><!-- End .col-lg-6 -->
									<div class="col-lg-6">
										<form action="#" class="d-flex mb-0 w-100">
											<input type="email" class="form-control mb-0" placeholder="Email address" required="">
											<input type="submit" class="btn btn-primary shadow-none" value="Subscribe">
										</form>
									</div><!-- End .col-lg-6 -->
								</div><!-- End .row -->
							</div><!-- End .widget -->

							<div class="row pt-3">
                                @foreach($footer_info as $info)
                                    <div class="col-sm-3 col-6 col-lg-3">
                                        <div class="widget">
                                            <h4 class="widget-title">{{ title_case($info->title) }}</h4>
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
								<div class="col-sm-3 col-6 col-lg-3">
								    <div class="widget">
									    <h4 class="widget-title">FOLLOW US</h4>
									    <div class="social-icons">
											<a href="/" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
											<a href="" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
											<a href="" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
										</div><!-- End .social-icons -->
                                        <br/>
										<h4 class="widget-title">PAYMENTS</h4>
									    <div class="payment-icons d-flex">
										    <div class="ms mr-3">
											   <img src="/img/business.png"  class="payment-mastercard" alt="make payment with mastercard">
											</div>
											<div class="vs mr-2">
											    <img src="/img/visa-card-ohram.png"  class="payment-visa" alt="make payment with mastercard">
											</div>
											<div class="vv ml-3">
											    <img src="https://www.theluxurysale.com/uploads/FPPVD3wLv0beoQtpi3N9H5s9acRv0yf3blevt2U8.png" class="payment-verve" alt="make payment with mastercard">
											</div>
										</div><!-- End .social-icons -->
									</div>
		                        </div>								
							</div><!-- End .row -->
						</div><!-- End .col-lg-9 -->
					</div><!-- End .row -->
				</div><!-- End .container -->
			</div><!-- End .footer-middle -->

			<div class="footer-bottom">
				<div class="container d-flex justify-content-center align-items-center flex-wrap">
					<p class="footer-copyright py-3 pr-4 mb-0">© THELUXURYSALE. 2020. All Rights Reserved</p>
					@if ( auth()->check() && auth()->user()->isAdmin() )
					  <p class="footer-copyright py-3 pr-4 mb-0"><a target="_blank" href="/admin" >Go to Admin</a></p>
					@endif
				</div><!-- End .container -->
			</div><!-- End .footer-bottom -->
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

	<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

	<!-- Plugins JS File -->
	<script src="/js/app.js?version={{ str_random(6) }}" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<!-- Main JS File -->
	<script src="/js/main.min.js?version={{ str_random(6) }}"></script>
    @yield('page-scripts')
    <script type="text/javascript">
        @yield('inline-scripts')
    </script>
</body>
</html>










