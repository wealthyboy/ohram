<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{   
    protected $fillable = [
        'category_id',
        'percentage_off',
        'expires',
    ];

    protected $dates = ['expires'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function discount_products(){
        return $this->hasMany('App\DiscountProduct');
    }
}
