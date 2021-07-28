<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Dichvu extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type_form',
        'pos',
        'status',
        'viettat',
    ];

    public function providers()
    {
        return $this->hasMany(Service::class);
    }
}
