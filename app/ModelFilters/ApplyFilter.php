<?php

namespace App\ModelFilters;

use App\Admin\HospitalAccess;
use Carbon\Carbon;
use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\DB;

class ApplyFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function refNo($refNo)
    {
        return $this->where('ref_no', 'LIKE', '%'.$refNo.'%');
    }

    public function createdAt($createdAt)
    {
        return $this->whereDate('created_at', convert_date_to_db($createdAt));
    }

    public function agent($agentId)
    {
        return $this->where('agent_id', $agentId);
    }

    public function country($id)
    {
        return $this->related('agent', function ($query) use ($id) {
            return $query->where('country', $id);
        });
    }

    public function register($name)
    {
        return $this->related('customers', function ($q) use ($name) {
            return $q->where('first_name', 'LIKE', '%'.$name.'%')
                ->orWhere('last_name', 'LIKE', '%'.$name.'%');
        });
    }

    public function email($text)
    {
        return $this->related('customers', function ($q) use ($text) {
            return $q->where('email', 'LIKE', '%'.$text.'%');
        });
    }

    public function status($id)
    {
        return $this->where('status', $id);
    }

    public function masterAgent($id)
    {
        return $this->where('master_agent', $id);
    }

    public function serviceCountry($id)
    {
        return $this->where('service_country', $id);
    }

    public function typeService($id)
    {
        return $this->where('type_service', $id);
    }

    public function typeInvoice($id)
    {
        return $this->where('type_invoice', $id);
    }

    public function provider($id)
    {
        return $this->where('provider_id', $id);
    }

    public function policy($id)
    {
        return $this->where('policy', $id);
    }

    public function typeVisa($id)
    {
        return $this->where('type_visa', $id);
    }

    public function netAmount($number)
    {
        return $this->where('net_amount', '>=', $number);
    }

    public function promotion($id)
    {
        return $this->where('promotion_id', $id);
    }

    public function paymentMethod($id)
    {
        return $this->where('payment_method', $id);
    }

    public function staff($id)
    {
        return $this->where('staff_id', $id);
    }

    public function note($string)
    {
        return $this->where('note', 'LIKE', '%'.$string.'%');
    }

    public function locationAustralia($id)
    {
        return $this->where('location_australia', $id);
    }

    public function fStatus($id)
    {
        return $this->where('status', $id);
    }
    public function startDate($time){
        return $this->whereDate('start_date','>=' ,convert_date_to_db($time));
    }
    public function endDate($time){
        return $this->whereDate('end_date','<=', convert_date_to_db($time));
    }
    public function fTime($time)
    {
        return $this->whereBetween('created_at', dateRangePicker($time));
    }
    public function month($month){
        return $this->where('count_month',$month);
    }

    public function fPeriod($time)
    {
        if ($time == 1) {
            return $this->where('created_at', Carbon::now()->format('Y-m-d'));
        } else {
            if ($time == 2) {
                return $this->whereBetween('created_at', [
                    Carbon::now()->subWeek(1)->format('Y-m-d h:i:s'),
                    Carbon::now()->format('Y-m-d h:i:s'),
                ]);
            } else {
                if ($time == 3) {
                    return $this->whereBetween('created_at', [
                        Carbon::now()->subMonth(1)->format('Y-m-d h:i:s'),
                        Carbon::now()->format('Y-m-d h:i:s'),
                    ]);
                } else {
                    if ($time == 4) {
                        return $this->whereBetween('created_at', [
                            Carbon::now()->subYear(1)->format('Y-m-d h:i:s'),
                            Carbon::now()->format('Y-m-d h:i:s'),
                        ]);
                    } else {
                        if ($time == 't01') {
                            return $this->whereBetween('created_at', [
                                date('Y-01-01 h:i:s'),
                                Carbon::parse(date('Y-01-01 h:i:s'))->endOfMonth(),
                            ]);
                        } else {
                            if ($time == 't02') {
                                return $this->whereBetween('created_at', [
                                    date('Y-02-01 h:i:s'),
                                    Carbon::parse(date('Y-02-01 h:i:s'))->endOfMonth(),
                                ]);
                            } else {
                                if ($time == 't03') {
                                    return $this->whereBetween('created_at', [
                                        date('Y-03-01 h:i:s'),
                                        Carbon::parse(date('Y-03-01 h:i:s'))->endOfMonth(),
                                    ]);
                                } else {
                                    if ($time == 't04') {
                                        return $this->whereBetween('created_at', [
                                            date('Y-04-01 h:i:s'),
                                            Carbon::parse(date('Y-04-01 h:i:s'))->endOfMonth(),
                                        ]);
                                    } else {
                                        if ($time == 't05') {
                                            return $this->whereBetween('created_at', [
                                                date('Y-05-01 h:i:s'),
                                                Carbon::parse(date('Y-05-01 h:i:s'))->endOfMonth(),
                                            ]);
                                        } else {
                                            if ($time == 't06') {
                                                return $this->whereBetween('created_at', [
                                                    date('Y-06-01 h:i:s'),
                                                    Carbon::parse(date('Y-06-01 h:i:s'))->endOfMonth(),
                                                ]);
                                            } else {
                                                if ($time == 't07') {
                                                    return $this->whereBetween('created_at', [
                                                        date('Y-07-01 h:i:s'),
                                                        Carbon::parse(date('Y-07-01 h:i:s'))->endOfMonth(),
                                                    ]);
                                                } else {
                                                    if ($time == 't08') {
                                                        return $this->whereBetween('created_at', [
                                                            date('Y-08-01 h:i:s'),
                                                            Carbon::parse(date('Y-08-01 h:i:s'))->endOfMonth(),
                                                        ]);
                                                    } else {
                                                        if ($time == 't09') {
                                                            return $this->whereBetween('created_at', [
                                                                date('Y-09-01 h:i:s'),
                                                                Carbon::parse(date('Y-09-01 h:i:s'))
                                                                    ->endOfMonth(),
                                                            ]);
                                                        } else {
                                                            if ($time == 't10') {
                                                                return $this->whereBetween('created_at', [
                                                                    date('Y-10-01 h:i:s'),
                                                                    Carbon::parse(date('Y-10-01 h:i:s'))
                                                                        ->endOfMonth(),
                                                                ]);
                                                            } else {
                                                                if ($time == 't11') {
                                                                    return $this->whereBetween('created_at', [
                                                                        date('Y-11-01 h:i:s'),
                                                                        Carbon::parse(date('Y-11-01 h:i:s'))
                                                                            ->endOfMonth(),
                                                                    ]);
                                                                } else {
                                                                    if ($time == 't12') {
                                                                        return $this->whereBetween('created_at', [
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

    public function issueDate($date){
        return $this->related('hoahongs',function ($q) use ($date){
            $q->whereDate('issue_date','>=' ,convert_date_to_db($date));
        });
    }
    public function policyNumber($number){
        return $this->related('hoahongs',function ($q) use ($number){
            $q->where('policy_no','LIKE' ,'%'.$number.'%');
        });
    }
    public function paymentNote($type){
        return $this->related('hoahongs',function ($q) use ($type){
            $q->where('payment_note_provider',$type);
        });
    }
    public function destination($country){
        return $this->related('customers',function ($q) use ($country){
            $q->where('destination',$country);
        });
    }
    public function sLiveInAS($number)
    {
        return $this->related('customers',function ($q) use ($number){
            $q->where('s_live_in_AS', $number);
        });
    }
    public function fDepartment($department){
        return $this->related('agent',function ($q) use ($department){
            $q->where('department',$department);
        });
    }
    public function fTimeStart($date){
        return $this->whereDate('start_date','>=' ,convert_date_to_db($date));
    }
    public function fTimeEnd($date){
        return $this->whereDate('end_date','>=' ,convert_date_to_db($date));
    }
    public function fCountry($country){
        return $this->where('service_country',$country);
    }
    public function hospitalAccess($config){
        $hospital = DB::table('hospital_accesses')->select('id')->where('hostpital_access', $config)->first()->id;
        return $this->where('hospital_id', $hospital);
    }
}
