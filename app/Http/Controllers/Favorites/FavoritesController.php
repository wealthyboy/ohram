<?php namespace App\Http\Controllers\Favorites;

use Illuminate\Http\Request;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Http\Resources\FavoritesResource;


class FavoritesController  extends Controller
{
  
	     /**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
		    $this->middleware('auth');
		    $this->settings =  \DB::table('system_settings')->first();
			$this->title =  'Favorites';
		}


		public function index(Request $request) 
		{
			$user = $request->user();
			$page_title = " Your wishlist";
			return view('favorites.index',compact('page_title'));
		}

	
	

		

		
		
		
		
		
		



 
}