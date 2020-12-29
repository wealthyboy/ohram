<?php

namespace App\Http\Controllers\CurrencySwitcher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Currency;

class CurrencySwitcherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {

        $currency = Currency::find($id);
        $rate = [ 'rate' => optional($currency->rate)->rate,'country' =>$currency->country, 'symbol' => $currency->symbol ];
        $request->session()->put('rate', json_encode(collect($rate)));
        $request->session()->put('switch', 'on');

        return back();
    }

  
}
