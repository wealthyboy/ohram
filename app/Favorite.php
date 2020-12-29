<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Favorite extends Model
{
    //
	

	public function users(){
        $this->belongsTo('App\User');
    }


    public static function has_liked_a_product($user_id,$product_id){
        $has_liked_a_product = Favorite::where(['user_id'=>$user_id,'product_id'=>$product_id])->first();
        return !empty($has_liked_a_product) ? true : false;
    }


    public function product_variation(){
        return $this->belongsTo('App\ProductVariation');
    }

    public function scopeCreateOrDelete(Builder $builder,$user_id,$id){

       $favorite = $builder->where(['user_id'=>$user_id,'product_variation_id'=>$id])->first();
        if ( null !== $favorite ) { 
            $favorite->delete();
            return false;
        }  else {
            $favorite = new Favorite;
            $favorite->user_id = $user_id;
            $favorite->product_variation_id = $id;
            $favorite->save();
            return true;
        }
    }
	
}
