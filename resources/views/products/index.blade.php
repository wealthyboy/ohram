@extends('layouts.app')
 
@section('content')
<section  style="background-repeat: no-repeat;background-size: cover;background-image: url({{ isset($category) ? $category->image : '' }}); background-position: center center; background-color: #00c2ad;" class="breadcrumb justify-content-center">

    <div class="breadcrumb-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-link">
                        <div class="container d-flex justify-content-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item color--light"><a href="/"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item  color--light active" aria-current="page">{{ $breadcrumb }}</li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title text-uppercase  color--light">{{ $breadcrumb }}</h1>
                    <p class="">{{ isset($category) ? optional($category)->description  : ''}}</p>
                </div>
            </div>
        </div>
    </div>
</section>




<div class="container-fluid  bg--gray">
    <div  class="row">
        <div class="col-lg-12 main-content">
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

        
        
    </div><!-- End .row -->
    <form id="sort_by">
        <input type="hidden" name="sort_by" id="sort" />
    </form>

</div>
@endsection
@section('inline-scripts')
    $(document).ready(function() {
        $("#load-products").loadProducts({
           'form':$('form#collections input'),
           'form_data':$("form#collections"),
           'form_sort_by':$("select#sort_by "),
           'target':'load-products',
           'loggedInStatus':8,
           'load_more':$(document).find('a.load_more'),
           'filter_url':'{{ request()->fullUrl() }}',
           'overlay': '.product-overlay'
        });
   
        //reset form
        $("#reset-search-form").on("click", function () {
           //  Reset all selections fields to default option.          
           $('input[type=checkbox]').each(function () {
               this.checked = false;
           }); 
        });   
   });
   
@stop

