<?php

namespace App\Http\Controllers\Thankyou;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\SystemSetting;



class ThankYouCtrl  extends Controller
{
   
        
	     /**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
			//$this->middleware('auth');
			$this->settings =  SystemSetting::first();

		}
		
		public function index() { 
		
		  $settings =   $this->settings;
		  return view('thankyou.index',compact('settings'));
		}
		
		
}