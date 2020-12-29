<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasChildren 
{
    
    public function scopeParents(Builder $builder,$order = null){

        if ($order == null){
           return $builder->whereNull('parent_id');
        }
        $builder->whereNull('parent_id')->orderBy($order,'asc');
    }

    public function isParent()
    {
        return $this->parent_id == null ? true : false;
    }

}
