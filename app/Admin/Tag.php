<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'menu_id', 'name','name_cn','name_vi','slug', 'type', 'note', 'status',
    ];

    public function menu_header()
    {
        return $this->belongsTo('App\Admin\MenuHeader','menu_id');
    }

}
