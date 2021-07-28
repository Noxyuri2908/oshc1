<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Campain extends Model
{
    protected $fillable = [
        'name', 'code', 'start_date','end_date', 'staff_id', 'is_send_sms', 'is_send_email', 'note', 'subject', 'content', 'status', 'created_by',
    ];

    public function owner(){
        return $this->belongsTo('App\Admin', 'created_by');
    }

    public function assign(){
        return $this->belongsTo('App\Admin', 'staff_id');
    }
}
