<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Information;
use Auth;
use App\Http\Helper;
use App\User;
use Illuminate\Validation\Rule;


class InformationController extends Controller
{
    //where we display art collection
	
	public function __construct()
    {	  
	    $this->middleware('admin', ['except' => ['show']]); 
    }
	
	public function  index(Request $request)  {
		$pages = Information::where('blog',false)->get(); 
	    return view('admin.information.index',compact('pages'));
	}

	public function  create(Request $request)  {
		User::canTakeAction(2);
		$pages = Information::parents()->get(); 
	    return view('admin.information.create',compact('pages'));
	}

	public function  store(Request $request)  {

		if ($request->isMethod('post') ) {

			$this->validate($request, [
					'title' => 'required|unique:information|max:100',
		   ]);
		   $info = new Information;
		   $info->title=$request->title;
		   $info->description=$request->description;
		   $info->sort_order=$request->sort_order;
		   $info->custom_link=$request->custom_link;
		   $info->image=$request->image;
		   $info->x_pos = $request->x_pos;
           $info->y_pos  = $request->y_pos;
		   $info->same_page =$request->same_page == 'yes'? true : false;
		   $info->parent_id=$request->parent_id;
		   $info->slug= str_slug($request->title);
		   $info->blog= false;
		   $info->save();
		   return redirect()->route('pages.index')->with('status','created');
		}  
	}


	public function update(Request $request,$id){

		$page = Information::find($id);
		if( $request->filled('parent_id') ) {
			$this->validate($request,[
				'title'=>[
					'required',
						Rule::unique('information')->where(function ($query) use ($request) {
						$query->where('parent_id', '=', $request->parent_id);
						})->ignore($id)
						
					],
			]);
		} 
		$this->validate($request, [
			'title'=>[
			'required',
					Rule::unique('information')->ignore($id),	
				],
		]);
		$page->title=$request->title;
		$page->description=$request->description;
		$page->slug= str_slug($request->title);
		$page->sort_order=$request->sort_order;
		$page->custom_link=$request->custom_link;
		$page->image  =  $request->image;
		$page->x_pos = $request->x_pos;
        $page->y_pos  = $request->y_pos;
		$page->same_page =$request->same_page == 'yes'? true : false;
		$page->parent_id=$request->parent_id;
		$page->blog= false;
		$page->save();
		return redirect()->route('pages.index')->with('status','created');
	}

	
	public function  edit(Request $request,$id)  
	{
		User::canTakeAction(4);
		$information = Information::find($id);
		$pages = Information::where('blog',false)->get(); 
	    return view('admin.information.edit',compact('information','pages'));
	}


	public function  show(Request $request,Information $information)  
	{
		$page_title = $information->name;
		return view('pages.index',compact('information','page_title'));
	}

	public function  destroy(Request $request,$id)  
	{
		 
        User::canTakeAction(5);
		$rules = array(
			'_token' => 'required',
		);
		$validator = \Validator::make($request->all(),$rules);
		if ( empty ( $request->selected)) {
			
			$validator->getMessageBag()->add('Selected', 'Nothing to Delete');    
			return \Redirect::back()
						->withErrors($validator)
						->withInput();
		}
		Information::destroy($request->selected);
		return redirect()->back()->with('status','removed');
	}
	 
	  





















	
}
