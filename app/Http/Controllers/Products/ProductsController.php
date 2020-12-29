<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SystemSetting;
use App\Category;
use App\Product;
use App\ProductVariation;
use App\Attribute;
use App\ProductVariationValue;
use App\RelatedProduct;
use App\Review;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\ProductsFilter\AttributesFilter;







class ProductsController extends Controller
{

    public function __construct()
    {	  
	  $this->settings =  SystemSetting::first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function  index(Request $request,Category $category,Builder $builder)  {

        $page_title = implode(" ",explode('-',$category->slug));
        $category_attributes = $category->attribute_parents()->has('children')->get();
        
            $products = Product::whereHas('categories',function(Builder  $builder) use ($category){
                $builder->where('categories.name',$category->name);
            })->filter($request,$this->getFilters($category_attributes))->latest()->paginate($this->settings->products_items_per_page);
            $products->appends(request()->all());
            if($request->ajax()) {
                return response()->json([
                    'products' => $products->toArray(),
                    'category_attributes' => $category_attributes->count()
                ]); 
            }

        $breadcrumb = $category->name; 
        return  view('products.index',compact(
            'category',
            'page_title',
            'category_attributes',
            'breadcrumb',
            'products'
        ));     
    }

    public function getFilters($category_attributes){
        $filters = [];
        foreach ($category_attributes as $category_attribute){
           $filters[$category_attribute->attribute->slug] = AttributesFilter::class;
        }
        return $filters;
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Category $category,Product $product)  { 
        $page_title = "{$product->product_name}";
        $favorites ='';
        $data= [];
        foreach ($product->parent_attributes as  $parent_attribute) {
            if ($parent_attribute->p_attribute_children()){
                $data[$parent_attribute->name] = $parent_attribute->p_attribute_children();
            }
        }
        $attributes =  collect($data);
        $attributes = $attributes->count() && $product->product_type == 'variable' ? $attributes : '{}';
        $related_products = RelatedProduct::where(['product_id' => $product->id])->get();
        $product->load(["variants","variants.images","default_variation","default_variation.images"]);
    	return view('products.show',compact('category','related_products','attributes','product','page_title'));
    }
    
    public function search(Request $request){
        $filtered_array = $request->only(['q', 'field']);
		if (empty( $filtered_array['q'] ) )  { 
			return redirect('/errors');
        }
        $breadcrumb = 'Search Results for  ' .$filtered_array['q'] ; 

		if($request->has('q')){
			$filtered_array = array_filter($filtered_array);
                $query = Product::whereHas('categories', function( $query ) use ( $filtered_array ){
                    $query->where('categories.name','like','%' .$filtered_array['q'] . '%')
                        ->orWhere('products.product_name', 'like', '%' .$filtered_array['q'] . '%')
                        ->orWhere('products.sku', 'like', '%' .$filtered_array['q'] . '%');
                })->orWhereHas('brand', function( $query ) use ( $filtered_array ){
                    $query->where('brands.brand_name', 'like', '%' .$filtered_array['q'] . '%');
                });
        }
			
        $products = $query->groupBy('products.id')->latest()->paginate($this->settings->products_items_per_page);
        $products->appends(request()->all());

        if($request->ajax())
        { 
            return response()->json([
                'products' => $products->toArray(),
            ]); 
        }
        return view('products.index',compact('products','breadcrumb'));  
    }


}
