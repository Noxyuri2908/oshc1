<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class QueueErrorLogs extends Model
{
    //
    protected $table = 'queue_error_logs';
    protected $fillable = [
        'model'  ,
        'model_id',
        'exception'
    ];
}
