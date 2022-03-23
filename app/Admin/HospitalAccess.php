<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HospitalAccess extends Model
{
    //
    protected $fillable = [
        'hostpital_access', 'service_id', 'policy'
    ];

    static function getIdByName($name)
    {
        if (!empty($name))
        {
            $hospital = DB::table('hospital_accesses')->select('id')->where('hostpital_access', $name)->first();
            return !empty($hospital) ? $hospital->id : '';
        }

        return '';
    }
}
