<?php

namespace App\Admin;

use App\ModelFilters\Admin\HoahongFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Hoahong extends Model
{
    use Filterable;
    protected $fillable = [
        'apply_id',
        'com_payment_method',
        'policy_no',
        'visa_status',
        'hoahong_month',
        'hoahong_year',
        'issue_date',
        'policy_status',
        'date_payment_provider',
        'payment_note_provider',
        'date_payment_agent',
        'account_bank',
        'note',
        'extra_money',
        'extra_time',
        'unit_money',
        'admin_create',
        'admin_update'
    ];

    public function invoice()
    {
        return $this->belongsTo(Apply::class, 'apply_id');
    }

    public function creater()
    {
        return $this->belongsTo('App\Admin', 'admin_create');
    }

    public function updater()
    {
        return $this->belongsTo('App\Admin', 'admin_update');
    }

    public function getPolicyStatusName()
    {
        if ($this->policy_status == null) {
            return;
        }
        return \Config::get('myconfig.policy_status')[$this->policy_status];
    }

    public static function getApplyDataCus($request)
    {
        return static::when($request->get('policy_number'), function ($query) use ($request) {
            $query->where('policy_no', 'LIKE', '%' . $request->get('policy_number') . '%');
        })->when($request->get('issue_date'), function ($query) use ($request) {
            $query->whereDate('issue_date', convert_date_to_db($request->get('issue_date')));
        })->when($request->get('payment_note'), function ($query) use ($request) {
            $query->where('payment_note_provider', $request->get('payment_note'));
        })->pluck('apply_id')->unique();
    }

    public static function getApplyDataExtend($request)
    {
        return static::when($request->get('policy_number'), function ($query) use ($request) {
            $query->where('policy_no', 'LIKE', '%' . $request->get('policy_number') . '%');
        })->when($request->get('issue_date'), function ($query) use ($request) {
            $query->whereDate('issue_date', convert_date_to_db($request->get('issue_date')));
        })->when($request->get('payment_note'), function ($query) use ($request) {
            $query->where('payment_note_provider', $request->get('payment_note'));
        })->pluck('apply_id')->unique();
    }

    public static function getApplyDataCom($request, $applyIds, $customerIds)
    {
        return static::when($request->get('ref_no'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('agent_id'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('country_id'), function ($query) use ($applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('register'), function ($query) use ($customerIds) {
            $query->whereIn('apply_id', $customerIds);
        })->when($request->get('net_amount'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('provider_id'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('status'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('type_service'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('service_country'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('visa_status'), function ($query) use ($request, $applyIds) {
            $query->where('visa_status', $request->get('visa_status'));
        })->when($request->get('hoahong_month'), function ($query) use ($request, $applyIds) {
            $query->where('hoahong_month', $request->get('hoahong_month'));
        })->when($request->get('hoahong_year'), function ($query) use ($request, $applyIds) {
            $query->where('hoahong_year', $request->get('hoahong_year'));
        })->when($request->get('date_payment_provider'), function ($query) use ($request) {
            $query->whereDate('date_payment_provider', convert_date_to_db($request->get('date_payment_provider')));
        })->when($request->get('account_bank'), function ($query) use ($request) {
            $query->where('account_bank', 'LIKE', $request->get('account_bank'));
        })->when($request->get('date_payment_agent'), function ($query) use ($request) {
            $query->whereDate('date_payment_agent', convert_date_to_db($request->get('date_payment_agent')));
        })->when($request->get('policy_no'), function ($query) use ($request) {
            $query->where('policy_no', 'LIKE', $request->get('policy_no'));
        })->when($request->get('issue_date'), function ($query) use ($request) {
            $query->whereDate('issue_date', convert_date_to_db($request->get('issue_date')));
        })->when($request->get('policy_status'), function ($query) use ($request) {
            $query->where('policy_status', $request->get('policy_status'));
        })->when($request->get('payment_note_provider'), function ($query) use ($request) {
            $query->where('payment_note_provider', $request->get('payment_note_provider'));
        })->when($request->get('note'), function ($query) use ($request) {
            $query->where('note', 'LIKE', $request->get('note'));
        })->when($request->get('staff_id'), function ($query) use ($request) {
            $query->where('admin_create', $request->get('staff_id'));
        })->when($request->get('created_at'), function ($query) use ($request) {
            $query->whereDate('created_at', convert_date_to_db($request->get('created_at')));
        })->when($request->get('f_department'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('f_status'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('f_country'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('f_time'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })->when($request->get('f_time_start') && $request->get('f_time_end'), function ($query) use ($request, $applyIds) {
            $query->whereIn('apply_id', $applyIds);
        })
            ->when($request->get('f_period'), function ($query) use ($request, $applyIds) {
                $query->whereIn('apply_id', $applyIds);
            })
            ->with([
                'invoice' => function ($query) {
                    $query->with([
                        'agent',
                        'comms',
                        'provider',
                        'service',
                        'customers',
                        'phieuthus'
                    ]);
                },
                'creater'
            ])
            ->orderby('id', 'desc');
    }
}
