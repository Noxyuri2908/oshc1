<?php

namespace App\Admin;

use App\Admin;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use PayPal\Api\Invoice;

class Profit extends Model
{
    use Filterable;
    protected $fillable = [
        'exchange_rate_re_provider',
        'apply_id',
        'date_of_receipt',
        'note_of_receipt',
        'pay_provider_bank_fee',
        'pay_provider_exchange_rate',
        'pay_provider_date',
        'pay_provider_bank_account',
        'pay_agent_bonus',
        'pay_agent_deduction',
        'pay_agent_exchange_rate',
        'pay_agent_date',
        'pay_provider_paid',
        'profit_extra_money',
        'profit_exchange_rate',
        'visa_status',
        'visa_month',
        'visa_year',
        'profit_status',
        'comm_status',
        'admin_create',
        'admin_update',
        'pay_provider_amount',
        'pay_provider_total_amount',
        'pay_provider_total_VN',
        'pay_provider_balancer_1',
        'profit_payment_note_provider',
        'profit_money',
        'profit_money_VND',
        'comm_re',
        're_total_amount',
        're_total_amount_vn',
        'comm_rate_agent_profit',
        'pay_agent_amount_comm',
        'pay_agent_amount_VN',
        'gst_status_agent_profit',
        'issue_date_com_agent',
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
        'note_cp',
        'staff_id_cp',
        'look_payment_form',
        'pay_agent_extra',
        'vnd',
        'profit_total',
        'profit_bankfee_VND',
        'gst'
    ];
    public static $STATUS = [
        1=>'Done',
        2=>'Refund'
    ];
    public static $commissionPaymentStatus = [
        1=>'Done',
        2=>'Refund'
    ];
    public static $gst_status_agent_profit = [
        1=>'Included',
        2=>'Not Included'
    ];

    public function invoice()
    {
        return $this->belongsTo(Apply::class, 'apply_id','id');
    }
    public function getStaffName()
    {
        $staff_id = $this->staff_id_cp;
        if(!empty($staff_id)){
            $staff = Admin::find($staff_id);
            return (!empty($staff))?$staff->username:'';
        }

        return '';
    }
    public function statusVisaText()
    {
        $visa_status = $this->visa_status;
        return isset(config('myconfig.status_visa')[$visa_status]) ? config('myconfig.status_visa')[$visa_status] : '';
    }
    public static function getReportAgentMonthly($request)
    {
        $hhs_id = Hoahong::when($request->get('start_date') && $request->get('end_date'), function ($query) use ($request) {
            $query->whereBetween('issue_date', [convert_date_to_db($request->get('start_date')), convert_date_to_db($request->get('end_date'))]);
        })
            ->pluck('apply_id');
        $agents_id = Apply::when($request->get('agent_id'), function ($query) use ($request) {
            $query->where('agent_id', $request->get('agent_id'));
        })->pluck('id');
        return static::whereIn('apply_id', $hhs_id)
            ->whereIn('apply_id', $agents_id)
            ->with([
                'invoice' => function ($query) {
                    $query->with([
                        'hoahongs',
                        'provider'
                    ]);
                }
            ])
            ->get();
    }
}
