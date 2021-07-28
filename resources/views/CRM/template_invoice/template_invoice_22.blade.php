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
    #table-2 th,#table-2 td {
        padding: 10px 15px;
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
                    <img src="{{$dataInvoice['logo']}}" alt="Logo" border="none">
                </td>
            </tr>
            <tr>
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 9px;">{{$dataInvoice['companyAddressVi1']}}</p>
                </td>
                <td style="width: 20%;">
                    <p style="text-align: left; font-size: 11px;">| {{$dataInvoice['companyPhoneVi1']}}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 9px;">{{$dataInvoice['companyAddressVi2']}}</p>
                </td>
                <td style="width: 20%;">
                    <p style="text-align: left; font-size: 11px;">| {{$dataInvoice['companyPhoneVi2']}}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 9px;">Email: {{$dataInvoice['companyEmailVi1']}}</p>
                </td>
                <td style="width: 20%;">
                </td>
            </tr>
        </table>
        <br>
        <p style="text-align: center;padding: 10px; color: #4682b4; font-size: 15px;">PHIẾU ĐỀ NGHỊ THANH TOÁN</p>
        <hr style="border-style: solid; border-width: 1px; color: #4682b4;">
        <p style="text-align: right;padding: 10px; font-size: 9px;">Đơn vị: {{ $dataInvoice['currency']}}</p>

        <table id="table-2" cellspacing="0" style="width: 100%;">

            <tr id="th-header">
                <th style="width: 50%; text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 11px;">NỘI DUNG</th>
                <th style="width: 50%; text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 11px;">CHI TIẾT</th>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 9px;">
                    Họ và tên người đề nghị:
                </td>
                <td style=" text-align:left; font-size: 9px;">
                    {{$dataInvoice['cusName']}}
                </td>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 9px;">
                    Nội dung chuyển tiền:
                </td>
                <td style=" text-align:left; font-size: 9px;">
                    {{$dataInvoice['cusContent']}}
                </td>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 9px;">
                    Ngày bắt đầu:
                </td>
                <td style=" text-align:left; font-size: 9px;">
                    {{convert_date_form_db($dataInvoice['start_date'])}}
                </td>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 9px;">
                    Ngày kết thúc:
                </td>
                <td style=" text-align:left; font-size: 9px;">
                {{convert_date_form_db($dataInvoice['end_date'])}}
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 9px;">
                    Hãng bảo hiểm:
                </td>
                <td style=" text-align:left; font-size: 9px;">
                    {{$dataInvoice['provider_name']}}
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr style="border-style: dashed; border-width: 1px; color: #4682b4;"></td>
            </tr>
            <tr>
                <td>
                    <b>PHÍ BẢO HIỂM</b>
                </td>
                <td>
                    <b>{{$dataInvoice['amount']}}</b>
                </td>
            </tr>
            <tr>
                <td>
                    <b>DISCOUNT/CASHBACK:</b>
                </td>
                <td>
                    <b>{{convert_price_float($dataInvoice['discount/cashback'])}}</b>
                </td>
            </tr>
            <tr>
                <td>
                    <b>PHÍ CHUYỂN:</b>
                </td>
                <td>
                    <b>{{$dataInvoice['bank_fee']}}</b>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Commission:</b>
                </td>
                <td>
                    <b>{{convert_price_float($dataInvoice['comm'])}}</b>
                </td>
            </tr>
            <tr>
                <th style=" text-align:left; font-size: 11px;" >TỔNG SỐ TIỀN PHẢI THU:</th>
                <th style=" text-align:left; font-size: 11px;" >{{convert_price_float($dataInvoice['totalAUD'])}}</th>
            </tr>
            <tr>
                <th style=" text-align:left; font-size: 11px;" >TỔNG SỐ TIỀN PHẢI THU (VNĐ):</th>
                <th style=" text-align:left; font-size: 11px;" >{{$dataInvoice['totalVND']}}</th>
            </tr>
        </table>
        <br />
        <div id="more-imf">
            {{decode_html($dataInvoice['content'])}}
        </div>
    </page>
@stop
