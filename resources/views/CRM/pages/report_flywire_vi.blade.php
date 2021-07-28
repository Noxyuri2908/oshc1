@extends('CRM.layouts.default')

@section('title')
    REPORT FLYWIRE
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.pages.css.customer-css')

@stop
@section('content')

    @include('CRM.elements.report.filter')
    <div class="table-export-excel" style="min-width: 200rem;" id="tableData">
        <img style="display: block" id='scream' width=340 height=113
             src="{{asset('images/oshc-icon.png')}}"
             v:shapes="Picture_x0020_1">
        <div>
            <br>
            <b style="font-size: 12.0pt;">FLYWIRE QUARTERLY REPORT</b>
            <br>
            <b style="background-color: #ccc; font-size: 12.0pt;">Agent partner: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$agentName}}</b>
        </div>
        <br>
        <br>
        <table align="left" cellspacing="0" border="0" >
            <tr style='mso-height-source:userset;height:27.9pt'>
                <td colspan=2 height=20  bgcolor="#EF4B88" style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Date of invoice</span></b></td>
                <td colspan=2 height=42  bgcolor="#EF4B88" style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Date of transaction</span></b></td>
                <td colspan=2 height=42  bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Name</span></b></td>
                <td colspan=2 height=42  bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Payment ID</span></b></td>
                <td colspan=2 height=42  bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white"> Amount </span></b></td>
                <td colspan=2 height=42  bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Currency</span></b></td>
                <td colspan=2 height=42   bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Commission rate<br> (%)</span></b></td>
                <td colspan=2 height=42   bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span   face="Times New Roman" size=3 color="white">Commission <br>$</span></b></td>
                <td colspan=2 height=42   bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Currency</span></b></td>
                <td colspan=2 height=42   bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Exchange</span></b></td>
                <td colspan=2 height=42  bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Commission <br>VND</span></b></td>
                <td colspan=2 height=42 bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Promotion to <br>AUD</span></b></td>
                <td colspan=2 height=42 bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Promotion to <br>VND</span></b></td>
                {{getQuarterDataReport($flywire)}}
                <td colspan=2 height=42  bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Payment status</span></b></td>
                <td colspan=2 height=42  bgcolor="#EF4B88"
                    style='height:54.4pt;
                        padding: 0px;
                        mso-ignore: padding;
                        color: white;
                        font-size: 12.0pt;
                        font-weight: 700;
                        font-style: normal;
                        text-decoration: none;
                        font-family: "Times New Roman";
                        mso-generic-font-family: auto;
                        mso-font-charset: 1;
                        mso-number-format: General;
                        text-align: center;
                        vertical-align: middle;
                        border-top: .5pt solid windowtext;
                        border-right: none;
                        border-bottom: .5pt solid windowtext;
                        border-left: .5pt solid windowtext;
                        background: hotpink;
                        mso-pattern: black none;
                        white-space: normal;'><b><span face="Times New Roman" size=3 color="white">Note</span></b></td>
            </tr>
            </tr>



            {{--data--}}
            @foreach($flywire as $items)
                @php
                    $comstatus = '';
                    $getQuarterId = Carbon::parse($items->delivered_date)->quarter;
                    $getYearQuarter = Carbon::parse($items->delivered_date)->format('Y'); // get year quarter
                    $initiated_date = convert_date_form_db($items->initiated_date);
                    $delivered_date = convert_date_form_db($items->delivered_date);
                    $amount_to = convert_price_float($items->amount_to);
                    $amount_to_unit = getCurrency($items->amount_to_unit);
                    $commission = $items->amount_to * ($items->comm /100); // commission $
                    $exchange_to_AUD = ExchangeToAUDForFlywire($items);
                    $exchange_to_VND = ExchangeToVNDForFlywire(Carbon::parse($items->delivered_date)->quarter, $getYearQuarter);
                    $exchange = $exchange_to_AUD * $exchange_to_VND;
                    $commission_vnd = $commission * $exchange;
                    $comstatus = array_get(\Config::get('myconfig.com_status'), (!empty((int)$items->com_status_cp)) ? (int)$items->com_status_cp : 1);
                    $promotion_vnd = $items->amount * $exchange_to_VND;
                    $totalQuarter = $commission_vnd + $promotion_vnd;
                    $countQuarter = getQuarter($flywire, 'dataQuarter');
                @endphp
                <tr>
                    <td colspan=2 align=center class="width-4 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$initiated_date}}</td> {{--date of invoice--}}
                    <td colspan=2 align=center class="width-5 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$delivered_date}}</td>  {{--date of transaction--}}
                    <td colspan=2 align=center class="width-7 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$items->full_name}}</td>  {{--name--}}
                    <td colspan=2 align=center class="width-5 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$items->ref_no}}</td>  {{--payment id--}}
                    <td colspan=2 align=center class="width-4 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$amount_to}}</span></td>    {{--amount--}}
                    <td colspan=2 align=center class="width-3 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$amount_to_unit}}</span></td>   {{--Currency--}}
                    <td colspan=2 align=center class="width-6 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$items->comm}}</span></td>  {{--commission rate--}}
                    <td colspan=2 align=center class="width-5 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{convert_price_float($commission)}}</span></td> {{--commission %--}}
                    <td colspan=2 align=center class="width-3 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$amount_to_unit}}</span></td>   {{--currency--}}
                    <td colspan=2 align=center class="width-5 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{convert_price_float($exchange, 0, 'VND')}}</span></td>    {{--exchange--}}
                    <td colspan=2 align=center class="width-6 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{convert_price_float($commission_vnd,0, 'VND')}}</span></td> {{--commission to vnd--}}
                    <td colspan=2 align=center class="width-5 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$items->amount}}</span></td>  {{--promotion to aud--}}
                    <td colspan=2 align=center class="width-5 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{convert_price_float($promotion_vnd, 0, 'VND')}}</span></td>  {{--promotion to vnd--}}
                    {{showDataReportForHTMLReport($countQuarter, $getQuarterId, $totalQuarter)}}
                    <td colspan=2 align=center class="width-5 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$comstatus}}</td> {{--payment status--}}
                    <td colspan=2 align=center class="width-15 td_table_export_excel" style='font-family: "Times New Roman"'><span face="Times New Roman" style="font-size: 12.0pt;">{{$items->note}}</td> {{--note--}}
                </tr>
            @endforeach
                <tr>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=6 class="width-5 td_table_export_excel" bgcolor="green" style=""><b style="font-size: 14pt">Total</b></td>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=2 class="width-5 td_table_export_excel" id="joinTotal"></td>

                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                    <td colspan=2 class="width-5 td_table_export_excel"></td>
                </tr>
        </table>
    </div>
