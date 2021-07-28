<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ExchangRate extends Model
{
    protected $fillable = [
        'month',
        'year',
        'unit',
        'rate',
        'type',
        'created_by',
        'updated_by',
        'quarter_id',
        'unit_to_aud',
        'aud_to_vnd'
    ];

    public function typeName()
    {
        $_type = $this->type;
        return isset(config('myconfig.type_exchange')[$_type]) ? config('myconfig.type_exchange')[$_type] : '';
    }

    public function unitName()
    {
        $_type = $this->unit;
        return isset(config('myconfig.currency')[$_type]) ? config('myconfig.currency')[$_type] : '';
    }

    public function staffCreate()
    {
        return $this->belongsTo('App\Admin', 'created_by');
    }

    public function staffUpdate()
    {
        return $this->belongsTo('App\Admin', 'updated_by');
    }
}
