<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
   	protected $fillable = ['service_id', 'type', 'num_month', 'price', 'status'];
   	public function service()
    {
        return $this->belongsTo('App\Admin\Service');
    }

}
