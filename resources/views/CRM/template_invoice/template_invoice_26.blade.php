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
                    <img style="width:230px;float: right" src="{{($dataInvoice['logo'])? $dataInvoice['logo'] : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3'}}" alt="Logo" id="img" border="none">
                </td>
            </tr>
            <tr>
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 12px;margin-bottom: 2px">{{$dataInvoice['companyAddressVi1']}}</p>
                </td>
                <td style="width: 20%;">
                    <p style="text-align: left; font-size: 12px;margin-bottom: 2px">| {{$dataInvoice['companyPhoneVi1']}}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 12px;margin-bottom: 2px">{{$dataInvoice['companyAddressVi2']}}</p>
                </td>
                <td style="width: 20%;">
                    <p style="text-align: left; font-size: 12px;margin-bottom: 2px">| {{$dataInvoice['companyPhoneVi2']}}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 12px;margin-bottom: 2px">Email: {{$dataInvoice['companyEmailVi1']}}</p>
                </td>
                <td style="width: 20%;">
                </td>
            </tr>
        </table>
        <br>
        <div class="header" style="display: flex;justify-content: center;align-items: center">
            <p style="text-align: center;padding: 10px; color: #4682b4; font-size: 15px; flex: 1">PHIẾU ĐỀ NGHỊ CHUYỂN TIỀN</p>
            <div class="content-right" style="flex: 1">
                <p style="text-align: right; font-size: 12px; margin-bottom: 2px">Ngày: {{ convert_date_form_db($dataInvoice['created_at'])}}</p>
                <p style="text-align: right; font-size: 12px; margin-bottom: 2px">Số hóa đơn: {{ $dataInvoice['ref_no']}}</p>
                <p style="text-align: right; font-size: 12px; margin-bottom: 2px">Đại lý: {{ $dataInvoice['agentName']}}</p>
            </div>
        </div>

        <hr style="border-style: solid; border-width: 1px; color: #4682b4;margin-top: 1px;margin-bottom: 1px">
        <table id="table-2" cellspacing="0" style="width: 100%;">

            <tr id="th-header">
                <th style="text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">KHÁCH HÀNG</th>
                <th style="text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">DỊCH VỤ</th>
                <th style="text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">LOẠI DỊCH VỤ</th>
                <th style="text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">NGÀY BẮT ĐẦU</th>
                <th style="text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">NGÀY KẾT THÚC</th>
                <th style="text-align:left; background-color: #87cefa; text-transform: uppercase; font-size: 12px;">GIÁ DỊCH VỤ</th>
            </tr>
            <tr>
                <td style=" text-align:left; font-size: 12px; padding: 5px 15px">{{$dataInvoice['cusName']}}</td>
                <td style=" text-align:left; font-size: 12px; padding: 5px 15px">{{$dataInvoice['provider_name']}}</td>
                <td style=" text-align:left; font-size: 12px; padding: 5px 15px">{{$dataInvoice['policy']}}</td>
                <td style=" text-align:left; font-size: 12px; padding: 5px 15px">{{convert_date_form_db($dataInvoice['start_date'])}}</td>
                <td style=" text-align:left; font-size: 12px; padding: 5px 15px">{{convert_date_form_db($dataInvoice['end_date'])}}</td>
                <td style=" text-align:left; font-size: 12px; padding: 5px 15px">{{convert_price_float($dataInvoice['serviceCharge'], 0, 'VND')}}</td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="padding: 5px 15px; font-size: 12px;">Phí chuyển tiền/phí dịch vụ</th>
                <td style="padding: 5px 15px; font-size: 12px;">{{$dataInvoice['bank_fee']}}</td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="padding: 5px 15px; font-size: 12px;">Tổng số tiền phải thu</th>
                <td style="padding: 5px 15px; font-size: 12px;">{{$dataInvoice['totalAmountReceivable']}}  {{$dataInvoice['currency']}}</td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="padding: 5px 15px; font-size: 12px;">Tỷ giá</th>
                <td style="padding: 5px 15px; font-size: 12px;">{{$dataInvoice['sum_exchange_rate_receipt']}}</td>
            </tr>
            <tr>
                <td colspan="6"><hr style="border-style: dashed; border-width: 1px; color: #4682b4; margin: 0"></td>
            </tr>
            <tr style=" text-align:center;">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style=" text-align:left; font-size: 12px; padding: 5px 15px; font-size: 12px;" >TỔNG SỐ TIỀN THANH TOÁN</th>
                <th style="text-align: left; padding: 5px 15px; font-size: 12px;">{{convert_price_float($dataInvoice['sum_amount_receipt'], 0, 'VND')}} VND</th>
            </tr>
        </table>
        <br />
        <div id="more-imf">
            {{decode_html($dataInvoice['content'])}}
        </div>
    </page>
@stop
