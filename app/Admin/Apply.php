<?php

namespace App\Admin;

use App\Admin;
use App\Admin\Customer;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Phieuthu;
use App\Admin\Commission;
use App\Admin\ProviderCom;
use App\Info;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Exception;
use function foo\func;


class Apply extends Model
{
    use Filterable;
    protected $fillable = [
        'agent_id',
        'master_agent',
        'note',
        'service_country',
        'type_service',
        'type_invoice',
        'policy',
        'provider_id',
        'no_of_adults',
        'no_of_children',
        'type_visa',
        'start_date',
        'end_date',
        'net_amount',
        'ref_no',
        'promotion_id',
        'promotion_amount',
        'status',
        'type_extra',
        'bank_fee',
        'gst',
        'surcharge',
        'extra',
        'comm',
        'total',
        'staff_id',
        'payment_method',
        'invoice_code',
        'location_australia',
        'bank_fee_number',
        'remind_status',
        'has_email',
        'education_email_agent',
        'amount_from',
        'amount_from_unit',
        'payment_come_from',
        'amount_to',
        'amount_to_unit',
        'payment_type',
        'initiated_date',
        'std_id',
        'type_of_payment_fw',
        'type_get_data_payment',
        'processing_date_remind',
        'remind_note',
        'customer_manager_id',
        'invoice_code_link',
        'delivered_date',
        'type_payment_agent_id',
        'gst_agent_id',
        'count_month',
        'count_day',
        'hospital_id'
    ];

    public function flywireColumn()
    {
        //return [
        //    'ref_no',
        //    'invoice_code',
        //    'agent_id',
        //    'full_name',
        //    'email',
        //    'status',
        //    ''
        //];
    }

    public function applyLink()
    {
        return $this->hasOne(static::class, 'ref_no', 'invoice_code_link');
    }

    public function hospital(){
        return $this->hasOne(HospitalAccess::class,'id', 'hospital_id');
    }

    public function task()
    {
        return $this->hasMany('App\Admin\Support', 'apply_id');
    }

    public function registerCus()
    {
        return (!empty($this->customers)) ? $this->customers->first() : [];
        //        return Customer::where('apply_id', $this->id)->where('type', 1)->first();
    }

    public function partners()
    {
        return (!empty($this->customers)) ? $this->customers->where('type', 2) : [];
        //        return Customer::where('apply_id', $this->id)->where('type', 2)->get();
    }

