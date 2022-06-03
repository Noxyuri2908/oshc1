<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Qa extends Model
{
    protected $fillable = [
        'area_id', 'name','name_cn','name_vi', 
        'content','content_cn','content_vi', 'status' ,
    ];

    public function area()
    {
        return $this->belongsTo('App\Admin\Area');
    }
}
