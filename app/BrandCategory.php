<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandCategory extends Model
{   
    protected $table = 'brand_category';


    protected $fillable =  ['category_id' ,'brand_id'];

}
