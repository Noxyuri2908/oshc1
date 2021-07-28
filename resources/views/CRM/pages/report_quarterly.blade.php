@extends('CRM.layouts.default')

@section('title')
    REPORT MONTHLY
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.pages.css.customer-css')

@stop
@section('content')

@include('CRM.elements.report.filter')
<div class="card mt-3">
    <table align="left" cellspacing="0" border="0">
        <colgroup width="75"></colgroup>
        <colgroup width="104"></colgroup>
        <colgroup width="196"></colgroup>
        <colgroup width="113"></colgroup>
        <colgroup width="85"></colgroup>
        <colgroup width="72"></colgroup>
        <colgroup width="126"></colgroup>
        <colgroup span="2" width="92"></colgroup>
        <colgroup width="83"></colgroup>
        <colgroup span="2" width="102"></colgroup>
        <colgroup width="113"></colgroup>
        <colgroup width="79"></colgroup>
        <tbody>
        <tr height="113" style="mso-height-source:userset;height:85.25pt">
            <td colspan="8" height="113" width="339" style="height:85.25pt;width:256pt" align="left" valign="top">
                    <img id="scream" width="340" height="113" src="http://oschabc.test/images/oshc-icon.png" v:shapes="Picture_x0020_1">
            </td>
        </tr>
        <tr>
            <td height="19" align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="center" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="bottom"><font face="Times New Roman"><br></font></td>
        </tr>
        <tr>
            <td colspan="3" rowspan="2" height="36" align="left" valign="middle"><b><font face="Times New Roman">QUARTERLY REPORT </font></b></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="bottom"><font face="Times New Roman"><br></font></td>
        </tr>
        <tr>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="bottom"><font face="Times New Roman"><br></font></td>
        </tr>
        <tr>
            <td height="24" align="left" valign="middle" bgcolor="#D9D9D9"><font face="Times New Roman">Agent partner: </font></td>
            <td align="center" valign="bottom" bgcolor="#D9D9D9"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="bottom" bgcolor="#D9D9D9"><b><font face="Times New Roman" color="#000000">DEOW</font></b></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="bottom"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="bottom"><font face="Times New Roman"><br></font></td>
        </tr>
        <tr>
            <td height="21" align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="center" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="right" valign="top" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="bottom"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="top"><font face="Times New Roman"><br></font></td>
            <td align="left" valign="bottom"><font face="Times New Roman"><br></font></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="37" align="center" valign="middle" bgcolor="#EF4B88"><b><font face="Times New Roman" color="#FFFFFF">Quarter</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88"><b><font face="Times New Roman" color="#FFFFFF">Date</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88"><b><font face="Times New Roman" color="#FFFFFF">Name</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88"><b><font face="Times New Roman" color="#FFFFFF">Payment ID</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88" sdnum="1033;0;#,##0.00"><b><font face="Times New Roman" color="#FFFFFF">Amount</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88" sdnum="1033;0;#,##0.00"><b><font face="Times New Roman" color="#FFFFFF">Currency</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88" sdnum="1033;0;#,##0.00"><b><font face="Times New Roman" color="#FFFFFF">Commission rate<br> (%)</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88" sdnum="1033;0;#,##0.00"><b><font face="Times New Roman" color="#FFFFFF">Commission <br>$</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88" sdnum="1033;0;#,##0.00"><b><font face="Times New Roman" color="#FFFFFF">Currency</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88" sdnum="1033;0;#,##0"><b><font face="Times New Roman" color="#FFFFFF">Exchange</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88" sdnum="1033;0;#,##0"><b><font face="Times New Roman" color="#FFFFFF">Commission<br>VND</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88" sdnum="1033;0;#,##0"><b><font face="Times New Roman" color="#FFFFFF">Quarter III</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88"><b><font face="Times New Roman" color="#FFFFFF">Payment status</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#EF4B88"><b><font face="Times New Roman" color="#FFFFFF">Note</font></b></td>
        </tr>
        @foreach($profits as $profit)
        @if(!empty($profit))
        @php
        $invoice = $profit->invoice;
        $getDateInitiated = (!empty($profit->invoice))?\Carbon::parse($profit->invoice->initiated_date)->format('d/m/Y'):'';
        $getDateInitiatedQuarter = (!empty($profit->invoice))?\Carbon::parse($profit->invoice->initiated_date)->quarter:'';
        $customerName = (!empty($invoice))?$invoice->getFullNameCus():'';
        $paymentId = (!empty($invoice))?$invoice->ref_no:'';
        $amount = (!empty($invoice))?$invoice->amount_from:'';
        $amountUnit = (!empty($invoice))?getCurrency($invoice->amount_from_unit):'';
        $commissionRatePer = (!empty($invoice) && !empty($invoice->getCom()))?$invoice->getCom()->comm:0;
        $commissionDollar =$amount * $commissionRatePer /100;
        $exchangeRate = 0;
        $commissionVND = $commissionDollar * $exchangeRate;
        $paymentStatus = getComStatusFlywire($profit->com_status_cp);
        @endphp
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan="1" height="79" align="center" valign="middle" bgcolor="#FBE5D6"><font face="Times New Roman">{{convertNumberToRomanNumber($getDateInitiatedQuarter)}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="bottom" sdval="44032" sdnum="1033;1033;M/D/YYYY"><font face="Times New Roman" color="#000000">{{$getDateInitiated}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom"><font face="Times New Roman" color="#000000">{{$customerName}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom"><font face="Times New Roman" color="#000000">{{$paymentId}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="bottom" sdval="21190" sdnum="1033;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><font face="Times New Roman" color="#000000">{{convert_price_float($amount)}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="bottom"><font face="Times New Roman" color="#000000">{{$amountUnit}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdval="0.2" sdnum="1033;0;#,##0.00"><font face="Times New Roman" color="#000000">{{$commissionRatePer}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdval="42.38" sdnum="1033;0;#,##0.00"><font face="Times New Roman">{{$commissionDollar}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="bottom"><font face="Times New Roman" color="#000000">{{$amountUnit}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom"><font face="Times New Roman" color="#000000">{{$exchangeRate}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#FFFFFF" sdnum="1033;0;@"><font face="Times New Roman" color="#000000">{{$paymentStatus}}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom"><font face="Times New Roman" color="#000000"><br></font></td>
        </tr>
        @endif
        @endforeach
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign="middle"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="bottom" sdnum="1033;1033;M/D/YYYY"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom" sdnum="1033;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="bottom" sdnum="1033;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#FFFFFF" sdnum="1033;0;@"><font face="Times New Roman" color="#000000"><br></font></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><b><font face="Times New Roman" color="#000000"><br></font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan="3" height="25" align="center" valign="middle"><b><font face="Times New Roman">Total</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><b><font face="Times New Roman"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><b><font face="Times New Roman"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><b><font face="Times New Roman"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdval="0" sdnum="1033;0;#,##0"><b><font face="Times New Roman">0</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><b><font face="Times New Roman"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><b><font face="Times New Roman"><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><font face="Times New Roman"><br></font></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="25" align="center" valign="middle"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" sdnum="1033;0;#,##0"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><font face="Times New Roman"><br></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle"><font face="Times New Roman"><br></font></td>
        </tr>
    </tbody>
    </table>
</div>
@stop
