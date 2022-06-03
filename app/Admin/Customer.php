<?php

namespace App\Admin;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Filterable;

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
        'cover_id',
        's_live_in_AS',
        'person_counsellor_id'
    ];

    protected $append = ['dateB', 'monthB', 'yearB'];

    public function apply()
    {
        return $this->belongsTo('App\Admin\Apply');
    }

    public function cover()
    {
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
                ->where('first_name', 'LIKE', '%' . $request->get('register') . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->get('register') . '%');
        })->when($request->get('email'), function ($query) use ($request) {
            $query->where('email', 'LIKE', '%' . $request->get('email') . '%');
        })->when($request->get('destination'), function ($query) use ($request) {
            $query->where('destination', $request->get('destination'));
        })->pluck('apply_id')->unique();
    }

    public static function getApplyDataCom($request)
    {
        return static::when($request->get('register'), function ($query) use ($request) {
            $query
                ->where('first_name', 'LIKE', '%' . $request->get('register') . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->get('register') . '%');
        })->when($request->get('email'), function ($query) use ($request) {
            $query
                ->where('email', 'LIKE', '%' . $request->get('email') . '%');
        })->pluck('apply_id')->unique();
    }

    public static function getApplyDataExtend($request)
    {
        return static::when($request->get('register'), function ($query) use ($request) {
            $query
                ->where('first_name', 'LIKE', '%' . $request->get('register') . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->get('register') . '%');
        })->when($request->get('email'), function ($query) use ($request) {
            $query
                ->where('email', 'LIKE', '%' . $request->get('email') . '%');
        })->pluck('apply_id')->unique();
    }

    static function importDataByExcelFile($items, $idApply)
    {
        $data = [];
        $data['apply_id'] = $idApply;
        $data['prefix_name'] = $items['title'];
        $data['first_name'] = $items['first_name'];
        $data['last_name'] = $items['last_name'];
        $data['gender'] = getKeyConfigByValue(config('myconfig.gender'), $items['gender']);
        $data['birth_of_date'] = convert_date_to_db($items['date_of_birth']);
        $data['country'] = getKeyConfigByValue(config('country.list'), $items['nationality']);
        $data['destination'] = getKeyConfigByValue(config('country.list'), $items['destination']);
        $data['provider_of_school'] = $items['oshc_provider_of_school'];
        $data['email'] = $items['email'];
        $data['school'] = $items['provider_of_school'];
        $data['student_id'] = $items['std_id'];
        $data['facebook'] = $items['facebook'];
        $data['phone'] = $items['mobile_no'];
        $data['s_live_in_AS'] = getKeyConfigByValue(config('myconfig.live_in_AS'), $items['is_the_student_already_living_in_australia']);
        $data['location_australia'] = getKeyConfigByValue(config('location_australia'), $items['location_australia']);
        $data['extend_fee'] = convert_price_float($items['extend_fee']);
        Customer::insert($data);
        return;
    }
}
