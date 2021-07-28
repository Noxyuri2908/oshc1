<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\MenuHeader;

class MenuHeader extends Model
{
    protected $fillable = [
        'name', 'name_cn','name_vi', 'slug', 'pos', 'status',
    ];

    public function category()
    {
        return $this->hasMany('App\Admin\Category', 'menu_id');
    }

    public function tag()
    {
        return $this->hasMany('App\Admin\Tag', 'menu_id');
    }
}
