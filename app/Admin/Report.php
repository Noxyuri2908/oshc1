<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'apply_id', 'user_id','amount','status' ,
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function apply(){
        return $this->belongsTo('App\Admin\Apply');
    }
}
