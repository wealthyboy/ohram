<?php

namespace App\Http\Controllers\WebHook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Order;
use App\OrderedProduct;
use App\Cart;
use App\Currency;
use App\Shipping;
use App\ProductVariation;
use App\Voucher;
use App\Mail\OrderReceipt;
use App\SystemSetting;



class WebHookController extends Controller
{

	public  $settings;

	public function __construct()
	{
		$this->settings =  SystemSetting::first();
    }


    public function payment(Request $request,Order $order)
    {   
        // if ( !array_key_exists('x-paystack-signature', $_SERVER) ) {
        //     return;
        // } 

       // Log::info($request->all());



        try {
            $inter = $request->all();
            Log::info($inter['txref']);


            $input    =  $request->data['metadata']['custom_fields'][0];
            $user     =  User::findOrFail($input['customer_id']);

            $carts    =  Cart::find($input['cart']);

            if (null == $carts ){
               return  http_response_code(200);
            }

            // foreach ($carts as $cart) {
            //     if ( $cart->quantity  < 1){
            //         $cart->delete();
            //     }
            // }

            $currency =  Currency::where('iso_code3',$request->data['currency'])->first();
        
            $order->user_id = $user->id;
            $order->address_id     =  optional($user->active_address)->id;
            $order->coupon         =  $input['coupon'] !== 0  ? $input['coupon'] : null;
            $order->status         = 'Processing';
            $order->shipping_id    =  $input['shipping_id'];
            $order->shipping_price =  optional(Shipping::find($input['shipping_id']))->converted_price;
            $order->currency       =  optional($currency)->symbol ?? '₦';
            $order->invoice        =  "INV-".date('Y')."-".rand(10000,39999);
            $order->payment_type   =  $request->data['authorization']['channel'];
            $order->total          =  $input['total'];
            $order->ip             =  $request->data['ip_address'];
            $order->save();

            \Log::info($carts);


            foreach ( $carts   as $cart){
                
                $OrderedProduct = new OrderedProduct;
                $OrderedProduct->order_id = $order->id;
                $OrderedProduct->product_variation_id = $cart->product_variation_id;
                $OrderedProduct->quantity = $cart->quantity;
                $OrderedProduct->status = "Processing";
                $OrderedProduct->price = $cart->ConvertCurrencyRate($cart->price);
                $OrderedProduct->total = $cart->ConvertCurrencyRate($cart->quantity * $cart->price);
                $OrderedProduct->created_at = \Carbon\Carbon::now();
                $OrderedProduct->save();
                //\Log::info($ord);
                $product_variation = ProductVariation::find($cart->product_variation_id);
                $qty  = $product_variation->quantity - $cart->quantity;
                $product_variation->quantity =  $qty < 1 ? 0 : $qty;
                $product_variation->save();
                //Delete all the cart
                $cart->delete();
            }
            $admin_emails = explode(',',$this->settings->alert_email);
            $symbol = optional($currency)->symbol  ;
            
            try {
                 $when = now()->addMinutes(5); 
                 \Mail::to($user->email)
                ->bcc($admin_emails[0])
                 ->send(new OrderReceipt($order,$this->settings,$symbol));
             } catch (\Throwable $th) {
                Log::info("Mail error :".$th);
            }

            //delete cart
            if ( $input['coupon'] ) {
                $code = trim($input['coupon']);
                $coupon =  Voucher::where('code', $input['coupon'])->first();
                if(null !== $coupon && $coupon->type == 'specific'){
                    $coupon->update(['valid'=>false]);
                }
            }
        } catch (\Throwable $th) {
            Log::info("Custom error :".$th);

        }

        return http_response_code(200);
        
        
    }
    

    // public function payment(Request $request,OrderedProduct $ordered_product,Order $order)
    // {    

    //     \Log::info($request->all());
    //     return;
    //     // if ( !array_key_exists('x-paystack-signature', $_SERVER) ) {
    //     //     return;
    //     // } 

 
    //     try {
            
    //         $input    =  $request->all();
    //         $user     =  User::findOrFail($i);
    //         $carts    =  Cart::find($input['cart']);
    //         $currency =  Currency::where('iso_code3',$request->data['currency'])->first();
        
    //         $order->user_id = $user->id;
    //         $order->address_id     =  optional($user->active_address)->id;
    //         $order->coupon         =  $input['coupon'];
    //         $order->status         = 'Processing';
    //         $order->shipping_id    =  $input['shipping_id'];
    //         $order->shipping_price =  optional(Shipping::find($input['shipping_id']))->converted_price;
    //         $order->currency       =  optional($currency)->symbol;
    //         $order->invoice        =  "INV-".date('Y')."-".rand(10000,39999);
    //         $order->payment_type   =  $request->data['authorization']['channel'];
    //         $order->total          =  $input['total'];
    //         $order->ip             =  $request->data['ip_address'];
    //         $order->save();
    //         foreach ( $carts   as $cart){
    //             $insert = [
    //                 'order_id'=>$order->id,
    //                 'product_variation_id'=>$cart->product_variation_id,
    //                 'quantity'=>$cart->quantity,
    //                 'status'=>"Processing",
    //                 'price'=>$cart->ConvertCurrencyRate($cart->sale_price) ?? $cart->ConvertCurrencyRate($cart->price),
    //                 'total'=>$cart->ConvertCurrencyRate($cart->quantity * $cart->price),
    //                 'created_at'=>\Carbon\Carbon::now()
    //             ];
    //             OrderedProduct::Insert($insert);
    //             $product_variation = ProductVariation::find($cart->product_variation_id);
    //             $qty  = $product_variation->quantity - $cart->quantity;
    //             $product_variation->quantity =  $qty < 1 ? 0 : $qty;
    //             $product_variation->save();
    //             //Delete all the cart
    //             $cart->remember_token = null;
    //             $cart->status = '';
    //             $cart->save();
    //         }
    //         $admin_emails = explode(',',$this->settings->alert_email);
    //         $symbol = optional($currency)->symbol;
            
    //         // try {
    //         //     $when = now()->addMinutes(5);
    //         //     \Mail::to($user->email)
    //         //     ->bcc($admin_emails[0])
    //         //     ->send(new OrderReceipt($order,$this->settings,$symbol));
    //         // } catch (\Throwable $th) {
    //         //     //throw $th;
    //         //     Log::info($th);
    //         // }

    //         //delete cart
    //         if ( $input['coupon'] ) {
    //             $code = trim($input['coupon']);
    //             $coupon =  Voucher::where('code', $input['coupon'])->first();
    //             if(null !== $coupon && $coupon->type == 'specific'){
    //                 $coupon->update(['valid'=>false]);
    //             }
    //         }
    //     } catch (\Throwable $th) {
    //         Log::info($th);
    //     }

    //     return http_response_code(200); 
    // }

    public function gitHub(){
        $output =  shell_exec('sh /home/forge/ohram.org/deploy.sh');
        Log::info($output);
    }

}
