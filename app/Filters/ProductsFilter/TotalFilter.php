<?php

namespace App\Filters\ProductsFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class TotalFilter  extends AbstractFilter
{
    public function filter(Builder $builder,$value){

        if(count($value) == 1){
            $value  =  array_shift($value);
            return  $builder->whereHas('product_variations',function(Builder  $builder) use ($value){
                $builder->where('price','<=' ,$value);
            });
        }

        return $builder->whereHas('product_variations',function(Builder  $builder) use ($value){
            $builder->whereBetween('price', [min($value),max($value)]);
        });
        

    }
    
}
