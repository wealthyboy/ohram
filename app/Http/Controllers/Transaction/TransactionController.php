<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TransactionLog;
use App\Cart;
use App\Http\Helper;

use App\Jobs\ProcessPayment;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendAwaitingPayment;




class TransactionController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function log(Request $request)
    {   
        $transaction_log = new TransactionLog;

        \Log::info($request->all());
        
        $request->session()->put('user_id', 'value');
        $cookie = \Cookie::get('cart');

        try {
            
        if ( $cookie !== null ) {
            $request->session()->put('user_id', $cookie);
            $tl = TransactionLog::where('token',$cookie)->first();
            $carts =  Cart::all_items_in_cart();

            

            $transaction_log->product_id = $request->productId;
            $rate  = Helper::rate();
            

            $transaction_log->status = 'Awaiting Payment Confirmation';
            $transaction_log->user_id = request()->user()->id;
            $transaction_log->token = $cookie;
            $transaction_log->shipping_id = $request->shipping_id;
            $transaction_log->currency = $request->currencyCode;
            $transaction_log->coupon = $request->coupon;
            $transaction_log->approved_amount =  $request->amount;
            $transaction_log->shipping_price =  $request->shipping_price;
            $transaction_log->transaction_reference = $request->txref;
            $transaction_log->product_id = $request->productId;
            $transaction_log->rate = $rate  ? $rate->rate : 1;
            $transaction_log->save();
            //$transaction_log->carts()->sync($carts->pluck('id')->toArray());

            foreach ( $carts   as $cart){
                $cart->transaction_id = $transaction_log->id;
                $cart->save();
                //return response(null,200);
            }

            $delay = now()->addMinutes(10);
            Notification::route('mail', 'ohraminternational@gmail.com')
            ->notify((new SendAwaitingPayment())->delay($delay));
            Notification::route('mail', 'jacob.atam@gmail.com')
            ->notify((new SendAwaitingPayment())->delay($delay));
            
           // ProcessPayment::dispatch()->delay(now()->addMinutes(10));
            return response($transaction_log,200);
        }
        
        return response(null,404);
        } catch (\Throwable $th) {
            //throw $th;
            \Log::error($th);
        }


 
    }

    







    public function confirm(Request $request)
    {
        
        $prudid = 22125466;
			
        $parameters = array(
            "productid"=>$request->productId,
            "transactionreference"=>$request->reqRef,
            "amount"=>$request->amount
            ); 
			
			$ponmo = http_build_query($parameters);
				
			$url = "https://webpay.interswitchng.com/collections/api/v1/gettransaction.json?" . $ponmo; // json
			$mac    = "AGYclEQngemQDoUCSJBGzeYro8Keu8rVLVjR1aCsR0Mk0TaAjgiI3UnU1aV9a0fQ96KcGLPDOrHOy3oSDjnUMZEo2NJFFXu1hpnYnwcTrJg1RJdc7fo4bvlzHp8a97DX";
			$hashv =$prudid . $request->reqRef . $mac;
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
				\Log::info($ch);
			}
			else 
			{  
				// Show me the result
				$json = json_decode($data, TRUE);
                curl_close($ch);    //END CURL SESSION///////////////////////////////
                $cookie = \Cookie::get('cart');


		       if ($cookie !== null) {
                    $transaction_log = TransactionLog::where('token',$cookie)->first();
                    if(null != $transaction_log){
                        if(isset($json["MerchantReference"])){
                            $transaction_log->transaction_reference = $json["MerchantReference"];
                            $transaction_log->approved_amount = $json["Amount"] / 100;
                            $transaction_log->response_description = $json["ResponseDescription"];
                            $transaction_log->status =  $json['ResponseCode'] == '00' ? 'Successfull' : 'Failed';
                            $transaction_log->response_code =  $json['ResponseCode'];
                            $transaction_log->response_date_time =  $json['TransactionDate'];
                            $transaction_log->save();
                        }else{
                            $transaction_log->response_description = $json["ResponseDescription"];
                            $transaction_log->status =  'Transaction incomplete';
                            $transaction_log->response_code =  $json['ResponseCode'];
                            $transaction_log->response_date_time =  $json['TransactionDate'];
                            $transaction_log->save();
                        }
        
                    }

                }

			    return response()->json(['status' =>$json,'tx' => $transaction_log]);
			}

    }

    
}
