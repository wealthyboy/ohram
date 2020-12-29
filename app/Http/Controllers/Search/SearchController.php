<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;

class SearchController extends Controller
{
    //where we display art collection
	
	public function __construct()
    {	  
	  $this->settings =  \DB::table('system_settings')->first();
    }
	

	protected function index(Request $request)  {  
		$filtered_array = $request->only(['q', 'field']);
		if (empty( $filtered_array['q'] ) )  { 
			return redirect('/errors');
		}

		if($request->has('q')){
			$q = 'search?q='.$filtered_array['q'];
			$url['url'] = '/api/search?q='.$filtered_array['q']; 
			$url = collect($url);
			$breadcrumb = 'Search'; 
			return view('products.index',compact('q','breadcrumb','url'));   
		} 
   }

    
      
	     
}
