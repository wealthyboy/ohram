<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected  $fillable = ['title','user_id','description','image','rating','product_id'];

    public function product(){
       return $this->belongsTo('App\Product');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function number_of_occurencies($product_id){
        $result = \DB::table('reviews')->select(\DB::raw('COUNT(rating) AS occurrences'))
        ->groupBy('rating')
        ->orderBy('occurrences', 'DESC')
        ->where(['reviews.product_id'=>$product_id])
        ->first();
        return $result  !== null ? $result->occurrences : 0;  
    }

    public function reviewPercent($number,$total){
        return ($number * 100)/$total;
    }

    public function highest_rating($product_id){
        $result= static::select('rating')
        ->groupBy('rating')
        ->orderByRaw('COUNT(*) DESC')
        ->where(['reviews.product_id'=>$product_id])
        ->first();
        return $result !== null ?  $result->rating : 0;
   } 


   public function img(){
       return $this->image ? $this->image : '/image/utilities/profile.png';
   }
}
