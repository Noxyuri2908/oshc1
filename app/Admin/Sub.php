<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    protected $fillable = [
        'email', 'status',
    ];
}
