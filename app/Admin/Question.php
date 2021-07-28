<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'name', 'email','phone','ques', 'content','answer','user_id','status' ,
    ];
}
