<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name', 'slug', 'type', 'note', 'status', 'content',
    ];
}
