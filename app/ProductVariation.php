<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SystemSetting;
use App\Traits\FormatPrice;
use App\Traits\ImageFiles;
use App\Http\Helper;
use App\Traits\Sharer;





class ProductVariation extends Model
{   

	use FormatPrice,Sharer,ImageFiles;

    protected $setting;

    public $folder = 'products';


    protected $fillable = [
        'name',
        'price',
        'sale_price',
        'product_id',
        'quantity',
        'image',
        'sku',
        'width',
        'length',
        'weight',
        'sale_price_expires',
        'image_m',
		'image_tn',
		'image_to_show_m',
        'image_to_show_tn',
        'extra_percent_off'
    ];

    protected $dates = [
        'sale_price_expires'
    ];

    public $appends = [
		'discounted_price',
        'currency',
        'variation',
        'converted_price',
        'customer_price',
        'image_to_show',
        'default_discounted_price',
        'percentage_off',
        'default_percentage_off',
		'image_m',
        'image_tn',
        'image_to_show_m',
        'extra_percent'

	];


    public function __construct(){
		$this->setting = SystemSetting::first();
	}
    
    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function product_variation_values()
    {
        return $this->hasMany('App\ProductVariationValue')->orderBy('attribute_parent_id','asc');
    }


    public function product_variation_attributes()
    {
        return $this->hasMany('App\ProductVariationAttribute');
    }


    public static function getTotalValue() {
		return static::sum(function($product_variantions) {
		   return $product_variantions->quantity * $product_variantions->price;
		});
    }
    
    public function product_variation_value()
    {
        return $this->hasOne('App\ProductVariationValue');
    }


    public function product_variation_attribute()
    {
        return $this->hasOne('App\ProductVariationAttribute');
    }


    public function product_variation_names(){
       return $this->product_variation_values;
    }

    public function stock(){
        return  $this->quantity == 0 ? 'Out of stock' : 'In stock' ;
	}

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable')->orderBy('created_at','asc');
    }

    public function img()
    {
        return $this->hasOne('App\Image','imageable_id','id');
    }

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }
    
    public function getVariationAttribute(){
		return $this->product_variation_names();
    }

    
    public function getCustomerPriceAttribute(){
		return $this->discounted_price ?? $this->converted_price ;
	}

}
