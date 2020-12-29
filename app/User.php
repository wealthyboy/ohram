<?php

namespace App;

use App\Follower;
use Illuminate\Support\Str;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'name','last_name', 'email','phone','verified','password','permission','user_type'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];



	/**
	 * Brings out the info from the Address table that belongs to the customers
	 *
	 * @var array
	 */
	public function addresses(){
		return $this->hasMany('App\Address');	
	}

	public function active_address(){
		return $this->hasOne('App\Address')->where('is_active',1);	
	}


	public function orders(){
		return $this->hasMany('App\Order');	
	}

	public function carts(){
		return $this->hasMany('App\Cart');	
	}

	public function favorites(){
		
		return $this->hasMany('App\Favorite');	
	}


	public function social(){
		return $this->hasMany('App\UserSocial');	
	}


	public function activities(){
		return $this->hasMany('App\Activity');	
	}

	public function hasSocialLinked($service)
	{
		return (bool) $this->social->where('service', $service)->count();
	}
		
	
	public function fullname() { 
		return ucfirst($this->name) . ' '. ucfirst($this->last_name);
	}


	public function users_permission(){
		return $this->hasOne("App\UserPermission");
	}
		

	public function scopeCustomers(Builder $builder){
		return $builder->where('type','subscriber');
	}

	public function scopeAdmin(Builder $builder){
		return $builder->whereNull('type');
	}


	public function ActiveAddress(){
        return optional($this->addresses)->where('is_active',true)->first();
    }


	public static function userHasPermission($num){
		$model = \Auth::user();
		return Str::contains($model->users_permission->permission->code, $num) ? true : false;
	}


	public static function canTakeAction($num){
		if(!User::userHasPermission($num)){
			dd('You dont have access,Permission Denied.'); 	
		}
	}


	public function isAdmin(){
		return $this->users_permission  !== null ? true : false;
	}

	public static function IsSuperUser(){
		$model = \Auth::user();
		return $model->users_permission->permission->name == 'Super User' ? true : false;
	}

	public function activity(){
		return $this->hasMany('App\Activity');
	}
			
	public function hasVerified() {
		$this->verified=true;
		$this->token = null;
		$this->save(); 
	}
}
