<?php

namespace App\Filters\ProductsFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class AttributesFilter  extends AbstractFilter
{
    public function filter(Builder $builder,$value){
        return $builder->whereHas('meta_fields',function(Builder  $builder) use ($value){
            $builder->whereIn('name',$value);
        });
    }  
}
