<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Information;
use Auth;
use App\Http\Helper;
use App\User;
use Illuminate\Validation\Rule;
use App\PageBanner;
use App\Attribute;
use App\Http\Resources\CommentResource;

class BlogController extends Controller
{
    //where we display art collection
	
	public function __construct()
    {	  
	    //$this->middleware('admin'); 
    }

	
	public function  index(Request $request)  {
		$posts = Information::where('blog',true)->get(); 
		$blog_image = PageBanner::where('page_name','blog')->first();
	    return view('blog.index',compact('posts','blog_image'));
	}

	public function  create(Request $request)  {
		//User::canTakeAction(2);
	    return view('blog.create');
	}

	public function  store(Request $request) 
	{

        $this->validate($request, [
		   'comment'   => 'required',
		   'author' => 'required',
		   'blog_id' => 'required|exists:information,id',
		]);
		
		$blog = Information::find($request->blog_id);

		$comment = $blog->comments()->create([
			'body' => $request->comment,
			'author' => $request->author,
			'email' => $request->email,
		]);

		if ($comment){
			return CommentResource::collection($blog->comments);
		}

		return response()->json([
			'message' => [
				'errors' => "Failed to create content",
				'code' => 400
			]
		],400);
	}

	public function  show(Request $request,Information $blog)  
	{   
		$page_title = $blog->title;
		$blog_image = PageBanner::where('page_name','blog')->first();
		return view('blog.show',compact('blog','blog_image','page_title'));
	}

	public function  tag(Request $request,$tag_id)  
	{   
		$attribute = Attribute::find($tag_id);
		$page_title = 'Bold -' .  $attribute->name. ' | Ohram'; 
        $posts = $attribute->information;
		$blog_image = PageBanner::where('page_name','blog')->first();
		return view('blog.index',compact('posts','blog_image','page_title'));
	}

	
	 
	  





















	
}
