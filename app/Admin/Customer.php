<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'apply_id',
        'prefix_name',
        'first_name',
        'last_name',
        'gender',
        'birth_of_date',
        'passport',
        'country',
        'place_study',
        'student_id',
        'phone',
        'email',
        'fb',
        'is_locate',
        'education_agent',
        'agent_code',
        'type',
        'full_name',
        'provider_of_school',
        'destination',
        'exchange_rate',
        'extend_fee',
        'cover_id'
    ];

    protected $append = ['dateB', 'monthB', 'yearB'];

    public function apply()
    {
        return $this->belongsTo('App\Admin\Apply');
    }

    public function cover(){
        return $this->hasOne('App\Cover', 'id', 'cover_id');
    }

    public function getDateBAttribute()
    {
        $tmp = $this->attributes['birth_of_date'];
        if ($tmp != null && $tmp != "") {
            $tmp = explode("/", $tmp);
            if (sizeof($tmp) == 3) {
                return $tmp[0];
            }
        } else {
            return '';
        }
        return '';
    }

    public function getMonthBAttribute()
    {
        $tmp = $this->attributes['birth_of_date'];
        if ($tmp != null && $tmp != "") {
            $tmp = explode("/", $tmp);
            if (sizeof($tmp) == 3) {
                return $tmp[1];
            }
        } else {
            return '';
        }
        return '';
    }

    public function getYearBAttribute()
    {
        $tmp = $this->attributes['birth_of_date'];
        if ($tmp != null && $tmp != "") {
            $tmp = explode("/", $tmp);
            if (sizeof($tmp) == 3) {
                return $tmp[2];
            }
        } else {
            return '';
        }
        return '';
    }

    public static function getApplyDataCus($request)
    {
        return static::when($request->get('register'), function ($query) use ($request) {
            $query
                ->where('first_name', 'LIKE', '%'.$request->get('register').'%')
                ->orWhere('last_name', 'LIKE', '%'.$request->get('register').'%');
        })->when($request->get('email'), function ($query) use ($request) {
            $query->where('email', 'LIKE', '%'.$request->get('email').'%');
        })->when($request->get('destination'), function ($query) use ($request) {
            $query->where('destination',$request->get('destination'));
        })->pluck('apply_id')->unique();
    }

    public static function getApplyDataCom($request)
    {
        return static::when($request->get('register'), function ($query) use ($request) {
            $query
                ->where('first_name', 'LIKE', '%'.$request->get('register').'%')
                ->orWhere('last_name', 'LIKE', '%'.$request->get('register').'%');
        })->when($request->get('email'), function ($query) use ($request) {
            $query
                ->where('email', 'LIKE', '%'.$request->get('email').'%');
        })->pluck('apply_id')->unique();
    }

    public static function getApplyDataExtend($request)
    {
        return static::when($request->get('register'), function ($query) use ($request) {
            $query
                ->where('first_name', 'LIKE', '%'.$request->get('register').'%')
                ->orWhere('last_name', 'LIKE', '%'.$request->get('register').'%');
        })->when($request->get('email'), function ($query) use ($request) {
            $query
                ->where('email', 'LIKE', '%'.$request->get('email').'%');
        })->pluck('apply_id')->unique();
    }
}
