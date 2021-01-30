<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}
