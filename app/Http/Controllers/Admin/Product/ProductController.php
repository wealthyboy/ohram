<?php 


namespace App\Http\Controllers\Admin\Product;


use App\User;
use App\Brand;

use App\Image;
use App\Product;
use App\Activity;
use App\Category;
use App\Attribute;
use App\Http\Helper;
use App\ProductSize;
use App\SystemSetting;
use App\RelatedProduct;
use App\CategoryProduct;
use App\AttributeCategoryChildren;
use App\BrandCategory;

use App\AttributeProduct;
use App\ProductAttribute;
use App\ProductVariation;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\ProductVariationValue;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;




class ProductController extends Controller
{
    
    protected $settings;

    public function __construct()
    {	  
	  $this->settings =  SystemSetting::first();
    }

    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {   
        $products = Product::with('categories')
                            ->orderBy('created_at','desc')->paginate(30);
        
        return view('admin.products.index',compact('products'));
    }


    public function barcode(ProductSize $product)
    {
        $qr = new QrCode;
        $qr->setText('https://.com/view/'.$product->product_image->product->link());
        $qr->setSize(150);
        return  \Image::make($qr->writeString())->response();
    }


    public function printInvoice($id){
        $product = ProductVariation::find($id);
        return view('admin.products.invoice',compact('product') );
    }
    

