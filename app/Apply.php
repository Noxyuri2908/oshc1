<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $guard_name = 'applies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'agent_id',
        'type_service',
        'provider_id',
        'policy',
        'no_of_adults',
        'no_of_children',
        'start_date',
        'end_date',
        'total'
    ];

    public function customer()
    {
        return $this->hasOne('App\Customer');
    }

    public function dichvu()
    {
        return $this->hasOne('App\Dichvu', 'id','type_service');
    }

    public function service()
    {
        return $this->hasOne('App\Service', 'id', 'provider_id');
    }

    public function hoahong()
    {
        return $this->hasOne('App\Hoahong');
    }

    public function profit()
    {
        return $this->hasOne('App\Profit','apply_id', 'id');
    }

    public function commission()
    {
        return $this->hasOne('App\Commission', 'user_id', 'agent_id');
    }
}
