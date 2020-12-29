<?php

namespace App\Http\Controllers\Account;


use App\Address;


use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Newsletter\Contracts\NewsletterContract;
use App\Services\Newsletter\Exceptions\UserAlreadySubscribedException;




class AccountController extends Controller
{
   
	     /**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct(NewsletterContract $newsletter)
        {
            $this->newsletter = $newsletter;
			$this->middleware('auth');
			$this->settings =  \DB::table('system_settings')->first();
		}
		
		public function index(Request $request){
			
		   //Get The Current LoggedIn user Id
			$page_title = 'Account Information';
			$settings =  $this->settings;
			$user = $request->user();
		    $active = true;
		    return view('account.index',compact('active','page_title','user','settings'));
		   
		}
	


		public function update(Request $request){

			$user = $request->user();

				$this->validate($request, [
					'first_name'     => 'required|max:30',
					'last_name'      => 'required|max:30',
					'phone_number'   => 'required|numeric|min:11|unique:users,phone_number,'.$user->id,
				]); 

				
				try {
					$this->newsletter->subscribe(
						config('services.mailchimp.list'),
						$request->user()->email
					);
				} catch (UserAlreadySubscribedException $e) {
							//dd($e->getMessage());
				}
				
				$user->last_name                     = $request->last_name;
				$user->name                          = $request->first_name;
				$user->phone_number                  = $request->phone_number;
				//$user->mailing_list                  = $request->mailing_list;
				$user->save();
		        return redirect()->back()->with('status','Your details have been updated.');
			 
		}


		
		public function updatePassword(Request $request){
			//
			if($request->isMethod('post')){
				$validator = Validator::make($request->all(), [
					'old_password' => 'required|string|max:255',
					'password' => 'bail|required|string|min:6',
				]);
			   
			   if (Hash::check($request->old_password, $request->user()->password)) {
					$request->user()->fill([
					  'password' => Hash::make($request->password)
					])->save();
				   return redirect()->back()->with('status', 'Password updated!');
			   }  else { 
					 $validator->after(function ($validator) {
						$validator->errors()->add('password', 'Your old password does not match our records.');
					});
				  return redirect()->back()->withErrors($validator);
				} 
				return false;
			}
			$page_title = 'Change Password';
			$user = User::find(Auth::id());
	
			return view('account.change_password',compact('user','page_title'));
		}
		
	     
}
