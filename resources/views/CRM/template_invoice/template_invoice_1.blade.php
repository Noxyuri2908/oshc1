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
    p{margin: 1px 0px; color: #222; font-size: 15px}

    #th-header th,
    tbody tr td{
        text-align: center !important;
    }

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
        padding: 0px 78px;
        height: 1000px;
        color: black;
    }

    tfoot:before {
        content: '';
        display: block;
        height: 53px;
    }
    #more-imf{width: 100%;}
    #more-imf>p>img{
        width: 100%;
        float: left;
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
                <td rowspan="4" style="width: 62%;vertical-align:bottom;padding-bottom: 10px;font-size: 19px;text-align: center">
                    <b style="text-align: center;color: black; font-size: 21px;">PHIẾU ĐỀ NGHỊ THANH TOÁN</b>
                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr style=" border-bottom: 9px solid white;">
                <td style="width: 40%; text-align: left">
                    <b style="text-align: left; font-size: 11px;margin-bottom: 2px; color: black">{{$dataInvoice['companyNameVi']}}</b>
                    <br>
                    <p style="text-align: left; font-size: 9.5px;margin-bottom: 2px;margin-top: 8px;padding-right: 60px;">{{$dataInvoice['companyAddressVi1']}}</p>
                    <p style="text-align: left; font-size: 11px;margin-bottom: 2px">{{$dataInvoice['companyPhoneVi1']}}</p>
                    <br>
                    <p style="text-align: left; font-size: 9.5px;margin-bottom: 2px;padding-right: 60px;">{{$dataInvoice['companyAddressVi2']}}</p>
                    <p style="text-align: left; font-size: 11px;margin-bottom: 2px">{{$dataInvoice['companyPhoneVi2']}}</p>
                </td>
                <td style="">
                    <p style="text-align: left; font-size: 11px; margin-bottom: 18px; font-weight: bold">Bên nhận :
                        <span style="text-align: left; font-size: 11px; margin-bottom: 2px;font-weight: normal;">{{ $dataInvoice['agentName']}}</span><br>
                        <span style="text-align: left; font-size: 11px; margin-bottom: 2px;font-weight: normal;">{{ $dataInvoice['address_agent']}}</span>
                    </p>
                    <p style="text-align: left; font-size: 11px; margin-bottom: 8px; font-weight: bold">Số hóa đơn : <span style="text-align: left; font-size: 11px; margin-bottom: 2px;font-weight: normal; padding-left: 54px;">{{ $dataInvoice['ref_no']}}</span></p>
                    <p style="text-align: left; font-size: 11px; margin-bottom: 8px; font-weight: bold">Ngày : <span style="text-align: left; font-size: 11px; margin-bottom: 2px;font-weight: normal; padding-left: 87px;">{{ convert_date_form_db($dataInvoice['date'])}}</span></p>
                    <p style="text-align: left; font-size: 10px; margin-bottom: 5px; font-weight: bold">Nội dung chuyển khoản : <span style="text-align: left; font-size: 11px; margin-bottom: 2px;font-weight: normal;">{{ $dataInvoice['cusContent']}}</span></p>
                </td>
            </tr>
            <tr style="border-top: 9px solid white;">
                <td style="width: 40%;">
                    <p style="text-align: left; font-size: 11px;margin-bottom: 2px">Email: {{$dataInvoice['companyEmailVi1']}}</p>
                </td>
                <td style="width: 20%;text-align: left">
                    <span style="color: black; font-size: 11px;margin: 0; ">Khách hàng : </span>
                    <b style="color: black;font-size: 14px; ">{{$dataInvoice['cusName']}}</b>
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

            <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 11px;padding: 10px">dịch vụ</th>
            <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 10px;padding: 10px">hãng bảo hiểm</th>
            <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 10px;padding: 10px">chương trình</th>
            <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 10px;padding: 10px">ngày bắt đầu</th>
            <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 11px;padding: 10px;width: 134px">ngày kết thúc</th>
            <th style="text-align:left; background-color: rgb(234,235,237); text-transform: uppercase; font-size: 11px;padding: 10px;width: 87px;">số tiền</th>
        </tr>
        <tr>
            <td style=" text-align:left; font-size: 11px; padding: 5px 9px">{{$dataInvoice['service']}}</td>
            <td style=" text-align:left; font-size: 11px; padding: 5px 9px">{{$dataInvoice['provider_name']}}</td>
            <td style=" text-align:left; font-size: 11px; padding: 5px 9px">{{$dataInvoice['policy']}}</td>
            <td style=" text-align:left; font-size: 11px; padding: 5px 9px">{{convert_date_form_db($dataInvoice['start_date'])}}</td>
            <td style=" text-align:left; font-size: 11px; padding: 5px 9px">{{convert_date_form_db($dataInvoice['end_date'])}}</td>
            <td style=" text-align:left; font-size: 11px; padding: 5px 9px">{{convert_price_float($dataInvoice['amount'])}} {{$dataInvoice['currency']}}</td>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="2" style="padding: 5px 9px; font-size: 11px;">Phí chuyển tiền/phí dịch vụ</th>
            <td style="padding: 5px 9px; font-size: 11px;">{{$dataInvoice['bank_fee']}} {{$dataInvoice['currency']}}</td>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            @if($dataInvoice['exchange_rate'] != 0 || !empty($dataInvoice['exchange_rate']))
                <th colspan="2" style="padding: 5px 15px; font-size: 13px;">Tổng số tiền phải thu</th>
                <td style="padding: 5px 9px; font-size: 13px;">{{$dataInvoice['amount_AUD']}}  {{$dataInvoice['currency']}}</td>
            @endif
        </tr>
        <tr >
            <td colspan="6" style="padding-left: 0 !important;padding-right: 0 !important;"><hr style="border-style: solid;border-width: 1px;color: #5c5c5c;margin: 0;"></td>
        </tr>
        <tr style=" text-align:center;">
            <th></th>
            <th></th>
            <th></th>
            @if($dataInvoice['exchange_rate'] == 0 || empty($dataInvoice['exchange_rate']))
                <th colspan="2" style="color: #000; text-align:left; font-size: 11px; padding: 5px 15px; font-size: 12px;	background-color: 	#D3D3D3;" >Tổng số tiền phải thu</th>
                <th style=" color: #000;text-align: left; padding: 5px 9px; font-size: 13px;background-color: 	#D3D3D3;">{{$dataInvoice['amount_AUD']}}  {{$dataInvoice['currency']}}</th>
            @else
                <th colspan="2"  style="color: #000; text-align:left; font-size: 11px; padding: 5px 15px; font-size: 12px;background-color: 	#D3D3D3;" >TỔNG SỐ TIỀN PHẢI THU (VND)</th>
                <th style=" color: #000;text-align: left; padding: 5px 9px; font-size: 13px;background-color: 	#D3D3D3;">{{convert_price_float($dataInvoice['amount_VND'], 0, 'VND')}}</th>
            @endif
        </tr>
    </table>
    <br />
    <div id="more-imf">
        {{decode_html($dataInvoice['content'])}}
    </div>

</page>
    @include('CRM.template_invoice.script_export_to_pdf')
@stop
