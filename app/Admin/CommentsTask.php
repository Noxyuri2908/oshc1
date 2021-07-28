<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class CommentsTask extends Model
{
    //

    protected $fillable = [
        'follow_id',
        'agent_id',
        'staff_create_fl',
        'staff_assign_fl',
        'staff_create_cm',
        'comment',
        'see',
        'send_to_staff_id',
        'date',
    ];

    public  function follows()
    {
        return $this->belongsTo(Follow::class); // Relationships
    }



}
