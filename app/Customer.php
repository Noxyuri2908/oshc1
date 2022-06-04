<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Apply;

class Customer extends Model
{
    protected $guard_name = 'customers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'apply_id',
        'first_name',
        'last_name',
        'exchange_rate',
    ];

    public function phone()
    {
        return $this->hasOne(Apply::class, 'apply_id');
    }
}
