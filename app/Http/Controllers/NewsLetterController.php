<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\Newsletter\Contracts\NewsletterContract;
use App\Services\Newsletter\Exceptions\UserAlreadySubscribedException;


class NewsLetterController extends Controller
{
    protected $newsletter;

    public function __construct(NewsletterContract $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function create(Request $request)
    {   
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        try {
            $this->newsletter->subscribe(
                config('services.mailchimp.list'),
                $request->email
            );
       } catch (UserAlreadySubscribedException $e) {
			dd($e->getMessage());
        }

       // return redirect()->back();
    }
}
