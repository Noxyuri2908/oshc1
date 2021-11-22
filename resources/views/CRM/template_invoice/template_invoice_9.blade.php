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

    #more-imf>p>img{
        width: 100%;
        float: left;
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
        padding: 0px 78px;
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
                <td rowspan="4" style="width: 62%;vertical-align:bottom; text-align: right;padding-bottom: 10px;">
                    <b style="text-align: center;color: black; font-size: 22px;">TAX INVOICE</b>
                </td>
            </tr>
            </tbody>

            <tfoot>
            <tr style=" border-bottom: 9px solid white;">
                <td style="width: 40%; text-align: left">
                    <b style="text-align: left; font-size: 10px;margin-bottom: 2px; color: black">{{$dataInvoice['company_name']}}</b>
                    <p style="text-align: left; font-size: 10px;margin-bottom: 2px">{{$dataInvoice['company_address']}}</p>
                    <p style="text-align: left; font-size: 10px;margin-bottom: 2px">{{$dataInvoice['company_phone']}}</p>
                </td>
                <td style="">
                    <p style="text-align: left; font-size: 9px; margin-bottom: 10px; font-weight: bolder;padding-right: 31px;">Billing address :
                        <span style="font-weight: normal; font-size: 9px">GLOBAL ONE VISA-HCM 20 Nguyen Thi Minh Khai, Da Kao Ward, District 1, HCMC</span>
                    </p>
                    <p style="text-align: left; font-size: 9px; margin-bottom: 2px; font-weight: bolder">Invoice No :
                        <span style="font-weight: normal; font-size: 9px">{{ $dataInvoice['ref_no']}}</span>
                    </p>
                    <p style="text-align: left; font-size: 9px; margin-bottom: 2px; font-weight: bolder">Date :
                        <span style="font-weight: normal; font-size: 9px;padding-left: 25px">{{ convert_date_form_db($dataInvoice['date'])}}</span>
                    </p>
                    <p style="text-align: left; font-size: 9px; margin-bottom: 2px; font-weight: bolder">Term :
                        <span style="font-weight: normal; font-size: 9px;padding-left: 23px">Immediate Payment</span>
                    </p>
                </td>

            </tr>
            <tr style="border-top: 9px solid white;">
                <td style="width: 40%;">
                </td>
                <td style="width: 20%;text-align: left">
                    <span style="color: black; font-size: 10px;margin: 0; ">Reference : </span>
                    <span style="color: black;font-size: 12px; ">{{$dataInvoice['cusName']}}</span>
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
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">SERVICE</th>
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">PROVIDER</th>
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">POLICY</th>
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">START DATE</th>
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px">END DATE</th>
                <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 9px;padding: 10px;width: 88px">AMOUNT</th>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 9px; padding: 5px 15px">{{$dataInvoice['service']}}</td>
                <td style=" text-align:left; font-size: 9px; padding: 5px 15px">
                    <p style="font-size: 9px;">{{$dataInvoice['provider_name']}}</p>
                    <p style="font-size: 9px;">{{ !empty($dataInvoice['cover']) ? '('.$dataInvoice['cover'].')' : '' }}</p>
                </td>
                <td style=" text-align:left; font-size: 9px; padding: 5px 9px">{{$dataInvoice['policy']}}</td>
                <td style=" text-align:left; font-size: 9px; padding: 5px 9px">{{convert_date_form_db($dataInvoice['start_date'])}}</td>
                <td style=" text-align:left; font-size: 9px; padding: 5px 9px">{{convert_date_form_db($dataInvoice['end_date'])}}</td>
                <td style=" text-align:left; font-size: 9px; padding: 5px 9px">{{convert_price_float($dataInvoice['amount'])}} {{$dataInvoice['currency']}}</td>
            </tr>
            <tr >
                <td colspan="6" style="padding-left: 0 !important;padding-right: 0 !important;"><hr style="border-style: solid; border-width: 1px; color: #5c5c5c; margin: 0;"></td>
            </tr>
            <tr style=" text-align:center;">
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2"  style="color: black; text-align:center; font-size: 9px; padding: 5px 0px; background-color: #D3D3D3" >
                    <p style="color: black; text-align:left; font-size: 9px; padding: 2px 15px; margin-bottom: 0;letter-spacing: 0.5px" >TOTAL AMOUNT PAYABLE</p>
                    <p style="color: black; text-align:left; font-size: 9px; padding: 2px 15px; margin-bottom: 0" >(GST inclusive)</p>
                </th>
                <th style=" color: black;text-align: left; padding: 5px 9px; font-size: 9px;background-color: #D3D3D3">{{convert_price_float($dataInvoice['amount'])}} {{$dataInvoice['currency']}}</th>
            </tr>
            <tr>
                <td></td>
                <td colspan="5" style="    text-align: right;padding-right: 0; padding-top: 5px !important;">
                    <i style="font-size: 8px; color: black;padding-left: 39px;text-align: right;">Note: If you hold a student dependent visa, you must be insured under the same policy as the main</i><br>
                    <i style="font-size: 8px; color: black; padding-left: 91px;text-align: right;">student visa holder. You are only eligible to hold a single policy if you are the primary visa holder.</i>
                </td>
            </tr>
        </table>
        <br />
        <div id="more-imf">
            {{decode_html($dataInvoice['content'])}}
        </div>

    </page>
    @include('CRM.template_invoice.script_export_to_pdf')
@stop
