<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Banner extends Model
{
    //
    public function scopeSliders(Builder $builder){
        return $builder->where('slider',true)->orderBy('sort_order','asc');
    }

    public function scopeBanners(Builder $builder){
        return $builder->orderBy('sort_order','asc');
    }

    public function image_path(){
        return asset('image/banners/'.$this->image);
     }
}
