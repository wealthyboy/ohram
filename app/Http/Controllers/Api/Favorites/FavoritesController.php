<?php namespace App\Http\Controllers\Api\Favorites;

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
		return FavoritesResource::collection($user->favorites);
	}
	
	public function store(Request $request) 
	{
		$user = $request->user();
		
		$favorite = Favorite::CreateOrDelete($user->id,$request->product_variation_id);
		return FavoritesResource::collection($user->favorites);
	}

	public function destroy(Request $request,$id) 
	{ 
	
		if($request->ajax()){
			$favorite =  Favorite::findOrFail($id);
			if (null !== $favorite){
				$favorite->delete();
				$user = $request->user();
				return FavoritesResource::collection($user->favorites);
			}
			return response()->json([],422);
		}

	}

	
}