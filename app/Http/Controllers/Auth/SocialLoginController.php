<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Socialite;
use App\User;
use Auth;


class SocialLoginController extends Controller
{
    //
	
	public function __construct()
    {
       $this->middleware(['social', 'guest']);
    }

    public function redirect($service, Request $request)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service, Request $request)
    {
        $serviceUser = Socialite::driver($service)->user();
		
	   // dd($serviceUser);

        $user = $this->getExistingUser($serviceUser, $service);
        

        if (!$user) {

        	$names  = explode(" ",$serviceUser->getName());

            $user = User::create([
                'name' => $names[0],
            	'last_name'=>$names[1],
                'email' => $serviceUser->getEmail(),
				'photo_picture'=> $serviceUser->getAvatar(),
                'verified'=>true,
                'phone'=>$serviceUser->getPhone(),
                'user_type'=>'customer',
            ]);
        }

        if ($this->needsToCreateSocial($user, $service)) {

            $user->social()->create([
                'social_id' => $serviceUser->getId(),
                'service' => $service,
            ]);
        }

        Auth::login($user, false);

        return redirect()->intended();
    }

    protected function needsToCreateSocial(User $user, $service)
    {
        return !$user->hasSocialLinked($service);
    }

    protected function getExistingUser($serviceUser, $service)
    {
        return User::where('email', $serviceUser->getEmail())->orWhereHas('social', function ($q) use ($serviceUser, $service) {
            $q->where('social_id', $serviceUser->getId())->where('service', $service);
        })->first();
    }
	
	
	
	
	
	
	
	
}
?>