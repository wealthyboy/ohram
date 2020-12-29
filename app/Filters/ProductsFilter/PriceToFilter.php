<?php

namespace App\Filters\ArtProductsFilter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\AbstractFilter;


class PriceToFilter  extends AbstractFilter
{
      public function filter(Builder $builder,$value){
        return $builder->where('price','<=',$value);
      }
    
}
