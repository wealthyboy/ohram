<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Sharer 
{
    public function getExtraPercentAttribute(){
        return  $this->product_type == 'variable'  
        ? optional($this->variant)->extra_percent_off
        : optional($this->default_variation)->extra_percent_off;   
    }

}
