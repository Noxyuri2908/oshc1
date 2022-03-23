<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    static function getIdByNameService($service_name)
    {
        if (!empty($service_name))
        {
            $service = DB::table('dichvus')->select('id')->where('name', $service_name)->first();
            return !empty($service) ? $service->id : '';
        }

        return '';
    }
}
