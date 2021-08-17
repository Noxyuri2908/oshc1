<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProfitFilter extends ModelFilter
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
        return $this->related('invoice', function ($q) use ($refNo) {
            $q->where('ref_no', 'LIKE', '%'.$refNo.'%');
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

    public function policyNo($number)
    {
        return $this->related('invoice.hoahong', function ($q) use ($number) {
            $q->where('policy_no', 'LIKE', '%'.$number.'%');
        });
    }

    public function typeService($id)
    {
        return $this->related('invoice', function ($q) use ($id) {
            $q->where('type_service', $id);
        });
    }

    public function typeVisa($id)
    {
        return $this->related('invoice', function ($q) use ($id) {
            $q->where('type_visa', $id);
        });
    }

    public function policy($id)
    {
        return $this->related('invoice', function ($q) use ($id) {
            $q->where('policy', $id);
        });
    }

    public function startDate($time)
    {
        return $this->related('invoice', function ($q) use ($time) {
            $q->whereDate('start_date', '>=', convert_date_to_db($time));
        });
    }

    public function endDate($time)
    {
        return $this->related('invoice', function ($q) use ($time) {
            $q->whereDate('end_date', '<=', convert_date_to_db($time));
        });
    }

    public function visaStatus($id)
    {
        return $this->where('visa_status', $id);
    }

    public function visaMonth($month)
    {
        return $this->where('visa_month', $month);
    }

    public function visaYear($year)
    {
        return $this->where('visa_year', $year);
    }

    public function profitStatus($id)
    {
        return $this->where('profit_status', $id);
    }

    public function commissionPaymentStatus($id)
    {
        return $this->where('comm_status', $id);
    }

    public function paymentNoteProvider($id)
    {
        return $this->related('invoice.hoahong', function ($q) use ($id) {
            $q->where('payment_note_provider', $id);
        });
    }

    public function bankAccount($text){
        return $this->where('pay_provider_bank_account','LIKE', '%'.$text.'%');
    }

    public function datePayment($date){
        return $this->whereDate('pay_provider_date',convert_date_to_db($date));
    }

    public function profitMoney($number){
        return $this->where('profit_money', 'LIKE', '%'.$number.'%');
    }

    public function extraFee($number){
        return $this->where('profit_extra_money', 'LIKE', '%'.$number.'%');
    }

    public function revenueFromService($number){
        return $this->where('profit_total', 'LIKE', '%'.$number.'%');
    }

    public function revenueFromExRate($number){
        return $this->where('profit_exchange_rate', 'LIKE', '%'.$number.'%');
    }

    public function profitVnd($number){
        return $this->where('profit_money_VND', 'LIKE', '%'.$number.'%');
    }

    public function bankFeeVnd($number){
        return $this->where('profit_bankfee_VND', 'LIKE', '%'.$number.'%');
    }

    public function gst($number){
        return $this->where('gst', 'LIKE', '%'.$number.'%');
    }

    public function netAmount($number){
        return $this->related('invoice', function ($q) use ($number) {
            $q->where('net_amount', 'LIKE', '%' .$number. '%');
        });
    }

    public function promotionAmount($number){
        return $this->related('invoice', function ($q) use ($number) {
            $q->where('promotion_amount', 'LIKE', '%' .$number. '%');
        });
    }

    public function extra($number){
        return $this->related('invoice', function ($q) use ($number) {
            $q->where('extra', 'LIKE', '%' .$number. '%');
        });
    }

    public function totalAmount($number){
        return $this->related('invoice', function ($q) use ($number) {
            $q->where('total', 'LIKE', '%' .$number. '%');
        });
    }

    public function difference($number){
        return $this->related('invoice', function ($q) use ($number) {
            $q->where('difference', 'LIKE', '%' .$number. '%');
        });
    }

    public function commissionRate($number){
        return $this->related('invoice.comms', function ($q) use ($number) {
            $q->where('comm', $number);
        });
    }

    public function bonus($number){
        return $this->where('pay_agent_bonus', $number);
    }

    public function amountCom($number){
        return $this->related('invoice', function ($q) use ($number) {
            $q->where('comm', 'LIKE', '%'.$number.'%');
        });
    }

    public function deduction($number){
        return $this->where('pay_agent_deduction', 'LIKE', '%'.$number.'%');
    }

    public function totalAmountCom($number){
        return $this->where('pay_agent_total_amount', 'LIKE', '%'.$number.'%');
    }

    public function exchangeRate($number){
        return $this->where('pay_agent_exchange_rate', 'LIKE', '%'.$number.'%');
    }

    public function vnd($number){
        return $this->where('vnd', 'LIKE', '%'.$number.'%');
    }

    public function amountVnd($number){
        return $this->where('pay_agent_amount_VN', 'LIKE', '%'.$number.'%');
    }

    public function dateOfPayment($number){
        return $this->whereDate('pay_agent_date', '<=', convert_date_to_db($number));
    }

    public function gstStatus($id){
        return $this->where('gst_status_agent_profit', $id);
    }

    public function amount($number){
       return $this->where('re_total_amount', 'LIKE', '%'.$number.'%');
    }

    public function exchangeRateComm($number){
        return $this->where('exchange_rate_re_provider', 'LIKE', '%'.$number.'%');
    }

    public function totalAmountComm($number){
        return $this->where('re_total_amount_vn', 'LIKE', '%'.$number.'%');
    }

    public function dateOfReceipt($number){
        return $this->whereDate('date_of_receipt', '<=', convert_date_to_db($number));
    }

    public function note($text){
        return $this->where('note_of_receipt', 'LIKE', '%'.$text.'%');
    }

    public function payProviderPaid($number){
        return $this->where('pay_provider_paid', 'LIKE', '%'.$number.'%');
    }

    public function payProviderAmount($number){
        return $this->where('pay_provider_amount', 'LIKE', '%'.$number.'%');
    }

    public function extendFee($number){
        return $this->related('invoice.customers', function ($q) use ($number) {
            $q->where('extend_fee', 'LIKE', '%'.$number.'%');
        });
    }

    public function payProviderBankFee($number){
        return $this->where('pay_provider_bank_fee', 'LIKE', '%'.$number.'%');

    }

    public function payProviderTotalAmount($number){
        return $this->where('pay_provider_total_amount', 'LIKE', '%'.$number.'%');
    }

    public function payProviderExchangeRate($number){
        return $this->where('pay_provider_exchange_rate', 'LIKE', '%'.$number.'%');
    }

    public function payProviderTotalVN($number){
        return $this->where('pay_provider_total_VN', 'LIKE', '%'.$number.'%');
    }

    public function ProviderName($text){
        return $this->related('invoice.provider', function ($q) use ($text) {
            $q->where('name', 'LIKE', '%'.$text.'%');
        });
    }

    public function dateOfPaymentPay($date){
        return $this->whereDate('pay_provider_date', '<=', convert_date_to_db($date));
    }
}
