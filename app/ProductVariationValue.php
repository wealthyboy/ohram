<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariationValue extends Model
{   
    protected $fillable = [
        'attribute_parent_id',
        'name',
        'attribute_id',
        'product_variation_id',
        'product_id',
    ];

    public function product_variation(){
        return $this->belongsTo('App\ProductVariation');
    }


    public function product_variation_attribute(){
        return $this->belongsTo('App\ProductVariationAttribute');
    }

    
    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function attribute(){
        return $this->belongsTo('App\Attribute');
    }

    public function parent_attribute(){
        return $this->belongsTo('App\Attribute','attribute_parent_id');
    }
}
