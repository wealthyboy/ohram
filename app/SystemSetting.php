<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    //alllow these to be mass assigned
	
	public $timestamps = false;
	
	protected $fillable = ['store_name',
	                       'address',
						   'store_email',
						   'store_phone',
						   'image',
						   'opening_times',
						   'meta_title',
						   'meta_description',
						   'meta_tag_keywords',
						   'products_items_per_page',
						   'alert_email',
						   's_h',
						   'order_status',
						   'invoice_prefix',
						   'store_logo',
						   'store_icon',
						   'products_items_size_w',
						   'products_items_size_h'
	];
				
	public function alert_email( ) { 
	   return $this->alert_email;
	}
	
	public function logo_path(){
	  return '/images/logo/'.$this->store_logo;
	}

	public function currency(){
		if ($this->customer_currency_id !== null){
			return  $this->belongsTo(Currency::class,'customer_currency_id');
		}
		return  $this->belongsTo(Currency::class);
	}

	
	public function default_currency(){
		return  $this->belongsTo(Currency::class,'currency_id');
	}
							
							
}
