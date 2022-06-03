<div style="font-family:UTM Avo;font-size:16px;color:#4c4c4c">
    <div><img style="width: 290px;"
            src="https://oshcglobal.com.au/images/oshcglobalsicon.jpg"
            alt="OSHC GLOBAL" class="CToWUd a6T" tabindex="0">
        <div class="a6S" dir="ltr" style="opacity: 0.01; left: 1072px; top: 403px;">
            <div id=":18f" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0"
                 aria-label="Tải xuống tệp đính kèm " data-tooltip-class="a1V" data-tooltip="Tải xuống">
                <div class="aSK J-J5-Ji aYr"></div>
            </div>
        </div>
    </div>
    Hi! Admin
    <br>You have received an application from
        <a href="http://www.oshcglobal.com.au" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.oshcglobal.com.au&amp;source=gmail&amp;ust=1597824360091000&amp;usg=AFQjCNEv7I9Pw6Y_NtPUf5OYCP04qdzwQg">www.oshcglobal.com.au</a>.
    <br>
    <p></p>
    <h2 style="height:auto;color:#cc2127;text-align:center">Application information</h2>
    <p></p><br><br>
    <div style="margin:5px 0px"><h3
            style="clear:both;display:block;float:left;width:100%;padding:15px;box-sizing:border-box;margin:0px;margin-top:20px">
            POLICY SUMMARY</h3></div>
    <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">OSHC
            provider:</label><span
            style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['service']['name']))?$data_email['service']['name']:'No service'}}</span>
    </div>
    <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">Start
            date:</label><span
            style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['service']['start_date']))?$data_email['service']['start_date']:'No service'}}</span>
    </div>
    <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">End
            date:</label><span
            style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['service']['end_date']))?$data_email['service']['end_date']:'No service'}}</span>
    </div>
    <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">No
            of
            Adults:</label><span
            style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['service']['no_of_adults']))?$data_email['service']['no_of_adults']:'No service'}}</span>
    </div>
    <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">No
            of
            children:</label><span
            style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['service']['no_of_children']))?$data_email['service']['no_of_children']:0}}</span>
    </div>
    <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">Price
            (in AU dollars):</label><span
            style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['service']['amount']))?convert_price_float($data_email['service']['amount']):0}}</span>
    </div>
    @if($data_email['main'])
        <div style="margin:5px 0px"><h3
                style="clear:both;display:block;float:left;width:100%;padding:15px;box-sizing:border-box;margin:0px;margin-top:20px">
                Personal Details</h3></div>
        <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">Title:</label><span
                style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['main'][0]['prefix_name']))?$data_email['main'][0]['prefix_name']:'No service'}}</span>
        </div>
        <div style="margin:5px 0px"><label
                style="display:inline-block;width:180px;margin-right:10px;text-align:right">Name:</label><span
                style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px">{{(!empty($data_email['main'][0]['first_name']))?$data_email['main'][0]['first_name']:'No service'}}</span><span
                style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px">{{(!empty($data_email['main'][0]['last_name']))?$data_email['main'][0]['last_name']:'No service'}}</span>
        </div>
        <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">Gender:</label><span
                style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['main'][0]['gender']))?\Config::get('myconfig.gender')[$data_email['main'][0]['gender']]:'No service'}}</span>
        </div>
        <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">Date
                of birth:</label><span
                style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['main'][0]['birth_of_date']))?$data_email['main'][0]['birth_of_date']:'No service'}}</span>
        </div>
        <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">Passport
                number:</label><span
                style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['main'][0]['passport']))?$data_email['main'][0]['passport']:'No service'}}</span>
        </div>
        <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">Nationality:</label><span
                style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty(\Config::get('country.list')[$data_email['main'][0]['country']]))?\Config::get('country.list')[$data_email['main'][0]['country']]:''}}
</span></div>
        <div style="margin:5px 0px"><label style="display:inline-block;width:180px;margin-right:10px;text-align:right">My current or future location in Australia:</label><span
                style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty(\Config::get('location_australia')[$data_email['service']['location_australia']]))?\Config::get('location_australia')[$data_email['service']['location_australia']]:''}}
