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

    #mainContent{
        width: 806px;
        margin: auto !important;
    }

    table#table-2,#table-2 th,#table-2 td {
        border: none;
        border-collapse: collapse;
    }
    #table-2 th,#table-2 td {
        padding: 10px 15px;
        padding-bottom: 0;
    }
    page{
        width: 100%;
        float: left;
        padding: 0px 85px;
        height: 1000px;
        color: black;
    }

    tfoot:before {
        content: '';
        display: block;
        height: 53px;
    }

    body{
        color: black !important;
    }
</style>
@section('content')
    @include('CRM.template_invoice.button_export_invoice')
    <page id="page" backcolor="#fff" backimgx="center" backimgy="bottom" backimgw="100%" backtop="42px" backleft="16px" backright="16px" backbottom="42px" footer="page" style="background: #fff;">
        <bookmark title="Lettre" level="0" ></bookmark>
        <table cellspacing="0" style="width: 100%; text-align: center; border-collapse: collapse">
            <tbody style=" ">
            <tr>
                <td rowspan="4" style="width: 20%;    padding-top: 45px;">
                    <img style="width:185px;float: left" src="{{$dataInvoice['logo']}}" alt="Logo" id="img" border="none">
                </td>
                <td rowspan="4" style="width: 62%;vertical-align:bottom; background: rgb(234,235,237);padding-bottom: 10px;">
                    <b style="text-align: center;color: black; font-size: 20px;">INVOICE</b>
                </td>
            </tr>
            </tbody>

            <tfoot>
            <tr style=" border-bottom: 9px solid white;">
                <td style="width: 40%; text-align: left">
                    <b style="text-align: left; font-size: 9px;margin-bottom: 2px; color: black">{{$dataInvoice['company_name']}}</b>
                </td>
            </tr>
            <tr style=" border-bottom: 9px solid white;" >
                <td style=" padding-right: 60px;">
                    <p style="text-align: left; font-size: 9px;margin-bottom: 2px">{{$dataInvoice['company_address']}}</p>
                    <p style="text-align: left; font-size: 9px;margin-bottom: 2px">{{$dataInvoice['company_phone']}}</p>
                </td>
                <td style="">
                    <p style="text-align: left; font-size: 9px; margin-bottom: 2px;    padding-right: 177.5px;">BILLING ADDRESS: GLOBAL ONE VISA-HCM
                        20 Nguyen Thi Minh Khai, Da Kao Ward, District 1, HCMC
                    </p>
                </td>
                <td></td>
            </tr>
            <tr style="">
                <td style="width: 40%;">
                </td>
                <td>
                    <p style="text-align: left; font-size: 9px; margin-bottom: 2px">Invoice No: {{ $dataInvoice['ref_no']}}</p>
                    <p style="text-align: left; font-size: 9px; margin-bottom: 2px">Date: {{ convert_date_form_db($dataInvoice['date'])}}</p>
                    <p style="text-align: left; font-size: 9px; margin-bottom: 2px">Term: Immediate Payment</p>
                </td>
            </tr>
            <tr style="border-top: 9px solid white;">
                <td style="width: 40%;">
                </td>
                <td style="width: 20%;text-align: left">
                    <p style="color: black; font-size: 10px;margin: 0; ">REFERENCE</p>
                    <b style="color: black;font-size: 13px; ">{{$dataInvoice['cusName']}}</b>
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
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">PROVIDER</th>
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">POLICY</th>
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">START DATE</th>
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">END DATE</th>
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">AMOUNT</th>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 9px; padding: 5px 15px">{{$dataInvoice['cusName']}}</td>
                <td style=" text-align:left; font-size: 9px; padding: 5px 15px">{{$dataInvoice['policy']}}</td>
                <td style=" text-align:left; font-size: 9px; padding: 5px 15px">{{convert_date_form_db($dataInvoice['start_date'])}}</td>
                <td style=" text-align:left; font-size: 9px; padding: 5px 15px">{{convert_date_form_db($dataInvoice['end_date'])}}</td>
                <th style=" color: #fff;text-align: left; padding: 5px 15px; font-size: 9px;background-color: rgb(220,87,134)">{{convert_price_float($dataInvoice['amount'])}}</th>
                <td style=" text-align:left; font-size: 9px; padding: 5px 15px"></td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th colspan="2" style="padding: 5px 15px; font-size: 9px;">Commission (include GST)</th>
                <td style="padding: 5px 15px; font-size: 9px;">{{$dataInvoice['comm']}}</td>
            </tr>
            <tr >
                <td colspan="5" style="padding-left: 0 !important;padding-right: 0 !important;"><hr style="border-style: dashed; border-width: 1px; color: #4682b4; margin: 0;"></td>
            </tr>
            <tr style=" text-align:center;">
                <th></th>
                <th></th>
                <th colspan="2"  style="color: #fff; text-align:left; font-size: 9px; padding: 5px 15px; font-size: 9px;background-color: rgb(220,87,134)" >TOTAL AMOUNT PAYABLE</th>
                <th style=" color: #fff;text-align: left; padding: 5px 15px; font-size: 9px;background-color: rgb(220,87,134)">{{convert_price_float($dataInvoice['total'])}}</th>
            </tr>
            <tr>
                <td colspan="5" style="    text-align: right;padding-right: 0; padding-top: 5px !important;">
                    <i style="font-size: 8px; color: black;padding-left: 39px;text-align: right;">Note: If you hold a student dependent visa, you must be insured under the same policy as the main</i><br>
                    <i style="font-size: 8px; color: black; padding-left: 136px;text-align: right;">student visa holder. You are only eligible to hold a single policy if you are the primary visa holder.</i>
                </td>
                <td></td>
            </tr>
        </table>
        <br />
        <div id="more-imf">
            {{decode_html($dataInvoice['content'])}}
        </div>

    </page>
    @include('CRM.template_invoice.script_export_to_pdf')
@stop
