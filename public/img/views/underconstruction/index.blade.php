<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>{{ isset( $page_title) ?  $page_title .' |  '.config('app.name') : 'ee' }}</title>
        <meta name="author" content="AchuWorld">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : '' }}">
        <meta name="keywords" content="{{ isset($settings->meta_tag_keywords) ? $settings->meta_tag_keywords : '' }}" />
        <meta name="generator" content="Social Likes: http://social-likes.js.org/">

        

        <!-- CSS -->
        <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/css/theme.css" rel="stylesheet" type="text/css" />
        <link href="/css/skins/skin-default.css" rel="stylesheet" type="text/css" />
        <link href="/css/plugins.css" rel="stylesheet" type="text/css" />

</head>



<body>


<div class="page-contaiter">
    <!--Content-->
    <section class="sec-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="error-page text-center">
                        <h1>{{ Config('app.name')}} is under maintainance</h1>

                        <!--<div class="widget">
                            <form class="search-form">
                                <input class="search-field input--lg" placeholder="Search.." value="" name="s" type="search">
                                <button type="submit" class="search-button btn btn--primary btn--lg">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>-->
                        <div class="copyright" data-sr="wait 0.5s, then enter right and move 40px over 1s">Copyright © {{ Config('app.name')}} </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--End Content-->
</div>
  <!-- JS -->
  

</body>
</html>