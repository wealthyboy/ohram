<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\SystemSetting;
use App\Http\Helper;



trait ImageFiles 
{

    protected $setting;


    public function __construct(){
        $this->setting = SystemSetting::first();
    }


    public function getImageToShowAttribute()
    {   
        $image =  optional($this->variant)->image ??  optional(optional($this->variant)->img)->image;
        return $this->product_type  == 'variable'
                            ? $image
                            : $this->image;
    }


    public function getImageToShowMAttribute()
    {   
        $image =  optional($this->variant)->image_m ??  optional(optional($this->variant)->img)->image_m;
        return $this->product_type  == 'variable'
                            ? $image  
                            : $this->image_m;
    }


    public function getImageToShowTnAttribute()
    {   
        $image =  optional($this->variant)->image_tn ??  optional(optional($this->variant)->img)->image_tn;
        return $this->product_type  == 'variable'
        ? $image 
        : $this->image_tn;
    }


    public function getAddImagesAttribute()
    {
        return $this->product_type  == 'variable'
        ? optional($this->variant)->images 
        : optional($this->default_variation)->images;
    }


    public function tn_path(){
        $image = basename($this->image);
        return  asset('images/'. $this->folder .'/tn/'.$image);
    }


    public function m_path(){
        $image = basename($this->image);
        return  asset('images/'.$this->folder.'/m/'.$image);
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
