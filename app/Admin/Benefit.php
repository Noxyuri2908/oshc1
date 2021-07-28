<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $fillable = [
        'name', 'name_cn', 'name_vi', 'cat_benefit_id', 'pos', 'created_by', 'status',
    ];

    public function cat_benefit(){
    	return $this->belongsTo('App\Admin\CatBenefit', 'cat_benefit_id');
    }

    public function user(){
    	return $this->belongsTo('App\User','created_by');
    }
}
