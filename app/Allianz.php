<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allianz extends Model
{
    //
    protected $table= 'allianzs';
    protected $fillable = [
        'service_id',
        'type',
        'price',
        'num_days',
        'status'
    ];
}
