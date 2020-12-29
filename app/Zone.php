<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //
    
	protected $fillable =[
			'name'
	];
    
	public function shipCompany(){
		return $this->belongsTo('App\ShipCompany');
	}
	
	public function  ShipCompanyDetails(){
		return $this->hasMany('App\ShipCompanyPrice');
	}
}
