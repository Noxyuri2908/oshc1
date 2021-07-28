<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Traffice extends Model
{
    //
    protected $table = 'traffices';
    protected $fillable = [
        'start_date',
        'end_date',
        'total_view',
        'total_user',
        'total_like',
        'total_reach',
        'note'
    ];
}
