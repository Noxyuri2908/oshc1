<?php

namespace App\Admin;

use App\Admin;
use App\User;
use Illuminate\Database\Eloquent\Model;

class CatBenefit extends Model
{
    protected $fillable = [
        'name', 'name_cn', 'name_vi', 'des_s', 'pos', 'created_by', 'status',
    ];

    public function user(){
    	return $this->belongsTo(Admin::class,'created_by','id');
    }

    public function benefits(){
    	return $this->hasMany('App\Admin\Benefit');
    }
}
