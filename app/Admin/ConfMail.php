<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ConfMail extends Model
{
    protected $fillable = [
        'name', 'name_vi', 'name_cn','content', 'content_vi', 'content_cn', 'type', 'status',
    ];
}
