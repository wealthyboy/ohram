<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Http\Flash;
use App\State;


use Illuminate\Support\Facades\Validator;
use App\Permission;


class UsersController extends Controller
{
	
	
    public function __construct()
    {
      // $this->middleware('auth');
        $this->middleware('admin'); 
    }
	/* display all users in the database */
	public function index(Request $request){
	    $users = User::admin()->get();	 	  
	    return view('admin.users.index', compact('users'));  
    }
	
	/* display all users in the database */
	public function edit(Request $request,$id){
		$user = User::find($id);
		$states = State::all();
		$permissions =\DB::table('permissions')->get();
	    return view('admin.users.edit', compact('states','permissions','user'));  
	}
	

	public function logout(Request $request)
    {
        \Auth::logout();
		return redirect('/admin/login');
    }
	

	public function show($id){
		$user = User::find($id);
		return view('admin.customers.show',compact('user','permissions'));
	}

    
	public function create(Request $request){
		//User::canTakeAction(2);
		$states = State::all();
		$permissions =Permission::get(); 
		return view('admin.auth.register',compact('permissions','states')); 	
    }
	

	 protected function update($id, Request $request)
    {      
		 
		$this->validate($request, [
			'first_name' => 'required|max:255',
			'email'        => 'required|email|max:255',
		]);

		$user  = User::find($id);
		$user->name =$request->first_name;
		$user->last_name =$request->last_name;
		$user->email=$request->email;
		$user->password = $request->has('password') ? bcrypt($request->password) : $user->password ;
		$user->save();

		//dd($request->permission_id);

		$user->users_permission()->update([
			'permission_id'=>$request->permission_id
		]);

		$user->addresses()->create([
			'first_name'=>$request->first_name,
			'last_name'=>$request->last_name,
			'address'=>$request->address,
			'city'=>$request->city,
			'state_id'=>1,
		]);
		
		return redirect('/admin/users');	  
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
				
		User::destroy($request->selected);
		return redirect()->back();
	}
	 
	public function delete(Request $request)
	{
		User::canTakeAction(5);
	    if ($request->isMethod('post')) {
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
		   User::destroy($request->selected);
		   $flash = app('App\Http\Flash');
		   $flash->success("Success","Users Deleted");
		   return redirect()->back(); 
		}
		
		User::destroy($request->selected);
		$flash = app('App\Http\flash');
		$flash->success("Success","User Deleted");
		return redirect()->back();	  
	}
	  
	  
	
	
	 
}