    public function childrens()
    {
        return (!empty($this->customers)) ? $this->customers->where('type', 3) : [];
        //        return Customer::where('apply_id', $this->id)->where('type', 3)->get();
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function agentMaster()
    {
        return $this->belongsTo(User::class, 'master_agent');
    }

    public function getAgentName()
    {
        $agent_id = $this->agent_id;
        return (!empty($agent_id)) ? User::findOrFail($agent_id)->name : '';
    }

    public function getAddressAgent()
    {
        $agent_id = $this->agent_id;
        return (!empty($agent_id)) ? User::findOrFail($agent_id)->office : '';
    }

    public function getOfficeAgent()
    {
        $agent_id = $this->agent_id;
        return (!empty($agent_id)) ? User::findOrFail($agent_id)->office : '';
    }

    public function getProvidersByService()
    {
        $data = !empty($this->service) && !empty($this->service->providers) ? $this->service->providers : '';
        return $data;
    }

    public function getAgentEmail()
    {
        $agent_id = $this->agent_id;
        return (!empty($agent_id)) ? User::findOrFail($agent_id)->email : '';
    }

    public function getFullNameCus()
    {
        return (!empty($this->customers) && !empty($this->customers->first())) ? $this->customers->first()->full_name : '';
    }

    public function getPaymentStatusFlywire()
    {
        $config = \Config::get('myconfig.payment_status');
        $paymentStatus = $this->status;
        return (!empty($config[$paymentStatus])) ? $config[$paymentStatus] : '';
    }

    public function getPayComeFrom()
    {
        $config = \Config::get('country.list');
        $paymentComeForm = $this->payment_come_from;
        return (!empty($config[$paymentComeForm])) ? $config[$paymentComeForm] : '';
    }

    public function getGenderCus()
    {
        $config = \Config::get('myconfig.gender');
        $gender = (!empty($this->registerCus())) ? $this->registerCus()->gender : '';
        return (!empty($config[$gender])) ? $config[$gender] : '';
    }

    public function getPhoneNo()
    {
        return (!empty($this->registerCus())) ? $this->registerCus()->phone : '';
    }

    public function getEmailCus()
    {
        return (!empty($this->registerCus())) ? $this->registerCus()->email : '';
    }

    public function getPaymentType()
    {
        $config = \Config::get('myconfig.payment_type');
        $paymentType = $this->payment_type;
        return (!empty($config[$paymentType])) ? $config[$paymentType] : '';
    }

    public function getDOB()
    {
        return (!empty($this->registerCus())) ? convert_date_form_db($this->registerCus()->birth_of_date) : '';
    }

    public function getCountry()
    {
        $config = \Config::get('country.list');
        $country = (!empty($this->registerCus())) ? $this->registerCus()->country : '';
        return (!empty($config[$country])) ? $config[$country] : '';
    }

    public function getPaymentMethod()
    {
        $config = \Config::get('myconfig.payment_method');
        $paymentMethod = $this->payment_method;
        return (!empty($config[$paymentMethod])) ? $config[$paymentMethod] : '';
    }

    public function statusText()
    {
        $_status = $this->status;
        return isset(config('myconfig.status_invoice')[$_status]) ? config('myconfig.status_invoice')[$_status] : '';
    }

    public function policyName()
    {
        $_policy = $this->policy;
        return isset(config('myconfig.policy')[$_policy]) ? config('myconfig.policy')[$_policy] : '';
    }

    public function getProviderName()
    {
        $_provider = $this->provider_id;
        if ($_provider == null) {
            return '';
        }
        return Service::findOrFail($_provider)->name;
    }

    public function visaName()
    {
        $_visa = $this->type_visa;
        return isset(config('myconfig.type_visa')[$_visa]) ? config('myconfig.type_visa')[$_visa] : '';
    }

    public function comms()
    {
        return $this->hasMany(Commission::class, 'user_id', 'agent_id');
    }

    public function getCom()
    {
        $result = (!empty($this->comms) && !empty($this->hoahong)) ? $this->comms
            ->where('policy', $this->policy)
            ->where('provider_id', $this->provider_id)
            ->where('validity_start_date', '<', $this->hoahong->issue_date)
            ->sortByDesc('validity_start_date')
            ->first() : [];
        if (!empty($result)) {
            $result->display = $result->getCom();
        }
        return $result;
    }

    public function getComFlywire()
    {
        return (!empty($this->comms)) ? $this->comms
            ->where('provider_id', $this->provider_id)
            ->where('validity_start_date', '<', $this->initiated_date)
            ->sortByDesc('validity_start_date')
            ->first() : [];
    }

    public function calCom()
    {
        $comm = Commission::where('user_id', $this->agent_id)
            ->where('type', $this->policy)
            ->where('type_service', $this->provider_id)
            ->first();
        if ($comm == null) {
            return 0;
        }
    }

    public function getDestination()
    {
        return !empty($this->registerCus()) && !empty($this->registerCus()->destination) && !empty(config('country.list')[$this->registerCus()->destination]) ? config('country.list')[$this->registerCus()->destination] : '';
    }

    public function getProviderCom()
    {
        return (!empty($this->provider_com)) ? $this->provider_com->where('provider_id', $this->provider_id)
            ->first() : [];
        //        return ProviderCom::where('policy', $this->policy)
        //            ->where('provider_id', $this->provider_id)
        //            ->first();
    }

    public static function getProviderComFlywire($provider_id, $delivered_date)
    {
        if (empty($provider_id) || !$provider_id)
        {
            return [];
        }
        $results = DB::select('select `amount` from `provider_coms` where `provider_id` = :provider_id and CAST(`validity_date` AS date) <  :delivered_date limit 1', ['provider_id' => $provider_id, 'delivered_date' => $delivered_date]);
        return (count($results) > 0) ? $results[0]->amount : 0;
    }

    public function provider_com()
    {
        return $this->hasMany(ProviderCom::class, 'policy', 'policy');
    }

    public function phieuthus()
    {
        return $this->hasMany('App\Admin\Phieuthu');
    }

    public function tailieus()
    {
        return $this->hasMany(Tailieu::class);
    }

    public function hhs()
    {
        return $this->hasMany('App\Admin\Hoahong', 'apply_id');
    }

    public function profit()
    {
        return $this->hasMany(Profit::class, 'apply_id');
    }

    public function refund()
    {
        return $this->hasMany('App\Admin\Refund', 'apply_id');
    }

    public function hoahongs()
    {
        return $this->hasMany(Hoahong::class, 'apply_id');
    }

    public function hoahong()
    {
        return $this->hasOne(Hoahong::class, 'apply_id', 'id');
    }

    public function gethh()
    {
        return $this->hoahongs->first();
    }

    public function getPaymentNoteHH()
    {
        $payment_note = $this->hoahongs->first()->payment_note_provider;
        return (!empty($payment_note) && !empty(config('myconfig.payment_note_provider')[$payment_note])) ? config('myconfig.payment_note_provider')[$payment_note] : '';
    }

    public function staff()
    {
        return $this->belongsTo('App\Admin', 'staff_id');
    }

    public function promotion()
    {
        return $this->belongsTo( Promotion::class,'promotion_id');
    }

    public function master()
    {
        return $this->belongsTo('App\User', 'master_agent');
    }

    public function provider()
    {
        return $this->belongsTo(Service::class, 'provider_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Admin\Dichvu', 'type_service');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id', 'apply_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'apply_id');
    }

