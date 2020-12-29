<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeCategoryChildren extends Model
{
    

    protected $fillable =  ['attribute_category_id' ,'attribute_id'];


    public function attribute()
    {   
        return $this->belongsTo(Attribute::class,'attribute_id');
    }

    public function children()
    {
        return $this->hasMany('App\AttributeCategory','parent_id','id');
    }


}