</span></div>
    @endif
    @if($data_email['adults'])
        <div style="margin:5px 0px"><h3
                style="clear:both;display:block;float:left;width:100%;padding:15px;box-sizing:border-box;margin:0px;margin-top:20px">
                Partner</h3></div>

        <table cellpadding="10" border="1" style="width:96%;margin:auto;border-color:#ddd;border-collapse:collapse">
            <tbody style="border:1px solid #777">
            <tr>
                <td colspan="6"><h3>Adults</h3></td>
            </tr>
            <tr>
                <td>
                    <b>Title</b>
                </td>
                <td>
                    <b>First Name</b>
                </td>
                <td>
                    <b>Last Name</b>
                </td>
                <td>
                    <b>Date of birth</b>
                </td>
                <td>
                    <b>Passport</b>
                </td>
                <td>
                    <b>Gender</b>
                </td>
            </tr>
            @foreach($data_email['adults'] as $adult)
                <tr>
                    <td>
                        {{(!empty($adult['prefix_name']))?$adult['prefix_name']:''}}
                    </td>
                    <td>
                        {{(!empty($adult['first_name']))?$adult['first_name']:''}}
                    </td>
                    <td>
                        {{(!empty($adult['last_name']))?$adult['last_name']:''}}
                    </td>
                    <td>
                        {{(!empty($adult['birth_of_date']))?$adult['birth_of_date']:''}}
                    </td>
                    <td>
                        {{(!empty($adult['passport']))?$adult['passport']:''}}
                    </td>
                    <td>
                        {{(!empty(\Config::get('myconfig.gender')[$adult['gender']]))?\Config::get('myconfig.gender')[$adult['gender']]:''}}
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
        <br>
        @if(!empty($data_email['child']))
            <div style="margin:5px 0px"><h3
                    style="clear:both;display:block;float:left;width:100%;padding:15px;box-sizing:border-box;margin:0px;margin-top:20px">
                    Children</h3></div>
            <table cellpadding="10" border="1" style="width:96%;margin:auto;border-color:#ddd;border-collapse:collapse">
                <tbody style="border:1px solid #777">
                <tr>
                    <td colspan="6"><h3>Children</h3></td>
                </tr>

                <tr>
                    <td>
                        <b>NO</b>
                    </td>
                    <td>
                        <b>Title</b>
                    </td>
                    <td>
                        <b>First Name</b>
                    </td>
                    <td>
                        <b>Last Name</b>
                    </td>
                    <td>
                        <b>Date of birth</b>
                    </td>
                    <td>
                        <b>Gender</b>
                    </td>
                </tr>
                @foreach($data_email['child'] as $child)
                    <tr>
                        <td>{{$loop->index +1}}</td>
                        <td>
                            {{(!empty($child['prefix_name']))?$child['prefix_name']:''}}
                        </td>

                        <td>
                            {{(!empty($child['first_name']))?$child['first_name']:''}}
                        </td>
                        <td>
                            {{(!empty($child['last_name']))?$child['last_name']:''}}
                        </td>
                        <td>
                            {{(!empty($child['birth_of_date']))?$child['birth_of_date']:''}}
                        </td>
                        <td>
                            {{(!empty(\Config::get('myconfig.gender')[$child['gender']]))?\Config::get('myconfig.gender')[$child['gender']]:''}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        @if(!empty($data_email['main']))
            <div style="margin:5px 0px"><h3
                    style="clear:both;display:block;float:left;width:100%;padding:15px;box-sizing:border-box;margin:0px;margin-top:20px">
                    Contact Details</h3></div>
            <div style="margin:5px 0px"><label
                    style="display:inline-block;width:180px;margin-right:10px;text-align:right">Mobile
                    Phone Number:</label><span
                    style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)">{{(!empty($data_email['main'][0]['phone']))?$data_email['main'][0]['phone']:'Null'}}</span>
            </div>
            <div style="margin:5px 0px"><label
                    style="display:inline-block;width:180px;margin-right:10px;text-align:right">Email:</label><span
                    style="display:inline-block;border:1px solid rgb(221,221,221);padding:5px;border-radius:5px;width:calc(100% - 220px)"><a
                        href="mailto:{{(!empty($data_email['main'][0]['email']))?$data_email['main'][0]['email']:'Null'}}"
                        target="_blank">{{(!empty($data_email['main'][0]['email']))?$data_email['main'][0]['email']:'Null'}}</a></span>
            </div>
            <br>
            <div>
                @endif

            </div>
</div>
