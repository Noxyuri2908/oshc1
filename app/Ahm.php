<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ahm extends Model
{
    //
    protected $table='ahms';
    protected $fillable = [
        'service_id',
        'type',
        'price',
        'num_days',
        'status'
    ];
}