    public function getCountDay()
    {
        $startDate = $this->start_date;
        $endDate = $this->end_date;
        if (!empty($startDate) && !empty($endDate)) {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
            $days = $startDate->diffInDays($endDate) + 1;
            return $days;
        }
        return '';
    }

    public function getCountMonth()
    {
        $startDate = $this->start_date;
        $endDate = $this->end_date;
        if (!empty($startDate) && !empty($endDate)) {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
            $months = $startDate->diffInMonths($endDate);
            return $months;
        }
        return '';
    }

    public static function getFlywireList($request, $per_page)
    {
        $getChildUser = getChildUser('flywire');
        $flywires = static::when(
            $request->get('full_name') ||
            $request->get('country') ||
            $request->get('school_id') ||
            $request->get('birth_of_date') ||
            $request->get('phone') ||
            $request->get('gender') ||
            $request->get('email')
                , function ($query) use ($request) {
                $query->join('customers', function ($customer) use ($request) {
                $customer
                    ->on('applies.id', '=', 'customers.apply_id')
                    ->when($request->get('full_name'), function ($query) use ($request) {
                        $query->where('customers.full_name', 'LIKE', '%'.$request->get('full_name').'%');
                    })
                    ->when($request->get('country'), function ($query) use ($request) {
                        $query->where('customers.country', $request->get('country'));
                    })
                    ->when($request->get('school_id'), function ($query) use ($request) {
                        $query->where('customers.place_study', $request->get('school_id'));
                    })
                    ->when($request->get('birth_of_date'), function ($query) use ($request) {
                        $query->whereDate('customers.birth_of_date', convert_date_to_db($request->get('birth_of_date')));
                    })
                    ->when($request->get('phone'), function ($query) use ($request) {
                        $query->where('customers.phone', 'LIKE', '%'.$request->get('phone').'%');
                    })
                    ->when($request->get('gender'), function ($query) use ($request) {
                        $query->where('customers.gender', $request->get('gender'));
                    })
                    ->when($request->get('email'), function ($query) use ($request) {
                        $query->where('customers.email', 'LIKE', '%'.$request->get('email').'%');
                    });
            });
            })
            ->when(
                $request->get('f_department') ||
                $request->get('paid_com_date_agent_cp') ||
                $request->get('provider_paid_date_cp') ||
                $request->get('agent_email')
                , function ($query) use ($request) {
                $query->join('users', function ($user) use ($request) {
                    $user
                        ->on('applies.agent_id', '=', 'users.id')
                        ->when($request->get('f_department'), function ($query) use ($request) {
                            $query->where('users.department', $request->get('f_department'));
                        })
                        ->when($request->get('paid_com_date_agent_cp'), function ($query) use ($request) {
                            $query->whereDate('users.paid_com_date_agent_cp', convert_date_to_db($request->get('paid_com_date_agent_cp')));
                        })
                        ->when($request->get('provider_paid_date_cp'), function ($query) use ($request) {
                            $query->whereDate('users.provider_paid_date_cp', convert_date_to_db($request->get('provider_paid_date_cp')));
                        })
                        ->when($request->get('agent_email'), function ($query) use ($request) {
                            $query->where('users.email', 'LIKE', '%'.$request->get('agent_email').'%');
                        });
                });
            })
            ->when($request->get('comstatus'),
                function ($query) use ($request){
                    $query->leftJoin('profits', function ($q) use ($request){
                       $q->on('profits.apply_id', '=', 'applies.id');
                    });
            })
            ->when($request->get('f_country'), function ($query) use ($request) {
                $query->where('payment_come_from', $request->get('f_country'));
            })->when($request->get('f_time'), function ($query) use ($request) {
                $query->whereBetween('initiated_date', dateRangePicker($request->get('f_time')));
            })->when($request->get('f_time_start') && $request->get('f_time_end'), function ($query) use ($request) {
                $query->whereBetween('initiated_date', [
                    convert_date_to_db($request->get('f_time_start')),
                    convert_date_to_db($request->get('f_time_end')),
                ]);
            })
            ->when($request->get('f_period'), function ($query) use ($request) {
                if ($request->get('f_period') == 1) {
                    $query->where('initiated_date', Carbon::now()->format('Y-m-d'));
                } else {
                    if ($request->get('f_period') == 2) {
                        $query->whereBetween('initiated_date', [
                            Carbon::now()->format('Y-m-d'),
                            Carbon::now()->subWeek(1)->format('Y-m-d'),
                        ]);
                    } else {
                        if ($request->get('f_period') == 3) {
                            $query->whereBetween('initiated_date', [
                                Carbon::now()->format('Y-m-d'),
                                Carbon::now()->subMonth(1)->format('Y-m-d'),
                            ]);
                        } else {
                            if ($request->get('f_period') == 4) {
                                $query->whereBetween('initiated_date', [
                                    Carbon::now()->format('Y-m-d'),
                                    Carbon::now()->subYear(1)->format('Y-m-d'),
                                ]);
                            } else {
                                if ($request->get('f_period') == 't01') {
                                    $query->whereBetween('initiated_date', [
                                        date('Y-01-01'),
                                        Carbon::parse(date('Y-01-01'))->endOfMonth(),
                                    ]);
                                } else {
                                    if ($request->get('f_period') == 't02') {
                                        $query->whereBetween('initiated_date', [
                                            date('Y-02-01'),
                                            Carbon::parse(date('Y-02-01'))->endOfMonth(),
                                        ]);
                                    } else {
                                        if ($request->get('f_period') == 't03') {
                                            $query->whereBetween('initiated_date', [
                                                date('Y-03-01'),
                                                Carbon::parse(date('Y-03-01'))->endOfMonth(),
                                            ]);
                                        } else {
                                            if ($request->get('f_period') == 't04') {
                                                $query->whereBetween('initiated_date', [
                                                    date('Y-04-01'),
                                                    Carbon::parse(date('Y-04-01'))->endOfMonth(),
                                                ]);
                                            } else {
                                                if ($request->get('f_period') == 't05') {
                                                    $query->whereBetween('initiated_date', [
                                                        date('Y-05-01'),
                                                        Carbon::parse(date('Y-05-01'))->endOfMonth(),
                                                    ]);
                                                } else {
                                                    if ($request->get('f_period') == 't06') {
                                                        $query->whereBetween('initiated_date', [
                                                            date('Y-06-01'),
                                                            Carbon::parse(date('Y-06-01'))->endOfMonth(),
                                                        ]);
                                                    } else {
                                                        if ($request->get('f_period') == 't07') {
                                                            $query->whereBetween('initiated_date', [
                                                                date('Y-07-01'),
                                                                Carbon::parse(date('Y-07-01'))->endOfMonth(),
                                                            ]);
                                                        } else {
                                                            if ($request->get('f_period') == 't08') {
                                                                $query->whereBetween('initiated_date', [
                                                                    date('Y-08-01'),
                                                                    Carbon::parse(date('Y-08-01'))->endOfMonth(),
                                                                ]);
                                                            } else {
                                                                if ($request->get('f_period') == 't09') {
                                                                    $query->whereBetween('initiated_date', [
                                                                        date('Y-09-01'),
                                                                        Carbon::parse(date('Y-09-01'))->endOfMonth(),
                                                                    ]);
                                                                } else {
                                                                    if ($request->get('f_period') == 't10') {
                                                                        $query->whereBetween('initiated_date', [
                                                                            date('Y-10-01'),
                                                                            Carbon::parse(date('Y-10-01'))
                                                                                ->endOfMonth(),
                                                                        ]);
                                                                    } else {
                                                                        if ($request->get('f_period') == 't11') {
                                                                            $query->whereBetween('initiated_date', [
                                                                                date('Y-11-01'),
                                                                                Carbon::parse(date('Y-11-01'))
                                                                                    ->endOfMonth(),
                                                                            ]);
                                                                        } else {
                                                                            if ($request->get('f_period') == 't12') {
                                                                                $query->whereBetween('initiated_date', [
                                                                                    date('Y-12-01'),
                                                                                    Carbon::parse(date('Y-12-01'))
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
            })
            ->when($request->get('ref_no'), function ($query) use ($request) {
                $query->where('ref_no', 'LIKE', '%'.$request->get('ref_no').'%');
            })
            ->when($request->get('invoice_code'), function ($query) use ($request) {
                $query->where('invoice_code', 'LIKE', '%'.$request->get('invoice_code').'%');
            })->when($request->get('agent_id'), function ($query) use ($request) {
                $query->where('agent_id', $request->get('agent_id'));
            })

            ->when($request->get('status'), function ($query) use ($request) {
                $query->where('status', $request->get('status'));
            })
            ->when($request->get('f_status'), function ($query) use ($request) {
                $query->where('status', $request->get('f_status'));
            })
            ->when($request->get('payment_come_from'), function ($query) use ($request) {
                $query->where('payment_come_from', $request->get('payment_come_from'));
            })
            ->when($request->get('payment_type'), function ($query) use ($request) {
                $query->where('payment_type', $request->get('payment_type'));
            })
            ->when($request->get('note'), function ($query) use ($request) {
                $query->where('note', 'LIKE', '%'.$request->get('note').'%');
            })
            ->when($request->get('initiated_date'), function ($query) use ($request) {
                $query->whereDate('initiated_date', convert_date_to_db($request->get('initiated_date')));
            })
            ->when($request->get('staff_id'), function ($query) use ($request) {
                $query->where('staff_id', $request->get('staff_id'));
            })
            ->when($request->get('created_at'), function ($query) use ($request) {
                $query->whereDate('created_at', convert_date_to_db($request->get('created_at')));
            })
            ->when($request->get('comstatus'), function ($query) use ($request){
                $query->where('profits.com_status_cp', $request->get('comstatus'));
            })
            ->when($request->get('delivered_start_date') && $request->get('delivered_end_date'), function ($query) use ($request) {
                $query->whereBetween('delivered_date', [
                    convert_date_to_db($request->get('delivered_start_date')),
                    convert_date_to_db($request->get('delivered_end_date')),
                ]);
            })
            ->when($request->get('promotion_id'), function ($query, $request){
                $query->join('promotions', function ($user) use ($request) {
                    $user
                        ->on('applies.promotion_id', '=', 'promotions.id')
                        ->when($request->get('promotion_id'), function ($query) use ($request) {
                            $query->where('promotions.id', $request->get('promotion_id'));
                        });
                });
            })
            ->with([
                'profit' => function ($q) {
                    $q->select([
                        'id',
                        'apply_id',
                        'com_from_provider_cp',
                        'exchange_in_aud_cp',
                        'com_in_aud_cp',
                        'provider_paid_date_cp',
                        'com_agent_cp',
                        'com_for_agent_aud_cp',
                        'exchange_rate_cp',
                        'com_for_agent_vnd_cp',
                        'paid_com_date_agent_cp',
                        'com_status_cp',
                        'profit_aud_cp',
                        'profit_vnd_cp',
                    ]);
                },
                'customers' => function ($q) {
                    $q->select([
                        'apply_id',
                        'place_study',
                        'country',
                        'email',
                        'type',
                        'id',
                        'full_name',
                    ]);
                },
                'agent' => function ($q) {
                    $q->select([
                        'id',
                        'name',
                        'email',
                    ]);
                },
            ])
            ->where('payment_method', 4)
            ->where('type_get_data_payment', 2)
            ->orderBy('initiated_date', 'desc');
        if($request->get('agent_id') == "0"){
            $flywires->whereNull('agent_id');
        }elseif($request->get('agent_id')){
            $flywires->where('agent_id', $request->get('agent_id'));
        }

        if($request->get('agent_id_filter') == "0"){
            $flywires->whereNull('agent_id');
        }elseif($request->get('agent_id_filter')){
            $flywires->where('agent_id', $request->get('agent_id_filter'));
        }

        if ($getChildUser['permissionSee']->contains(3)) {
            $flywires->where('staff_id', $getChildUser['admin']->id);
        } elseif ($getChildUser['permissionSee']->contains(2)) {
            $flywires->whereIn('staff_id', $getChildUser['getAllAdminDepartment']);
        }
         $result = $flywires->select([
                'ref_no',
                'invoice_code',
                'status',
                'payment_come_from',
                'payment_type',
                'note',
                'applies.created_at',
                'payment_method',
                'type_get_data_payment',
                'applies.id',
                'promotion_id',
                'agent_id',
                'staff_id',
                'initiated_date',
                'amount_from',
                'amount_from_unit',
                'amount_to',
                'amount_to_unit',
                'delivered_date',
            ]);

        if ($per_page == 0)
        {
            return $result->get();
        }

        if ($request->get('comstatus'))
        {
            return $result->paginate($result->count());
        }

        return $result->paginate($per_page);
    }

    public static function getFlywireReport($request)
    {
        $flywire = Apply::select(
            'applies.id',
            'applies.agent_id',
            'applies.provider_id',
            'applies.initiated_date',
            'applies.delivered_date',
            'applies.ref_no',
            'applies.amount_to',
            'applies.amount_to_unit',
            'applies.amount_from_unit',
            'applies.payment_method',
            'applies.type_get_data_payment',
            'customers.full_name',
            'promotions.amount',
            'profits.com_status_cp')
            ->join('customers', 'customers.apply_id', '=', 'applies.id')
            ->leftJoin('promotions', 'promotions.id', '=', 'applies.promotion_id')
            ->leftJoin('profits', 'profits.apply_id', '=', 'applies.id')
            ->where('applies.payment_method', 4)
            ->where('applies.type_get_data_payment', 2)
            ->when($request->get('agent_id'), function ($query) use ($request) {
                $query->where('applies.agent_id',  '=',  $request->get('agent_id'));
            })
            ->whereBetween('applies.delivered_date', [
                convert_date_to_db($request->get('start_date')),
                convert_date_to_db($request->get('end_date')),
            ])
            ->groupBy(
                'applies.id',
                'applies.agent_id',
                'applies.provider_id',
                'applies.initiated_date',
                'applies.delivered_date',
                'applies.ref_no',
                'applies.amount_to',
                'applies.amount_to_unit',
                'applies.payment_method',
                'applies.type_get_data_payment',
                'customers.full_name',
                'promotions.amount',
                'profits.com_status_cp'
            )
            ->orderBy('applies.initiated_date', 'ASC')->get();
        foreach ($flywire as $items)
        {
            $obj = getComm($items->agent_id, $items->provider_id, $items->initiated_date);
            $items['comm'] = $obj;
        }
        return $flywire;
    }

    public static function getApplyDataCus($request, $customerIds, $hoahongIds)
    {
        return static::when($request->get('ref_no'), function ($query) use ($request) {
            $query->where('ref_no', 'LIKE', '%'.$request->get('ref_no').'%');
        })
            ->when($request->get('created_at'), function ($query) use ($request) {
                $query->whereDate('created_at', convert_date_to_db($request->get('created_at')));
            })
            ->when($request->get('agent_id'), function ($query) use ($request) {
                $query->where('agent_id', $request->get('agent_id'));
            })

            ->when($request->get('country_id'), function ($query) use ($request) {
                $query->where('service_country', $request->get('country_id'));
            })
            ->when($request->get('register'), function ($query) use ($request, $customerIds) {
                $query->whereIn('id', $customerIds);
            })
            ->when($request->get('status'), function ($query) use ($request, $customerIds) {
                $query->where('status', $request->get('status'));
            })
            ->when($request->get('destination'), function ($query) use ($request, $customerIds) {
                $query->whereIn('id', $customerIds);
            })
            ->when($request->get('email'), function ($query) use ($request, $customerIds) {
                $query->whereIn('id', $customerIds);
            })
            ->when($request->get('master_agent'), function ($query) use ($request) {
                $query->where('master_agent', $request->get('master_agent'));
            })
            ->when($request->get('service_country'), function ($query) use ($request) {
                $query->where('service_country', $request->get('service_country'));
            })
            ->when($request->get('type_service'), function ($query) use ($request) {
                $query->where('type_service', $request->get('type_service'));
            })
            ->when($request->get('type_invoice'), function ($query) use ($request) {
                $query->where('type_invoice', $request->get('type_invoice'));
            })
            ->when($request->get('provider_id'), function ($query) use ($request) {
                $query->where('provider_id', $request->get('provider_id'));
            })
            ->when($request->get('policy'), function ($query) use ($request) {
                $query->where('policy', $request->get('policy'));
            })
            ->when($request->get('type_visa'), function ($query) use ($request) {
                $query->where('type_visa', $request->get('type_visa'));
            })
            ->when($request->get('net_amount'), function ($query) use ($request) {
                $query->where('net_amount', '>=', $request->get('net_amount'));
            })
            ->when($request->get('promotion_id'), function ($query) use ($request) {
                $query->where('promotion_id', $request->get('promotion_id'));
            })
            ->when($request->get('payment_method'), function ($query) use ($request) {
                $query->where('payment_method', $request->get('payment_method'));
            })
            ->when($request->get('policy_number'), function ($query) use ($request, $hoahongIds) {
                $query->whereIn('id', $hoahongIds);
            })
            ->when($request->get('issue_date'), function ($query) use ($request, $hoahongIds) {
                $query->whereIn('id', $hoahongIds);
            })
            ->when($request->get('payment_note'), function ($query) use ($request, $hoahongIds) {
                $query->whereIn('id', $hoahongIds);
            })
            ->when($request->get('staff_id'), function ($query) use ($request) {
                $query->where('staff_id', $request->get('staff_id'));
            })
            ->when($request->get('note'), function ($query) use ($request) {
                $query->where('note', 'LIKE', '%'.$request->get('note').'%');
            })
            ->when($request->get('location_australia') == '0' || $request->get('location_australia'), function ($query) use ($request) {
                $query->where('location_australia', $request->get('location_australia'));
            })
            ->when($request->get('f_department'), function ($query) use ($request) {
                //$query->whereIn('agent_id', $agentIds);
                $query->whereHas('agent', function ($q) use ($request) {
                    $q->where('department', $request->get('f_department'));
                });
            })
            ->when($request->get('f_status'), function ($query) use ($request) {
                $query->where('status', $request->get('f_status'));
            })
            ->when($request->get('f_country'), function ($query) use ($request) {
                $query->where('service_country', $request->get('f_country'));
            })
            ->when($request->get('f_time'), function ($query) use ($request) {
                $query->whereBetween('created_at', dateRangePicker($request->get('f_time')));
            })->when($request->get('f_time_start') && $request->get('f_time_end'), function ($query) use ($request) {
                $query->whereBetween('created_at', [
                    convert_date_to_db($request->get('f_time_start')),
                    convert_date_to_db($request->get('f_time_end')),
                ]);
            })
            ->when($request->get('f_period'), function ($query) use ($request) {
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
                                Carbon::now()->subMonth(1)->format('Y-m-d h:i:s'),
                                Carbon::now()->format('Y-m-d h:i:s'),
                            ]);
                        } else {
                            if ($request->get('f_period') == 4) {
                                $query->whereBetween('created_at', [
                                    Carbon::now()->subYear(1)->format('Y-m-d h:i:s'),
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
                                                                Carbon::parse(date('Y-07-01 h:i:s'))->endOfMonth(),
                                                            ]);
                                                        } else {
                                                            if ($request->get('f_period') == 't08') {
                                                                $query->whereBetween('created_at', [
                                                                    date('Y-08-01 h:i:s'),
                                                                    Carbon::parse(date('Y-08-01 h:i:s'))->endOfMonth(),
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
            })
            ->where('type_get_data_payment', '=', 1)
            ->orderby('created_at', 'desc')
            ->with([
                'customers',
                'agent',
                'hoahongs',
                'master',
                'service',
                'provider',
                'promotion',
                'staff',
            ]);
    }

    public function scopeRegister($query, $request)
    {
        if ($request->has('register')) {
            $query->where('register', 'LIKE', '%'.$request->register.'%');
        }
        return $query;
    }

    public static function getApplyDataExtend($request, $agentIds, $customerIds, $hoahongIds, $promotionIds)
    {
        return static::when($request->get('ref_no'), function ($query) use ($request) {
            $query->where('ref_no', 'LIKE', '%'.$request->get('ref_no').'%');
        })
            ->when($request->get('created_at'), function ($query) use ($request) {
                $query->whereDate('created_at', convert_date_to_db($request->get('created_at')));
            })
            ->when($request->get('agent_id'), function ($query) use ($request) {
                $query->where('agent_id', $request->get('agent_id'));
            })
            ->when($request->get('country_id'), function ($query) use ($agentIds) {
                $query->whereIn('agent_id', $agentIds);
            })
            ->when($request->get('register'), function ($query) use ($request, $customerIds) {
                $query->whereIn('id', $customerIds);
            })
            ->when($request->get('status'), function ($query) use ($request, $customerIds) {
                $query->where('status', $request->get('status'));
            })
            ->when($request->get('email'), function ($query) use ($request, $customerIds) {
                $query->whereIn('id', $customerIds);
            })
            ->when($request->get('master_agent'), function ($query) use ($request) {
                $query->where('master_agent', $request->get('master_agent'));
            })
            ->when($request->get('service_country'), function ($query) use ($request) {
                $query->where('service_country', $request->get('service_country'));
            })
            ->when($request->get('type_service'), function ($query) use ($request) {
                $query->where('type_service', $request->get('type_service'));
            })
            ->when($request->get('type_invoice'), function ($query) use ($request) {
                $query->where('type_invoice', $request->get('type_invoice'));
            })
            ->when($request->get('provider_id'), function ($query) use ($request) {
                $query->where('provider_id', $request->get('provider_id'));
            })
            ->when($request->get('policy'), function ($query) use ($request) {
                $query->where('policy', $request->get('policy'));
            })
            ->when($request->get('type_visa'), function ($query) use ($request) {
                $query->where('type_visa', $request->get('type_visa'));
            })
            ->when($request->get('net_amount'), function ($query) use ($request) {
                $query->where('net_amount', '>=', $request->get('net_amount'));
            })
            ->when($request->get('promotion_id'), function ($query) use ($request) {
                $query->where('promotion_id', $request->get('promotion_id'));
            })
            ->when($request->get('payment_method'), function ($query) use ($request) {
                $query->where('payment_method', $request->get('payment_method'));
            })
            ->when($request->get('policy_number'), function ($query) use ($request, $hoahongIds) {
                $query->whereIn('id', $hoahongIds);
            })
            ->when($request->get('issue_date'), function ($query) use ($request, $hoahongIds) {
                $query->whereIn('id', $hoahongIds);
            })
            ->when($request->get('payment_note'), function ($query) use ($request, $hoahongIds) {
                $query->whereIn('id', $hoahongIds);
            })
            ->when($request->get('staff_id'), function ($query) use ($request) {
                $query->where('staff_id', $request->get('staff_id'));
            })
            ->when($request->get('note'), function ($query) use ($request) {
                $query->where('note', 'LIKE', '%'.$request->get('note').'%');
            })
            ->when($request->get('location_australia') == '0' || $request->get('location_australia'), function ($query) use ($request) {
                $query->where('location_australia', $request->get('location_australia'));
            })
            ->when($request->get('promotion_code'), function ($query) use ($promotionIds) {
                $query->whereIn('promotion_id', $promotionIds);
            })
            ->when($request->get('remind_status'), function ($query) use ($request, $promotionIds) {
                $query->where('remind_status', $request->get('remind_status'));
            })
            ->when($request->get('f_department'), function ($query) use ($request, $agentIds) {
                $query->whereIn('agent_id', $agentIds);
            })
            ->when($request->get('f_status'), function ($query) use ($request) {
                $query->where('status', $request->get('f_status'));
            })
            ->when($request->get('f_country'), function ($query) use ($request) {
                $query->where('service_country', $request->get('f_country'));
            })
            ->when($request->get('f_time'), function ($query) use ($request) {
                $query->whereBetween('created_at', dateRangePicker($request->get('f_time')));
            })->when($request->get('f_time_start') && $request->get('f_time_end'), function ($query) use ($request) {
                $query->whereBetween('created_at', [
                    convert_date_to_db($request->get('f_time_start')),
                    convert_date_to_db($request->get('f_time_end')),
                ]);
            })->when($request->get('f_period'), function ($query) use ($request) {
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
                                Carbon::now()->subMonth(1)->format('Y-m-d h:i:s'),
                                Carbon::now()->format('Y-m-d h:i:s'),
                            ]);
                        } else {
                            if ($request->get('f_period') == 4) {
                                $query->whereBetween('created_at', [
                                    Carbon::now()->subYear(1)->format('Y-m-d h:i:s'),
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
                                                                Carbon::parse(date('Y-07-01 h:i:s'))->endOfMonth(),
                                                            ]);
                                                        } else {
                                                            if ($request->get('f_period') == 't08') {
                                                                $query->whereBetween('created_at', [
                                                                    date('Y-08-01 h:i:s'),
                                                                    Carbon::parse(date('Y-08-01 h:i:s'))->endOfMonth(),
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
            })
            ->where('type_get_data_payment', '=', 1)
            ->orderby('created_at', 'desc')
            ->with([
                'customer',
                'customers',
                'agent.info',
                'hoahongs',
                'master',
                'service',
                'provider',
                'promotion',
                'staff',
            ]);
    }

    public static function getApplyDataCom($request, $customerIds)
    {
        return static::when($request->get('ref_no'), function ($query) use ($request) {
            $query->where('ref_no', 'LIKE', '%'.$request->get('ref_no').'%');
        })->when($request->get('agent_id'), function ($query) use ($request) {
            $query->where('agent_id', $request->get('agent_id'));
        })
            //    ->when($request->get('country_id'), function ($query) use ($agentIds) {
            //    $query->whereIn('agent_id', $agentIds);
            //})
            ->when($request->get('net_amount'), function ($query) use ($request) {
                $query->where('net_amount', '>=', $request->get('net_amount'));
            })->when($request->get('provider_id'), function ($query) use ($request) {
                $query->where('provider_id', $request->get('provider_id'));
            })->when($request->get('status'), function ($query) use ($request, $customerIds) {
                $query->where('status', $request->get('status'));
            })->when($request->get('type_service'), function ($query) use ($request) {
                $query->where('type_service', $request->get('type_service'));
            })->when($request->get('service_country'), function ($query) use ($request) {
                $query->where('service_country', $request->get('service_country'));
            })
            //    ->when($request->get('f_department'), function ($query) use ($request, $agentIds) {
            //    $query->whereIn('agent_id', $agentIds);
            //})
            //    ->when($request->get('f_status'), function ($query) use ($request, $agentIds) {
            //    $query->where('status', $request->get('f_status'));
            //})
            ->when($request->get('f_country'), function ($query) use ($request) {
                $query->where('service_country', $request->get('f_country'));
            })->when($request->get('f_time'), function ($query) use ($request) {
                $query->whereBetween('created_at', dateRangePicker($request->get('f_time')));
            })->when($request->get('f_time_start') && $request->get('f_time_end'), function ($query) use ($request) {
                $query->whereBetween('created_at', [
                    convert_date_to_db($request->get('f_time_start')),
                    convert_date_to_db($request->get('f_time_end')),
                ]);
            })
            ->when($request->get('f_period'), function ($query) use ($request) {
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
                                Carbon::now()->subMonth(1)->format('Y-m-d h:i:s'),
                                Carbon::now()->format('Y-m-d h:i:s'),
                            ]);
                        } else {
                            if ($request->get('f_period') == 4) {
                                $query->whereBetween('created_at', [
                                    Carbon::now()->subYear(1)->format('Y-m-d h:i:s'),
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
                                                                Carbon::parse(date('Y-07-01 h:i:s'))->endOfMonth(),
                                                            ]);
                                                        } else {
                                                            if ($request->get('f_period') == 't08') {
                                                                $query->whereBetween('created_at', [
                                                                    date('Y-08-01 h:i:s'),
                                                                    Carbon::parse(date('Y-08-01 h:i:s'))->endOfMonth(),
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
            })
            ->pluck('id')
            ->unique();
    }

    public static function importByPaymentId($payment_id, $place_id)
    {
        if (!empty($payment_id))
        {
            try {
                $apply_id = Apply::select('id')->where('ref_no', $payment_id)->get();

                if (!empty($apply_id))
                {
                    foreach ($apply_id as $item)
                    {
                        Customer::where('apply_id', $item->id)->update(['place_study' => $place_id]);
                    }
                }
            }catch (\Exception $e)
            {
                echo  $e->getMessage();
            }
        }
        return redirect(route('crm.dashboard'));
    }
}
