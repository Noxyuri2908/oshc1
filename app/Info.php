<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Info extends Model
{
    protected $fillable = [
        'user_id',
        'registered_date',
        'agent_code',
        'status',
        'rating',
        'country',
        'city',
        'office',
        'tel_1',
        'tel_2',
        'fb',
        'type',
        'website',
        'contact_person',
        'person_in_charge',
        'note',
        'department',
        'type_agent',
        'type_id',
        'market_id',
    ];

    protected $append = ['person_charge', 'text_status', 'text_type_agent', 'text_market', 'text_department', 'text_country'];

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
    public function person(){
        return $this->belongsTo('App\Admin\Person','contact_person');
    }
    public function getPersonChargeAttribute() {
    	$tmp = $this->attributes['person_in_charge'];
    	if ($tmp != null && $tmp != "") {
    		$tmp = User::find($tmp);
    	}
    	return $tmp;
    }

    public function getTextStatusAttribute() {
        $tmp = $this->attributes['status'];
        return isset(config('admin.status')[$tmp]) ? config('admin.status')[$tmp] : '';
    }

    public function getTextTypeAgentAttribute() {
        $tmp = $this->attributes['type_id'];
        return isset(config('admin.type_agent')[$tmp]) ? config('admin.type_agent')[$tmp] : '';
    }

    public function getTextMarketAttribute() {
        $tmp = $this->attributes['market_id'];
        $values = '';
        $arrayValue = json_decode($tmp);
        if(is_array($arrayValue)){
            foreach($arrayValue as $key => $one){
                if(isset(config('myconfig.market')[$one])){
                    $values .= ($key+1 != count($arrayValue))?config('myconfig.market')[$one].',':config('myconfig.market')[$one];
                }
            }
            return $values;
        }else{
            return ;
        }
    }

    public function getTextDepartmentAttribute() {
        $tmp = $this->attributes['department'];
        return isset(config('myconfig.department')[$tmp]) ? config('myconfig.department')[$tmp] : '';
    }

    public function getTextCountryAttribute() {
        $tmp = $this->attributes['country'];
        return isset(config('country.list')[$tmp]) ? config('country.list')[$tmp] : '';
    }
    public static function getApplyDataCus($request){
        return static::when($request->get('country_id'), function ($query) use ($request) {
            $query->where('country', $request->get('country_id'));
        })->when($request->get('f_department'), function ($query) use ($request) {
            $query->where('department', $request->get('f_department'));
        })->pluck('user_id');
    }
    public static function getApplyDataExtend($request){
        return static::when($request->get('country_id'), function ($query) use ($request) {
            $query->where('country', $request->get('country_id'));
        })->when($request->get('f_department'), function ($query) use ($request) {
            $query->where('department', $request->get('f_department'));
        })->pluck('user_id');
    }
    public static function getApplyDataCom($request){
        return static::when($request->get('country_id'), function ($query) use ($request) {
            $query->where('country', $request->get('country_id'));
        })->when($request->get('f_department'), function ($query) use ($request) {
            $query->where('department', $request->get('f_department'));
        })
            ->pluck('user_id')
            ->unique();
    }
}
