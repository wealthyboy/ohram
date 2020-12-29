<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class OrderedProduct extends Model
{
    //
	
	protected $table = 'ordered_product';
	
	protected $fillable = ['order_id','cancelled','status','product_variation_id','price'];

	public $appends = ['order_price'];

	
	public function order(){
		return $this->belongsTo('App\Order');
	}

	public function getOrderPriceAttribute(){
		return  $this->price ?? optional($this->product_variation)->customer_price;
	}

	public function product_variation(){
		return $this->belongsTo('App\ProductVariation','product_variation_id');
	}

	public  function sum_items($order_id) {   
		$total = \DB::table('ordered_product')->select(\DB::raw('SUM(total) as items_total'))->where('order_id',$order_id)->get();
		return 	$total = $total[0];
	}

	
	
	

    
		
}
