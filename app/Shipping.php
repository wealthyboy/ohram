<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasChildren;
use App\Traits\FormatPrice;



class Shipping extends Model
{
    use HasChildren,FormatPrice;

    protected $fillable = ['name','parent_id'];

    public $appends = [
        'converted_price',
    ];
	

    public function children()
    {
        return $this->hasMany('App\Shipping','parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Shipping','parent_id','id');
    }


    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    

    public function locations()
    {
        return $this->belongsToMany('App\Shipping','location_shipping');
    }
    

}
