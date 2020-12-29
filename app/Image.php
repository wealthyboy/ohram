<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\ImageFiles  as Img;



class Image extends Model
{

    protected $fillable = [ 'parent_id', 'image','imageable_type','imageable_id'];

   // use Img;//,SoftDeletes,CascadeSoftDeletes;

    public $folder = 'products';


    public $appends = [
		'image_m', 
		'image_tn'
	];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function scopeParents(Builder $builder){
        return $builder->whereNull('parent_id')->orderBy('created_at','desc');
    }


    public function children()
    {
        return $this->hasMany('App\Image','parent_id','id');
    }


    public function getImageToShowMAttribute()
    {
        return  !empty($this->variants[0]) &&  $this->variants[0]->product->product_type == 'variable'
 						? $this->variants[0]->image_m 
						: $this->image_m;
    }


    public function getImageToShowTnAttribute()
    {
        return  !empty($this->variants[0]) && $this->variants[0]->product->product_type == 'variable'
						? $this->variants[0]->image_tn 
						: $this->image_tn;
    }


    public function imageSize($size){
        if ( $this->image ) { 
            $image = basename($this->image);
            return asset('images/'.$this->folder.'/'. $size .'/'.$image);
        }
    }


    public function getImageMAttribute(){
       return $this->imageSize('m'); 
    }
    

    public function getImageTnAttribute(){
       return $this->imageSize('tn'); 
    }

  
}
