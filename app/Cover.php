<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    //
    use Filterable;
    protected $fillable = [
      'service_id',
      'policy',
      'cover'
    ];
}
