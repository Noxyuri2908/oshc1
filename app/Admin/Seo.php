<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'content', 'status',
    ];
}
