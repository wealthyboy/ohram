<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Live;
use App\Banner;
use App\Product;
use App\Category;
use App\Review;
use App\Information;
use Stevebauman\Location\Location;
use App\SystemSetting;
use App\User;

use App\Http\Helper;
use Illuminate\Support\Str;

use App\Currency;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $site_status = Live::first();

        $banners = Banner::banners()->get();
        $products = Product::where('featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();


        $reviews = Review::with(['user', 'product'])->orderBy('created_at', 'DESC')->take(4)->get();

        $reviews->each(function ($review) {
            $review->short_description = Str::limit(strip_tags($review->description), 100, '....');
        });

        $posts = Information::orderBy('created_at', 'DESC')->where('blog', true)->take(6)->get();
        $page_title = 'Ohram | From detox teas to meal replacement protein shakes, our babes do it all. Get back on track, reduce bloating, and flatten that tummy!';

        if (
            null !== $site_status->make_live
        ) {

            return view('index', compact('banners', 'page_title', 'reviews', 'products', 'posts'));
        } else {
            //Show site if admin is logged in
            if (auth()->check()  && auth()->user()->isAdmin()) {
                return view('index', compact('banners', 'page_title', 'reviews', 'products', 'posts'));
            }
            return view('underconstruction.index');
        }
    }
}