    public function loadAttr(Request $request){
        $attribute_id = array_filter($request->attribute_ids);
        if (empty($attribute_id)){
            return response()->json([
                'error' => 'Please select at least 1 attribute'
            ],422);
        }
        $product_attributes = Attribute::find($attribute_id);
        $counter = rand(1,500);
        return view('admin.products.variation',compact('counter','product_attributes'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create()
    {
        User::canTakeAction(2);
        $brands = Brand::all();
        $categories = Category::parents()->get();
        $product_attributes = Attribute::parents()->where('type','both')->orderBy('sort_order','asc')->get();
        $meta_attributes = Attribute::parents()->where('type','!=','both')->orderBy('sort_order','asc')->get();
        return view('admin.products.create',compact('product_attributes','meta_attributes','brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {   

        $this->validate($request,[
            "category_id"  => "required|array",
            'product_name'=>[
                'required',
                    Rule::unique('products')->where(function ($query) use ($request) {
                        $query->where('deleted_at','=',null);
                    }) 
            ],
        ]);


        $image  = $request->image;
        $cA = [];

        $sale_price = $request->has('sale_price') ? $request->sale_price : null;
        $product->product_name = $request->product_name;
        $product->price        = $request->price;
        $product->sale_price   = $sale_price;
        $product->slug         = str_slug($request->product_name);
        $product->weight       = $request->weight;
        $product->height       = $request->height;
        $product->image        = $request->image;
        $product->width        = $request->width;
        ///$product->extra_percent_off  = $request->extra_percent_off;

        $product->description  = $request->description;
        $product->sale_price_expires = Helper::getFormatedDate($request->sale_price_expires);
        $product->allow       = $request->allow ? $request->allow : 0;
        $product->brand_id    = $request->brand_id;
        $product->total = 2;
        $product->featured=  $request->featured_product ? 1 : 0;
        $product->pending= 0;
        $product->product_type = $request->type;
        $product->attributes  = $this->attributes($request);
        $product->quantity  = $request->quantity;
        $product->sku = str_random(6);
        if($request->filled('has_more_variation')){
            $product->has_variants  = 1;
        }
        
        $product->save();

        /**
         * Save categories
         */
        $categories = Category::find($request->category_id);

        if(!empty($request->category_id)){
            $product->categories()->sync($request->category_id);
            foreach ($categories as $category) {
                if ($request->brand_id){
                    BrandCategory::updateOrCreate(
                        ['category_id' => $category->id, 'brand_id' => $request->brand_id],
                        ['category_id' => $category->id, 'brand_id' => $request->brand_id]
                    );  
                }
            }
        }


        /**
         * Sync categories with attributes
        */

        if( !empty($request->meta_fields) ){

            foreach($request->meta_fields as $parent_id  => $value){
                foreach ($categories as $category) {
                    $category->attributes()->syncWithoutDetaching($parent_id);
                    foreach($category->parent_attributes as $attribute){
                        if($parent_id === $attribute->id){ 
                            $cA[$attribute->pivot->id][] = $value;
                        } 
                    }
                }

            }
            $product->meta_fields()->sync(array_filter(array_values($request->meta_fields))); 
        }

        /**
         * Save related products
        */
        if( !empty($request->related_products) ){
            foreach ($request->related_products as $key => $product_ids) {
                $product->related_products()->create([
                    'related_id' =>  $product_ids,
                    'sort_order' =>$request->sort_order[$key],
                ]);
            }
        }

        

        $product_variation = new  ProductVariation();
        $product_variation->price = $request->price;
        $product_variation->sale_price = $request->sale_price;
        $product_variation->image = $request->image;
        $product_variation->width = $request->width;
        $product_variation->sale_price_expires = Helper::getFormatedDate($request->sale_price_expires);
        $product_variation->length = $request->length;
        $product_variation->weight = $request->weight;
        $product_variation->quantity  = $request->quantity;
        //$product_variation->extra_percent_off  = $request->type == 'simple' ? $request->extra_percent_off : null;

        
        $product_variation->sku = str_random(6);
        $product_variation->product_id = $product->id;
        $product_variation->default = 1;
        $product_variation->save();
        $images = null;

        if ($request->type == 'simple'){
            if (!empty($request->images) ) {
                $images =  $request->images;
                $images = array_filter($images);
                foreach ( $images as $variation_image) {
                    $images = new Image(['image' => $variation_image]);
                    $product_variation->images()->save($images);
                }
            } 
        }
       
        if ($request->type !== 'simple'){

            if( $request->filled('has_more_variation') ){
                $data   = [];
                $names  = [];
                $cA     = [];


                foreach ($request->product_attributes  as $key => $attributes) {
                    if ($attributes == null){
                        continue;
                    }

                    /**
                     * 
                     * Sync the the attributes and categories
                     */
                    $filtered_attributes = array_filter($request->product_attributes[$key]);
                    
                    foreach($attributes as $parent_id => $attribute_id){
                        if ($attribute_id == null){
                            continue;
                        }
                        $data[$parent_id] = ['parent_id'=>null]; 
                        $data[$attribute_id] = ['parent_id'=>$parent_id]; 
                        $name = Attribute::find($attribute_id)->name;
                    

                        /**
                         * 
                         * Sync the the attributes and categories
                         */

                        foreach ($categories as $category) {
                            $category->attributes()->syncWithoutDetaching($parent_id);
                            foreach($category->parent_attributes as $attribute){
                                if($parent_id === $attribute->id){ 
                                   $cA[$attribute->pivot->id][] = $attribute_id;
                                } 
                            }
                        }
                    }
                    //$category->attributes()->syncWithoutDetaching($cA);

                
                    $product_variation = new  ProductVariation();
                    // $images  = $request->images;
                    // $image1  = array_shift($images);
                    $variation_images = !empty($request->variation_images[$key]) ? $request->variation_images[$key] : [];
                    $product_variation->name = $name;
                    $product_variation->price = null !== $request->variation_price[$key] ?$request->variation_price[$key] : $request->price;
                    $product_variation->sale_price =  null !== $request->variation_sale_price[$key] ?$request->variation_sale_price[$key] : $request->sale_price;
                    $product_variation->image = $request->variation_image[$key];
                    $product_variation->width = $request->variation_width[$key];
                    $product_variation->sale_price_expires = Helper::getFormatedDate($request->variation_sale_price_expires[$key]);
                    $product_variation->length = $request->variation_length[$key];
                    $product_variation->weight = $request->variation_weight[$key];
                    //$product_variation->extra_percent_off  = $request->extra_percent_off[$key];

                    $product_variation->quantity  = null !== $request->variation_quantity[$key] ?$request->variation_quantity[$key] : $request->quantity;
                    $product_variation->sku = str_random(6);
                    $product_variation->product_id = $product->id;
                    $product_variation->save();
                    if (count($variation_images )  > 0) {
                        $images = array_filter($variation_images);
                        foreach ( $images  as $image) {
                            $imgs= new Image(['image' => $image]);
                            $product_variation->images()->save($imgs);
                        }
                    }   
                    $this->syncProductVariationValues($filtered_attributes,$product_variation,$product);
                }

                
                //dd($data);
                $product->meta_fields()->syncWithoutDetaching($data);
                $product->attributes()->syncWithoutDetaching($data);
            }
        }

        

        

        foreach( $cA as $key => $values){
            foreach( $values as $k => $value){
                AttributeCategoryChildren::updateOrCreate(
                    ['attribute_category_id' => $key, 'attribute_id' => $value],
                    ['attribute_category_id' => $key, 'attribute_id' => $value]
                );
            }
        }
        
        (new Activity)->Log("Created a new product {$request->product_name}");
        return \Redirect::to('/admin/products');
    }


    public function buildAttributes(Request $request,$edit = null,$new = null){
        $names  = [];
        $meta_fields = [];
        if( !empty($request->product_attributes) ){
            foreach ($request->product_attributes  as $key => $attributes) {
                $names[] = Attribute::find($attributes)->pluck('name')->toArray();
            }
            $names = array_shift($names);
        }
        return  $names;
    }


    public function metaFields(Request $request,$edit = null,$new = null){
        $meta_fields = [];
        if( !empty($request->meta_fields) ){
            $meta_fields = Attribute::find(array_values($request->meta_fields))->pluck('name')->toArray();
        }
        return $meta_fields;
    }


    public function buildEAttributes(Request $request,$edit = null,$new = null){
        $names  = [];
        if( !empty($request->edit_product_attributes) ){
            foreach ($request->edit_product_attributes  as $key => $attributes) {
                foreach ($attributes  as $key => $attribute) {
                   $names[] = Attribute::find($attribute)->pluck('name')->toArray();
                }
            }
            $names =  array_slice($names, 0, 2, true);;
        }
        $attr = [];
        foreach ($names  as $key => $name) {
            foreach ($name  as $k => $n) {
              $attr[] = $n;
            }
        }
        return $attr;
    }


    public function buildAAttributes(Request $request,$edit = null,$new = null){
        $names  = [];
        $meta_fields = [];
        if( !empty($request->add_to_product_attributes) ){
            foreach ($request->add_to_product_attributes  as $key => $attributes) {
                $names[] = Attribute::find($attributes)->pluck('name')->toArray();
            }
            $names = array_shift($names);
            return  $names;
        }
        return  $names;
    }


    public function attributes(Request $request){
        return implode(',',array_merge($this->metaFields($request),$this->buildAttributes($request),$this->buildEAttributes($request),$this->buildAAttributes($request)));
    }


    public function search(Request $request){
        $filtered_array = $request->only(['q', 'field']);
		if (empty( $filtered_array['q'] ) )  { 
			return redirect('/errors');
		}
		if($request->has('q')){
			$filtered_array = array_filter($filtered_array);
			

                $query = Product::whereHas('categories', function( $query ) use ( $filtered_array ){
                    $query->where('categories.name','like','%' .$filtered_array['q'] . '%')
                        ->orWhere('products.product_name', 'like', '%' .$filtered_array['q'] . '%')
                        ->orWhere('products.sku', 'like', '%' .$filtered_array['q'] . '%');


                });
        }
			
        $products = $query->groupBy('products.id')->paginate(10);
        return view('admin.products.index',compact('products'));  
    }

    /**
     * Display the specified resource.
     *
     * param  \App\Product  $product
     * return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        //$product_images = $product->product_images->slice(1);
        return view('admin.products.show',compact('other_sizes','product_images','sizes','product'));
    }


    public function getRelatedProducts(Request $request){
        if ($request->filled('product_name')){
            $products = Product::where('product_name', 'like', '%' . $request->product_name . '%')
            ->take(10)
            ->get();
            return view('admin.products.related_products',compact('products'));  
        }
        return [];
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * param  \App\Product  $product
     * return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        User::canTakeAction(3);
        $brands = Brand::all();
        $selected_meta  = [];
        $metas  = [];    
        $categories = Category::parents()->get();
        $product = Product::find($id);
        $variants = $product->variants;
        $product_attributes = Attribute::parents()->where('type','both')->orderBy('sort_order','asc')->get();
        $meta_attributes = Attribute::parents()->where('type','!=','both')->orderBy('sort_order','asc')->get();
        
        return view('admin.products.edit',compact('metas','variants','product','meta_attributes','product_attributes','brands','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * param  \App\Product  $product
     * return \Illuminate\Http\Response
     */
    public function update(Request $request,$id) 
    { 

        //dd($request->add_to_product_attributes);
        $this->validate($request,[
            "category_id"  => "required|array",
            'product_name'=>[
                'required',
                    Rule::unique('products')->where(function ($query)  {
                    $query->where('deleted_at', '=', null);
                    })->ignore($id) 
            ],
        ]);


        $product = Product::findOrFail($id);
        $image  = $request->image;
        $names  = []; 
        $cA = [];
        $product_attributes = [];
       
        
        $sale_price = $request->has('sale_price') ? $request->sale_price : null;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->sale_price = $sale_price;
        $product->sale_price_expires = Helper::getFormatedDate($request->sale_price_expires);
        $product->slug        =  str_slug($request->product_name);
        $product->weight      = $request->weight;
        $product->height      = $request->height;
        $product->image       = $request->image;
        $product->width       = $request->width;
        $product->description = $request->description;
        $product->allow       = $request->allow ? $request->allow : 0;
        $product->brand_id    = $request->brand_id;
        $product->total       = 2;
        $product->product_type = $request->type;
        $product->featured    =  $request->featured_product ? 1 : 0;
        $product->pending     = 0;
        $product->quantity    = $request->quantity;
        $product->sku         = str_random(6);
        $product->attributes  = $this->attributes($request);
        $product->save();
        $categories = Category::find($request->category_id);

        if( !empty($request->category_id) ){
            $product->categories()->sync($request->category_id);
        }


        /**
          *  Sync categories with attributes
        */

        if( !empty($request->meta_fields) ){
            foreach($request->meta_fields as $parent_id  => $value){
                $categories = Category::find($request->category_id);
                foreach ($categories as $category) {
                    $category->attributes()->syncWithoutDetaching($parent_id);
                    foreach($category->parent_attributes as $attribute){
                        if($parent_id === $attribute->id){ 
                            $cA[$attribute->pivot->id][] = $value;
                        } 
                    }
                }

            }
            $product->meta_fields()->sync(array_filter(array_values($request->meta_fields)));  
        }


        $product_variation =  new ProductVariation();

        if (null !== $product->default_variation){
            $product_variation =  ProductVariation::find(optional($product->default_variation)->id);
        } else {
            $product_variation =  new ProductVariation();
            $product_variation->sku = str_random(6);
        }

        
        $product_variation->price      = $request->price;
        $product_variation->sale_price = $request->sale_price;
        $product_variation->image      = $request->image;
        $product_variation->width      = $request->width;
        $product_variation->sale_price_expires   = Helper::getFormatedDate($request->sale_price_expires);
        $product_variation->length     = $request->length;
        $product_variation->weight     = $request->weight;
        $product_variation->quantity   = $request->quantity;
        $product_variation->product_id = $product->id;
        $product_variation->default = 1;
        $product_variation->save();

        if ($request->type == 'simple'){
            if (!empty($request->images) ) {
                $images = array_filter($request->images);
                foreach ( $images as $variation_image) {
                    $images = new Image(['image' => $variation_image]);
                    $product_variation->images()->save($images);
                }
            } 
        }



        if( !empty($request->new_variation_images) ){
            foreach ( $request->new_variation_images as $variant_id => $images) {
                $variation = ProductVariation::find($variant_id);
                $images = array_filter( $images);
                foreach ( $images as $image) {
                    if ($image == ''){
                       continue;
                    }
                    $images = new Image(['image' => $image]);
                    $variation->images()->save($images);
                }
            }
        }


        if(!empty($request->related_products)){
            foreach ($request->related_products as $related_product_id => $product_ids) {
                $product->related_products()->updateOrCreate(
                    [
                        'id' =>  $related_product_id
                    ],
                    [
                    'related_id' =>  $product_ids,
                    'sort_order' =>  $request->sort_order[$related_product_id],
                    ]
                );
            }
        }

        if ($request->type !== 'simple'){

            //Save the variation
            if($request->filled('edit_variation')){
                $data = [];
                $var  = [];
                $names=[];
                $cA = [];

                $add_to_product_attributes = [];
                if(!empty($request->edit_product_attributes)){

                    foreach($request->edit_product_attributes as $variant_id => $attribute_id ){ 
                        $stored_variation_images  = !empty($request->edit_variation_images[$variant_id]) ? $request->edit_variation_images[$variant_id] : [];
                        //$image = $request->edit_variation_image[$variant_id] ?? 
                        $product_variation       =  ProductVariation::updateOrCreate(
                            ['id' => $variant_id],
                            [
                                'price' => $request->edit_variation_price[$variant_id] ?  $request->edit_variation_price[$variant_id] :  $request->price,
                                'sale_price' => $request->edit_variation_sale_price[$variant_id] ? $request->edit_variation_sale_price[$variant_id]  : $sale_price,
                                'width' => $request->edit_variation_width[$variant_id]  ? $request->edit_variation_width[$variant_id] : $request->width,
                                'length' => $request->edit_variation_length[$variant_id],
                                'image' => $request->edit_variation_image[$variant_id], 
                                'sale_price_expires' => !empty($request->edit_variation_sale_price_expires[$variant_id]) ?   Helper::getFormatedDate($request->edit_variation_sale_price_expires[$variant_id]) : Helper::getFormatedDate($request->sale_price_expires),
                                'weight' => $request->edit_variation_weight[$variant_id],
                                'quantity'  => $request->edit_variation_quantity[$variant_id] ? $request->edit_variation_quantity[$variant_id] : $request->quantity,
                                'product_id' => $product->id,
                               // 'extra_percent_off'  => $request->extra_percent_off[$variant_id]
                            ]
                        );

                    
                        if( !empty($request->add_to_product_attributes) ){
                            foreach($request->add_to_product_attributes as $variant_id => $attribute_id ){
                                foreach($attribute_id as $parent_id => $id ){
                                if ( $id == null ){
                                    continue;
                                }

                                /**
                                 * 
                                 * Sync the the attributes and categories
                                */
                                $categories = Category::find($request->category_id);
                                foreach ($categories as $category) {
                                    $category->attributes()->syncWithoutDetaching($parent_id);
                                    foreach($category->parent_attributes as $attribute){
                                        if($parent_id === $attribute->id){ 
                                          $cA[$attribute->pivot->id][] = $attribute_id;
                                        } 
                                    }
                                }
                                
            
                                    $product_attributes[$parent_id] = ['parent_id'=>null]; 
                                    $product_attributes[$id] = ['parent_id'=>$parent_id]; 
                                    $attribute = Attribute::find($id);
                                    $product_variation->product_variation_values()->create([
                                        'attribute_parent_id' => $parent_id,
                                        'attribute_id' => $id,
                                        'name' => $attribute->name,
                                        'product_id' => $product->id
                                    ]);
                                }
                            } 
                        }

                    }
                }


            

                /**
                 * 
                 * Edit Product attributes
                 */

                if( !empty($request->edit_product_attributes) ){
                    $data  = [];
                    $attr  = [];
                    $cA = [];

                    foreach ($request->edit_product_attributes  as $variation_id => $attributes) {
                        foreach ($attributes  as $product_variation_value_id => $pattributes) {
                            foreach($pattributes as $parent_id => $id){
                                if ( $id == '' ){
                                    ProductVariationValue::destroy([$product_variation_value_id]);
                                    continue;
                                }

                                 
                                 /**
                                 * 
                                 * Sync the the attributes and categories
                                 */
                                $categories = Category::find($request->category_id);
                                foreach ($categories as $category) {
                                    $category->attributes()->syncWithoutDetaching($parent_id);
                                    foreach($category->parent_attributes as $attribute){
                                        if($parent_id === $attribute->id){ 
                                          $cA[$attribute->pivot->id][] = $id;
                                        } 
                                    }
                                }
                                
                                $attribute = Attribute::find($id);
                                ProductVariationValue::updateOrCreate(
                                    ['id' => $product_variation_value_id],
                                    [
                                        'attribute_parent_id' => optional($attribute)->parent_id,
                                        'attribute_id' => optional($attribute)->id,
                                        'name' => optional($attribute)->name,
                                    ]
                                ); 
                                $product_attributes[$parent_id] = ['parent_id'=>null]; 
                                $product_attributes[$id] = ['parent_id'=>$parent_id]; 
                                $product->attributes()->detach();

                            } 
                        }
                    }

                }

                //dd($var);
            }

            /**
             * 
             * Add new variation
             */
            if($request->filled('new_variation')){
                $data = [];
                foreach ($request->product_attributes  as $key => $attributes) {
                $product_variation = new  ProductVariation();
                
                $variation_images = !empty($request->variation_images[$key]) ? $request->variation_images[$key] : [];
                
                $product_variation->price = null !== $request->variation_price[$key] ?$request->variation_price[$key] : $request->price;
                $product_variation->sale_price =  null !== $request->variation_sale_price[$key] ?$request->variation_sale_price[$key] : $sale_price;
                $product_variation->image = $request->variation_image[$key];
                $product_variation->width = $request->variation_width[$key];
                $product_variation->sale_price_expires = Helper::getFormatedDate($request->variation_sale_price_expires[$key]);
                //$product_variation->extra_percent_off  = $request->extra_percent_off[$key];

                $product_variation->length = $request->variation_length[$key];
                $product_variation->weight = $request->variation_weight[$key];
                $product_variation->quantity  = null !== $request->variation_quantity[$key] ?$request->variation_quantity[$key] : $request->quantity;
                $product_variation->product_id = $product->id;
                $product_variation->save();
                if (!empty($variation_images) ) {
                    foreach ( $variation_images as $variation_image) {
                        $images = new Image(['image' => $variation_image]);
                        $product_variation->images()->save($images);
                    }
                }

                /***
                 * Sync with atrributes with categories
                 */
                
                            
                foreach( $attributes as $parent_id => $id ){
                    if ( $id == null ){
                        continue;
                    }
                    $product_attributes[$parent_id] = ['parent_id'=>null]; 
                    $product_attributes[$id] = ['parent_id'=>$parent_id]; 

                    $attribute = Attribute::find($id);
                    $product_variation->product_variation_values()->create([
                        'attribute_parent_id' => $parent_id,
                        'attribute_id' => $id,
                        'name' => $attribute->name,
                        'product_id' => $product->id
                    ]);

                     /**
                     * 
                     * Sync the the attributes and categories
                     */
                    foreach ($categories as $category) {
                        $category->attributes()->syncWithoutDetaching($parent_id);
                        foreach($category->parent_attributes as $attribute){
                            if($parent_id === $attribute->id){ 
                               $cA[$attribute->pivot->id][] = $id;
                            } 
                        }
                    }

                } 

            }
        }
    }   
        foreach ($categories as $category) {
            BrandCategory::updateOrCreate(
                ['category_id' => $category->id, 'brand_id' => $request->brand_id],
                ['category_id' => $category->id, 'brand_id' => $request->brand_id]
            );  
        }
        foreach( $cA as $key => $values){
            foreach( $values as $k => $value){
                AttributeCategoryChildren::updateOrCreate(
                    ['attribute_category_id' => $key, 'attribute_id' => $value],
                    ['attribute_category_id' => $key, 'attribute_id' => $value]
                );
            }
        }

        $product->attributes()->sync($product_attributes);       
         //Delete any pending image
        Image::where('image','No Image')->delete();
        return \Redirect::to('/admin/products');
    }


    public function synAttributesCategories($request,$parent_id)
    {
        $cA = [];
        $categories = Category::find($request->category_id);
        foreach ($categories as $category) {
            $category->attributes()->syncWithoutDetaching($parent_id);
            foreach($category->parent_attributes as $attribute){
                if($parent_id === $attribute->id){ 
                    $cA[$attribute->pivot->id][] = $id;
                } 
            }
        }

        return $cA;
    }

 

    public function syncProductVariationValues($filtered_attributes,$product_variation,$product)
    {
        $names = [];

        foreach ($filtered_attributes  as  $parent_id => $attribute_id) 
        {   
            if ( $attribute_id == null ){
                continue;
            }
            $attribute = Attribute::find($attribute_id);
            $names[]=$attribute->name;
            $product_variation->name = explode('_',implode('_', $names))[0]; 
            $product_variation->save(); 
            $product_variation->product_variation_values()->create([
                'attribute_parent_id' => $parent_id,
                'attribute_id' => $attribute_id,
                'name' => $attribute->name,
                'product_id' => $product->id
            ]);
        }  
    }



     public function destroyVariation(Request $request,$product_variation_id)
     {
        $product_variation_values = ProductVariationValue::whereIn('product_variation_id',[$product_variation_id])->get();
        foreach ($product_variation_values as $product_variation_value) {
            $product_variation_value->product->attributes()->detach([$product_variation_value->attribute_id]);
        }
        $product_variation = ProductVariation::find($product_variation_id);
        $product = $product_variation->product;
        ProductVariation::destroy( $product_variation_id );
        if (!$product->variants->count()){
           $product->has_variants = false;
           $product->save();
        }
        return response('done',200);
     }

     public function destroyRelatedProduct(Request $request,$id)
     {
        RelatedProduct::destroy( $id );
        return response('done',200);
     }

   

    /**
     * Remove the specified resource from storage.
     *
     * param  \App\Product  $product
     * return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::canTakeAction(5);
        $rules = array (
                '_token' => 'required' 
        );
        $validator = \Validator::make ( $request->all (), $rules );
        if (empty ( $request->selected )) {
            $validator->getMessageBag ()->add ( 'Selected', 'Nothing to Delete' );
            return \Redirect::back ()->withErrors ( $validator )->withInput ();
        }
        $count = count($request->selected);
        (new Activity)->Log("Deleted  {$count} Products");

        foreach ( $request->selected as $selected ){
            $delete = Product::find($selected);
            $delete->variants()->delete();
            $delete->variant()->delete();
            $delete->delete();
        }
        
        return redirect()->back();
    }
}
