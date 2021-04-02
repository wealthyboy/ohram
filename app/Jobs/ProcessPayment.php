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
use App\OrderedProduct;
use App\Http\Helper;
use App\Shipping;
use App\ProductVariation;
use App\SystemSetting;
use App\Mail\OrderReceipt;







class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProductVariation $product_variation, SystemSetting $settings, TransactionLog $transactionLog, Helper $helper, OrderedProduct $ordered_product,Order $order,Shipping $shipping)
    {
        //query 

        $transactions = $transactionLog::has("pending_carts")->where('status', "Awaiting Payment Confirmation")->get();

        $prudid = 22125466;

        $settings = $settings::first();

		foreach ($transactions as $transaction_log) {
            $parameters = array(
                "productid"=>$prudid,
                "transactionreference"=>$transaction_log->transaction_reference,
                "amount"=> $transaction_log->approved_amount * 100,
             ); 
             
             $ponmo = http_build_query($parameters);
                 
             $url = "https://webpay.interswitchng.com/collections/api/v1/gettransaction.json?" . $ponmo; // json
             $mac    = "AGYclEQngemQDoUCSJBGzeYro8Keu8rVLVjR1aCsR0Mk0TaAjgiI3UnU1aV9a0fQ96KcGLPDOrHOy3oSDjnUMZEo2NJFFXu1hpnYnwcTrJg1RJdc7fo4bvlzHp8a97DX";
             $hashv =$prudid . $transaction_log->transaction_reference . $mac;
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
                \Log::error($ch);
             }
             else 
             {  
                 // Show me the result
                $json = json_decode($data, TRUE);
                curl_close($ch); 
 
                //END CURL SESSION///////////////////////////////
                if(isset($json["MerchantReference"])){

                    if ( $json['ResponseCode'] == '00' ) {
                            $transaction_log->transaction_reference = $json["MerchantReference"];
                            $transaction_log->approved_amount = $json["Amount"] / 100;
                            $transaction_log->response_description = $json["ResponseDescription"];
                            $transaction_log->status =  $json['ResponseCode'] == '00' ? 'Successfull' : 'Failed';
                            $transaction_log->response_code =  $json['ResponseCode'];
                            $transaction_log->response_date_time =  $json['TransactionDate'];
                            $transaction_log->status = "Approved";

                            $transaction_log->save();

                            \Log::info("Transction ok");

                            //Log the order

                            $order->user_id = optional($transaction_log->user)->id;
                            $order->address_id     =  optional(optional($transaction_log->user)->active_address)->id;
                            $order->coupon         =  null;
                            $order->status         = 'Processing';
                            $order->shipping_id    =  $transaction_log->shipping_id;
                            $order->shipping_price =  optional($shipping::find($transaction_log->shipping_id))->converted_price;
                            $order->currency       =  $transaction_log->currency;
                            $order->invoice        =  "INV-".date('Y')."-".rand(10000,39999);
                            $order->payment_type   =  'online';
                            $order->order_type     =  'online';
                            $order->total          =  $transaction_log->approved_amount;
                        // $order->ip           = $request->ip();
                        //  $order->user_agent   = $request->server('HTTP_USER_AGENT');
                            $order->save();
                            foreach ( $transaction_log->pending_carts   as $cart){
                                $insert = [
                                    'order_id'=>$order->id,
                                    'product_variation_id'=>$cart->product_variation_id,
                                    'quantity'=>$cart->quantity,
                                    'status'=>"Processing",
                                    'price'=>$cart->ConvertCurrencyRate($cart->price),
                                    'total'=>$cart->ConvertCurrencyRate($cart->quantity * $cart->price),
                                    'created_at'=>now()
                                ];
                                OrderedProduct::Insert($insert);
                                $product_variation = ProductVariation::find($cart->product_variation_id);
                                $qty  = $product_variation->quantity - $cart->quantity;
                                $product_variation->quantity =  $qty < 1 ? 0 : $qty;

                                $product_variation->save();
                                $cart->status = "Paid & Confirmed";
                                $cart->save();
                            }
                            $admin_emails = explode(',',$settings->alert_email);
                            $symbol = $transaction_log->currency;

                            try {
                                $when = now()->addMinutes(5);
                                \Mail::to(optional($transaction_log->user)->email)
                                ->bcc($admin_emails[0])
                                ->send(new OrderReceipt($order,$settings,$symbol));
                            } catch (\Throwable $th) {
                                //throw $th;
                            }
                            
                    }
                    
                    \Log::info("Transction ok");

                }else{
                    $transaction_log->response_description = $json["ResponseDescription"];
                    $transaction_log->status =  'Transaction incomplete';
                    $transaction_log->response_code =  $json['ResponseCode'];
                    $transaction_log->response_date_time =  $json['TransactionDate'];
                    $transaction_log->save();
                    //Mail the user 

                    \Log::info("Transction failed");

                }

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
