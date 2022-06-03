<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class TaskMediaStatus extends Model
{
    //
    protected $fillable = [
        'type',
        'name',
        'category'
    ];
    protected $casts = [
        'category'=>'array'
    ];
}
