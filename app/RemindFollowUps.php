<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemindFollowUps extends Model
{
    //

    protected $fillable = [
        'follow_up_id',
        'time_no_follow_up'
    ];
}
