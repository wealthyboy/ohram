<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Review;
use App\PageBanner;


class ReviewsController extends Controller
{
    //where we display art collection
	
	public $reviews;
	
	public function __construct()
    {	  
	    $this->middleware('admin');	
    }
	
	public function  index()  
	{ 
	   $reviews = Review::all();
	   $review_image = PageBanner::where('page_name','reviews')->first();
	   return view('admin.reviews.index',compact('reviews','review_image'));
	}

	
	public function destroy(Request $request) 
	{ 
		$rules = array(
			'_token' => 'required',
		);
		// dd(get_class(\new Validator));
		$validator = \Validator::make($request->all(),$rules);
		
		if ( empty ( $request->selected)) {
			$validator->getMessageBag()->add('Selected', 'Nothing to Delete');    
			return \Redirect::back()
						->withErrors($validator)
						->withInput();
		}
				
		Review::destroy($request->selected);
		return redirect()->back();
	}
	
}