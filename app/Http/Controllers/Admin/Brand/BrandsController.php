<?php

namespace App\Http\Controllers\Admin\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;
use App\User;



class BrandsController extends Controller
{
    //

    
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function index()
    {    
        $brands =  Brand::orderBy('brand_name','asc')->get();
        return view('admin.brands.index',compact('brands'));
	}
	

	 public function create()
    {   
		User::canTakeAction(2);
		return view('admin.brands.create');
    }
	
	public function store(Request $request)
    {   
		$this->validate($request, [
			'brand_name' => 'required|unique:brands',
		]);
		Brand::Insert($request->except('_token'));
		$flash = app('App\Http\Flash');
		$flash->success("Success","Created");
		return redirect()->route('brands.index') ; 
	}
	
	
	public function edit(Request $request ,$id)
    {   
	}
	
	
	public function destroy(Request $request,$id)
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
		Brand::destroy($request->selected);  	
		$flash = app('App\Http\Flash');
		$flash->success("Success","Deleted");
		return redirect()->back();
    		 
	}
	
	
}


