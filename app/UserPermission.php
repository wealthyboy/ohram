<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    //
    protected $fillable = [
        'permission_id'
    ];
    public function permission(){
        return $this->belongsTo("App\Permission");
    }

}
