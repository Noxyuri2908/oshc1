<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\Category;

class Category extends Model
{
    protected $fillable = [
        'menu_id', 'name', 'name_cn','name_vi', 'slug', 'status',
    ];

    public function post()
    {
        return $this->hasMany('App\Admin\Post');
    }

    public function menu_header()
    {
        return $this->belongsTo('App\Admin\MenuHeader','menu_id');
    }
}