@stop
@push('scripts')
    <script>

        $('#btn').on('click', function ()
        {
            $("#tableData").excelexportjs({
                containerid: "tableData",
                datatype: 'table',
                encoding:"utf-8",
                locale:'en-US'
            });
        })

        $(document).ready(function ()
        {
            function format2(n, currency) {
                var money = n.toLocaleString('it-IT', {style : 'currency', currency : currency});
                money = money.split(".");
                return money.join(',');
            }

            function totalQuarter()
            {
                var total = [];
                var td1 = $('td[data-total-quarter-1]');
                var length1 = td1.length;
                if (length1 != 0)
                {
                    var totalQuarter1 = 0;
                    var index1 = '';
                    for (var i = 0; i < length1; i++)
                    {
                        totalQuarter1 += Number(td1[i].getAttribute('data-total-quarter-1'));
                        index1 = td1[i].getAttribute('index');
                    }
                    total[index1] = `<td colspan=2 class="width-5 td_table_export_excel" align="center"><b align="center" style="font-size: 14pt;text-align: center;vertical-align: center">${format2(totalQuarter1, "VND")}</b></td>`;

                } // quarter 1

                var td2 = $('td[data-total-quarter-2]');
                var length2 = td2.length;
                if (length2 != 0 )
                {
                    var totalQuarter2 = 0;
                    var index2 = '';
                    for (var i = 0; i < length2; i++)
                    {
                        totalQuarter2 += Number(td2[i].getAttribute('data-total-quarter-2'));
                        index2 = td2[i].getAttribute('index');
                    }
                    total[index2] = `<td colspan=2 class="width-5 td_table_export_excel"><b align="center" style="font-size: 14pt;text-align: center;vertical-align: center">${format2(totalQuarter2, "VND")}</b></td>`;

                } // quarter 2


                var td3 = $('td[data-total-quarter-3]');
                var length3 = td3.length;
                if (length3 != 0 )
                {
                    var totalQuarter3 = 0;
                    var index3 = '';
                    for (var i = 0; i < length3; i++)
                    {
                        totalQuarter3 += Number(td3[i].getAttribute('data-total-quarter-3'));
                        index3 = td3[i].getAttribute('index');
                    }
                    total[index3] = `<td colspan=2 class="width-5 td_table_export_excel"><b align="center" style="font-size: 14pt;text-align: center;vertical-align: center">${format2(totalQuarter3, "VND")}</b></td>`;

                } // quarter 3

                var td4 = $('td[data-total-quarter-4]');
                var length4 = td4.length;
                if (length4 != 0 )
                {
                    var totalQuarter4 = 0;
                    var index4 = '';
                    for (var i = 0; i < length4; i++)
                    {
                        totalQuarter4 += Number(td4[i].getAttribute('data-total-quarter-4'));
                        index4 = td4[i].getAttribute('index');
                    }
                    total[index4] = `<td colspan=2 class="width-5 td_table_export_excel"><b align="center" style="font-size: 14pt;text-align: center;vertical-align: center">${format2(totalQuarter4, "VND")}</b></td>`;

                } // quarter 4
                $(total.join(" ")).insertAfter('#joinTotal');
            }

            totalQuarter();


            $('#inputGroupSelect01').select2({
                dropdownParent: $('#inputParentGroupSelect01'),
                ajax: {
                    url: '{{route('agent.getAgentSelect')}}',
                    type: 'GET',
                    quietMillis: 10000,
                    dataType: 'json',
                    data: function (term) {
                        var query = {
                            name: term.term,
                        }
                        return query
                    },
                    processResults: function (data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'

                        var results = []
                        data.forEach(e => {
                            results.push({
                                id: e.id,
                                text: e.name,
                            })
                        })
                        return {
                            results: results,
                        }
                    },
                },
            })
            $('#inputGroupSelect01').append('').trigger('change')
        })


    </script>
@endpush

