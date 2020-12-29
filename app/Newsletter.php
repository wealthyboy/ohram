<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = ['email'];

    public function email_list(){
        return $this->belongsTo('App\EmailList');
    }
}
