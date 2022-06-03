<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    //
    protected $table = 'appointments';
    protected $fillable = [
        'agent_id',
        'title',
        'start_date',
        'end_date',
        'address',
        'color',
        'attendees',
        'note'
    ];
}
