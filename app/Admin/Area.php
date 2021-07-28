<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	protected $fillable = [
		'name' , 'name_cn' , 'name_vi' , 'status',
	];

	public function qa(){
        return $this->hasMany('App\Admin\Qa');
    }
}
