<?php

namespace App\Http\Controllers\ChangePassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    


    public function __construct()
    {
       // $this->newsletter = $newsletter;
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        
        $page_title = 'Change Password';
        $user = $request->user();
        $active = true;
        return view('account.change_password.index',compact('active','page_title','user'));
    }
}
