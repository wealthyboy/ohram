

@extends('layouts.app')
        
@section('content')
<div class=" bg--gray">
    <section class="breadcrumb justify-content-center">
        <div class="background-image" data-background="{{ optional($blog_image)->image }}" 
            style="background-image: url({{ optional($blog_image)->image }}); background-position: {{ optional($blog_image)->x_pos . '%' }} {{ optional($blog_image)->y_pos . '%'}};"
            data-bg-posx="center" data-bg-posy="center" data-bg-overlay="4"></div> 
            <div class="breadcrumb-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="breadcrumb-title">Blog</h1>
                            <nav class="breadcrumb-link">
                                <span><a href="/">Home</a></span> /
                                <span>Blog</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @if ($posts->count()) 
    <section class="sec-padding bg--gray">
        <div id="blog-entry" class="blog-entry blog-masonry">
            <div class="container">
               <div class="page-head text-center">
                  <h2 class="page-title heading-hr-margin">OHRAM BLOG</h2>
               </div>
                <div class="row blog-masonry-wrap text-center ">
                    @foreach($posts as $post)
                        <!--Item-->
                        <div class="blog-item-grid col-md-4 col-lg-4">
                            <!--Blog Item-->
                            <div class="blog-item bg--light">
                                <div class="blog-item-image">
                                    <a class="blog-img-link">
                                         <img title="{{ $post->title }}" src="{{ $post->image }}" alt="{{ $post->title }} ">
                                    </a>
                                </div>

                                <div class="blog-item-content">
                                    <div class="tag p-5 bold">
                                            @foreach($post->attributes as $tag)
                                            <a href="/blog/tag/{{ $tag->id }}"><i class="fa fa-tags"></i> {{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                       
                                    <div class="clearfix"></div>
                                    <div>
                                        <h5 class="text-uppercase mt-n3"> 
                                            <a title="{{  $post->title }}" href="{{ route('blog.show',['blog'=> $post->slug]) }}" class="">
                                               {{ $post->title }}
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="blog-description-content text-center">
                                            <?php echo  html_entity_decode($post->teaser);  ?>
                                         </div>
                                        <p class="info pb-3">
                                            <i class="fa fa-clock-o"></i><span>{{ $post->created_at->diffForHumans() }}</span>
                                        </p>
                                </div>
                            </div>
                            <!--End Blog Item-->
                        </div>
                    @endforeach
                   
                </div>
                <div class="clearfix"></div>
                    
            </div>
        </div>
    </section>
<!--End Content-->
@endif


    
</div>


<!-- /container -->
 
@endsection

@section('page-scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@stop
@section('inline-scripts')
$(document).ready(function() {
    $('.blog-masonry-wrap').masonry({
    // options
       itemSelector: '.blog-item-grid',
    });      
});
@stop

