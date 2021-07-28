<div style="font-family:UTM Avo;font-size:16px;color:#4c4c4c">
    <div><img
        style="width: 290px;"
        src="{{asset('images/oshcglobalsicon.jpg')}}"
            alt="OSHC GLOBALS" class="CToWUd a6T" tabindex="0">
        <div class="a6S" dir="ltr" style="opacity: 0.01; left: 390px; top: 238px;">
            <div id=":1i8" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0"
                 aria-label="Tải xuống tệp đính kèm " data-tooltip-class="a1V" data-tooltip="Tải xuống">
                <div class="aSK J-J5-Ji aYr"></div>
            </div>
        </div>
    </div>
    <br>
    <p align="justify" style="margin:0 10% 0 5%"><b>Dear {{(!empty($data_email_payment_customer['name']))?$data_email_payment_customer['name']:''}}, </b></p><br>
    <div><p align="justify" style="margin:0 10% 0 5%">Thank you for submitting your application for your Overseas
            Student Health Cover ({{(!empty($data_email_payment_customer['service']))?$data_email_payment_customer['service']:''}}) policy and choosing {{(!empty($data_email_payment_customer['type_payment']))?$data_email_payment_customer['type_payment']:''}}.</p><br>
        <p align="justify" style="margin:0 10% 0 5%">We will issue the certificate as requested once receiving your
            payment.</p><br>
        <p align="left" style="margin:0 10% 0 5%">Pls feel free to contact our team should you have any queries.</p><br>
        <p align="justify" style="margin:0 10% 0 5%">Kind regards, <br>OSHCGLOBAL TEAM</p><br></div>
    <div>
    </div>
</div>
