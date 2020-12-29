<div id="load-products" class="row mt-3  align-items-start">

@if ($products->count())

@foreach($products as $product)
<div  class="col-6  p-0 pr-3 col-md-3 col-xl-3 ">
        <div class="product-default inner-quickview bg--light  inner-icon">
            <figure>
                <a href="{{ $product->link }}">
                    <img src="{{ $product->image_to_show_m }}" alt="{{ $product->product_name }}" />
                </a>
                @if($product->default_percentage_off)
                <div class="label-group">
                    <div  class="product-label label-sale">-{{ $product->default_percentage_off }}%</div>
                </div>
                @endif
                <div class="btn-icon-group"></div>
                @if($product->extra_percent)
                  <a href="" class="btn-quickview" title="Quick View">Extra {{ $product->extra_percent }}% OFF</a>
                @endif
            </figure>
            <div class="product-details  text-center">
                <div class="mx-auto">
                    
                    @if($product->colours->count())
                        <div  class="justify-content-center d-flex mb-1">
                            @foreach($product->colours as $color)
                               <div   style="border:1px solid #222; height: 15px; width: 15px; border-radius: 50%; background-color: {{ $color->color_code }};" class="mr-1"></div>
                            @endforeach
                        </div>
                    @endif
                    @if($product->brand_name)
                        <div  class="product-brand bold">
                            {{ $product->brand_name }} 
                        </div>
                    @endif

                    <div class="color--primary bold">
                        <a href="{{ $product->link }}">{{ $product->product_name }}</a>
                    </div>
                </div>
                <div class="price-box mx-auto mt-1">
                    @if( $product->default_discounted_price)
                        <span class="old-price bold">{{ $product->currency }}{{ number_format($product->converted_price)   }}</span>
                        <span class="product-price bold">{{ $product->currency }}{{ number_format($product->default_discounted_price)  }}</span>
                    @else
                        <span class="product-price bold">{{ $product->currency }}{{ number_format($product->converted_price) }}</span>
                    @endif
                </div><!-- End .price-box -->

                <div class="add-to-link mx-auto mb-2 d-none d-lg-block d-xl-block">
                    <a href="{{ $product->link }}" class="single_add_to_cart_button bold btn btn--primary">Buy Now</a>
                </div>
            </div><!-- End .product-details -->
        </div>

    </div><!-- End .col-sm-4 -->

    @endforeach
    @else
        <div class="col-12 d-flex justify-content-center">
            <div class="text-center pb-3">
                <img  width="200" height="200" src="/images/utilities/empty_product.svg" /> 
                <p class="bold">No Products Found</p>
            </div>
        </div>

    @endif
</div> 

<script>
   window.onload = function(){
    $("#load-products").loadProducts({
        'form':$('form#collections input'),
        'form_data':$("form#collections"),
        'form_sort_by':$("form#sort_by select"),
        'target':'load-products',
        'loggedInStatus':8,
        'load_more':$('a.load_more'),
        'filter_url':'{{ request()->fullUrl() }}',
    });

    //reset form
    $("#reset-search-form").on("click", function () {
        //  Reset all selections fields to default option.          
        $('input[type=checkbox]').each(function () {
            this.checked = false;
        }); 
    });
   }
   
</script>