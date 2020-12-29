<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    //

    public function promo_texts(){
        return $this->hasMany('App\PromoText');
    }
}
