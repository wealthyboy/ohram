<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    //
    protected $fillable = [
        'instagram_handle','post_type', 'unique_code','date_of_birth','account_name','account_number','bank_name',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function voucher(){
        return $this->hasOne('App\Voucher');
    }
}
