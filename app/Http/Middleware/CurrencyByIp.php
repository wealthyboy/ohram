<?php

namespace App\Http\Middleware;

use Closure;
use App\Currency;
use App\CurrencyRate;
use App\SystemSetting;
use App\Http\Helper;
use Stevebauman\Location\Location;


 

class CurrencyByIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

        $rate = [];
        $position = '';

        $settings = SystemSetting::first();
        if ($settings->allow_multi_currency){
            if ($request->session()->has('switch')) { 
                return $next($request);
            }

            if ($request->session()->has('userLocation')) {  
                $user_location =  json_decode(session('userLocation'));
                try {
                    if ( $user_location && $user_location->ip !== request()->ip() ) {
                        $position = (new Location())->get(request()->ip());
                        $country = Currency::where('country', $position->countryName)->first();
                        if (!$country){
                            if (in_array( $position->countryName,array_values(Helper::EU()))){
                                $country = Currency::where('country', 'Europe')->first();
                                $rate = [ 'rate' => optional($country->rate)->rate,'country' =>$country->country, 'symbol' => $country->symbol ];  
                            } else {
                                $country = Currency::where('country', 'United States')->first();
                                $rate = [ 'rate' => optional($country->rate)->rate,'country' =>$country->country, 'symbol' => $country->symbol ];
                            }
                        } elseif (null !== $country && $country->country == optional($settings->currency)->country){
                            $rate = [ 'rate' => 1,'country' =>$position->countryName,  'code'=> $country->iso_code3, 'symbol' => $country->symbol ];
                        } else {
                            $rate = [ 'rate' => optional($country->rate)->rate,'country' =>$position->countryName, 'code'=> $country->iso_code3, 'symbol' => $country->symbol ];
                        }
                        $request->session()->put('rate', json_encode(collect($rate)));
                        $request->session()->put('userLocation',  json_encode($position));
                    } 
                } catch (\Throwable $th) {
                    //throw $th;
                }
            
            } else {
                try {
                    $position = (new Location())->get(request()->ip());
                    $country = Currency::where('country', $position->countryName)->first();
                    if (null == $country){
                        if (in_array( $position->countryName,array_values(Helper::EU()))){
                            $country = Currency::where('country', 'Europe')->first();
                            $rate = [ 'rate' => optional($country->rate)->rate,'country' =>$country->name, 'symbol' => $country->symbol ];  
                        } else {
                            $country = Currency::where('country', 'United States')->first();
                            $rate = [ 'rate' => optional($country->rate)->rate,'country' =>$country->name, 'symbol' => $country->symbol ];
                        }
                        
                    } elseif (null !== $country && $country->country == optional($settings->currency)->country){
                        $rate = [ 'rate' => 1,'country' =>$position->countryName, 'code'=> $country->iso_code3,  'symbol' => $country->symbol ];
                    } else {
                        $rate = [ 'rate' => optional($country->rate)->rate,'country' =>$position->countryName, 'code'=> $country->iso_code3,  'symbol' => $country->symbol ];
                    }
                    $request->session()->put('rate', json_encode(collect($rate)));
                    $request->session()->put('userLocation',  json_encode($position));
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        } else {
            $request->session()->forget(['switch', 'rate']);            
        }

        
      
        return $next($request);
    }
}
