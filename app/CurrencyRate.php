<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    public function currency_rate_countries()
    {
        return $this->hasMany(CurrencyRateCountry::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency2_id');
    }
}
