<?php

namespace App\Http\Controllers\Ambassador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SystemSetting;
use App\Mail\AmbNotification;
use App\Ambassador;

class AmbassadorsController extends Controller
{
    
    public $settings;

    public function __construct()
    {        
        $this->settings =  SystemSetting::first();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('account.ambassador.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:ambassadors,email',
            'instagram_handle' => 'required|unique:ambassadors|max:150',
            'unique_code' => 'required|unique:ambassadors|max:150',
        ]);


        $ambassador  = new Ambassador;
        $ambassador->full_name =  $request->full_name;
        $ambassador->instagram_handle =  $request->instagram_handle;
        $ambassador->unique_code =  $request->unique_code;
        $ambassador->phone_number =  $request->phone_number;
        $ambassador->email =  $request->email;
        $ambassador->account_number =  $request->bank_account_number;
        $ambassador->account_name =  $request->bank_name;
        $ambassador->save();

        if($ambassador){
            // $admin_emails = explode(',',$this->settings->alert_email);
			// foreach ($admin_emails as $alert_email ){
			// 	\Mail::to($alert_email)
			// 	->send(new AmbNotification($ambassador)); 
			// }
           return back()->with( 'success','Thanks for coming on board.Please give us e a moment to review your details'); 
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function msg()
    {
        //
        return view('account.ambassador.notice');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
