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

    table#table-2,#table-2 th,#table-2 td {
        border: none;
        border-collapse: collapse;
    }
    #th-header>th,
    tr>th{
        padding: 10px 15px;
    }

    #table-2>tbody>tr>td{
        padding: 5px 5px;
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
    <page backcolor="#fff" backimgx="center" backimgy="bottom" backimgw="100%" backtop="42px" backleft="16px" backright="16px" backbottom="42px" footer="page" style="font-family: DejaVu Sans;font-size: 12pt">
        <bookmark title="Lettre" level="0" ></bookmark>
        <table cellspacing="0" style="width: 100%; text-align: center;">
            <tr>
                <td style="width: 40%; text-align: left; font-size: 14px;">
                    {{$dataInvoice['companyNameVi']}}
                </td>
                <td style="width: 20%;">
                </td>
                <td rowspan="4" style="width: 40%;">
                    <img style="width:230px;float: right" src="{{($dataInvoice['logo'])? $dataInvoice['logo'] : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3'}}" alt="Logo" id="img" border="none">
                </td>
            </tr>
            <tr>
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 12px;margin-bottom: 2px;">{{$dataInvoice['companyAddressVi1']}}</p>
                </td>
                <td style="width: 20%;">
                    <p style="text-align: left;margin-bottom: 2px; font-size: 12px;">| {{$dataInvoice['companyPhoneVi1']}}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 12px;margin-bottom: 2px;">{{$dataInvoice['companyAddressVi2']}}</p>
                </td>
                <td style="width: 20%;">
                    <p style="text-align: left; font-size: 12px;margin-bottom: 2px;">| {{$dataInvoice['companyPhoneVi2']}}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 12px;margin-bottom: 2px;">Email: {{$dataInvoice['companyEmailVi1']}}</p>
                </td>
                <td style="width: 20%;">
                </td>
            </tr>
        </table>
        <br>
        <p style="text-align: center; color: #4682b4; font-size: 15px;margin-bottom: 2px;">PHIẾU ĐỀ NGHỊ THANH TOÁN</p>
        <p style="text-align: right; font-size: 9px;">Khách hàng: {{ $dataInvoice['agentName']}}</p>

        <hr style="border-style: solid; border-width: 1px; color: #4682b4;">

        <table id="table-2" cellspacing="0" style="width: 100%;">

            <tr id="th-header">
                <th style="width: 50%; text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 11px;">NỘI DUNG</th>
                <th style="width: 50%; text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 11px;">CHI TIẾT</th>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 12px;">
                    Họ và tên người đề nghị:
                </td>
                <td >
                    {{$dataInvoice['cusName']}}
                </td>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 12px;">
                    Số hóa đơn:
                </td>
                <td >
                    {{$dataInvoice['ref_no']}}
                </td>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 12px;">
                    Ngày bắt đầu:
                </td>
                <td >
                    {{convert_date_form_db($dataInvoice['start_date'])}}
                </td>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 12px;">
                    Ngày kết thúc:
                </td>
                <td style=" text-align:left; font-size: 12px;">
                {{convert_date_form_db($dataInvoice['end_date'])}}
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 12px;">
                    Hãng bảo hiểm:
                </td>
                <td >
                    {{$dataInvoice['provider_name']}}
                </td>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 12px;">
                    Phí bảo hiểm
                </td>
                <td>
                    {{$dataInvoice['insuranceFees']}}
                </td>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 12px;">
                    Phí chuyển tiền
                </td>
                <td>
                    {{$dataInvoice['bank_fee']}}
                </td>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 12px;">
                    Tổng số tiền phải thu AUD
                </td>
                <td>
                    {{$dataInvoice['totalAUD']}}
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr style="border-style: dashed; border-width: 1px; color: #4682b4;"></td>
            </tr>
            <tr>
                <th style=" text-align:left; font-size: 12px;" >Tỷ giá</th>
                <th style=" text-align:left; font-size: 12px;" >{{convert_price_float($dataInvoice['sum_exchange_rate_receipt'])}}</th>
            </tr>
            <tr>
                <th style=" text-align:left; font-size: 12px;" >TỔNG SỐ TIỀN PHẢI THU (VNĐ)</th>
                <th style=" text-align:left; font-size: 12px;" >{{convert_price_float($dataInvoice['sum_amount_receipt'], 0)}}</th>
            </tr>
        </table>
        <br />
        <div id="more-imf">
            {{decode_html($dataInvoice['content'])}}
        </div>
    </page>
@stop
