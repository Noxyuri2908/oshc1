<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $fillable = [
        'code', 'title', 'content', 'type',
    ];
}
