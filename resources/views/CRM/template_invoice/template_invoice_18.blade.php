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
    p{margin: 1px 0px; color: #222; font-size: 12px}

    table#table-2,#table-2 th,#table-2 td {
        border: none;
        border-collapse: collapse;
    }
    #table-2 th,#table-2 td {
        padding: 10px 15px;
    }
    .td-content-info{
        width: 100%;
    }
    /*.border-td{*/
    /*    border-style: dashed !important;*/
    /*    border-bottom: 1px !important;*/
    /*    border-left: none !important;*/
    /*    border-right: none !important;*/
    /*    color: #4682b4 !important;*/
    /*    border-collapse : unset !important;*/
    /*}*/

    .bank label span{
        padding-bottom: 2px;
    }

    page{
        width: 100%;
        float: left;
        padding: 0px 85px;
        height: 1000px;
        margin-top: 30px;
    }
</style>
@section('content')
    @include('CRM.template_invoice.button_export_invoice')
    <page backcolor="#fff" id="example" backimgx="center" backimgy="bottom" backimgw="100%" backtop="42px" backleft="68px" backright="16px" backbottom="42px" footer="page" style="font-family: cambria;font-size: 12pt">
        <bookmark title="Lettre" level="0" ></bookmark>
        <table cellspacing="0" style="width: 100%; text-align: center; font-size: 10px;">
            <tr>
                <td rowspan="2" style="width: 50%;">
                    <p style="text-align: left;"><b style="font-size: 15px">{{$dataInvoice['company_name']}}</b></p>
                    <p style="text-align: left; font-size: 12px;">{{$dataInvoice['company_address']}}</p>
                    <p style="text-align: left; font-size: 12px">{{$dataInvoice['company_phone']}}</p>
                    <p style="text-align: left; font-size: 12px">{{$dataInvoice['company_website']}}</p>
                    <br /><br />
                    <p style="text-align: left; color: #4682b4; font-size: 24pt;">INVOICE</p>
                    <p style="text-align: left; font-size: 12px"><b style="font-size: 15px;">BIILING ADDRESS:</b> {{$dataInvoice['agentName']}}</p>
                    <p style="text-align: left; font-size: 12px">{{$dataInvoice['office']}}</p>
                </td>
                <td colspan="2" style="width: 50%;  float: right;">
                    <div class="logo-company" style="height: 126px">
                        <img style="width:230px;float:right;" src="{{($dataInvoice['logo'])? $dataInvoice['logo'] : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3'}}" alt="Logo" id="img" border="none">
                    </div>
                    <div class="info-invoice" style="text-align: right">
                        <p><b>DATE:</b> <span style="font-size: 12px">{{$dataInvoice['date']}}</span></p>
                        <p><b>INVOICE NO:</b> <span style="font-size: 12px">{{$dataInvoice['ref_no']}}</span></p>
                        <p><b>REFERENCE:</b> <span style="font-size: 12px">{{($dataInvoice['cusName']) ? $dataInvoice['cusName'] : '...'}}</span></p>
                        <p><b>TERM:</b> <span style="font-size: 12px">{{$dataInvoice['term']}}</span></p>
                    </div>
                </td>
            </tr>
        </table>
        <br>
        <hr style="border-style: solid; border-width: 1px; color: #4682b4;">
        <br>
        <p style="text-align: right;padding: 10px; font-size: 10px;">Currency: {{$dataInvoice['currency']}}</p>

        <table id="table-2" cellspacing="0" style="width: 100%; font-size: 10px; border: none;">

            <tr id="th-header">
                <th style="width: 25%; text-align:center; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">Provider</th>
                <th style="width: 15%; text-align:center; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">POLICY</th>
                <th style="width: 20%; text-align:center; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">Start date</th>
                <th style="width: 20%; text-align:center; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">End date</th>
                <th style="width: 20%; text-align:center; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">Amount</th>
            </tr>
            <tr>
                <td style=" font-size:12px; text-align:center;">{{$dataInvoice['provider_name']}}</td>
                <td style=" font-size:12px; text-align:center;">{{$dataInvoice['policy']}}</td>
                <td style=" font-size:12px; text-align:center;">{{convert_date_form_db($dataInvoice['start_date'])}}</td>
                <td style=" font-size:12px; text-align:center;">{{convert_date_form_db($dataInvoice['end_date'])}}</td>
                <td style=" font-size:12px; text-align:center;">{{convert_price_float($dataInvoice['serviceCharge'])}}</td>
            </tr>
            <tr style="border-bottom: 1px dashed #4682b4;">
                <td style="font-size: 12px; text-align:center;"></td>
                <td style=" text-align:center;"></td>
                <td style=" text-align:center;"></td>
                <td style=" text-align:center;"></td>
                <td style=" font-size: 12px; text-align:center;">{{$dataInvoice['tmp']}}</td>
            </tr>
            <tr >
                <th colspan="4" style="text-align:center;"><h4 style=" font-size: 12px; font-weight: 700" >TOTAL AMOUNT PAYABLE</h4></th>
                <td style="text-align: center; "><b style="font-size: 12px;">{{convert_price_float($dataInvoice['serviceCharge'])}}</b></td>
            </tr>
        </table>
        <div id="editor"></div>
        <div id="more-imf">
            {{decode_html($dataInvoice['content'])}}
        </div>
    </page>
@stop
