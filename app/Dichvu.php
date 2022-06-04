<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dichvu extends Model
{
    protected $guard_name = 'dichvus';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
    ];
}
