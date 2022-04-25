<?php

namespace App;

use App\Admin\Follow;
use Illuminate\Database\Eloquent\Model;

class RemindFollowUps extends Model
{
    //

    protected $fillable = [
        'follow_up_id',
        'time_no_follow_up'
    ];

    public function follows()
    {
        return $this->belongsTo(Follow::class, 'follow_up_id');
    }
}
