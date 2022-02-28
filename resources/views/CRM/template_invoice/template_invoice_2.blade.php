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

    #th-header>th{
        text-align:left;
        background-color: rgb(234,235,237);
        text-transform: uppercase;
        font-size: 11px;
        padding: 5px;
    }

    .pr-25{
        padding-right: 25px !important;
    }

    #td-content>td,
    #table-2>tr:nth-child(3)>th:nth-child(4),
    #table-2>tr:nth-child(3)>td{
        text-align:left;
        font-size: 11px;
        padding: 5px 9px;
    }

    tfoot>tr>td>p,
    tfoot>tr>td>b,
    tfoot>td>td>p>span{
        text-align: left;
        font-size: 11px;
    }

    tfoot>tr>td:nth-child(1)>p,
    tfoot>tr>td:nth-child(1)>b{
        margin-bottom: 2px;
    }

    tfoot>tr>td:nth-child(2)>p{
        margin-bottom: 8px;
        font-weight: bolder;
    }

    tfoot>tr>td:nth-child(2)>p>span{
        font-weight: normal;
    }

    .pl-64{
        padding-left: 64px;
    }

    .pl-99{
        padding-left: 99px;
    }

    #mainContent{
        width: 806px;
        margin: auto !important;
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

    .sub-des{
        text-align: right !important;
        padding-right: 0;
        padding-top: 5px !important;
    }
    .sub-des i{
        font-size: 10px;
    }
</style>
@include('CRM.template_invoice.style')

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
                        <b style="">{{decode_html($dataInvoice['companyNameVi'])}}</b>
                            <br>
                        <p style="">{{decode_html($dataInvoice['companyAddressVi1'])}}</p>
                        <p style="">{{decode_html($dataInvoice['companyPhoneVi1'])}}</p>
                            <br>
                        <p style="padding-right: 60px;">{{decode_html($dataInvoice['companyAddressVi2'])}}</p>
                        <p style="">{{decode_html($dataInvoice['companyPhoneVi2'])}}</p>
                    </td>
                    <td style="">
                        <p style="margin-bottom: 18px">Bên nhận :
                            <span >{{decode_html($dataInvoice['agentName'])}}</span><br>
                            <span >{{decode_html($dataInvoice['address_agent'])}}</span>
                        </p>
                        <p style="">Số hóa đơn :
                            <span class="pl-64">{{ $dataInvoice['ref_no']}}</span>
                        </p>
                        <p style="">Ngày :
                            <span class="pl-99">{{ convert_date_form_db($dataInvoice['date'])}}</span>
                        </p>
                        <p style="">Nội dung chuyển khoản :
                            <span >{{ $dataInvoice['cusContent']}}</span>
                        </p>
                    </td>
                </tr>
                <tr style="border-top: 9px solid white;">
                    <td style="width: 40%;">
                        <p style="">Email : {{$dataInvoice['companyEmailVi1']}}</p>
                    </td>
                    <td style="width: 20%;text-align: left">
                        <span style="font-size: 11px;margin: 0;">Khách hàng : </span>
                        <b style="font-size: 14px; ">{{$dataInvoice['cusName']}}</b>
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
                <th style="width: 105px">dịch vụ</th>
                <th style="width: 105px">hãng bảo hiểm</th>
                <th style="width: 90px">chương trình</th>
                <th style="width: 100px">ngày bắt đầu</th>
                <th style="width: 100px">ngày kết thúc</th>
                <th style="width: 150px">số tiền</th>
            </tr>
            <tr id="td-content">
                <td style=" ">{{$dataInvoice['service']}}</td>
                <td style=" ">{{$dataInvoice['provider_name']}}</td>
                <td style=" ">{{$dataInvoice['policy']}}</td>
                <td style=" ">{{convert_date_form_db($dataInvoice['start_date'])}}</td>
                <td style=" ">{{convert_date_form_db($dataInvoice['end_date'])}}</td>
                <td style=" " class="text-right pr-25">{{convert_price_float($dataInvoice['amount'])}} {{$dataInvoice['currency']}}</td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2" class="align-right fontSize11px pl-15px">Phí gia hạn</th>
                <td class="fontSize11px pr-25 text-right"  style="">5 {{$dataInvoice['currency']}}</td>
            </tr>
            @if ($dataInvoice['promotion_amount'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="align-right fontSize11px pl-15px" >Khuyến mại</th>
                    <td class="fontSize11px pr-25 text-right"  style="">{{$dataInvoice['promotion_amount']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            @if ($dataInvoice['extra'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="align-right fontSize11px pl-15px" >Chiết khấu</th>
                    <td class="fontSize11px pr-25 text-right" style="">{{$dataInvoice['extra']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            @if ($dataInvoice['bank_fee'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="align-right fontSize11px pl-15px" style="padding-left: 15px">Phí chuyển tiền/phí dịch vụ</th>
                    <td class="fontSize11px pr-25 text-right"  style="">{{$dataInvoice['bank_fee']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            <tr >
                <td colspan="6" style="padding: 0 !important;"><hr style="border-style: solid; border-width: 1px; color: #5c5c5c; margin: 0;"></td>
            </tr>
            @if($dataInvoice['exchange_rate'] != 0 || !empty($dataInvoice['exchange_rate']))
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2" id="total-rate">Tổng số tiền phải thu</th>
                <td id="total-rate" class="text-right pr-25">{{$dataInvoice['amount_AUD']}}  {{$dataInvoice['currency']}}</td>
            </tr>
            @endif
            <tr style=" text-align:center;">
                <th></th>
                <th></th>
                <th></th>
                @if($dataInvoice['exchange_rate'] == 0 || empty($dataInvoice['exchange_rate']))
                    <th colspan="2" id="total-rate" >Tổng số tiền phải thu</th>
                    <th id="total-rate" class="text-right pr-25" style="width: 150px;text-align: center">{{$dataInvoice['amount_AUD']}}  {{$dataInvoice['currency']}}</th>
                @else
                    <th colspan="2"  id="total-rate" >TỔNG SỐ TIỀN PHẢI THU (VND)</th>
                    <th id="total-rate" class="text-right pr-25" style="width: 150px;text-align: center">{{convert_price_float($dataInvoice['amount_VND'], 0, 'VND')}}</th>
                @endif
            </tr>
            <tr>
                <td></td>
{{--                <td></td>--}}
{{--                <td></td>--}}
                <td colspan="5" class="sub-des">
                    <i >Áp dụng tỷ giá bán {{$dataInvoice['currency']}}/VND của ngân Vietcombank tại thời điểm thanh toán.</i><br>
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
