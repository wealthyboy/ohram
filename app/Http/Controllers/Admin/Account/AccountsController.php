<?php

namespace App\Http\Controllers\Admin\Account;

use Illuminate\Http\Request;
use App\Product;
use App\OrderedProduct;
use App\Http\Helper;
use App\Order;
use Carbon\Carbon;
use App\ProductSize;

use App\Http\Controllers\Controller;
use App\User;
use App\SystemSetting;
use App\ProductVariation;

class AccountsController extends Controller 
{
    
    public $settings;

    public function __construct()
    {
        $this->settings = SystemSetting::first();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 

        //
        User::canTakeAction(1);

        // if($request->has('from_date')){
        //     $graph_orders = OrderedProduct::select('id', 'created_at')
        //     ->get()
        //     ->groupBy(function($date) {
        //         return Carbon::parse($date->created_at)->format('m'); // grouping by months
        //     });

        //     $from_date =  Helper::getDate($request->from_date).' 00:00:00'; 
        //     $to_date =  Helper::getDate($request->to_date).' 23:59:59';  
        //     $ordered_products =  \DB::select('SELECT * FROM `ordered_product` WHERE created_at >= ? AND created_at <= ? ', [$from_date,$to_date]);
        //     $ordered_products = OrderedProduct::hydrate($ordered_products);

        //     $no_of_products_left =  \DB::select('SELECT SUM(product_sizes.quantity) as items_total FROM `product_sizes`  WHERE price is not null  AND created_at >= ? AND created_at <= ? ', [$from_date,$to_date]);
        //     $no_of_products_left=  ProductSize::hydrate($no_of_products_left)[0]->items_total;

        //     $total_sales =  \DB::select('SELECT SUM(orders.total) as items_total FROM `orders` WHERE created_at >= ? AND created_at <= ? ', [$from_date,$to_date]);
        //     $total_sales = Order::hydrate($total_sales)[0];
        //     $p_total =  \DB::select('SELECT SUM(product_sizes.price*product_sizes.quantity) as items_total FROM `product_sizes` WHERE  price is not null  AND created_at >= ? AND created_at <= ? ', [$from_date,$to_date]);
        //     $p_total =  ProductSize::hydrate($p_total)[0];
        //     return view('admin.account.index',compact(
        //         'no_of_products_left',
        //         'no_of_products',
        //         'ordered_products',
        //         'total_sales',
        //         'graph_orders' ,
        //         'p_total'
        //     ));
        // }
        // // $graph_orders = OrderedProduct::select('id', 'created_at')
        // // ->get()
        // // ->groupBy(function($date) {
        // //     return Carbon::parse($date->created_at)->format('m'); // grouping by months
        // // });

        $todays_orders = OrderedProduct::select(\DB::raw('SUM(quantity) as qty'))
                                 ->whereDate('created_at', Carbon::today())->get();
        $todays_sales = Order::select(\DB::raw('SUM(total) as items_total'))
                               ->whereDate('created_at', Carbon::today())->get();
        $currency = $this->settings->default_currency->symbol;
        $todays_sales = null !== $todays_sales ? $todays_sales[0] : null;
        $todays_orders = null !== $todays_orders ? $todays_orders[0] : null;

        $all_sales_value = Order::select(\DB::raw('SUM(total) as items_total'))->get();
        $all_sales_value = null !== $all_sales_value ? $all_sales_value[0] : null;
        $all_sales = OrderedProduct::select(\DB::raw('SUM(quantity) as qty'))->get();
        $all_sales = null !== $all_sales ? $all_sales[0] : null;

        //products quantities left
    
        $products = Product::get();

        $remaining_products = [];

        $total_value = [];
        foreach ($products as $key => $product) {
            if ($product->has_variants) {

                //Counts the remaining products
                array_push($remaining_products, $product->variants()->select(\DB::raw('SUM(quantity) as quantity'))
                ->where('quantity','>', 0)
                ->Where('quantity','!=', null)
                ->pluck('quantity')->first());
                array_push($total_value, $product->variants()->select(\DB::raw('SUM(quantity * price) as total'))->pluck('total')->first());
            }  else {
                //
                //Counts the remaining products
                array_push($remaining_products, 
                           $product->default_variation()
                           ->select(\DB::raw('SUM(quantity) as quantity')
                        )
                ->where('quantity','>', 0)
                ->Where('quantity','!=', null)
                ->pluck('quantity')->first());
                array_push($total_value, $product->default_variation()->select(\DB::raw('SUM(quantity * price) as total'))->pluck('total')->first());
            } 
        }

        $total_value = array_sum($total_value);

        $remaining_products = array_sum($remaining_products);

        return view('admin.account.index',compact(
            'todays_orders',
            'todays_sales',
            'currency',
            'total_value',
            'all_sales_value',
            'all_sales',
            'remaining_products'
        ));



       
    
    }

   

   


  
}
