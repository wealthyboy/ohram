<?php

namespace App\Http\Controllers\Api\NewsLetter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Newsletter;
use App\Services\Newsletter\Contracts\NewsletterContract;
use App\Services\Newsletter\Exceptions\UserAlreadySubscribedException;


class NewsLetterController extends Controller
{

    public $newsletter;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request,NewsletterContract $newsletter)
    {   
		$this->newsletter = $newsletter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $reviews =  $product->reviews()->orderBy('created_at','DESC')->paginate(5);
        return ReviewResourceCollection::collection( $reviews );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,NewsLetter $newsletter)
    {

        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $email = Newsletter::where('email',$request->email)->first();

        if (null !== $email ){

            return response()->json(
                [
                    'message' => 'Thanks for signing up'
                ],200
            );
        }

        //save in db
        $newsletter->create([
            'email' => $request->email,
        ]);

        //new Review Notification
        //Sign up to mail chimp

        try {
            $this->newsletter->subscribe(
                config('services.mailchimp.list'),
                $request->email
            );
        } catch (UserAlreadySubscribedException $e) {
			return response()->json(
                [
                    'message' => 'Thanks for signing up'
                ],200
            );
        }


        return response()->json(
            [
                'message' => 'Thanks for signing up'
            ],200
        );
    }
    
}
