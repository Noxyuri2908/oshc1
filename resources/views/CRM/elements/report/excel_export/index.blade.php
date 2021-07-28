@php
$array_month = $data['array_month'];
$totalMonth = [];
$totalOfPolicyMonth = [];
$dateOfPaymentMonth = [];
$extra = [];
$reportAgent = $data['reportAgent'];
$agents = $data['agents'];
@endphp
<table class="table table-bordered" id="table2" style="table-layout:auto;width:100%">
    <tr class="ro3">
        <td colspan="10" style="text-align:left;width:0.572in; " class="ce6">
            <p>MONTHLY REPORT </p>
        </td>

    </tr>
    <tr class="ro4">
        <td colspan="3" style="text-align:left;width:0.572in; " class="ce9">
            <p>Agent partner:</p>
        </td>
        <td colspan="7" style="text-align:left;width:0.4728in; " class="ce9">
        <p>{{(!empty(request()->get('agent_id')) && !empty($agents[request()->get('agent_id')]))?$agents[request()->get('agent_id')]:'Empty'}}</p>
        </td>

    </tr>
    <tr class="ro4">
        <td colspan="3" style="text-align:left;width:0.572in; " class="ce9">
            <p>Date</p>
        </td>
        <td colspan="7" style="text-align:left;width:0.4728in; " class="ce9">
            <p>Start Date {{request()->get('start_date')}} end date {{request()->get('end_date')}}</p>
        </td>
    </tr>

    @php
        $commision_dollar_total = 0;
        $gst_total = 0;
        $commision_dollar_gst_total = 0;
    @endphp
    <tr class="ro6">
        <td colspan="3" style="text-align:left;width:0.0543in; " class="ce3">
            <p>Policy</p>
        </td>
        <td colspan="3" style="text-align:left;width:0.4181in; " class="ce3">
            <p>Name</p>
        </td>
        <td colspan="3" style="text-align:left;width:1.002in; " class="ce3">
            <p>Provider </p>
        </td>
        <td colspan="3" style="text-align:left;width:1.0244in; " class="ce3">
            <p>Policy No</p>
        </td>
        <td style="text-align:left;width:1.1236in; " class="ce3">
            <p>Date of policy</p>
            <p> </p>
        </td>
        <td colspan="2" style="text-align:left;width:0.0654in; " class="ce3">
            <p>Start date</p>
        </td>
        <td colspan="2" style="text-align:left;width:0.6055in; " class="ce3">
            <p>End date</p>
        </td>
        <td style="text-align:left;width:1.2118in; " class="ce3">
            <p>Policy Status</p>
        </td>
        <td style="text-align:left;width:1.002in; " class="ce3">
            <p>Amount $(1)</p>
        </td>
        <td style="text-align:left;width:0.6827in; " class="ce3">
            <p>Unit</p>
        </td>
        <td style="text-align:left;width:0.9909in; " class="ce3">
            <p>Commission rate (%) (2)</p>
        </td>
        <td style="text-align:left;width:1.5862in; " class="ce3">
            <p>Commission $ (Excluded GST)(3)= (1)*(2)/1.1</p>
        </td>
        <td style="text-align:left;width:1.5862in; " class="ce3">
            <p>GST (4) = (3)*10%</p>
        </td>
        <td style="text-align:left;width:1.1453in; " class="ce3">
            <p>Commission $ (Included GST) (5) = (4) + (3)</p>
        </td>
        <td style="text-align:left;width:1.002in; " class="ce3">
            <p>Com status</p>
        </td>
        @if(!empty($array_month))
        @foreach($array_month as $month)
        <td style="text-align:left;width:0.8591in; " class="ce3">
            <p>{{$month}}</p>
        </td>
        @endforeach
        @endif
        <td style="text-align:left;width:1.0465in; " class="ce3">
            <p>Visa status</p>
        </td>
        <td style="text-align:left;width:0.9583in; " class="ce3">
            <p>Payment Status</p>
        </td>
        <td style="text-align:left;width:0.9583in; " class="ce3">
            <p>Date of payment</p>
        </td>
        <td style="text-align:left;width:0.6492in; " class="ce3">
            <p>+/- $</p>
        </td>
        <td style="text-align:left;width:0.6937in; " class="ce3">
            <p>+/- time</p>
        </td>
        <td style="text-align:left;width:1.7402in; " class="ce21">
            <p>Note</p>
        </td>
    </tr>
        @foreach($reportAgent as $profit)
            @php
                $invoice = $profit->invoice;
                $hoahong = (!empty($invoice))? $invoice->hoahongs->first():'';

                $getRegister = (!empty($invoice))?$invoice->registerCus():'';
                $provider = (!empty($invoice))? $invoice->provider:'';
                $agent = (!empty($invoice))? $invoice->agent:'';
                $comm = (!empty($invoice))? $invoice->getCom() :'';
                $commission_rate = (!empty($comm))?$comm->comm:0;
                $amount_dollar = (!empty($profit))?$profit->pay_agent_amount_comm:0;
                $commision_dollar = $amount_dollar * $commission_rate*10/100 / 1.1;
                $commision_dollar_total += $commision_dollar;
                $gst= $commision_dollar * 0.1;
                $gst_total += $gst;
                $commision_gst= $commision_dollar+$gst;
                $commision_dollar_gst_total +=$commision_gst;
                $payment_status = (!empty($profit) && $profit->comm_status == 1)?'Done':'Refund';
                $com_status = (!empty($hoahong))?$hoahong->com_payment_method:'';
            @endphp

            <tr class="ro7 cal-value-of-month-col">
                <td colspan="3" style="text-align:left;width:0.0543in; " class="ce4">
                    <p>{{(!empty($invoice))?$invoice->policyName():''}}</p>
                </td>
                <td colspan="3" style="text-align:left;width:0.4181in; " class="ce11">
                    <p>{{(!empty($getRegister))?$getRegister->first_name .' '.$getRegister->last_name :''}}</p>
                </td>
                <td colspan="3" style="text-align:left;width:1.002in; " class="ce11">
                    <p>{{!empty($invoice)?$invoice->getProviderName():''}}</p>
                </td>
                <td colspan="3" style="text-align:left;width:1.0244in; " class="ce11">
                    <p>{{(!empty($hoahong))?$hoahong->policy_no:''}}</p>
                </td>
                <td style="text-align:right; width:1.1236in; " class="ce13">
                    <p>{{(!empty($hoahong))?\Carbon::parse($hoahong->issue_date)->format('d/m/Y'):''}}</p>
                </td>
                <td colspan="2" style="text-align:right; width:0.0654in; " class="ce13">
                    <p>{{!empty($invoice)?\Carbon::parse($invoice->start_date)->format('d/m/Y'):''}}</p>
                </td>
                <td colspan="2" style="text-align:right; width:0.6055in; " class="ce13">
                    <p>{{!empty($invoice)?\Carbon::parse($invoice->end_date)->format('d/m/Y'):''}}</p>
                </td>
                <td style="text-align:left;width:1.2118in; " class="ce11">
                    <p>{{(!empty($hoahong))?$hoahong->getPolicyStatusName():''}}</p>
                </td>
                <td style="text-align:right; width:1.002in; " class="ce12">
                    <p>{{(!empty($amount_dollar))?convert_price_float($amount_dollar):''}}</p>
                </td>
                <td style="text-align:left;width:0.6827in; " class="ce4">
                    <p>{{(!empty($provider))?$provider->currency():''}}</p>
                </td>
                <td style="text-align:right; width:0.9909in; " class="ce12">
                    <p>{{(!empty($comm))?$comm->comm:''}}</p>
                </td>
                <td style="text-align:right; width:1.5862in; " class="ce12">
                    <p>{{(!empty($commision_dollar))?convert_price_float($commision_dollar):''}}</p>
                </td>
                <td style="text-align:right; width:1.5862in; " class="ce12">
                    <p>{{(!empty($gst))?convert_price_float($gst):''}}</p>
                </td>
                <td style="text-align:right; width:1.1453in; " class="ce12">
                    <p>{{(!empty($commision_gst))?convert_price_float($commision_gst):''}}</p>
                </td>
                <td style="text-align:left;width:1.002in; " class="ce4">
                    <p>{{(!empty($com_status))?\Config::get('myconfig.type_payment')[$com_status]:''}}</p>
                </td>
                @if(!empty($array_month))
                @foreach($array_month as $month)
                    @php

                        if($com_status == 2 && convertDateMonthMMToM($profit->date) == convertDateMonthMMToM($month)){
                            $money = 0;
                        }elseif(convertDateMonthMMToM($profit->date) == convertDateMonthMMToM($month)){
                            $money=$profit->pay_agent_amount_comm;
                            $totalOfPolicyMonth[$month]= +1;
                            $dateOfPaymentMonth[$month] = !empty($profit)?\Carbon::parse($profit->pay_agent_date)->format('d/m/Y'):'';
                        }
                        else{
                            $money='';
                        }
                        $extraMoney = (!empty($hoahong->extra_money))?$hoahong->extra_money:0;
                        if(!empty($extra[$month])){
                            $extra[$month] += $extraMoney;
                        }else{
                            $extra[$month] = $extraMoney;
                        }
                        $totalMonth[$month][]=$money;

                    @endphp
                    <td style="text-align:left;width:0.8591in;" class="ce12 cal-value-of-month">
                        {{$money}}
                    </td>
                @endforeach
                @endif
                <td>
                    {{(!empty($profit) && !empty($profit->visa_status))?\Config::get('myconfig.status_visa')[$profit->visa_status]:''}}
                </td>
                <td>
                    <p>{{$payment_status}}</p>
                </td>
                <td>
                    {{!empty($profit)?\Carbon::parse($profit->pay_agent_date)->format('d/m/Y'):''}}
                </td>
                <td>
                    {{!empty($hoahong) && !empty($hoahong->extra_money)?$hoahong->extra_money:0}}
                </td>
                <td>
                    {{!empty($hoahong)?$hoahong->extra_time:''}}
                </td>
                <td>
                    {{!empty($hoahong)?$hoahong->note:''}}
                </td>
            </tr>
        @endforeach
        @php
            $totalMonth = collect($totalMonth)->transform(function($data){
                return collect($data)->sum();
            });
        @endphp
    <tr class="ro4">
        <td colspan="17" style="text-align:left;width:0.0543in; " class="ce5">
            <p>Total</p>
        </td>
        <td style="text-align:left;width:1.2118in; " class="ce5"> </td>
        <td style="text-align:left;width:1.002in; " class="ce16"> </td>
        <td style="text-align:left;width:0.6827in; " class="ce5"> </td>
        <td style="text-align:left;width:0.9909in; " class="ce16"> </td>
        <td style="text-align:right; width:1.5862in; " class="ce17">
            <p>{{convert_price_float($commision_dollar_total)}}</p>
        </td>
        <td style="text-align:right; width:1.5862in; " class="ce17">
            <p>{{convert_price_float($gst_total)}}</p>
        </td>
        <td style="text-align:right; width:1.1453in; " class="ce17">
            <p>{{convert_price_float($commision_dollar_gst_total)}}</p>
        </td>
        <td style="text-align:left;width:1.002in; " class="ce5"></td>
        @if(!empty($array_month))
            @foreach($array_month as $month)
            <td style="text-align:left;width:1.002in; " class="ce5">
                {{($totalMonth->isNotEmpty() && !empty($totalMonth[$month]))?$totalMonth[$month]:''}}
            </td>
            @endforeach
        @endif
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr class="ro4">
        <td colspan="2" style="text-align:left;width:0.0543in; " class="ce7">
           <p>Month</p>
           <p> </p>
        </td>
        <td colspan="3" style="text-align:left;width:0.2193in; " class="ce7">
           <p>Total of policy</p>
           <p> </p>
        </td>
        <td colspan="2" style="text-align:left;width:0.8146in; " class="ce7">
           <p>Commission paid</p>
           <p> </p>
        </td>
        <td colspan="3" style="text-align:left;width:0.0102in; " class="ce7">
           <p>+/-</p>
        </td>
        <td colspan="4" style="text-align:left;width:0.0543in; " class="ce7">
           <p>Total paid </p>
           <p> </p>
        </td>
        <td colspan="2" style="text-align:left;width:1.0791in; " class="ce14">
           <p>Date of payment</p>
           <p> </p>
        </td>
    </tr>

    @if(!empty($array_month))
    @foreach($array_month as $month)
        <tr class="ro4">
            <td colspan="2" style="text-align:left;width:0.0543in; " class="ce7">
                <p>{{$month}}</p>
            </td>
            <td colspan="3" style="text-align:left;width:0.2193in; " class="ce7">
                <p>{{(collect($totalOfPolicyMonth)->isNotEmpty() && !empty($totalOfPolicyMonth[$month]))?$totalOfPolicyMonth[$month]:0}}</p>
            </td>
            <td colspan="2" style="text-align:left;width:0.8146in; " class="ce7">
                <p>{{($totalMonth->isNotEmpty() && !empty($totalMonth[$month]))?$totalMonth[$month]:0}}</p>
            </td>
            <td colspan="3" style="text-align:left;width:0.0102in; " class="ce7">
                <p>{{(!empty($extra) && !empty($extra[$month]))?$extra[$month]:0}}</p>
            </td>
            <td colspan="4" style="text-align:left;width:0.0543in; " class="ce7">
                @php
                    if(!empty($totalMonth[$month])){
                        $paymentHistoryTotalMonth = $totalMonth[$month];
                    }
                    else{
                        $paymentHistoryTotalMonth = 0;
                    }
                    if(!empty($extra[$month])){
                        $paymentHistoryExtra = $extra[$month];
                    }else{
                        $paymentHistoryExtra = 0;
                    }
                @endphp
                <p>{{$paymentHistoryTotalMonth + $paymentHistoryExtra}}</p>
            </td>
            <td colspan="2" style="text-align:left;width:1.0791in; " class="ce14">
                <p>{{!empty($dateOfPaymentMonth[$month])?$dateOfPaymentMonth[$month]:''}}</p>
            </td>
        </tr>
    @endforeach
    @endif
</table>
