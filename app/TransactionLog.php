<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function carts(){
		  return $this->belongsToMany('App\Cart');
    }


    public function pending_carts(){
		  return $this->belongsToMany('App\Cart')->where("status",'Pending');
    }

}
