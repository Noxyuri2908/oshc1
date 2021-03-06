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

    .pr-25{
        padding-right: 25px !important;
    }
    #th-header>th{
        text-align:left;
        background-color: rgb(234,235,237);
        text-transform: uppercase;
        font-size: 11px;
        padding: 5px;
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
                    <b style="text-align: center;color: black; font-size: 21px;">PHI???U ????? NGH??? THANH TO??N</b>
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
                    <p style="margin-bottom: 18px">B??n nh???n :
                        <span >{{decode_html($dataInvoice['agentName'])}}</span><br>
                        <span >{{decode_html($dataInvoice['address_agent'])}}</span>
                    </p>
                    <p style="">S??? h??a ????n :
                        <span class="pl-64">{{ $dataInvoice['ref_no']}}</span>
                    </p>
                    <p style="">Ng??y :
                        <span class="pl-99">{{ convert_date_form_db($dataInvoice['date'])}}</span>
                    </p>
                    <p style="">N???i dung chuy???n kho???n :
                        <span >{{ $dataInvoice['cusContent']}}</span>
                    </p>
                </td>
            </tr>
            <tr style="border-top: 9px solid white;">
                <td style="width: 40%;">
                    <p style="">Email : {{$dataInvoice['companyEmailVi1']}}</p>
                </td>
                <td style="width: 20%;text-align: left">
                    <span style="font-size: 11px;margin: 0;">Kh??ch h??ng : </span>
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

        <table id="table-2" cellspacing="0" style="width: 100%; table-layout: fixed">

            <tr id="th-header">
                <th style="width: 105px">d???ch v???</th>
                <th style="width: 105px">h??ng b???o hi???m</th>
                <th style="width: 90px">ch????ng tr??nh</th>
                <th style="width: 100px">ng??y b???t ?????u</th>
                <th style="width: 100px">ng??y k???t th??c</th>
                <th style="width: 150px">s??? ti???n</th>
            </tr>
            <tr id="td-content">
                <td style="">{{$dataInvoice['service']}}</td>
                <td style="">{{$dataInvoice['provider_name']}}</td>
                <td style="">{{$dataInvoice['policy']}}</td>
                <td style="">{{convert_date_form_db($dataInvoice['start_date'])}}</td>
                <td style="">{{convert_date_form_db($dataInvoice['end_date'])}}</td>
                <td style="" class="text-right pr-25">{{convert_price_float($dataInvoice['amount'])}} {{$dataInvoice['currency']}}</td>
            </tr>
            @if ($dataInvoice['extend_fee'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="align-right fontSize11px pl-15px">Ph?? gia h???n</th>
                    <td class="fontSize11px text-right pr-25"  style="">{{$dataInvoice['extend_fee']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            @if ($dataInvoice['promotion_amount'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="align-right fontSize11px pl-15px" >Khuy???n m??i</th>
                    <td class="fontSize11px text-right pr-25"  style="">{{$dataInvoice['promotion_amount']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            @if ($dataInvoice['extra'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="align-right fontSize11px pl-15px" >Chi???t kh???u</th>
                    <td class="fontSize11px text-right pr-25" style="">{{$dataInvoice['extra']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            @if ($dataInvoice['bank_fee'])
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="align-right fontSize11px pl-15px" style="padding-left: 15px">Ph?? chuy???n ti???n/ph?? d???ch v???</th>
                    <td class="fontSize11px text-right pr-25"  style="">{{$dataInvoice['bank_fee']}} {{$dataInvoice['currency']}}</td>
                </tr>
            @endif
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2" class="align-right fontSize11px pl-15px">Hoa h???ng d???ch v???</th>
                <td class="text-right pr-25">{{$dataInvoice['comm']}} {{$dataInvoice['currency']}}</td>
            </tr>
            <tr >
                <td colspan="6" style="padding: 0 !important;"><hr style="border-style: solid; border-width: 1px; color: #5c5c5c; margin: 0;"></td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2" class="align-right" id="total-rate">T???ng s??? ti???n ph???i thu</th>
                <th id="total-rate" class="text-right pr-25" style="width: 150px">{{$dataInvoice['amount_AUD']}}  {{$dataInvoice['currency']}}</th>
            </tr>
            @if($dataInvoice['exchange_rate'] != 0 || !empty($dataInvoice['exchange_rate']))
                <tr style=" text-align:center;">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th colspan="2" class="align-right" id="total-rate">T???NG S??? TI???N PH???I THU (VND)</th>
                    <th id="total-rate" class="text-right pr-25" style="width: 150px;">{{convert_price_float($dataInvoice['amount_VND'], 0, 'VND')}}</th>
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                {{--                <td></td>--}}
                <td colspan="5" class="sub-des text-right">
                    <i >??p d???ng t??? gi?? b??n {{$dataInvoice['currency']}}/VND c???a ng??n Vietcombank t???i th???i ??i???m thanh to??n.</i><br>
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
