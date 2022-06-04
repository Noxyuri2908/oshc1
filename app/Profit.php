<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    protected $guard_name = 'profits';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'pay_agent_bonus',
        'pay_agent_extra',
        'visa_status',
        'apply_id',
    ];
}
