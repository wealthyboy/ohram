<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ isset( $page_title) ?  $page_title .' |  '.config('app.name') : 'OHRAM' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta name="keywords" content="{{ isset($system_settings->meta_tag_keywords) ? $system_settings->meta_tag_keywords : 'cleanse,detox,flattummy,flattummy tea ng,slimming tea' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="{{ Config('app.url') }}">

       <!-- Favicone Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="/img/favicon-96x96.png">
    <link rel="apple-touch-icon" href="/img/favicon-96x96.png">

   

    <!-- CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
	<!-- Main CSS File -->
	<link rel="stylesheet" href="/css/style.min.css">
	<link rel="stylesheet" type="text/css" href="/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="/css/skins/skin-default.css">

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
			user: {!! auth()->check() ? auth()->user() : '[]' !!},
			loggedIn: {!! auth()->check() ? true : '0' !!},
			token: '{{ csrf_token() }}'
		}
	</script>
</head>
<body>
	<div id="app" class="page-wrapper">
		

		<header class="header">
			

			<div class="header-middle">
				<div class="container p-4">
					<div class="header-center order-first order-lg-0 ml-0">
						<a href="/" class="logo">
							<img src="{{ $system_settings->logo_path() }}" alt="{{ Config('app.name') }} Logo">
						</a>
					</div><!-- End .header-center -->
				</div><!-- End .container -->
			</div><!-- End .header-middle -->

			
		</header><!-- End .header -->
        <main class="main">
          @yield('content')
        </main> 
        <footer>
            <div class="footer-bottom">
				<div class="container d-flex justify-content-center align-items-center flex-wrap">
					<p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name')}}. 2020. All Rights Reserved</p>
				</div><!-- End .container -->
			</div><!-- End .footer-bottom -->
        </footer>
    </div><!-- End .page-wrapper -->

	<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->


	

	

	<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

	<!-- Plugins JS File -->
    <script src="/js/app.js?version={{ str_random(6) }}" type="text/javascript"></script>
	<!-- Main JS File -->
	<script src="/js/main.min.js?version={{ str_random(6) }}"></script>
    @yield('page-scripts')
    <script type="text/javascript">
        @yield('inline-scripts')
    </script>
</body>
</html>










