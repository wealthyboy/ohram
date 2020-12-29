<?php

namespace App\Http\Controllers\Account;


use App\Address;

use App\User;

use Illuminate\Support\Facades\Auth;

use Validator;
use App\State;
use App\Http\Controllers\Controller;
use App\Location;

use Illuminate\Http\Request;

class AddressController extends Controller
{
   
	     /**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
			$this->middleware('auth');
		   // $this->settings =  \DB::table('systemsettings')->first();
		}
		
		public function index(Request $request){//list all addresses
		      //Get The Current LoggedIn user Id
		    $id = Auth::user()->id;
			$page_title = 'Address';
		     //Find his Account Details
			$addresses = User::find($id)->addresses;
			$states = State::all();
			//check to see if the address IS EMPTY			
			return view('account.address.index', compact('states','addresses','page_title') ); 	 
		}

		public function create(){
			$page_title = 'Address';
			$states = State::all();
			return view('account.address.create',compact('states','page_title'));	 
		}


		public function getStates(Request $request,$id){
			$country =  Location::findOrFail($id);
			return view('account.address.includes.states',compact('country'));	 
		}


		public function getShipping(Request $request,$id){
			$location =  Location::findOrFail($id);
			return view('account.address.includes.shipping',compact('location'));	 
		}
		  
		public function store(Request $request){
		     //Get The Current LoggedIn user Id
		    $id = Auth::user()->id;

			if ( $request->isMethod('post') ) { //Check For Submission
			
				$this->validate($request, [
				   'first_name'   => 'required|max:30',
				   'last_name'    => 'required|max:30',
				   'address'      => 'required|max:200',
				   'city'         => 'required|max:100',
				   'state'        => 'required|numeric' ,
				   'country'        => 'required'  

				]);

				$address  = new Address();
				$address->user_id                     =  $id;
				$address->first_name                  =  $request->first_name;
				$address->last_name                   =  $request->last_name;
				$address->address                     =  $request->address;
				$address->address_2                   =  $request->address_2;
				$address->city                        =  $request->city;
				$address->country                     =  Location::find($request->country)->name;
				$address->state                       =  Location::find($request->state)->name;
				$address->state_id                    =  $request->state;
				$address->save();
				$addresses =  Address::where('user_id',\Auth::id())->get();

				//make the first address defau;t
				if ( $addresses->count()  == 1 ) {

					$address->is_active  = 1;
					$address->save();
				}

				$addresses =  Address::where('user_id',\Auth::id())->get();
				if($request->ajax()){
					return response()->json([
						'address' => $addresses 
					]);
				}
					
				return redirect('/address');
					
			}
  
	    }

	    public function getAddress(Request $request){
		   //Get The Current LoggedIn user Id
		    $address =  $request->user()->address()->orderBy('created_at','desc')->get();
		    return view('partials.address',compact('address'));
		} 
		
		
		public function delete(Request $request,$id){
		   //Get The Current LoggedIn user Id
		    $key = Auth::user()->id;
			 
		    $address =  $request->user()->address();//Check to see How many address we have 
		    $count   =  $address->get()->count();//Check to see How many address we have 

		    if (  $count <=1 ) {

		    	if($request->ajax()){

		    	 	$returnData = array(
					 'status'=>'You cannot delete your defualt address.'
                    );
					
					return response()->json($returnData, 500);
		        }
		         return redirect()->back()->withErrors(['error_warning'=>'You cannot delete your defualt address.']);//reject if we have only on address
		    } else {
		        Addres::find($id)->delete();

		        if($request->ajax()){
                  
		            $address = $address->get();
		            if ($request->art_address) {
						return view('account.art.includes.address',compact('address')); 

					}

		        	return view('partials.address',compact('address'));
		        }
		        return redirect()->back()->with('status', ' Successfully Deleted ');//reject if we have ; 
		    }  
           
		} 
		
		public function update(Request $request, $id){
			
		      $address = Addres::find($id);
			  //Get The Current LoggedIn user Id AS fORIEGN kEY
			  $foriegn_key = Auth::user()->id;
			  $states = State::all();
			  $page_title = 'Address';


			
			  if ( $request->isMethod('post') ) { 
			      
					$this->validate($request, [
					   'first_name'   => 'required|alpha_spaces|max:50',
					   'last_name'    => 'required|alpha_spaces|max:50',
					   'address'      => 'required|max:200',
					   'city'         => 'required|max:100',
					   'state'        => 'required'  
					]);
					
					$address->user_id                      =   $foriegn_key;
					$address->first_name                  =    $request->first_name;
					$address->last_name                   =    $request->last_name;
					$address->address                     =   $request->address ; 
					$address->address_2                   =   $request->address_2;
					$address->city                        =   $request->city;
					$address->state_id                    =   $request->state;
					$address->save();
					//Get The Address
					$address = User::find($foriegn_key)->address;

			        if($request->ajax()){
			            $address =  $request->user()->address()->get();//Check to see How many address we have 
			        	if ($request->art_address) {
						  return view('account.art.includes.address',compact('address')); 

					    }
			        	return view('partials.address',compact('address'));
			        }
					
				   return redirect()->action('Account\AddressController@index');
			  } else  {
			  
			       return view('account.address.edit',compact('states','page_title','address')); 
			 
			    }
				
	    }
		
	
	   
		
}
