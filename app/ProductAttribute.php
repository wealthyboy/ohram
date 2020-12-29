<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasChildren;


class ProductAttribute extends Model
{   

    use HasChildren;

    protected $fillable = [
        'attribute_id',
        'product_id',
        'parent_id',
    ];


    public function attribute()
    {
        return $this->belongsTo('App\Attribute');
    }
    
    public function product()
    {
        return $this->belongsTo('App\Product');
    }   

    public function children()
    {
        return $this->hasMany('App\ProductAttribute','parent_id','id');
    }

    public function isAChild($id)
    {
        foreach ($this->children() as $key => $value) {
            if($value->attribute_id == $id){
              return 'selected';
            } 
        }

        return '';
    }

    public function parent()
    {
        return $this->hasOne('App\ProductAttribute','parent_id');
    }

    
}
