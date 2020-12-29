<?php

namespace App\Http\Controllers\Vouchers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Http\Controllers\Controller;
use App\Voucher;
use Carbon\Carbon;
use App\Category;
use App\User;
use App\Ambassador;


class VouchersController  extends Controller
{
   
        
		/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('admin');
	}
	


	public function index() {
		$vouchers = Voucher::all();
		$categories = Category::all();
		return view('admin.vouchers.index',compact('categories','vouchers'));
	}
	
	public function edit(Request $request,$id) {
		User::canTakeAction(4); 
		$voucher = Voucher::find($id);    
		return view('admin.vouchers.edit',compact('id','voucher'));
	}

	public function update(Request $request,$id){
		if ($request->isMethod('post')) {
			
			$voucher = Voucher::find($id);
			$this->validate($request, [
				'code'      => 'required|unique:vouchers,code,'.$id,
				'discount'  => 'required',
				'type'    =>'required',

			]);
			$voucher->code     = $request->code;
			$voucher->user_id  = \Auth::user()->id;
			$voucher->amount   = $request->discount;
			$voucher->type   = $request->type;

			$voucher->expires  = $this->getExpiryDate($request->expiry);
			$voucher->from_value = $request->has('from_value') ? $request->from_value : null;
			$voucher->category_id = $request->has('category') ? $request->category : null;
			$voucher->status =$request->status != 1 ? 0 :$request->status;
			$voucher->save(); 
			return redirect('admin/vouchers');
				
		}
			
			
	}

	public function getExpiryDate($date){
		if($date) {
			$exp_date = explode('/', $date);
			$expiry_date = Carbon::createFromDate($exp_date[2], $exp_date[1], $exp_date[0]);//
		}else{
			$expiry_date = null;
		}
		return $expiry_date;
	}



	public function create(Request $request) {		
		return view('admin.vouchers.create',compact('categories','amb'));
	}
		
 


	public function store(Request $request) {
		User::canTakeAction(2);

		if ($request->isMethod('post')) {

			$coupon = new Voucher();
			//VALIDATE NEW RECORDS
			$this->validate($request, [
				'code'      => 'required|unique:vouchers|max:150',
				'type'      => 'required',
				'discount'  => 'required',
			]);

		
			$coupon->code     =  $request->code; 
			$coupon->user_id  = \Auth::user()->id;
			$coupon->amount   = $request->discount;
			$coupon->type   = $request->type;
			$coupon->expires  = $this->getExpiryDate($request->expiry);
			$coupon->from_value = $request->has('from_value') ? $request->from_value : null;
			//$coupon->category_id = $request->has('category') ? $request->category : null;
			$coupon->status =$request->status != 1 ? 0 :$request->status;
			$coupon->save(); 
						
			return redirect('admin/vouchers');	
		}			  
		return view('admin.vouchers.create',compact('categories','amb'));
	}
		
	
	public function delete(Request $request) { 
		User::canTakeAction(5);
	    if ($request->isMethod('post')) {			
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
		Voucher::destroy($request->selected);
		return redirect()->back();
		
		}
	}
		
		




}