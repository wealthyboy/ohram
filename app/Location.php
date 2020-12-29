<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasChildren;

class Location extends Model
{
    use HasChildren;
	
	protected $fillable = ['name','parent_id'];
	
    public function children()
    {
        return $this->hasMany('App\Location','parent_id','id');
    }

    public function shipping()
    {
        return $this->hasMany('App\Shipping');
    }

    public function shippings()
    {
        return $this->belongsToMany('App\Location','location_shipping');

	}
}
