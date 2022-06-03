<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Tailieu extends Model
{
    protected $fillable = [
        'apply_id', 'name', 'type_file', 'admin_id', 'note', 'link'
    ];

    public function invoice()
    {
        return $this->belongsTo('App\Admin\Apply', 'apply_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Admin','admin_id');
    }

    public function typeFileName(){
    	$type = $this->type_file;
    	return isset(config('myconfig.type_file')[$type]) ? config('myconfig.type_file')[$type] : '';
    }

    public function link_download()
    {
        return config('admin.base_url').'tailieus/'.$this->link;
    }
}
