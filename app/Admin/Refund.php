<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{

    protected $fillable = [
        'apply_id',
        'admin_create',
        'adim_update',
        'refund_provider_amount',
        'request_date',
        'refund_provider_date',
        'std_deduction',
        'refund_provider_exchange_rate',
        'std_date_apyment',
        'std_status',
        'std_amount',
        'std_exchange_rate',
        'std_note',
        'note2',
        'refund_profit_2',
        'refund_profit_2_VN',
        'refund_amount_com_agent',
        'refund_exchange_rate_agent',
        'refund_agent_vnd',
        'refund_amount_com_agent_gbcfa',
        'refund_situation_pp',
        'refund_type_of_refund_pp',
        'refund_bank_pp',
        'commission',
        'extra_fee',
        'bank_fee',
        'balance',
        'status'

    ];

    public function invoice()
    {
        return $this->belongsTo(Apply::class, 'apply_id');
    }
    public function getTypeOfRefund(){
        return !empty($this->refund_type_of_refund_pp) && !empty(config('myconfig.type_of_refund_profit')[$this->refund_type_of_refund_pp])?config('myconfig.type_of_refund_profit')[$this->refund_type_of_refund_pp]:'';
    }
}
