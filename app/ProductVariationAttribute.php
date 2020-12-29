<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariationAttribute extends Model
{
    
    public function p_attribute(){
        return $this->belongsTo('App\Attribute','attribute_parent_id');
    }


    public function attribute(){
        return $this->belongsTo('App\Attribute','attribute_id');
    }
}
