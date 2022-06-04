<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hoahong extends Model
{
    protected $guard_name = 'hoahongs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'apply_id',
        'policy_status',
        'policy_no',
        'issue_date',
    ];
}
