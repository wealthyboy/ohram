<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SystemSetting;
use App\Category;
use App\Collection;
use App\Product;


class CategoryController extends Controller
{
    //

    public function __construct()
    {	  
	  $this->settings =  SystemSetting::first();
    }
	
	public function  index(Request $request,Category $category)  {
	  

        $settings =  $this->settings;
        $page_title = implode(" " ,explode('-',$category->slug));
        if($request->has('sort_by')){
            $sort = explode(',',$request->sort_by);
            $collections =  $category->products()->orderBy($sort[0],$sort[1])->groupBy('category_product.product_id')->paginate($this->settings->products_items_per_page);
        } else {
            $collections =  $category->products()->orderBy('created_at','DESC')->paginate($this->settings->products_items_per_page);
        }
        if ($request->ajax()) { 
            return  \View::make('collection.load_more',['category'=>$category,'collections'=>$collections,'page_title'=> $page_title]);     
        }
          return  \View::make('collection.index',['category'=>$category,'collections'=>$collections,'page_title'=> $page_title]);     
        }
}
