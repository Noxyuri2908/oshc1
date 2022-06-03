<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'image', 'title', 'link', 'content', 'page', 'type', 'note', 'status',
    ];

    protected $append =[
    	'array_page',
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

    public function getArrayPageAttribute() {
        $res = [];
        $tmp = $this->attributes['page'];
        if ($tmp != null && $tmp != "") {
            $res = explode(";", $tmp);
        }
        return $res;
    }
}
