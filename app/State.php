<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SystemSetting;

class State extends Model
{
    //
    protected $fillable = ['name'];

    public $timestamps = false;

    public function address(){
        return $this->hasMany('App\Addres');
    }

    public function offline_address(){
    }

    public function shipping_price(){
        return null !== $this->state ? $this->state->shipping_price : 0.00;

    }

}
