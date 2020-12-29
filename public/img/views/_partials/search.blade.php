
<!--Widget-->

<div class="widget">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-category" role="button" aria-expanded="true" aria-controls="widget-body-2"><h4>{{ $category->name }}</h4></a>
    </h3>
    @foreach (  $category->children as $children)
    <div class="collapse show" id="widget-category">
        <div class="widget-body">
            <ul class="cat-list">
                <li ><a href="/products/{{ $children->slug }}">{{ $children->name }} </a></li>
            </ul>
        </div><!-- End .widget-body -->
    </div><!-- End .collapse -->
    @endforeach
</div><!-- End .widget -->

<form id="collections" action="">

@foreach($category_attributes as $category_attribute)
    <div  class="widget">
        <h3 class="widget-title">
            <a class="collapsed" data-toggle="collapse" href="#widget-body-4{{ $category_attribute->id }}" role="button" aria-expanded="true" aria-controls="widget-body-4{{ $category_attribute->id}}">{{ $category_attribute->attribute->name }}</a>
        </h3>
        <div class="collapse"  id="widget-body-4{{ $category_attribute->id }}">
            <div class="widget-body">
                <ul class="cat-list">
                   @foreach($category_attribute->children as $category_attribute)
                        <li>
                            <div class="checkbox">
                                <label  id="box{{ $category_attribute->attribute->name }}" class="checkbox-label">
                                <input for="box{{ $category_attribute->attribute->name }}" name="{{ $category_attribute->attribute->name }}[]" value="{{ $category_attribute->attribute->name }}" class="filter-product" type="checkbox">
                                    <span class="checkbox-custom rectangular"></span>
                                    <span class="checkbox-label-text">{{ $category_attribute->attribute->name }}</span> 
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