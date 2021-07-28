<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id', 'comment_id', 'name', 'email', 'content', 'status', 
    ];

    protected $append = ['list_rep'];

    public function post()
    {
        return $this->belongsTo('App\Admin\Post');
    }

   	public function getListRepAttribute() {
        return $this->where('comment_id',$this->id)->where('status',1)->get();
    }
}
