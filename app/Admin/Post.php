<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\Tag;

class Post extends Model
{
   	protected $fillable = [
        'name',
        'name_cn',
        'name_vi',
        'image' ,
        'slug' ,
        'des_s',
        'des_s_cn',
        'des_s_vi',
        'content',
        'content_cn',
        'content_vi',
        'tags' ,
        'cat_id' ,
        'number_click' ,
        'meta_title',
        'meta_des',
        'meta_key' ,
        'created_by',
        'created_at',
        'type',
        'status' ,
        'post_created_at'
    ];

    protected $append = ['array_tag','list_tags'];

    public function category()
    {
        return $this->belongsTo('App\Admin\Category','cat_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','created_by');
    }

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

    public function getArrayTagAttribute() {
        $res = [];
        $tmp = $this->attributes['tags'];
        if ($tmp != null && $tmp != "") {
            $res = explode(";", $tmp);
        }
        return $res;
    }

    public function getListTagsAttribute() {
        $res = [];
        $tmp = $this->attributes['tags'];
        if ($tmp != null && $tmp != "") {
            $res = explode(";", $tmp);
        }
        $tags = Tag::whereIn('id',$res)->get();
        return $tags;
    }
}
