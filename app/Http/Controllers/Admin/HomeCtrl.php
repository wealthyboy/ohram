<?php 

namespace App\Http\Controllers\Admin;


use App\Order;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helper;
use App\Category;
use App\Currency;

use Illuminate\Support\Facades\Storage;





class HomeCtrl extends Controller
{
	
	protected $redirectTo = '/admin/login';

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
        return view('admin.index'); 
     }
     
	
}
?>