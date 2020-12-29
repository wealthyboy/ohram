<?php

namespace App\Http\Controllers\Dispatch;

use App\User;


use App\Http\Controllers\Controller;


use Illuminate\Http\Request;


class DispatchController extends Controller
{
   
        
	     /**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct(NewsletterContract $newsletter)
        {
			$this->middleware('auth');
			$this->settings =  \DB::table('systemsettings')->first();
		}
		
		public function index(Request $request){
			
		  
		   
	    }
		
		
			   
			   
			 
		  
}
