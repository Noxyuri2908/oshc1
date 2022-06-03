<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ProviderCom extends Model
{
    protected $fillable = [
        'provider_id',
        'policy',
        'amount',
        'type',
        'validity_date',
        'note'
    ];

    public function provider(){
        return $this->belongsTo('App\Admin\Service', 'provider_id');
    }

    public function policyName(){
            $policy_id = $this->policy;
            return isset(config('myconfig.policy')[$policy_id]) ? config('myconfig.policy')[$policy_id] : '';
    }

    public function textCom(){
        return  number_format($this->amount).($this->type == 1 ? '%' : '$');
    }
}
