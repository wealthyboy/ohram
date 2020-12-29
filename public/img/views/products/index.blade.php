@extends('layouts.app')
 
@section('content')
<div class="top-notice text-white bg--gray">
    <div class="container text-center">
        <h5 class="d-inline-block mb-0"><b>Join our newsletter and be the first to know</b></h5>
    </div><!-- End .container -->
</div>
<section class="breadcrumb no-banner  justify-content-center">
    <div class="breadcrumb-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12  text-center">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-link">
                        <div class="container d-flex justify-content-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb }}</li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title">{{ $breadcrumb }}</h1>
                    <p class="">{{ $category->description }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid mb-3">
    <div  class="row">
       @if ( isset($category) &&  isset($category_attributes) && $category_attributes->count() )
            <div class="col-lg-9 main-content">
       @else
            <div class="col-lg-12 main-content">
        @endif
        @if ($products->count())
            <nav class="toolbox horizontal-filter filter-sorts">
                <div class="toolbox-left">
                    <div class="toolbox-item toolbox-sort pr-1">

                        <label class="ml-3"></label>
                        <div class="select-custom">
                            <select  name="sort_by" class="form-control">
                                <option value="" selected="selected">Sort By</option>
                                <option value="created_at,asc">Oldest</option>
                                <option value="created_at,desc">Newest</option>
                                <option value="price,asc">Lowest Price</option>
                                <option value="price,desc">Highest Price</option>
                            </select>
                        </div><!-- End .select-custom -->


                    </div><!-- End .toolbox-item -->
                </div><!-- End .toolbox-left -->


                <div class="toolbox-right">
                    <div class="toolbox-item toolbox-show">
                        <label>Show:</label>

                        <div class="select-custom">
                            <select name="count" class="form-control">
                                <option value="12">12</option>
                                <option value="24">24</option>
                                <option value="36">36</option>
                            </select>
                        </div><!-- End .select-custom -->
                    </div><!-- End .toolbox-item -->

                    <div class="toolbox-item layout-modes">
                        <a href="#" class="layout-btn btn-grid active" title="Grid">
                            <i class="icon-mode-grid"></i>
                        </a>
                        
                    </div><!-- End .layout-modes -->
                </div><!-- End .toolbox-right -->
            </nav>
        @endif
            @if ( isset($category) &&  isset($category_attributes) && !empty($category_attributes) )
                @include('_partials.products',['no_attr'=>false])
            @else
                @include('_partials.products',['no_attr' => true])
            @endif

            <div id="pagination" class="col-md-10 text-center mb-20 col-md-offset-1">
                @if(!empty($products->hasMorePages()))
                <a href="{{ $products->nextPageUrl() }}" id="load_more" class="btn btn-block loadmore btn-loadmore load_more mt-4 mb-2">Load More ...</a>
                @endif
            </div>

        </div><!-- End .col-lg-9 -->

        

        @if ( isset($category) &&  isset($category_attributes) && !empty($category_attributes) )
            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
            <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                <div class="pin-wrapper" style="">
                    <div class="sidebar-wrapper" style="">
                        @include('_partials.search',['category_attributes'=>$category_attributes])
                        
                    </div>
                </div>
            </aside><!-- End .col-lg-3 -->
        @endif
    </div><!-- End .row -->
    <form id="sort_by">
        <input type="hidden" name="sort_by" id="sort" />
    </form>

</div>
@endsection
@section('page-scripts')
<script src="{{ asset('js/loadProducts.jquery.js') }}"></script> 
@stop