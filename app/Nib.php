<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nib extends Model
{
    //
    protected $table='nibs';
    protected $fillable = [
        'service_id',
        'type',
        'price',
        'num_days',
        'status'
    ];
}
