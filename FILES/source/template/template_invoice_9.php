<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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

    tfoot>tr>td:nth-child(1)>p,
    tfoot>tr>td:nth-child(1)>b{
        text-align: left;
        font-size: 11px;
        margin-bottom: 2px;
        color : #000;
    }

    tfoot>tr>td:nth-child(2){
        padding-right: 31px;
    }

    tfoot>tr>td:nth-child(2)>p{
        text-align: left;
        font-size: 11px;
        margin-bottom: 2px;
        font-weight: bolder;
    }

    tfoot>tr>td:nth-child(2)>p:nth-child(1){
        margin-bottom: 10px;
    }

    tfoot>tr>td:nth-child(2)>p>span{
        font-weight: normal;
        font-size: 12px;
    }

    #th-header>th{
        text-align:center;
        background-color: rgb(234,235,237);
        text-transform: uppercase;
        font-size: 11px;
        padding: 10px;
        color: #000;
    }

    #td-content>td{
        text-align:center;
        font-size: 10px;
        padding: 5px 9px;
        color: #000;
    }

    #total-rate{
        text-align:center;
        font-size: 13px;
        padding: 5px 0px;
        background-color: #D3D3D3;
        color: #000;
        font-weight: bolder;
    }

    #total-rate>p{
        margin: 0;
        font-size: 13px;
    }

    #total-rate>p:nth-child(2){
        font-weight: normal;
    }

    #more-imf>p>img{
        width: 100%;
        float: left;
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
    ;
    }

    tfoot:before {
        content: '';
        display: block;
        height: 53px;
    }

    .sub-des{
        text-align: right;
        padding-right: 0;
        padding-top: 5px !important;
        color: #000;
    }

    .sub-des>i{
        font-size: 10px;
    }
</style>

<page id="page" backcolor="#fff" backimgx="center" backimgy="bottom" backimgw="100%" backtop="42px" backleft="16px" backright="16px" backbottom="42px" footer="page" style="background: #fff;">
    <bookmark title="Lettre" level="0" ></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; border-collapse: collapse">
        <tbody style=" ">
        <tr>
            <td rowspan="4" style="width: 20%; padding-top: 45px;">
                <img style="width:185px;float: left" src="_logo" alt="Logo" id="img" border="none">
            </td>
            <td rowspan="4" style="width: 62%;vertical-align:bottom; text-align: right;padding-bottom: 10px;">
                <b style="text-align: center;color: black; font-size: 20px;">INVOICE</b>
            </td>
        </tr>
        </tbody>

        <tfoot>
        <tr style=" border-bottom: 9px solid white;">
            <td style="width: 40%; text-align: left">
                <b >_company_name</b>
                <p >_company_address</p>
                <p >_company_phone</p>
            </td>
            <td style="padding-right: 31px">
                <p >BILLING ADDRESS:
                    <span >_agentName</span><br>
                    <span >_agentAddress</span>
                </p>
                <p >Invoice No: _ref_no</p>
                <p >Date: _date</p>
                <p >Term: Immediate Payment</p>
            </td>
        </tr>
        <tr style="color: #000">
            <td style="width: 40%;">
            </td>
            <td style="width: 20%;text-align: left">
                <p style="font-size: 11px;margin: 0; ">REFERENCE</p>
                <b style="font-size: 14px; font-weight: bolder">_cusName</b>
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
            <th style="">SERVICE</th>
            <th >PROVIDER</th>
            <th >POLICY</th>
            <th >START DATE</th>
            <th >END DATE</th>
            <th >AMOUNT</th>
        </tr>
        <tr id="td-content">
            <td >_service</td>
            <td >
                <p style="font-size: 10px;margin-bottom: 5px;">_provider_name</p>
                <p style="font-size: 10px;">_cover</p>
            </td>
            <td >_policy</td>
            <td >_startdate</td>
            <td >_enddate</td>
            <td >_amount _currency</td>
            <td ></td>
        </tr>
        <tr >
            <td colspan="6" style="padding: 0 !important;"><hr style="border-style: solid; border-width: 1px; color: #5c5c5c; margin: 0;"></td>
        </tr>
        <tr style=" text-align:center;">
            <th></th>
            <th></th>
            <th></th>
            <th colspan="2" id="total-rate">
                <p >TOTAL AMOUNT PAYABLE</p>
                <p >(GST inclusive)</p>
            </th>
            <th id="total-rate" >_amount _currency</th>
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
        _content
    </div>

</page>

</body>
</html>
