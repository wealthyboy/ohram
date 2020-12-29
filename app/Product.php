<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Carbon\Carbon;
use App\Traits\HasChildren;
use App\Traits\FormatPrice;
use App\Traits\ImageFiles;
use App\Traits\Sharer;
use App\Favorite;
use App\Filters\ProductsFilter\ProductFilters;
use App\SystemSetting;
use Illuminate\Database\Eloquent\Builder;




class Product extends Model 
{
    //

	use HasChildren,Sharer,FormatPrice,ImageFiles;//,SoftDeletes,CascadeSoftDeletes;

	public $folder = 'products';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
	protected $dates = ['deleted_at','sale_price_expires'];

	public $appends = [
		'discounted_price',
		'default_discounted_price',
		'link',
		'currency',
		'converted_price',
		'brand_name',
		'image_to_show',
		'default_variation_id',
		'percentage_off',
		'default_percentage_off',
		'average_rating',
		'average_rating_count',
		'add_images',
		'customer_price',
		'qty',
		'is_wishlist',
		'image_m',
        'image_tn',
		'image_to_show_m',
		'image_to_show_tn',
		'colours',
		'inventory',
		'stock',
		'extra_percent'

	];

	protected $cascadeDeletes = ['meta_fields','attributes','variants','categories'];

	protected $fillable = [];

	protected $setting;

	public function __construct()
	{
		$this->setting = SystemSetting::first();
	}
	

	public function product_variations()
    {
		return  $this->hasMany('App\ProductVariation');
	}

	public function variants()
    {
		return  $this->hasMany('App\ProductVariation')
		           ->where('default',false)
		           ->orderBy('created_at','asc');
	}


	public function variant()
	{
		return $this->hasOne('App\ProductVariation')->whereDefault(false);
	}


	public function default_variation()
	{
		return $this->hasOne('App\ProductVariation')->whereDefault(true);
	}
	
	
	public function colors()
    {
        return $this->belongsToMany('App\Attribute')
		->groupBy('attribute_id')
		->whereNotNull('color_code');
    }


	public function getColoursAttribute()
    {
        return $this->colors;
	}
	

	public function product_variation_values()
    {
        return $this->hasMany('App\ProductVariationValue');
	}

	
	public function product_stock()
	{
		$inventory  = [];
		$attribute  = [];
        foreach ($this->variants as  $variant) {
		    $inventory[
			   implode('_',$variant->product_variation_values->pluck('name')->toArray())
		    ] =  array_merge(
						    $variant->toArray(),[
							   'images' => $variant->images->toArray()
						]);
		}
        $inventory = collect($inventory);
        $stock = "[$inventory]";
		return $stock;
	}


	public function getAverageRatingAttribute(){
		return (new Review())->highest_rating($this->id);
	}


	public function getAverageRatingCountAttribute(){
        return (new Review())->number_of_occurencies($this->id);
	}


	public function getIsWishlistAttribute(){
		if (auth()->check()){
			return null !== Favorite::where(['product_variation_id'=> $this->default_variation_id, 'user_id' => auth()->user()->id])->first() ? true : false;
		}
		return false;
	}


	public function product_inventory()
	{
		$inventory  = [];
		$attributes  = [];
		$stock = [];
		$a = [];
        foreach ($this->variants as  $variant) {
			$first = ProductVariationValue::where("product_variation_id", $variant->id)->orderBy('attribute_parent_id','asc')->first();
			foreach ($variant->product_variation_values->slice(1) as  $variation_value) {
				$stock[$first->name][optional($variation_value->parent_attribute)->name][ $variation_value->name ] = $variation_value->name;
			}
		}
        $inventory = collect($stock);
        $stock = "[$inventory]";
		return $stock;
	}


	public function stock(){
        return  $this->quantity == 0 ? 'Out of stock' : '₦'.number_format($this->price).' '.$this->quantity .' Left' ;
	}


	public function favorites(){
        return $this->hasOne('App\Favorite');
	}

		 
	public function link()
	{
		$link  = '/product/';
		$link .=  optional(optional($this->category)->category)->slug ? 
		          optional(optional($this->category)->category)->slug .'/' :
		          $this->categories[0]->slug .'/';
		$link .= $this->slug;
		return $link;
	}


    public function scopeFilter(Builder $builder,$request,array $filters = []){
        return (new ProductFilters($request))->add($filters)->filter($builder);
    }


	public function category(){
		return $this->hasOne(CategoryProduct::class)->where('category_id',optional($this->pivot)->category_id);
	}


	public function attribute(){
		return $this->hasOne(AttributeProduct::class)->where('parent_id',optional($this->pivot)->parent_id);
	}


    public function categories()
    {
        return $this->belongsToMany('App\Category')->withPivot('category_id');
	}


	public function related_products()
    {
        return $this->hasMany(RelatedProduct::class);
	}


	public function attributes()
    {
		return  $this->belongsToMany('App\Attribute')
					->groupBy('attribute_id')
					->withPivot('attribute_id')
					->withPivot('parent_id')
					->withPivot('id');
	}


	public function product_variation_attributes()
    {
        return $this->hasMany('App\ProductVariationAttribute');
	}
	

	public function product_variation_attribute()
	{
		return $this->hasOne('App\ProductVariationAttribute');
	}


	public function parent_attributes()
    {
		return $this->belongsToMany('App\Attribute')
		            ->groupBy('attribute_id')
					->wherePivot('parent_id',null)
					->withPivot('id')
					->withPivot('product_id');
	}


	public function meta_fields()
    {
		return  $this->belongsToMany('App\Attribute','meta_field')
					->groupBy('attribute_id')
					->withPivot([
						'attribute_id',
						'image',
						'id'
					]);
	}


	public function images()
    {
        return $this->morphMany('App\Image', 'imageable')->orderBy('id','asc')->where('image','!=','No Image');
	}
	

	public function newProducts(){
	   return $this->created_at->diffInDays(Carbon::now(), 7);
	}
	
		
	public function brand()
    {
	   return $this->belongsTo('App\Brand');
	}


	public function reviews(){
		return $this->hasMany('App\Review');
	}

	
	public function ordered_product(){
		return $this->hasOne('App\OrderedProduct');
	}


	public function getRouteKeyName(){
		return 'slug';
	}


	public function getLinkAttribute(){
		return $this->link();
	}


	public function getDefaultVariationIdAttribute(){
		return $this->product_type == 'variable' 
		? optional($this->variant)->id
		: optional($this->default_variation)->id;
	}


	public function getQtyAttribute(){
		return $this->product_type == 'variable' 
		? optional($this->variant)->quantity
		: $this->quantity;
	}


	public function getInventoryAttribute(){
		return $this->product_inventory();
	}

	public function getStockAttribute(){
		return $this->product_stock();
	}


	public function getItemIsWishlistAttribute(){
		if ( auth()->check() ){
			return auth()->user()->favorites()->where("product_variation_id",$this->default_variation_id)->count();
		}
		return null;
	}


	public function getBrandNameAttribute(){
		return optional($this->brand)->brand_name;
	}


	public function getDefaultDiscountedPriceAttribute(){
		return $this->formatted_discount_price();
	}

		
}
