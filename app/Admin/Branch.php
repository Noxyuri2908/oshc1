<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $table = 'branches';
    protected $fillable = [
        'title',
        'address',
        'phone'
    ];
}
