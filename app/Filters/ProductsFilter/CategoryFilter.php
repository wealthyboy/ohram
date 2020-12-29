<?php

namespace App\Filters\ArtProductsFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class CategoryFilter  extends AbstractFilter
{
    public function filter(Builder $builder,$value){
        return $builder->whereHas('categories',function(Builder  $builder) use ($value){
            $builder->where('categories.category_name',$value);
        });
    }
    
}
