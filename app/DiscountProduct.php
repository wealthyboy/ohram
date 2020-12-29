<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountProduct extends Model
{

    protected $table = 'discount_product';

    protected $fillable=[
        'product_id',
        'sale_price' ,
        'discount_id'
    ];
}
