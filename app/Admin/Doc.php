<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    protected $fillable = [
        'name', 'name_cn', 'name_vi', 'des_s', 'link', 'service_id', 'pos', 'created_by', 'status',
    ];

    public function service(){
    	return $this->belongsTo('App\Admin\Service');
    }

    public function user(){
    	return $this->belongsTo('App\User','created_by');
    }
}
