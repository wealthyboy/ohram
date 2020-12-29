<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Activity extends Model
{
    //
    use softDeletes;

    public  function  Log($action){
       $this->user_id = \Auth::user()->id;
       $this->email = \Auth::user()->email;
       $this->username = \Auth::user()->name;
       $this->action = $action;
       $this->save();
    }


    public function user(){
        return $this->belongsTo('App\User');
    }
}
