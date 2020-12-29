<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\HasChildren;
use App\AttributeCategory;



class Attribute extends Model
{

    use HasChildren;

    public $appends = [
        
    ];

    public function values()
    {
        return $this->hasMany('App\AttributeProduct','parent_id','id');
    }

    public function children()
    {
        return $this->hasMany('App\Attribute','parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Attribute','parent_id','id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')
                    ->groupBy('attribute_id');
    }


    public function product_attribute_children()
    {
        return $this->hasMany(AttributeProduct::class,'parent_id')->where('product_id',optional($this->pivot)->product_id);
    }

    
    public function product_variation_value_attribute_children($product_id)
    {
        return $this->hasMany(ProductVariationValue::class,'parent_attribute_id')->where('product_id',$product_id);
    }


    public function categories()
    {
        return $this->belongsToMany('App\Category')->withPivot('category_id');
    }

    public function information()
    {
        return $this->belongsToMany('App\Information')->withPivot('information_id');
    }

    public function variation_value()
    {
        return $this->hasOne(ProductVariationValue::class,'attribute_parent_id');
    }

    public function p_attribute_children()
    {  
       $data = []; 
       foreach ($this->product_attribute_children as $product_attribute_children) {
           $key = $product_attribute_children->attribute->color_code !== null ? $product_attribute_children->attribute->color_code : $product_attribute_children->attribute->name;
           $data[$key] = $product_attribute_children->attribute->name;
       }

       return $data;
    }

  
    
    public function attribute_category_children()
    {  
       $data = []; 
       $attribute_categories = AttributeCategory::where('parent_id',$this->pivot->id)->get();
       foreach ($attribute_categories as $attribute_category) {
           $data[] = $attribute_category->attribute->name;
       }

       return $data;
    }
    
   


}
