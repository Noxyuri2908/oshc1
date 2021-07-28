<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TempMail extends Model
{
    protected $fillable = [
        'banner', 'background_footer', 'content', 'content_vi', 'content_cn', 'type','status',
    ];

    public function setBannerAttribute($value) {
    	$tmp = $value;
    	if ($tmp != null && $tmp != "") {
    		$index = strpos($tmp,'FILES/source/');
    		if (!$index === false) {
    			$tmp = substr($tmp,$index, strlen($tmp));
    		}
    	}
    	$this->attributes['banner'] = $tmp;
    }

    public function getBannerAttribute() {
    	$tmp = $this->attributes['banner'];
    	if ($tmp != null && $tmp != "") {
    		$tmp = config('admin.base_url').$tmp;
    	}
    	return $tmp;
    }

    public function setBackgroundFooterAttribute($value) {
    	$tmp = $value;
    	if ($tmp != null && $tmp != "") {
    		$index = strpos($tmp,'FILES/source/');
    		if (!$index === false) {
    			$tmp = substr($tmp,$index, strlen($tmp));
    		}
    	}
    	$this->attributes['background_footer'] = $tmp;
    }

    public function getBackgroundFooterAttribute() {
    	$tmp = $this->attributes['background_footer'];
    	if ($tmp != null && $tmp != "") {
    		$tmp = config('admin.base_url').$tmp;
    	}
    	return $tmp;
    }
}
