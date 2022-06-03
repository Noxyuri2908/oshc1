<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'dichvu_id', 'slug', 'des_s', 'des_f', 'price', 'link', 'image',  'type', 'note', 'pos', 'price_type', 'created_by', 'status', 'currency_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User','created_by');
    }

    public function dichvu(){
        return $this->belongsTo('App\Admin\Dichvu');
    }

    public function applies(){
        return $this->hasMany('App\Admin\Apply');
    }

    public function currency(){
        $currency_id = $this->currency_id;
        return isset(config('myconfig.currency')[$currency_id]) ? config('myconfig.currency')[$currency_id] : '';
    }

    public function docs(){
        return $this->hasMany('App\Admin\Doc');
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
}
