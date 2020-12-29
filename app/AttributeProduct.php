<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{
    protected $table = 'attribute_product';

    protected $fillable = [
        'product_id',
        'attribute_id',
        'parent_id',
    ];

    public function attribute()
    {
       return $this->belongsTo('App\Attribute');
    }

    public function product()
    {
       return $this->belongsTo('App\Product');
    }
   
}
