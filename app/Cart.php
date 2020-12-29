<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Traits\FormatPrice;
use App\Http\Helper;



class Cart extends Model
{

	protected $table ='carts';
	
	public $timestamps = false;
	
	protected $fillable =[
			'product_id',
			'user_id',
			'remember_token',
			'quantity',
			'total',
			'price',
			'product_variation_id'
		];

	public $appends = [
		'sub_total',
		'converted_price',
		'customer_price',
		'cart_total'
	];
	
	public static function items_in_cart() {  
	    //SELECT ALL FROM THE USER ID && FROM THE USER COOKIE
	    $cookie=\Cookie::get('cart');
	    $cart = \DB::table('carts')->select('carts.*')->where(['remember_token'=>$cookie])->get();
	    return null !== $cart ? $cart : null;
	}

	public static function all_items_in_cart() {  
	    //SELECT ALL FROM THE USER ID && FROM THE USER COOKIE
		$cookie=\Cookie::get('cart');
		$carts = Cart::with(["product_variation","product_variation.product","product_variation.product_variation_values"])->where(['carts.remember_token'=>$cookie])->get();
	    static::sync($carts);
	    return $carts;
	}

	public  static function sync($carts){
        if ( null == $carts ) return null;
		foreach ($carts as $cart) {
			if (null == $cart->product_variation){
				$cart->delete();
			}

			if (null !== $cart->product_variation && $cart->product_variation->quantity < $cart->quantity){
				$cart->update([
				   'quantity' => $cart->product_variation->quantity,
				   'user_id' => optional(auth()->user())->id		
				]);
			}

			$cart->update([
				'user_id' => optional(auth()->user())->id	
			]);
		}
	}

	public function product(){
	  	return $this->belongsTo('App\Product');
	}

	public function product_variation(){
		return $this->belongsTo('App\ProductVariation');
    }


	
	public static function sum_items_in_cart() {   
	   $cookie=\Cookie::get('cart'); 
       $total = \DB::table('carts')->select(\DB::raw('SUM(carts.total) as items_total'))->where('remember_token',$cookie)->get();
       return 	static::ConvertCurrencyRate($total = $total[0]->items_total);
	}

	public static function cart_number() { 
		$cookie=\Cookie::get('cart');
		$number_products_in_cart = \DB::table('carts')->select('carts.*')->where('remember_token',$cookie)->count();
		return $number_products_in_cart;
	}

	public static function ConvertCurrencyRate($price){
      
		$rate = Helper::rate();
		if ($rate){
		  return round(($price * $rate->rate),0);  
		}
		return round($price,0);  
  
	 }

	public static function delete_items_in_cart_purchased() { 
		$cookie=\Cookie::get('cart');
		$delete_cart = \DB::table('carts')->select('carts.*')->where('remember_token',$cookie)->delete();
		return $delete_cart;
	}

	public function getCustomerPriceAttribute(){
		return $this->converted_price;
	}

	public function getConvertedPriceAttribute(){
	    return static::ConvertCurrencyRate($this->price);   
	}

	public function getCartTotalAttribute(){
		return  static::ConvertCurrencyRate($this->total);
	}

	public function getSubTotalAttribute(){
		return  static::ConvertCurrencyRate(static::sum_items_in_cart());
	}

	
	  
}
