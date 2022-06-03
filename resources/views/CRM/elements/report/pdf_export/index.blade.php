@php
    $array_month = getMonthYearInDateRange(convertTwoDateInputToDateRange(request()->get('start_date'),request()->get('end_date')));
    $totalMonth = [];
    $totalOfPolicyMonth = [];
    $dateOfPaymentMonth = [];
    $extra = [];
@endphp
@php
    $commision_dollar_total = 0;
    $gst_total = 0;
    $commision_dollar_gst_total = 0;
@endphp

<table id="table2" style="border-collapse: collapse; table-layout: fixed; ">
<tbody>
<tr style="mso-height-source: userset; height: 85.25pt;">
    <td style="height: 85.25pt; width: 256pt;" colspan="8">
        <img id="scream" src="{{asset('images/oshc-icon.png')}}" width="340" height="113" />
    </td>
</tr>
<tr style="mso-height-source: userset; height: 19.65pt;">
<td style="height: 19.65pt; width: 4pt;"> </td>
<td style="width: 350pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 16.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: left; vertical-align: middle; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="10">MONTHLY REPORT</td>
<td style="width: 10pt;"> </td>
<td style="width: 80pt;"> </td>
<td style="width: 5pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 43pt;"> </td>
<td style="width: 36pt;"> </td>
<td style="width: 87pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 49pt;"> </td>
<td style="width: 71pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 82pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 62pt;"> </td>
<td style="width: 70pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 79pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 86pt;"> </td>
<td style="width: 83pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 47pt;"> </td>
<td style="width: 50pt;"> </td>
<td style="width: 124pt;"> </td>
</tr>
<tr style="mso-height-source: userset;">
    <td style="width: 4pt;"> </td>
    <td bgcolor="#E0E0E0" style="width: 87pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 12.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: left; vertical-align: middle; background: #E0E0E0; mso-pattern: black none; white-space: normal;" colspan="3">Agent partner:</td>
    <td bgcolor="#E0E0E0" style="width: 263pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 12.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: left; vertical-align: middle; background: #E0E0E0; mso-pattern: black none; white-space: normal;" colspan="7">{{(!empty(request()->get('agent_id')) && !empty($agents[request()->get('agent_id')]))?$agents[request()->get('agent_id')]:'Empty'}}</td>
    <td style="width: 10pt;"> </td>
    <td style="width: 80pt;"> </td>
    <td style="width: 5pt;"> </td>
    <td style="width: 77pt;"> </td>
    <td style="width: 43pt;"> </td>
    <td style="width: 36pt;"> </td>
    <td style="width: 87pt;"> </td>
    <td style="width: 72pt;"> </td>
    <td style="width: 49pt;"> </td>
    <td style="width: 71pt;"> </td>
    <td style="width: 113pt;"> </td>
    <td style="width: 113pt;"> </td>
    <td style="width: 82pt;"> </td>
    <td style="width: 72pt;"> </td>
    <td style="width: 62pt;"> </td>
    <td style="width: 70pt;"> </td>
    <td style="width: 67pt;"> </td>
    <td style="width: 79pt;"> </td>
    <td style="width: 75pt;"> </td>
    <td style="width: 86pt;"> </td>
    <td style="width: 83pt;"> </td>
    <td style="width: 77pt;"> </td>
    <td style="width: 77pt;"> </td>
    <td style="width: 69pt;"> </td>
    <td style="width: 77pt;"> </td>
    <td style="width: 67pt;"> </td>
    <td style="width: 75pt;"> </td>
    <td style="width: 69pt;"> </td>
    <td style="width: 69pt;"> </td>
    <td style="width: 47pt;"> </td>
    <td style="width: 50pt;"> </td>
    <td style="width: 124pt;"> </td>
