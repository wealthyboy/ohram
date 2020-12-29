<?php

namespace App\Http\Controllers\Orders;


use Illuminate\Http\Request;

use App\Order;
use App\Product;
use App\User;
use App\OrderedProduct;
use App\Addres;
use App\Http\Controllers\Controller;
use App\SystemSetting;
use App\Http\Helper;



class OrdersController extends Controller{ 


  
    public function __construct()
    {
       $this->middleware('auth');
	   $this->settings =  SystemSetting::first();
    }
	
	public function index ( ) { 
	    $id  =  \Auth::user()->id;
		$settings   =  $this->settings;
		$orders     =  User::find($id)->orders()->orderBy('id','DESC')->get();
		$page_title = 'Order Information';
		$currency =  Helper::getCurrency();
        return view('account.orders.index',compact('currency','page_title','orders'));
	}
	
	
	
	public function updateP(Request $request, $id=null) {  
		
	    if ($request->ajax() ) {  
			if (\Session::has('product_id'))
			{
				$order_product_id = session('product_id');
				OrderedProduct::where('id', $order_product_id)->update(array('cancelled' => true));
				$returnData = array(
					'status' => 'success',
					'message' => 'Product Cancelled.'
				);
				return response()->json($returnData, 200); 
			}
		} 
	}


  
	
	public function update_status(Request $request) { 
		$order = Order::find($request->id);
		$order->status = $request->order_status;
		$order->save();
		if ( $request->notify  == 1 ) { 

		}
		$returnData = array(
			'status' => 'success',
            'message' => 'Status Updated.'
        );
        return response()->json($returnData, 200);	  
	}
	

	public function show($id) {
		$order = Order::find($id);
		$page_title = 'Order Information';
		$currency = $this->settings->currency->symbol;
		$total = $order->ordered_products[0]->sum_items($order->id)->items_total;
		$currency =  Helper::getCurrency();
		return view('account.orders.show',compact('currency','order','order','page_title','total'));
	}


}