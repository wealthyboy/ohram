<?php  

namespace App\Http\ViewComposer;

use  App\User;
use Illuminate\View\View;

use Auth;
use App\Cart;
use App\Information;
use App\Category;
use App\SystemSetting;
use App\Voucher;
use App\Promo;
use App\Currency;

use App\PageBanner;


use Illuminate\Support\Facades\Cache;

class   NavComposer { 
   
   
    public function compose (View $view) { 
		$global_categories = Category::parents()->orderBy('id', 'asc')->get();
		$footer_info = Information::where('blog',false)->parents()->get(); 
		$global_promos = Promo::where('make_live',1)->get(); 
		$system_settings = SystemSetting::first();
		$currencies = Currency::all();
		$news_letter_image = PageBanner::where('page_name','newsletter')->first();
	    $view->with([
		   	'footer_info'=>$footer_info,
		   	'global_categories'=> $global_categories,
			'system_settings'=>$system_settings,
			'global_promos'=>$global_promos,
			'news_letter_image' =>$news_letter_image,
			'currencies' =>$currencies
	    ]);
    

}




}