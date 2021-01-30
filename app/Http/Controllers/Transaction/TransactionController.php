<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TransactionLog;

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
        $request->session()->put('user_id', 'value');
        if (\Cookie::get('cart') !== null) {
            $cookie = \Cookie::get('cart');
            $request->session()->put('user_id', $cookie);

            $tl = TransactionLog::where('token',$cookie)->first();
            if(null != $tl){
                $tl->status = 'Pending';
                $tl->user_id = request()->user()->id;
                $tl->token = $cookie;
                $tl->approved_amount = $request->amount;
                $tl->transaction_reference = $request->txref;
                $tl->product_id = $request->productId;

                $tl->save();
                return response(null,200);
            }

            $transaction_log->status = 'Pending';
            $transaction_log->user_id = request()->user()->id;
            $transaction_log->token = $cookie;
            $transaction_log->approved_amount =  $request->amount;
            $transaction_log->transaction_reference = $request->txref;
            $transaction_log->product_id = $request->productId;
            $transaction_log->save();
            return response(null,200);
        
        }
        
        return response(null,404);
 
    }


    public function confirm(Request $request)
    {
        
        $prudid = 1076;
			
        $parameters = array(
            "productid"=>$request->productId,
            "transactionreference"=>$request->reqRef,
            "amount"=>$request->amount
            ); 
			
			$ponmo = http_build_query($parameters);
				
			$url = "https://sandbox.interswitchng.com/collections/api/v1/gettransaction.json?" . $ponmo; // json
			$mac    = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";
			$hashv =$prudid . $request->reqRef . $mac;
			$thash = hash('sha512',$hashv);
			//note the variables appended to the url as get values for these parameters
			$headers = array(
				"GET /HTTP/1.1",
				"Host: sandbox.interswitchng.com",
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
				Log::info($ch);
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
                        $transaction_log->transaction_reference = $json["MerchantReference"];
                        $transaction_log->approved_amount = $json["Amount"] / 100;
                        $transaction_log->response_description = $json["ResponseDescription"];
                        $transaction_log->status =  $json['ResponseCode'] == '00' ? 'Successfull' : 'Failed';
                        $transaction_log->response_code =  $json['ResponseCode'];
                        $transaction_log->response_date_time =  $json['TransactionDate'];
                        $transaction_log->token = null;
                        $transaction_log->save();
                    }

                }

			    return response()->json(['status' =>$json,'tx' => $transaction_log]);
			}

    }

    
}
