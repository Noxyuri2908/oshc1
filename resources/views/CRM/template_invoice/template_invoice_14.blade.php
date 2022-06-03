@extends('CRM.layouts.default')

@section('title')
    INVOICE
    @parent
@stop
<style type="text/css">
    table { vertical-align: top; }
    tr    { vertical-align: top; }
    td    { vertical-align: top; }
    h1,h2{margin: 0;}
    p{margin: 1px 0px; color: #222; font-size: 14px}

    .c-black{
        color: black;
    }

    #mainContent{
        width: 806px;
        margin: auto !important;
    }

    tfoot>tr>td:nth-child(1)>p,
    tfoot>tr>td:nth-child(1)>b{
        text-align: left;
        font-size: 11px;
        margin-bottom: 2px;
        color : #000;
    }

    tfoot>tr>td:nth-child(2){
        padding-right: 31px;
    }

    tfoot>tr>td:nth-child(2)>p{
        text-align: left;
        margin-bottom: 2px;
        font-weight: bolder;
        font-size: 12px;
    }

    tfoot>tr>td:nth-child(2)>p:nth-child(1){
        margin-bottom: 10px;
    }

    tfoot>tr>td:nth-child(2)>p>span{
        font-weight: normal;
        font-size: 12px;
    }

    #th-header>th{
        text-align:center;
        background-color: rgb(234,235,237);
        text-transform: uppercase;
        padding: 10px;
        color: #000;
    }

    #td-content>td{
        text-align:center;
        font-size: 11px;
        padding: 5px 9px;
        color: #000;
    }

    #total-rate{
        text-align:center;
        font-size: 13px;
        padding: 5px 0px;
        background-color: #D3D3D3;
        color: #000;
        font-weight: bolder;
    }

    #total-rate>p{
        margin: 0;
        font-size: 13px;
    }

    #total-rate>p:nth-child(2){
        font-weight: normal;
    }

    #more-imf>p>img{
        width: 100%;
        float: left;
    }

    table#table-2,#table-2 th,#table-2 td {
        border: none;
        border-collapse: collapse;
    }
    /*#table-2 th,#table-2 td {*/
    /*    padding: 10px 15px;*/
    /*    padding-bottom: 0;*/
    /*}*/
    page{
        width: 100%;
        float: left;
        padding: 0px 78px;
        height: 1000px;
    }

    tfoot:before {
        content: '';
        display: block;
        height: 53px;
    }

    .sub-des{
        text-align: right;
        padding-right: 0;
        padding-top: 5px !important;
        color: #000;
    }

    .sub-des>i{
        font-size: 10px;
    }
    table>tbody>tr:nth-child(1)>th:nth-child(1),
    table>tbody>tr:nth-child(1)>th:nth-child(2)
    {
        width: 105px;
    }

    table>tbody>tr:nth-child(1)>th:nth-child(3)
    {
        width: 90px;
    }
    table>tbody>tr:nth-child(1)>th:nth-child(4),
    table>tbody>tr:nth-child(1)>th:nth-child(5)
    {
        width: 100px;
    }

    table>tbody>tr:nth-child(1)>th:nth-child(6)
    {
        width: 150px;
    }

    table>tbody>tr:nth-child(1)>th{
        font-size: 12px;
    }

</style>

