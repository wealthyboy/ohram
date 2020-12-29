<?php namespace App\Http\Controllers\Errors;


use App\Http\Controllers\Controller;

class ErrorsCtrl extends Controller
{
	public function index() { 
	    return view('errors.404');
	}
}


?>