<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeCategory extends Model
{
   protected $table = 'attribute_category';

   protected $fillable = [
		'attribute_id','parent_id'
	];

   protected $appends = ['name'];

   public function attribute()
   {   
      return $this->belongsTo(Attribute::class,'attribute_id');
   }

   public function children()
   {
      return $this->hasMany('App\AttributeCategoryChildren','attribute_category_id');
   }
    
   public function getNameAttribute()
   {   
      return $this->attribute->name;
	}
}
