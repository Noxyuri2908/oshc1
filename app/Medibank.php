<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medibank extends Model
{
    //
    protected $table = 'medibanks';
    protected $fillable = [
        'service_id',
        'type',
        'price',
        'num_days',
        'status'
    ];
}
