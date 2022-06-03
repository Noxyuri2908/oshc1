<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin;

class Support extends Model
{
    protected $fillable = [
        'agent_id', 'task', 'task_type', 'level', 'status', 'remind', 'leader', 'process_by', 'service', 'type_service',
        'person_in_charge', 'from_date', 'to_date', 'processing', 'content', 'type', 'apply_id'
    ];

    public function u_leader(){
    	return $this->belongsTo('App\Admin','leader');
    }

    public function u_process_by(){
        return $this->belongsTo('App\Admin','process_by');
    }

    public function agent(){
        return $this->belongsTo('App\User','agent_id');
    }

    public function pIC(){
        $arr_id = $this->person_in_charge != null ? explode(";", $this->person_in_charge) : [];
        return Admin::whereIn('id',$arr_id)->get();

    }

    public function apply(){
        return $this->belongsTo('App\Admin\Apply','apply_id');
    }
}
