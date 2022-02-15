<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class HospitalAccess extends Model
{
    //
    protected $fillable = [
        'hostpital_access', 'service_id', 'policy'
    ];
}