</tr>
<tr style="mso-height-source: userset; height: 18.15pt;">
<td style="height: 18.15pt; width: 4pt;"> </td>
<td bgcolor="#E0E0E0" style="width: 87pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 12.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: left; vertical-align: middle; background: #E0E0E0; mso-pattern: black none; white-space: normal;" colspan="3">Date</td>
<td bgcolor="#E0E0E0" style="width: 263pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 12.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: left; vertical-align: middle; background: #E0E0E0; mso-pattern: black none; white-space: normal;" colspan="7">Start Date {{request()->get('start_date')}} end date {{request()->get('end_date')}}</td>
<td style="width: 10pt;"> </td>
<td style="width: 80pt;"> </td>
<td style="width: 5pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 43pt;"> </td>
<td style="width: 36pt;"> </td>
<td style="width: 87pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 49pt;"> </td>
<td style="width: 71pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 82pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 62pt;"> </td>
<td style="width: 70pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 79pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 86pt;"> </td>
<td style="width: 83pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 47pt;"> </td>
<td style="width: 50pt;"> </td>
<td style="width: 124pt;"> </td>
</tr>
<tr style="mso-height-source: userset; height: 15.9pt;">
<td style="height: 15.9pt; width: 4pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 8.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: Tahoma; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: left; vertical-align: top; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
<td style="width: 41pt;"> </td>
</tr>

<tr style="height: 54.4pt;color: white;">
    <td bgcolor="#FF69B4" align="center" style="height:54.4pt;
    width:61pt;padding: 0px;
    mso-ignore: padding;
    color: white;
    font-size: 11.0pt;
    font-weight: 700;
    font-style: normal;
    text-decoration: none;
    font-family: 'Times New Roman';
    mso-generic-font-family: auto;
    mso-font-charset: 1;
    mso-number-format: General;
    text-align: center;
    vertical-align: middle;
    border-top: .5pt solid #000;
    border-right: none;
    border-bottom: .5pt solid #000;
    border-left: .5pt solid #000;
    background: hotpink;
    mso-pattern: black none;
    white-space: normal;" colspan="3">Policy</td>
    <td bgcolor="#FF69B4" style="width: 122pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;" colspan="3">Name</td>
    <td bgcolor="#FF69B4" style="width: 94pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;" colspan="3">Provider</td>
    <td bgcolor="#FF69B4" style="width: 87pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;" colspan="3">Policy No</td>
    <td bgcolor="#FF69B4" style="width: 80pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Date of policy</td>
    <td bgcolor="#FF69B4" style="width: 82pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;" colspan="2">Start date</td>
    <td bgcolor="#FF69B4" style="width: 79pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;" colspan="2">End date</td>
    <td bgcolor="#FF69B4" style="width: 87pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Policy Status</td>
    <td bgcolor="#FF69B4" style="width: 72pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Amount $<br /> (1)</td>
    <td bgcolor="#FF69B4" style="width: 49pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Unit</td>
    <td bgcolor="#FF69B4" style="width: 71pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Commission rate (%)<br /> (2)</td>
    <td bgcolor="#FF69B4" style="width: 113pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Commission $ (Excluded GST)<br /> (3)= (1)*(2)/1.1</td>
    <td bgcolor="#FF69B4" style="width: 113pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">GST <br /> (4) = (3)*10%</td>
    <td bgcolor="#FF69B4" style="width: 82pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Commission $ (Included GST)<br /> (5) = (4) + (3)</td>
    <td bgcolor="#FF69B4" style="width: 72pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Com status</td>
    @if(!empty($array_month))
        @foreach($array_month as $month)
        <td bgcolor="#FF69B4" style="width: 62pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">{{$month}}</td>
    @endforeach
    @endif
    <td bgcolor="#FF69B4" style="width: 75pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Visa status</td>
    <td bgcolor="#FF69B4" style="width: 69pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Payment Status</td>
    <td bgcolor="#FF69B4" style="width: 69pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Date of payment</td>
    <td bgcolor="#FF69B4" style="width: 79pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">+/- $</td>
    <td bgcolor="#FF69B4" style="width: 75pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">+/- time</td>
    <td bgcolor="#FF69B4" style="width: 124pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: .5pt solid #000; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: hotpink; mso-pattern: black none; white-space: normal;">Note</td>
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
<tr style="mso-height-source: userset; height: 27.9pt;">
    <td style="height: 27.9pt; width: 61pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\@'; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="3">{{(!empty($invoice))?$invoice->policyName():''}}</td>
    <td style="width: 122pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\@'; text-align: left; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="3">{{(!empty($getRegister))?$getRegister->first_name .' '.$getRegister->last_name :''}}</td>
    <td style="width: 94pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\@'; text-align: left; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="3">{{!empty($invoice)?$invoice->getProviderName():''}}</td>
    <td style="width: 87pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\@'; text-align: left; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="3">{{(!empty($hoahong))?$hoahong->policy_no:''}}</td>
    <td style="width: 80pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: 'Short Date'; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($hoahong))?\Carbon::parse($hoahong->issue_date)->format('d/m/Y'):''}}</td>
    <td style="width: 82pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: 'Short Date'; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="2">{{!empty($invoice)?\Carbon::parse($invoice->start_date)->format('d/m/Y'):''}}</td>
    <td style="width: 79pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: 'Short Date'; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="2">{{!empty($invoice)?\Carbon::parse($invoice->end_date)->format('d/m/Y'):''}}</td>
    <td style="width: 87pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\@'; text-align: left; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($hoahong))?$hoahong->getPolicyStatusName():''}}</td>
    <td style="width: 72pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($amount_dollar))?convert_price_float($amount_dollar):''}}</td>
    <td style="width: 49pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\@'; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($provider))?$provider->currency():''}}</td>
    <td style="width: 71pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($comm))?$comm->comm:''}}</td>
    <td style="width: 113pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($commision_dollar))?convert_price_float($commision_dollar):''}}</td>
    <td style="width: 113pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($gst))?convert_price_float($gst):''}}</td>
    <td style="width: 82pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($commision_gst))?convert_price_float($commision_gst):''}}</td>
    <td style="width: 72pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\@'; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($com_status))?\Config::get('myconfig.type_payment')[$com_status]:''}}</td>
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
    <td class="ce12 cal-value-of-month" style="padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{$money}}</td>
        @endforeach
    @endif
    <td style="width: 75pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{(!empty($profit) && !empty($profit->visa_status))?\Config::get('myconfig.status_visa')[$profit->visa_status]:''}}</td>
    <td style="width: 69pt;  padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{$payment_status}}</td>
    <td style="width: 69pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{!empty($profit)?\Carbon::parse($profit->pay_agent_date)->format('d/m/Y'):''}}</td>
    <td style="width: 79pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{!empty($hoahong) && !empty($hoahong->extra_money)?$hoahong->extra_money:0}}</td>
    <td style="width: 75pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{!empty($hoahong)?$hoahong->extra_time:''}}</td>
    <td style="width: 124pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: .5pt solid #000; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{!empty($hoahong)?$hoahong->note:''}}</td>
