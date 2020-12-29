<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $fillable=['brand_name'];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }


    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