@section('content')
    @include('CRM.template_invoice.button_export_invoice')
    <page id="page" backcolor="#fff" backimgx="center" backimgy="bottom" backimgw="100%" backtop="42px" backleft="16px" backright="16px" backbottom="42px" footer="page" style="background: #fff;">
        <bookmark title="Lettre" level="0" ></bookmark>
        <table cellspacing="0" style="width: 100%; text-align: center; border-collapse: collapse">
            <tbody style=" ">
            <tr>
                <td rowspan="4" style="width: 20%; padding-top: 45px;">
                    <img style="width:185px;float: left" src="{{$dataInvoice['logo']}}" alt="Logo" id="img" border="none">
                </td>
                <td rowspan="4" style="width: 62%;vertical-align:bottom; text-align: right;padding-bottom: 10px;">
                    <b style="font-size: 22px;color: #000">TAX INVOICE</b>
                </td>
            </tr>
            </tbody>

            <tfoot>
            <tr style="">
                <td style="width: 40%; text-align: left">
                    <b style="">{{$dataInvoice['company_name']}}</b>
                    <p style="">{{$dataInvoice['company_address']}}</p>
                    <p style="">{{$dataInvoice['company_phone']}}</p>
                </td>
                <td style="padding-right: 31px">
                    <p style="">BILLING ADDRESS :
                        <span >{{ $dataInvoice['agentName']}}</span><br>
                        <span >{{ $dataInvoice['address_agent']}}</span>
                    </p>
                    <p style="">Invoice No :
                        <span style="">{{ $dataInvoice['ref_no']}}</span>
                    </p>
                    <p style="">Date :
                        <span style="padding-left: 32px">{{ convert_date_form_db($dataInvoice['date'])}}</span>
                    </p>
                    <p style="">Term :
                        <span style="padding-left: 31px">Immediate Payment</span>
                    </p>
                </td>

            </tr>
            <tr style="color: #000">
                <td style="width: 40%;">
                </td>
                <td style="width: 20%;text-align: left">
                    <span style="font-size: 12px;margin: 0; ">Reference : </span>
                    <span style="font-size: 14px; font-weight: bolder">{{$dataInvoice['cusName']}}</span>
                </td>
            </tr>
            </tfoot>
        </table>
        <br>
        <div class="header" style="display: flex;justify-content: center;align-items: center">
            <div class="content-right" style="flex: 1">

            </div>
        </div>

        <table id="table-2" cellspacing="0" style="width: 100%;">

            <tr id="th-header">
                <th style="">SERVICE</th>
                <th style="">PROVIDER</th>
                <th style="">POLICY</th>
                <th style="">START DATE</th>
                <th style="">END DATE</th>
                <th style="width: 100px">AMOUNT</th>
            </tr>
            <tr id="td-content">
                <td style=" ">{{$dataInvoice['service']}}</td>
                <td style=" ">
                    <p style="font-size: 11px" class="provider">{{$dataInvoice['provider_name']}}</p>
                    <p style="font-size: 11px" class="provider">{{ !empty($dataInvoice['cover']) ? '('.$dataInvoice['cover'].')' : '' }}</p>
                </td>
                <td style="">{{$dataInvoice['policy']}}</td>
                <td style="">{{convert_date_form_db($dataInvoice['start_date'])}}</td>
                <td style="">{{convert_date_form_db($dataInvoice['end_date'])}}</td>
                <td style="" class="text-right">{{convert_price_float($dataInvoice['amount'])}} {{$dataInvoice['currency']}}</td>
            </tr>
            {{--            <tr>--}}
            {{--                <th></th>--}}
            {{--                <th></th>--}}
            {{--                <th></th>--}}
            {{--                <th colspan="2" style="color: #000" class="text-right pl-29">Commission (include GST)</th>--}}
            {{--                <td style="text-align: right;color: #000;padding-right: 9px">{{$dataInvoice['comm']}} {{$dataInvoice['currency']}}</td>--}}
            {{--            </tr>--}}
            @if ($dataInvoice['extend_fee'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="text-right fontSize11px pl-15px c-black" >Extend fee</th>
                    <td class="fontSize11px c-black text-right" style="padding-right: 9px !important;">{{$dataInvoice['extend_fee']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            @if ($dataInvoice['discount'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="text-right fontSize11px pl-15px c-black" >Discount</th>
                    <td class="fontSize11px c-black text-right" style="padding-right: 9px !important;">{{$dataInvoice['discount']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            @if ($dataInvoice['promotion'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="text-right fontSize11px pl-15px c-black" >Promotion</th>
                    <td class="fontSize11px c-black text-right" style="padding-right: 9px !important;">{{$dataInvoice['promotion']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            @if ($dataInvoice['bank_fee'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="text-right fontSize11px pl-15px c-black" >Surcharge fee</th>
                    <td class="fontSize11px c-black text-right" style="padding-right: 9px !important;">{{$dataInvoice['bank_fee']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            @if ($dataInvoice['comm'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="text-right fontSize11px pl-15px c-black" >Commission</th>
                    <td class="fontSize11px c-black text-right" style="padding-right: 9px !important;">{{convert_price_float($dataInvoice['comm'])}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            <tr >
                <td colspan="6" style="padding: 0 !important;"><hr style="border-style: solid; border-width: 1px; color: #5c5c5c; margin: 0;"></td>
            </tr>
            <tr style=" text-align:center;">
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2" class="text-right"  id="total-rate">TOTAL AMOUNT PAYABLE</th>
                <th id="total-rate" class="text-right" style="padding-right: 9px">{{convert_price_float($dataInvoice['total'])}} {{$dataInvoice['currency']}}</th>
            </tr>
            <tr>
                <td></td>
                <td colspan="5" class="sub-des">
                    <i >Note: If you hold a student dependent visa, you must be insured under the same policy as the main</i><br>
                    <i >student visa holder. You are only eligible to hold a single policy if you are the primary visa holder.</i>
                </td>
            </tr>
        </table>
        <br />
        <div id="more-imf">
            {{decode_html($dataInvoice['content'])}}
        </div>

    </page>
    @include('CRM.template_invoice.script_export_to_pdf', ['ref_no' => $dataInvoice['ref_no']])
@stop
