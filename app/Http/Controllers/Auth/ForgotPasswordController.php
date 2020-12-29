<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\MailResetPasswordNotification;
use Carbon\Carbon;
use App\PasswordReset;
use App\User;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $token = str_random(64);
        DB::table('password_resets')->insert([
            ['email' => $request->email, 'token' => $token ,'created_at' => Carbon::now()],
        ]);
        \Notification::route('mail', $request->email)
        ->notify(new MailResetPasswordNotification($token));
        return response()->json([
            'message' => 'A password reset link has been sent to '.$request->email
        ],200);
         
    }
    

    public function reset(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where('email',$request->email)->first();
        $user->password =  bcrypt($request->password);
        if ( $user->save() ){
            return response()->json([
                'message' => 'Your password has been reset successufully'
            ],200);
        }
        return response()->json([
            'message' => 'We could not reset your password'
        ],422);
         
    }

    public function validateToken(Request $request,$token)
    {

        $password = PasswordReset::where('token',$token)->first();
        if ( null !== $password ){
            if ( $password->created_at->diffInMinutes(now()) > 3660 ){
                return response()->json([
                    'errors' => 'Token is invalid .Please resquest another',
                    'allow_validate' => false
                ],422); 
            } 
            return response()->json([
                'allow_validate' => true
            ],200); 
        }

        return response()->json([
            'errors' => 'Token is invalid .',
            'allow_validate' => false
        ],403);
         
    }


    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users']);
    }
}
