<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    protected $fillable = [
        'service_id', 'benefit_id', 'note', 'note_cn','note_vi', 'created_by', 'status',
    ];

    public function benefit(){
    	return $this->belongsTo('App\Admin\Benefit');
    }

   	public function service(){
    	return $this->belongsTo('App\Admin\Service');
    }

    public function user(){
    	return $this->belongsTo('App\User','created_by');
    }
}