</tr>
@endforeach
@php
$totalMonth = collect($totalMonth)->transform(function($data){
    return collect($data)->sum();
});
@endphp
<tr style="mso-height-source: userset; height: 18.15pt;">
<td style="height: 18.15pt; width: 605pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="17">Total</td>
<td style="width: 87pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
<td style="width: 72pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
<td style="width: 49pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
<td style="width: 71pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
<td style="width: 113pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{convert_price_float($commision_dollar_total)}}</td>
<td style="width: 113pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{convert_price_float($gst_total)}}</td>
<td style="width: 82pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{convert_price_float($commision_dollar_gst_total)}}</td>
<td style="width: 72pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
@if(!empty($array_month))
                    @foreach($array_month as $month)
<td style="width: 62pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">{{($totalMonth->isNotEmpty() && !empty($totalMonth[$month]))?$totalMonth[$month]:''}}</td>
@endforeach
@endif
<td style="width: 75pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
<td style="width: 69pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
<td style="width: 69pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
<td style="width: 79pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;">null</td>
<td style="width: 75pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
<td style="width: 124pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: none; border-right: .5pt solid #000; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;"> </td>
</tr>
<tr style="mso-height-source: userset; height: 25.65pt;">
<td style="height: 25.65pt; width: 4pt;"> </td>
<td style="width: 41pt;"> </td>
<td style="width: 16pt;"> </td>
<td style="width: 30pt;"> </td>
<td style="width: 34pt;"> </td>
<td style="width: 58pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 1pt;"> </td>
<td style="width: 21pt;"> </td>
<td style="width: 73pt;"> </td>
<td style="width: 4pt;"> </td>
<td style="width: 10pt;"> </td>
<td style="width: 80pt;"> </td>
<td style="width: 5pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 43pt;"> </td>
<td style="width: 36pt;"> </td>
<td style="width: 87pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 49pt;"> </td>
<td style="width: 71pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 82pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 62pt;"> </td>
<td style="width: 70pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 79pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 86pt;"> </td>
<td style="width: 83pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 47pt;"> </td>
<td style="width: 50pt;"> </td>
<td style="width: 124pt;"> </td>
</tr>
<tr style="mso-height-source: userset; height: 19.65pt;">
<td style="height: 19.65pt; width: 350pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 16.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: left; vertical-align: middle; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="10">PAYMENT HISTORY</td>
<td style="width: 4pt;"> </td>
<td style="width: 10pt;"> </td>
<td style="width: 80pt;"> </td>
<td style="width: 5pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 43pt;"> </td>
<td style="width: 36pt;"> </td>
<td style="width: 87pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 49pt;"> </td>
<td style="width: 71pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 82pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 62pt;"> </td>
<td style="width: 70pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 79pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 86pt;"> </td>
<td style="width: 83pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 47pt;"> </td>
<td style="width: 50pt;"> </td>
<td style="width: 124pt;"> </td>
</tr>
<tr style="mso-height-source: userset; height: 25.65pt;">
<td style="height: 25.65pt; width: 4pt;"> </td>
<td style="width: 41pt;"> </td>
<td style="width: 16pt;"> </td>
<td style="width: 30pt;"> </td>
<td style="width: 34pt;"> </td>
<td style="width: 58pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 1pt;"> </td>
<td style="width: 21pt;"> </td>
<td style="width: 73pt;"> </td>
<td style="width: 4pt;"> </td>
<td style="width: 10pt;"> </td>
<td style="width: 80pt;"> </td>
<td style="width: 5pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 43pt;"> </td>
<td style="width: 36pt;"> </td>
<td style="width: 87pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 49pt;"> </td>
<td style="width: 71pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 82pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 62pt;"> </td>
<td style="width: 70pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 79pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 86pt;"> </td>
<td style="width: 83pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 47pt;"> </td>
<td style="width: 50pt;"> </td>
<td style="width: 124pt;"> </td>
</tr>
<tr style="mso-height-source: userset; height: 18.15pt;">
<td bgcolor=" lightseagreen" style="height: 18.15pt; width: 45pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: lightseagreen; mso-pattern: black none; white-space: normal;" colspan="2">Month</td>
<td bgcolor=" lightseagreen" style="width: 80pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: lightseagreen; mso-pattern: black none; white-space: normal;" colspan="3">Total of policy</td>
<td bgcolor=" lightseagreen" style="width: 130pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: lightseagreen; mso-pattern: black none; white-space: normal;" colspan="2">Commission paid</td>
<td bgcolor=" lightseagreen" style="width: 95pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: lightseagreen; mso-pattern: black none; white-space: normal;" colspan="3">+/-</td>
<td bgcolor=" lightseagreen" style="width: 99pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border-top: .5pt solid #000; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; background: lightseagreen; mso-pattern: black none; white-space: normal;" colspan="4">Total paid</td>
<td bgcolor=" lightseagreen" style="width: 120pt; padding: 0px; mso-ignore: padding; color: white; font-size: 11.0pt; font-weight: bold; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: General; text-align: center; vertical-align: middle; border: .5pt solid #000; background: lightseagreen; mso-pattern: black none; white-space: normal;" colspan="2">Date of payment</td>
<td style="width: 36pt;"> </td>
<td style="width: 87pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 49pt;"> </td>
<td style="width: 71pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 113pt;"> </td>
<td style="width: 82pt;"> </td>
<td style="width: 72pt;"> </td>
<td style="width: 62pt;"> </td>
<td style="width: 70pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 79pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 86pt;"> </td>
<td style="width: 83pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 77pt;"> </td>
<td style="width: 67pt;"> </td>
<td style="width: 75pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 69pt;"> </td>
<td style="width: 47pt;"> </td>
<td style="width: 50pt;"> </td>
<td style="width: 124pt;"> </td>
</tr>
@if(!empty($array_month))
                @foreach($array_month as $month)
