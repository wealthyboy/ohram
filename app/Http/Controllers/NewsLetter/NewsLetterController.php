<?php

namespace App\Http\Controllers\NewsLetter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Newsletter;


class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    return view('newsletter.index');
    }

    public function unsubscribe(Request $request)
    {
      $email = Newsletter::where('email',$request->email)->delete();
      return redirect()->back()->with('success','You have successfully unsubscribe');
    }

    
    
}
