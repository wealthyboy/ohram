<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Product;
use App\Cart;
use App\User;
use Storage;
use App\Http\Resources\CartIndexResource;


class CartController  extends Controller {

    
    public function __construct()
	{
			
	}
		
    public function index() {
		$page_title = "Your Cart  ";
		$sub_total =  Cart::sum_items_in_cart();
		$carts = Cart::all_items_in_cart();
		return view('carts.index',compact('sub_total','carts','page_title'));
	}
	
	
	   

	 


	
	
	




}