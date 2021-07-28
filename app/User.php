<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Admin;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $fillable = [
        'name',
        'email',
        'status',
        'password',
        'created_by',
        'staff_id',
        'shares',
        'commission_offer',
        'is_default',
        'had_case',
        'first_case_date',
        'note1',
        'note2',
        'potential_service',
        'registered_date',
        'agent_code',
        'rating',
        'country',
        'city',
        'office',
        'department',
        'type_id',
        'market_id',
        'tel_1',
        'tel_2',
        'fb',
        'website',
        'person_in_charge',
        'contact_person',
        'note',
        'type',
        'type_agent'
    ];
    protected $append = [
        'array_shares',
        'list_shares',
        'array_staff',
        'text_status',
        'text_market',
        'type_agent'
    ];

    public function applies()
    {
        return $this->hasMany('App\Admin\Apply');
    }

    public function country()
    {
        $country_id = $this->country;
        return isset(config('country.list')[$country_id]) ? config('country.list')[$country_id] : '';
    }

    public function proccess()
    {
        return $this->hasMany('App\Admin\Support', 'agent_id');
    }

    public function follows()
    {
        return $this->hasMany('App\Admin\Follow', 'user_id');
    }

    public function commission()
    {
        return $this->hasMany('App\Admin\Commission');
    }

    public function contacts()
    {
        return $this->hasMany('App\Admin\Person', 'user_id');
    }
    public function info()
    {
        return $this->hasOne(Info::class);
    }
    public function staff()
    {
        return $this->belongsTo('App\Admin', 'staff_id');
    }
    public function getNote(){
        $info = $this->info()->first();
        return (!empty($info))?$info->note:'';
    }


    public function getAuthorizationAttribute()
    {
        $tmp = $this->attributes['authorization'];
        $res = [];
        if ($tmp != null && $tmp != "") {
            $res = explode(";", $tmp);
        }
        return $res;
    }

    public function getArraySharesAttribute()
    {
        $res = [];
        $tmp = $this->attributes['shares'];
        if ($tmp != null && $tmp != "") {
            $res = explode(";", $tmp);
        }
        return $res;
    }

    public function getListSharesAttribute()
    {
        $res = [];
        $tmp = $this->attributes['shares'];
        if ($tmp != null && $tmp != "") {
            $res = explode(";", $tmp);
        }
        $staffs = Admin::whereIn('id', $res)->get();
        return $staffs;
    }

    public function getArrayStaffAttribute()
    {
        $res = [];
        $tmp = $this->attributes['shares'];
        $asgn = $this->attributes['staff_id'];
        if ($tmp != null && $tmp != "") {
            $res = explode(";", $tmp);
        }
        if ($asgn != null) $res[] = $asgn;
        $staffs = Admin::whereIn('id', $res)->get();
        if ($staffs->count() > 0) $res = $staffs->pluck('id')->all();
        else $res = [];
        return $res;
    }

    public function getTextStatusAttribute()
    {
        $tmp = $this->attributes['status'];
        return isset(config('admin.status')[$tmp]) ? config('admin.status')[$tmp] : '';
    }
    public function getTextMarketAttribute(){
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
    public function getPotentialService($dichvu)
    {
        $potential_service = $this->potential_service;
        if (!empty($potential_service)) {
            if (is_array($potential_service)) {
                $dichvus = $dichvu->whereIn('id', $potential_service)->pluck('name');
                $nameService = '';
                foreach ($dichvus as $key => $dichvu) {
                    $nameService .= $dichvu . (($key + 1 == count($dichvus)) ? '.' : ', ');
                }
                return $nameService;
            } else {
                $dichvus = $dichvu->where('id',$potential_service)->first();
                return $dichvus->name;
            }
        }
        return '';
    }
    public static function getAllAgentCache(){
        $allAgent = cache()->rememberForever('getAllAgentComm',function (){
            return \App\User::with(['info'])->get(['name','id']);
        });
        return $allAgent;
    }
    public function getTextTypeAgentAttribute() {
        $tmp = $this->attributes['type_id'];
        return isset(config('admin.type_agent')[$tmp]) ? config('admin.type_agent')[$tmp] : '';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'potential_service'=>'array',
        'market_id'=>'array'
    ];

    public static function queryExportAgent($request)
    {
        $potential_service_filter = (!empty($request->get('potential_service'))) ? $request->get('potential_service') : [];
        $users = User::when($request->get('name'), function ($query) use ($request) {
            $query->where('name', 'LIKE', $request->get('name').'%');
        })
            ->when($request->get('agent_code'), function ($query) use ($request) {
                $query->where('agent_code', 'LIKE', '%'.$request->get('agent_code').'%');
            })
            ->when($request->get('market_id'), function ($query) use ($request) {
                if ($request->get('market_id')[0] == 'null') {
                    $query->whereNull('market_id');
                } else {
                    $query->whereJsonContains('market_id', $request->get('market_id'));
                }
            })->when($request->get('tel_1'), function ($query) use ($request) {
                $query->where('tel_1', 'LIKE', '%'.$request->get('tel_1').'%');
            })->when($request->get('tel_2'), function ($query) use ($request) {
                $query->where('tel_2', 'LIKE', '%'.$request->get('tel_2').'%');
            })->when($request->get('website'), function ($query) use ($request) {
                $query->where('website', 'LIKE', '%'.$request->get('website').'%');
            })->when($request->get('country'), function ($query) use ($request) {
                if ($request->get('country') == 'null') {
                    $query->whereNull('country');
                } else {
                    $query->where('country', $request->get('country'));
                }
            })->when($request->get('rating'), function ($query) use ($request) {
                if ($request->get('rating') == 'null') {
                    $query->whereNull('rating');
                } else {
                    $query->where('rating', $request->get('rating'));
                }
            })->when($request->get('city'), function ($query) use ($request) {
                $query->where('city', 'LIKE', '%'.$request->get('city').'%');
            })->when($request->get('office'), function ($query) use ($request) {
                $query->where('office', 'LIKE', '%'.$request->get('office').'%');
            })->when($request->get('department') || $request->get('f_department'), function ($query) use ($request) {
                if ($request->get('f_department')) {
                    $query->where('department', $request->get('f_department'));
                } else {
                    if ($request->get('department') == 'null') {
                        $query->whereNull('department');
                    } else {
                        $query->where('department', $request->get('department'));
                    }
                }
            })->when($request->get('registered_date'), function ($query) use ($request) {
                $query->where('registered_date', $request->get('registered_date'));
            })->when($request->get('info_type_id'), function ($query) use ($request) {
                if ($request->get('info_type_id') == 'null') {
                    $query->whereNull('type_id');
                } else {
                    $query->where('type_id', $request->get('info_type_id'));
                }
            })
            ->when($request->get('user_status') || $request->get('f_status'), function ($query) use ($request) {
                if (!empty($request->get('f_status'))) {
                    if($request->get('f_status') != 'all'){
                        $query->where('status', $request->get('f_status'));
                    }
                } elseif (!empty($request->get('user_status'))) {
                    if ($request->get('user_status') == 'null') {
                        $query->whereNull('status');
                    } else {
                        $query->where('status', $request->get('user_status'));
                    }
                }
            })->when($request->get('email'), function ($query) use ($request) {
                $query->where('email', 'LIKE', '%'.$request->get('email').'%');
            })
            ->when($request->get('staff_id'), function ($query) use ($request) {
                if ($request->get('staff_id') == 'null') {
                    $query->whereNull('staff_id');
                } else {
                    $query->where('staff_id', $request->get('staff_id'));
                }
            })
            ->when($request->get('created_at'), function ($query) use ($request) {
                $query->whereDate('created_at', convert_date_to_db($request->get('created_at')));
            })
            ->when($request->get('note1'), function ($query) use ($request) {
                $query->where('note1', 'LIKE', '%'.$request->get('note1').'%');
            })
            ->when($request->get('note2'), function ($query) use ($request) {
                $query->where('note2', 'LIKE', '%'.$request->get('note2').'%');
            })
            ->when($request->get('potential_service') && $request->get('potential_service') != [], function ($query) use ($request, $potential_service_filter) {
                $query->whereJsonContains('potential_service', $potential_service_filter);
            })
            ->when($request->get('f_period') || ($request->get('f_time_start') && $request->get('f_time_end')), function ($query) use ($request) {
                if ($request->get('f_time_start') && $request->get('f_time_end')) {
                    $query->whereBetween('created_at', [
                        convert_date_to_db($request->get('f_time_start').' 00:00:00'),
                        convert_date_to_db($request->get('f_time_end').' 23:59:59'),
                    ]);
                } elseif ($request->get('f_period')) {
                    if ($request->get('f_period') == 1) {
                        $query->where('created_at', Carbon::now()->format('Y-m-d'));
                    } else {
                        if ($request->get('f_period') == 2) {
                            $query->whereBetween('created_at', [
                                Carbon::now()->subWeek(1)->format('Y-m-d h:i:s'),
                                Carbon::now()->format('Y-m-d h:i:s'),
                            ]);
                        } else {
                            if ($request->get('f_period') == 3) {
                                $query->whereBetween('created_at', [
                                    Carbon::now()
                                        ->subMonth(1)
                                        ->format('Y-m-d h:i:s'),
                                    Carbon::now()->format('Y-m-d h:i:s'),
                                ]);
                            } else {
                                if ($request->get('f_period') == 4) {
                                    $query->whereBetween('created_at', [
                                        Carbon::now()
                                            ->subYear(1)
                                            ->format('Y-m-d h:i:s'),
                                        Carbon::now()->format('Y-m-d h:i:s'),
                                    ]);
                                } else {
                                    if ($request->get('f_period') == 't01') {
                                        $query->whereBetween('created_at', [
                                            date('Y-01-01 h:i:s'),
                                            Carbon::parse(date('Y-01-01 h:i:s'))->endOfMonth(),
                                        ]);
                                    } else {
                                        if ($request->get('f_period') == 't02') {
                                            $query->whereBetween('created_at', [
                                                date('Y-02-01 h:i:s'),
                                                Carbon::parse(date('Y-02-01 h:i:s'))->endOfMonth(),
                                            ]);
                                        } else {
                                            if ($request->get('f_period') == 't03') {
                                                $query->whereBetween('created_at', [
                                                    date('Y-03-01 h:i:s'),
                                                    Carbon::parse(date('Y-03-01 h:i:s'))->endOfMonth(),
                                                ]);
                                            } else {
                                                if ($request->get('f_period') == 't04') {
                                                    $query->whereBetween('created_at', [
                                                        date('Y-04-01 h:i:s'),
                                                        Carbon::parse(date('Y-04-01 h:i:s'))->endOfMonth(),
                                                    ]);
                                                } else {
                                                    if ($request->get('f_period') == 't05') {
                                                        $query->whereBetween('created_at', [
                                                            date('Y-05-01 h:i:s'),
                                                            Carbon::parse(date('Y-05-01 h:i:s'))->endOfMonth(),
                                                        ]);
                                                    } else {
                                                        if ($request->get('f_period') == 't06') {
                                                            $query->whereBetween('created_at', [
                                                                date('Y-06-01 h:i:s'),
                                                                Carbon::parse(date('Y-06-01 h:i:s'))->endOfMonth(),
                                                            ]);
                                                        } else {
                                                            if ($request->get('f_period') == 't07') {
                                                                $query->whereBetween('created_at', [
                                                                    date('Y-07-01 h:i:s'),
                                                                    Carbon::parse(date('Y-07-01 h:i:s'))
                                                                        ->endOfMonth(),
                                                                ]);
                                                            } else {
                                                                if ($request->get('f_period') == 't08') {
                                                                    $query->whereBetween('created_at', [
                                                                        date('Y-08-01 h:i:s'),
                                                                        Carbon::parse(date('Y-08-01 h:i:s'))
                                                                            ->endOfMonth(),
                                                                    ]);
                                                                } else {
                                                                    if ($request->get('f_period') == 't09') {
                                                                        $query->whereBetween('created_at', [
                                                                            date('Y-09-01 h:i:s'),
                                                                            Carbon::parse(date('Y-09-01 h:i:s'))
                                                                                ->endOfMonth(),
                                                                        ]);
                                                                    } else {
                                                                        if ($request->get('f_period') == 't10') {
                                                                            $query->whereBetween('created_at', [
                                                                                date('Y-10-01 h:i:s'),
                                                                                Carbon::parse(date('Y-10-01 h:i:s'))
                                                                                    ->endOfMonth(),
                                                                            ]);
                                                                        } else {
                                                                            if ($request->get('f_period') == 't11') {
                                                                                $query->whereBetween('created_at', [
                                                                                    date('Y-11-01 h:i:s'),
                                                                                    Carbon::parse(date('Y-11-01 h:i:s'))
                                                                                        ->endOfMonth(),
                                                                                ]);
                                                                            } else {
                                                                                if ($request->get('f_period') == 't12') {
                                                                                    $query->whereBetween('created_at', [
                                                                                        date('Y-12-01 h:i:s'),
                                                                                        Carbon::parse(date('Y-12-01 h:i:s'))
                                                                                            ->endOfMonth(),
                                                                                    ]);
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            })
            ->when(
                $request->get('user_status') ||
                $request->get('agent_code') ||
                $request->get('market_id') ||
                $request->get('tel_1') ||
                $request->get('tel_2') ||
                $request->get('website') ||
                $request->get('city') ||
                $request->get('office') ||
                $request->get('registered_date') ||
                $request->get('staff_id') ||
                $request->get('department') ||
                $request->get('potential_service')
                , function ($query) {
                $query->orderBy('name');
            })
            ->orderBy('id', 'desc')
            ->get();

        return $users;

    }

    public static function importAgentCode($email, $agentCode)
    {
        DB::table('users')
            ->where('email', $email)
            ->update(['agent_code' => $agentCode]);
    }

    public static function importTypeOfAgent($username)
    {
        DB::table('users')
            ->where('name', $username)
            ->update(['type_id' => 4]);
    }

    public static function removeAgent($agentName)
    {

        DB::table('users')->where('name', 'LIKE', '%'.$agentName.'%')->delete();
    }

    public static function getAgentName($agent_id)
    {
        $result = DB::table('users')->select('name')->where('id', $agent_id)->first();
        return !empty($result) ? $result->name : '';
    }

    public static function updateEmailAgent($agentName, $email)
    {
//        $emailFromDB = DB::table('users')->select('email')->where('email', 'LIKE', '%'.$email.'%')->get();
//        if ($emailFromDB)
//        {
//            dd($emailFromDB);
//        }
//        DB::table('users')->where('name', "$agentName")->update(['email' => $email]);
    }


}
