<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Webinfo extends Model
{
    protected $fillable = [
        'code', 'name', 'name_cn', 'name_vi', 'content', 'content_cn', 'content_vi',  'image', 'link', 'status',
    ];

    public function setImageAttribute($value) {
    	$tmp = $value;
    	if ($tmp != null && $tmp != "") {
    		$index = strpos($tmp,'FILES/source/');
    		if (!$index === false) {
    			$tmp = substr($tmp,$index, strlen($tmp));
    		}
    	}
    	$this->attributes['image'] = $tmp;
    }

    public function getImageAttribute() {
    	$tmp = $this->attributes['image'];
    	if ($tmp != null && $tmp != "") {
    		$tmp = config('admin.base_url').$tmp;
    	}
    	return $tmp;
    }
}
