<?php

namespace App\Http\Controllers\Admin\Orders;

use Illuminate\Http\Request;

use App\Order;
use App\User;
use App\SystemSetting;
use App\OrderedProduct;
use App\Http\Controllers\Controller;
use App\Http\Helper;




class OrdersController extends Controller{ 


  
    public function __construct()
    {

       $this->middleware('admin'); 
	   $this->settings =  \DB::table('system_settings')->first();
    }

    public function index ( ) { 
	
		$orders = Order::orderBy('created_at','desc')->get();
        return view('admin.orders.index',compact('orders'));
    }
    

    public function invoice($id){
        $order     =  Order::find($id);
        $system_settings = SystemSetting::first();
		$sub_total = $order->ordered_products[0]->sum_items($order->id)->items_total;
        return view('admin.orders.invoice',compact('sub_total','order','system_settings'));
    }

    public static function order_status() { 
		return [
			"Processing",
			"Refunded",
			"Shipped",
			"Delivered"
		];
	}

	public function show($id) { 
       $order       =  Order::find($id);
       $sub_total   =  $order->ordered_products[0]->sum_items($order->id)->items_total;
	   $statuses    =  static::order_status();
	   return view('admin.orders.show',compact('statuses','order','sub_total'));
	}
	
	public function updateStatus(Request $request){
		$ordered_product = OrderedProduct::findOrFail($request->ordered_product_id);
		$ordered_product->status = $request->status;
		$ordered_product->save();        
		return $ordered_product;
	}
    

    public function dispatchNote(Request $request,$id){
	    $page_title = 'Dispatch Note';
		$order =  Order::find($id);	 
		return view('admin.dispatch.index',compact('order','page_title'));
	}


}