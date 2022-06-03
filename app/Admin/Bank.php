<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'name', 'code', 'account', 'brand', 'account_name', 'country', 'created_by', 'updated_by',
    ];

    public function countryName(){
        $country_id = $this->country;
        return isset(config('country.list')[$country_id]) ? config('country.list')[$country_id] : '';
    }

    public function staffCreate()
    {
        return $this->belongsTo('App\Admin', 'created_by');
    }

    public function staffUpdate()
    {
        return $this->belongsTo('App\Admin', 'updated_by');
    }
}