<tr style="mso-height-source: userset; height: 18.15pt;">
    <td style="height: 18.15pt; width: 45pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\@'; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="2">{{$month}}</td>
    <td style="width: 80pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="3">{{(collect($totalOfPolicyMonth)->isNotEmpty() && !empty($totalOfPolicyMonth[$month]))?$totalOfPolicyMonth[$month]:0}}</td>
    <td style="width: 130pt; ;padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="2">{{($totalMonth->isNotEmpty() && !empty($totalMonth[$month]))?$totalMonth[$month]:0}}</td>
    <td style="width: 95pt; ;padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="3">{{(!empty($extra) && !empty($extra[$month]))?$extra[$month]:0}}</td>
    <td style="width: 99pt; ;padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: '\#\,\#\#0'; text-align: right; vertical-align: middle; border-top: none; border-right: none; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="4">@php if(!empty($totalMonth[$month])){ $paymentHistoryTotalMonth = $totalMonth[$month]; } else{ $paymentHistoryTotalMonth = 0; } if(!empty($extra[$month])){ $paymentHistoryExtra = $extra[$month]; }else{ $paymentHistoryExtra = 0; } @endphp {{$paymentHistoryTotalMonth + $paymentHistoryExtra}}</td>
    <td style="width: 120pt; padding: 0px; mso-ignore: padding; color: #000; font-size: 11.0pt; font-weight: 400; font-style: normal; text-decoration: none; font-family: 'Times New Roman'; mso-generic-font-family: auto; mso-font-charset: 1; mso-number-format: 'Short Date'; text-align: center; vertical-align: middle; border-top: none; border-right: .5pt solid #000; border-bottom: .5pt solid #000; border-left: .5pt solid #000; mso-background-source: auto; mso-pattern: auto; white-space: normal;" colspan="2">{{!empty($dateOfPaymentMonth[$month])?$dateOfPaymentMonth[$month]:''}}</td>
    <td style="width: 36pt;"> </td>
    <td style="width: 87pt;"> </td>
    <td style="width: 72pt;"> </td>
    <td style="width: 49pt;"> </td>
    <td style="width: 71pt;"> </td>
    <td style="width: 113pt;"> </td>
    <td style="width: 113pt;"> </td>
    <td style="width: 82pt;"> </td>
    <td style="width: 72pt;"> </td>
    <td style="width: 62pt;"> </td>
    <td style="width: 70pt;"> </td>
    <td style="width: 67pt;"> </td>
    <td style="width: 79pt;"> </td>
    <td style="width: 75pt;"> </td>
    <td style="width: 86pt;"> </td>
    <td style="width: 83pt;"> </td>
    <td style="width: 77pt;"> </td>
    <td style="width: 77pt;"> </td>
    <td style="width: 69pt;"> </td>
    <td style="width: 77pt;"> </td>
    <td style="width: 67pt;"> </td>
    <td style="width: 75pt;"> </td>
    <td style="width: 69pt;"> </td>
    <td style="width: 69pt;"> </td>
    <td style="width: 47pt;"> </td>
    <td style="width: 50pt;"> </td>
    <td style="width: 124pt;"> </td>
</tr>
@endforeach
@endif
</tbody>
</table>
@push('scripts')

@endpush
