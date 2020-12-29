<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{   
    protected $fillable= ['related_id','product_id','sort_order'];

    public function product(){
        return $this->belongsTo(Product::class,'related_id');
    }
}
