<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\TransactionLog;
use Throwable;

use App\Order;
use App\Cart;
use App\User;


use App\OrderedProduct;
use App\Http\Helper;
use App\Shipping;
use App\ProductVariation;
use App\SystemSetting;
use App\Mail\OrderReceipt;







class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $transaction_log;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transaction_log)
    {
        $this->transaction_log  = $transaction_log;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProductVariation $product_variation, SystemSetting $settings, Helper $helper, OrderedProduct $ordered_product,Order $order,Shipping $shipping)
    {
        //query 
        $settings = $settings::first();

		$prudid = 22125466;
        $carts    =  Cart::where('transaction_id', $this->transaction_log->id)->get();
        $tr_log = TransactionLog::find($this->transaction_log->id);
        $user     =  User::findOrFail($this->transaction_log->user_id);        

        $parameters = array(
               "productid"=>$prudid,
               "transactionreference"=>$this->transaction_log->transaction_reference,
               "amount"=> $this->transaction_log->approved_amount * 100,
            ); 
			
			$ponmo = http_build_query($parameters);
				
			$url = "https://webpay.interswitchng.com/collections/api/v1/gettransaction.json?" . $ponmo; // json
			$mac    = "AGYclEQngemQDoUCSJBGzeYro8Keu8rVLVjR1aCsR0Mk0TaAjgiI3UnU1aV9a0fQ96KcGLPDOrHOy3oSDjnUMZEo2NJFFXu1hpnYnwcTrJg1RJdc7fo4bvlzHp8a97DX";
			$hashv =$prudid . $this->transaction_log->transaction_reference . $mac;
			$thash = hash('sha512',$hashv);
			//note the variables appended to the url as get values for these parameters
			$headers = array(
				"GET /HTTP/1.1",
				"Host: webpay.interswitchng.com",
				"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
				"Accept-Language: en-us,en;q=0.5",
				"Keep-Alive: 300",
				"Connection: keep-alive",
					"Hash: " . $thash 
							);
				
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
			curl_setopt($ch, CURLOPT_POST, false );
			
			
			$data = curl_exec($ch);  //EXECUTE CURL STATEMENT///////////////////////////////
			$json = null;
			if (curl_errno($ch)) 
			{ 
				dd($ch);
			}
			else 
			{  
				// Show me the result
                $json = json_decode($data, TRUE);
                curl_close($ch); 

                
                //END CURL SESSION///////////////////////////////
                if( isset($json["ResponseCode"]) &&  $json['ResponseCode'] == '00' ){

                    $tr_log->transaction_reference = $json["MerchantReference"];
                    $tr_log->approved_amount = $json["Amount"] / 100;
                    $tr_log->response_description = $json["ResponseDescription"];
                    $tr_log->status =  $json['ResponseCode'] == '00' ? 'Successfull' : 'Failed';
                    $tr_log->response_code =  $json['ResponseCode'];
                    $tr_log->response_date_time =  $json['TransactionDate'];
                    $tr_log->save();
                    $order->user_id = $this->transaction_log->user_id;
                    $order->address_id     =  optional($user->active_address)->id;
                    $order->coupon         =  $this->transaction_log->coupon;
                    $order->status         = 'Processing';
                    $order->shipping_id    =  $this->transaction_log->shipping_id;
                    $order->shipping_price =  $this->transaction_log->shipping_price;
                    $order->currency       =  $this->transaction_log->currency;
                    $order->invoice        =  "INV-".date('Y')."-".rand(10000,39999);
                    $order->payment_type   =  'interswitch - online';
                    $order->total          =  $this->transaction_log->approved_amount;
                    $order->save();
                
                    \Log::info($carts);

                    if ($carts->count()){
                        foreach ( $carts   as $cart ){
                            $OrderedProduct = new OrderedProduct;
                            $price = $cart->sale_price ?? $cart->price;
                            $quantity = $cart->quantity * $price;
                            $OrderedProduct->order_id = $order->id;
                            $OrderedProduct->product_variation_id = $cart->product_variation_id;
                            $OrderedProduct->quantity = $cart->quantity;
                            $OrderedProduct->status = "Processing";
                            $OrderedProduct->price = $cart->ConvertCurrencyRate($price, $this->transaction_log->rate);
                            $OrderedProduct->total = $cart->ConvertCurrencyRate($quantity, $this->transaction_log->rate);
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
                        $symbol = $this->transaction_log->currency;
                        
                        try {
                            $when = now()->addMinutes(5); 
                            \Mail::to($user->email)
                            ->cc("jacob.atam@gmail.com")
                            ->bcc($admin_emails[0])
                            ->send(new OrderReceipt($order,$this->settings,$symbol));
                        } catch (\Throwable $th) {
                            Log::info("Mail error :".$th);
                        }
                    }


                }else{
                    $tr_log->response_description = $json["ResponseDescription"];
                    $tr_log->status =  'Transaction incomplete';
                    $tr_log->response_code =  $json['ResponseCode'];
                    $tr_log->response_date_time =  $json['TransactionDate'];
                    $tr_log->save();
                    \Log::error("Transaction Failed");
                }
               





			}
        

        //
    }


    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
       \Log::error($exception);        
    }



    public function logOrder(){

    }
}
