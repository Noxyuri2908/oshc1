<?php

namespace App\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'comm',
        'donvi',
        'type_payment',
        'validity_start_date',
        'gst',
        'status',
        'unit',
        'policy'
    ];

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }

    public function service(){
    	return $this->belongsTo(Service::class, 'provider_id');
    }
    public function dichvus(){
        return $this->belongsTo(Dichvu::class, 'service_id');
    }
    public function getCom(){
        $com = $this->comm;
        $unit = $this->donvi;
        $configUnit = config('myconfig.donvi');
        $getUnit = (!empty($configUnit[$unit]))?$configUnit[$unit]:'';
        return $com.$getUnit;
    }
    public function getGst(){
        $gst = $this->gst;
        $configGst = config('myconfig.gst');
        $getGst = (!empty($configGst[$gst]))?$configGst[$gst]:'';
        return $getGst;
    }
    public function getTypePayment(){
        $type_payment = $this->type_payment;
        $configTypePayment = config('myconfig.type_payment');
        $getTypePayment = (!empty($configTypePayment[$type_payment]))?$configTypePayment[$type_payment]:'';
        return $getTypePayment;
    }
}
