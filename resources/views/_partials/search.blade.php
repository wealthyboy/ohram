
<!--Widget-->

<div class="widget">
    <h3 class="widget-title">
        <a data-toggle="collapse" class="bold" href="#widget-category" role="button" aria-expanded="true" aria-controls="widget-body-2">{{ $category->name }}</a>
    </h3>
    <div class="collapse show" id="widget-category">
        <div class="widget-body">
            <ul class="cat-list">
                @foreach (  $category->children as $children)
                   <li><a href="/products/{{ $children->slug }}">{{ $children->name }} </a></li>
                @endforeach
            </ul>
        </div><!-- End .widget-body -->
    </div><!-- End .collapse -->
</div><!-- End .widget -->

<form id="collections" action="">

@if ($category->brands->count())

    <div  class="widget">
        <h3 class="widget-title">
            <a  data-toggle="collapse" class="bold"    href="#widget-body-4brand" role="button" aria-expanded="true" aria-controls="widget-body-4brand">BRAND</a>
        </h3>
        <div class="collapse show"  id="widget-body-4brand">
            <div class="widget-body">
                <ul class="cat-list  {{$category->brands->count() > 6  ?  'widget-scroll' : '' }}">
                   @foreach($category->brands as $brand)
                        <li class="">
                            <div class="checkbox">
                                <label  id="box{{ optional($brand)->name }}" class="checkbox-label">
                                <input for="box{{ optional($brand)->name }}" name="brands[]" value="{{ optional($brand)->brand_name }}" class="filter-product" type="checkbox">
                                    <span class="checkbox-custom rectangular"></span>
                                        <span class="checkbox-label-text color--primary">{{ optional($brand)->brand_name }}   </span> 
                                </label>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div><!-- End .widget-body -->
        </div><!-- End .collapse -->
    </div><!-- End .widget -->

@endif

<div class="widget">
    <h3 class="widget-title ">
        <a data-toggle="collapse" href="#widget-prices" role="button" class="bold" aria-expanded="true" aria-controls="widget-body-2">Prices</a>
    </h3>
    <div class="collapsed bold" id="widget-prices">
        <div class="widget-body">
            <ul class="cat-list">
               
                <li>
                    <div class="checkbox">
                        <label  id="box50" class="checkbox-label">
                        <input for="box50" name="prices[]" value="200000" class="filter-product" type="checkbox">
                            <span class="checkbox-custom rectangular"></span>
                            <span class="checkbox-label-text">Less Than  200,000</span> 
                        </label>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                        <label  id="box50" class="checkbox-label">
                        <input for="box50" name="prices[]" value="400000" class="filter-product" type="checkbox">
                            <span class="checkbox-custom rectangular"></span>
                            <span class="checkbox-label-text">Less Than  400,000</span> 
                        </label>
                    </div>
                </li>
 
                <li>
                    <div class="checkbox">
                        <label  id="box50" class="checkbox-label">
                        <input for="box50" name="prices[]" value="600000" class="filter-product" type="checkbox">
                            <span class="checkbox-custom rectangular"></span>
                            <span class="checkbox-label-text">Less Than  600,000</span> 
                        </label>
                    </div>
                </li>

                <li>
                    <div class="checkbox">
                        <label  id="box50" class="checkbox-label">
                        <input for="box50" name="prices[]" value="800000" class="filter-product" type="checkbox">
                            <span class="checkbox-custom rectangular"></span>
                            <span class="checkbox-label-text">Less Than  800,000</span> 
                        </label>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                        <label  id="box50" class="checkbox-label">
                        <input for="box50" name="prices[]" value="1000000" class="filter-product" type="checkbox">
                            <span class="checkbox-custom rectangular"></span>
                            <span class="checkbox-label-text">Less Than  1,000,000</span> 
                        </label>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                        <label  id="box50" class="checkbox-label">
                        <input for="box50" name="prices[]" value="10000000" class="filter-product" type="checkbox">
                            <span class="checkbox-custom rectangular"></span>
                            <span class="checkbox-label-text">Less Than  10,000,000</span> 
                        </label>
                    </div>
                </li>

            </ul>
        </div><!-- End .widget-body -->
    </div><!-- End .collapse -->
</div><!-- End .widget -->

@foreach($category_attributes as $category)
    <div  class="widget">
        <h3 class="widget-title">
            <a class="collapsed bold "   data-toggle="collapse" href="#widget-body-4{{ $category->id }}" role="button" aria-expanded="true" aria-controls="widget-body-4{{ $category->id}}">{{ optional($category->attribute)->name }}</a>
        </h3>
        <div class="collapse"  id="widget-body-4{{ $category->id }}">
            <div class="widget-body">
                <ul class="cat-list  {{ $category->children->count() > 6  ?  'widget-scroll' : '' }}">
                   @foreach($category->children as $category_attribute)
                        <li class="">
                            <div class="checkbox">
                                <label  id="box{{ optional($category->attribute)->name }}" class="checkbox-label">
                                <input for="box{{ optional($category->attribute)->name }}" name="{{ optional($category->attribute)->name }}[]" value="{{ optional($category_attribute->attribute)->name }}" class="filter-product" type="checkbox">
                                    <span class="checkbox-custom rectangular"></span>
                                     <span class="checkbox-label-text color--primary">{{ optional($category_attribute->attribute)->name }}   </span> 
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div><!-- End .widget-body -->
        </div><!-- End .collapse -->
    </div><!-- End .widget -->
@endforeach
    <!-- Content -->
    
</form>