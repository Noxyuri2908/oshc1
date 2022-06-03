<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class HoahongFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function refNo($no)
    {
        return $this->related('invoice', function ($q) use ($no) {
            $q->where('ref_no', 'LIKE', '%'.$no.'%');
        });
    }

    public function agent($agent_id)
    {
        return $this->related('invoice', function ($q) use ($agent_id) {
            $q->where('agent_id', $agent_id);
        });
    }

    public function country($country_id)
    {
        return $this->related('invoice.agent', function ($q) use ($country_id) {
            $q->where('country', $country_id);
        });
    }

    public function register($name)
    {
        return $this->related('invoice.customers', function ($q) use ($name) {
            $q->where('first_name', 'LIKE', '%'.$name.'%')
                ->orWhere('last_name', 'LIKE', '%'.$name.'%');
        });
    }

    public function netAmount($number)
    {
        return $this->related('invoice', function ($q) use ($number) {
            $q->where('net_amount', '>=', $number);
        });
    }

    public function provider($id)
    {
        return $this->related('invoice', function ($q) use ($id) {
            $q->where('provider_id', $id);
        });
    }

    public function status($id)
    {
        return $this->related('invoice', function ($q) use ($id) {
            $q->where('status', $id);
        });
    }

    public function typeService($id)
    {
        return $this->related('invoice', function ($q) use ($id) {
            $q->where('type_service', $id);
        });
    }

    public function serviceCountry($id)
    {
        return $this->related('invoice', function ($q) use ($id) {
            $q->where('service_country', $id);
        });
    }

    public function visaStatus($id)
    {
        return $this->where('visa_status', $id);
    }

    public function hoahongMonth($month)
    {
        return $this->where('hoahong_month', $month);
    }

    public function hoahongYear($year)
    {
        return $this->where('hoahong_year', $year);
    }

    public function datePaymentProvider($date)
    {
        return $this->whereDate('date_payment_provider', convert_date_to_db($date));
    }

    public function accountBank($name)
    {
        return $this->where('account_bank', 'LIKE', '%'.$name.'%');
    }

    public function datePaymentAgent($date)
    {
        return $this->whereDate('date_payment_agent', convert_date_to_db($date));
    }

    public function policyNo($number)
    {
        return $this->where('policy_no', 'LIKE', '%'.$number.'%');
    }

    public function issueDate($date)
    {
        return $this->whereDate('issue_date', convert_date_to_db($date));
    }

    public function policyStatus($status)
    {
        return $this->where('policy_status', $status);
    }

    public function paymentNoteProvider($type)
    {
        return $this->where('payment_note_provider', $type);
    }

    public function note($text)
    {
        return $this->where('note', 'LIKE', '%'.$text.'%');
    }

    public function staff($id)
    {
        return $this->where('admin_create', $id);
    }

    public function createdAt($date)
    {
        return $this->whereDate('created_at', convert_date_to_db($date));
    }

    public function fStatus($status)
    {
        return $this->related('invoice', function ($q) use ($status) {
            $q->where('status', $status);
        });
    }

    public function fDepartment($id)
    {
        return $this->related('invoice.agent', function ($q) use ($id) {
            $q->where('department', $id);
        });
    }

    public function fPeriod($time)
    {
        return $this->related('invoice.agent', function ($q) use ($time) {
            if ($time == 1) {
                $q->where('created_at', Carbon::now()->format('Y-m-d'));
            } else {
                if ($time == 2) {
                    $q->whereBetween('created_at', [
                        Carbon::now()->subWeek(1)->format('Y-m-d h:i:s'),
                        Carbon::now()->format('Y-m-d h:i:s'),
                    ]);
                } else {
                    if ($time == 3) {
                        $q->whereBetween('created_at', [
                            Carbon::now()->subMonth(1)->format('Y-m-d h:i:s'),
                            Carbon::now()->format('Y-m-d h:i:s'),
                        ]);
                    } else {
                        if ($time == 4) {
                            $q->whereBetween('created_at', [
                                Carbon::now()->subYear(1)->format('Y-m-d h:i:s'),
                                Carbon::now()->format('Y-m-d h:i:s'),
                            ]);
                        } else {
                            if ($time == 't01') {
                                $q->whereBetween('created_at', [
                                    date('Y-01-01 h:i:s'),
                                    Carbon::parse(date('Y-01-01 h:i:s'))->endOfMonth(),
                                ]);
                            } else {
                                if ($time == 't02') {
                                    $q->whereBetween('created_at', [
                                        date('Y-02-01 h:i:s'),
                                        Carbon::parse(date('Y-02-01 h:i:s'))->endOfMonth(),
                                    ]);
                                } else {
                                    if ($time == 't03') {
                                        $q->whereBetween('created_at', [
                                            date('Y-03-01 h:i:s'),
                                            Carbon::parse(date('Y-03-01 h:i:s'))->endOfMonth(),
                                        ]);
                                    } else {
                                        if ($time == 't04') {
                                            $q->whereBetween('created_at', [
                                                date('Y-04-01 h:i:s'),
                                                Carbon::parse(date('Y-04-01 h:i:s'))->endOfMonth(),
                                            ]);
                                        } else {
                                            if ($time == 't05') {
                                                $q->whereBetween('created_at', [
                                                    date('Y-05-01 h:i:s'),
                                                    Carbon::parse(date('Y-05-01 h:i:s'))->endOfMonth(),
                                                ]);
                                            } else {
                                                if ($time == 't06') {
                                                    $q->whereBetween('created_at', [
                                                        date('Y-06-01 h:i:s'),
                                                        Carbon::parse(date('Y-06-01 h:i:s'))->endOfMonth(),
                                                    ]);
                                                } else {
                                                    if ($time == 't07') {
                                                        $q->whereBetween('created_at', [
                                                            date('Y-07-01 h:i:s'),
                                                            Carbon::parse(date('Y-07-01 h:i:s'))->endOfMonth(),
                                                        ]);
                                                    } else {
                                                        if ($time == 't08') {
                                                            $q->whereBetween('created_at', [
                                                                date('Y-08-01 h:i:s'),
                                                                Carbon::parse(date('Y-08-01 h:i:s'))->endOfMonth(),
                                                            ]);
                                                        } else {
                                                            if ($time == 't09') {
                                                                $q->whereBetween('created_at', [
                                                                    date('Y-09-01 h:i:s'),
                                                                    Carbon::parse(date('Y-09-01 h:i:s'))
                                                                        ->endOfMonth(),
                                                                ]);
                                                            } else {
                                                                if ($time == 't10') {
                                                                    $q->whereBetween('created_at', [
                                                                        date('Y-10-01 h:i:s'),
                                                                        Carbon::parse(date('Y-10-01 h:i:s'))
                                                                            ->endOfMonth(),
                                                                    ]);
                                                                } else {
                                                                    if ($time == 't11') {
                                                                        $q->whereBetween('created_at', [
                                                                            date('Y-11-01 h:i:s'),
                                                                            Carbon::parse(date('Y-11-01 h:i:s'))
                                                                                ->endOfMonth(),
                                                                        ]);
                                                                    } else {
                                                                        if ($time == 't12') {
                                                                            $q->whereBetween('created_at', [
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
        });
    }

    public function fTimeStart($date)
    {
        return $this->related('invoice', function ($q) use ($date) {
            $q->whereDate('start_date', '>=', convert_date_to_db($date));
        });
    }

    public function fTimeEnd($date)
    {
        return $this->related('invoice', function ($q) use ($date) {
            $q->whereDate('end_date', '>=', convert_date_to_db($date));
        });
    }
    public function fCountry($country)
    {
        return $this->related('invoice', function ($q) use ($country) {
            $q->where('service_country', $country);
        });
    }
}
