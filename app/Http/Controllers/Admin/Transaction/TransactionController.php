<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TransactionLog;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $transactions = TransactionLog::orderBy('created_at','desc')->paginate(10);
        return view('admin.transaction.index',compact('transactions'));
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function requery(Request $request,$id)
    {
        $prudid = 22125466;
        $transaction_log = TransactionLog::find($id);
			
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
				dd($ch);
			}
			else 
			{  
				// Show me the result
                $json = json_decode($data, TRUE);
                curl_close($ch); 

                dd($json);
                
                //END CURL SESSION///////////////////////////////
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


			    return back();
			}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
