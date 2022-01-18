<html>
<head>
    <title>Luckydraw</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        /* reset */
        body, ul, li, p, h1, h2, h3, h4 {
            margin: 0;
            padding: 0;
        }

        /* slideshow */

        ul {
            width: 100%;
            height: 200px;

            margin: 0 auto;

            position: relative;

            list-style: none;

            -webkit-perspective: 700px;
            perspective: 700px;
        }

        li {
            position: absolute;

            transform-origin: 0 100%;
        }

        li.current {
            transition: all 0.4s ease-out;
            opacity: 1.0;
        }

        li.in {
            opacity: 0.0;
            transform: rotate3d(1, 0, 0, -90deg);
        }

        li.out {
            transition: all 0.4s ease-out;
            opacity: 0.0;
            transform: rotate3d(1, 0, 0, 90deg);
        }

        .pyro > .before,
        .pyro > .after {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            box-shadow: 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff;
            -moz-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
            -webkit-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
            -o-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
            -ms-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
            animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        }

        .pyro > .after {
            -moz-animation-delay: 1.25s, 1.25s, 1.25s;
            -webkit-animation-delay: 1.25s, 1.25s, 1.25s;
            -o-animation-delay: 1.25s, 1.25s, 1.25s;
            -ms-animation-delay: 1.25s, 1.25s, 1.25s;
            animation-delay: 1.25s, 1.25s, 1.25s;
            -moz-animation-duration: 1.25s, 1.25s, 6.25s;
            -webkit-animation-duration: 1.25s, 1.25s, 6.25s;
            -o-animation-duration: 1.25s, 1.25s, 6.25s;
            -ms-animation-duration: 1.25s, 1.25s, 6.25s;
            animation-duration: 1.25s, 1.25s, 6.25s;
        }

        @-webkit-keyframes bang {
            to {
                box-shadow: 0px -184.6666666667px #00fff7, 69px -334.6666666667px #ffa200, 71px -311.6666666667px #ff00a2, -1px -67.6666666667px #0088ff, -195px -302.6666666667px #ffd500, 4px -315.6666666667px #e1ff00, 186px 80.3333333333px #eeff00, -80px -324.6666666667px #00ff26, 98px 0.3333333333px #8800ff, -123px -23.6666666667px #d5ff00, 136px -253.6666666667px #4000ff, -82px -380.6666666667px #00ff15, -99px -209.6666666667px #00ff22, -231px -216.6666666667px #00ff5e, 204px -27.6666666667px #00fffb, -160px 62.3333333333px #5900ff, 214px -232.6666666667px #cc00ff, 117px -327.6666666667px #ffae00, -81px -95.6666666667px #00ff44, -202px -111.6666666667px #04ff00, 35px -113.6666666667px #1eff00, 4px -342.6666666667px #ff00f2, -30px -24.6666666667px #59ff00, -55px -186.6666666667px #4dff00, 114px 71.3333333333px #cc00ff, -6px -151.6666666667px #b7ff00, 243px 43.3333333333px #ccff00, -87px -359.6666666667px #00ffa6, 232px -199.6666666667px #0095ff, 113px -178.6666666667px #51ff00, 237px -71.6666666667px #ff0048, 25px -242.6666666667px deepskyblue, 197px -251.6666666667px #d0ff00, -192px -76.6666666667px #ff8000, -223px -349.6666666667px #0d00ff, -150px -395.6666666667px #8000ff, -192px -406.6666666667px #0062ff, -74px -272.6666666667px #ff00c8, 126px -409.6666666667px #ff001e, -171px 27.3333333333px #ff00d9, 57px -96.6666666667px #00ff1e, -234px -391.6666666667px #00ff66, -229px -34.6666666667px #00ffbf, 173px -31.6666666667px #00ffe1, 72px -279.6666666667px #ff9900, 99px -29.6666666667px #00ff44, -223px -340.6666666667px red, -160px -350.6666666667px #00ffb7, -186px -64.6666666667px #00ff8c, -1px -354.6666666667px #c400ff, -176px -340.6666666667px #3cff00;
            }
        }
        @-moz-keyframes bang {
            to {
                box-shadow: 0px -184.6666666667px #00fff7, 69px -334.6666666667px #ffa200, 71px -311.6666666667px #ff00a2, -1px -67.6666666667px #0088ff, -195px -302.6666666667px #ffd500, 4px -315.6666666667px #e1ff00, 186px 80.3333333333px #eeff00, -80px -324.6666666667px #00ff26, 98px 0.3333333333px #8800ff, -123px -23.6666666667px #d5ff00, 136px -253.6666666667px #4000ff, -82px -380.6666666667px #00ff15, -99px -209.6666666667px #00ff22, -231px -216.6666666667px #00ff5e, 204px -27.6666666667px #00fffb, -160px 62.3333333333px #5900ff, 214px -232.6666666667px #cc00ff, 117px -327.6666666667px #ffae00, -81px -95.6666666667px #00ff44, -202px -111.6666666667px #04ff00, 35px -113.6666666667px #1eff00, 4px -342.6666666667px #ff00f2, -30px -24.6666666667px #59ff00, -55px -186.6666666667px #4dff00, 114px 71.3333333333px #cc00ff, -6px -151.6666666667px #b7ff00, 243px 43.3333333333px #ccff00, -87px -359.6666666667px #00ffa6, 232px -199.6666666667px #0095ff, 113px -178.6666666667px #51ff00, 237px -71.6666666667px #ff0048, 25px -242.6666666667px deepskyblue, 197px -251.6666666667px #d0ff00, -192px -76.6666666667px #ff8000, -223px -349.6666666667px #0d00ff, -150px -395.6666666667px #8000ff, -192px -406.6666666667px #0062ff, -74px -272.6666666667px #ff00c8, 126px -409.6666666667px #ff001e, -171px 27.3333333333px #ff00d9, 57px -96.6666666667px #00ff1e, -234px -391.6666666667px #00ff66, -229px -34.6666666667px #00ffbf, 173px -31.6666666667px #00ffe1, 72px -279.6666666667px #ff9900, 99px -29.6666666667px #00ff44, -223px -340.6666666667px red, -160px -350.6666666667px #00ffb7, -186px -64.6666666667px #00ff8c, -1px -354.6666666667px #c400ff, -176px -340.6666666667px #3cff00;
            }
        }
        @-o-keyframes bang {
            to {
                box-shadow: 0px -184.6666666667px #00fff7, 69px -334.6666666667px #ffa200, 71px -311.6666666667px #ff00a2, -1px -67.6666666667px #0088ff, -195px -302.6666666667px #ffd500, 4px -315.6666666667px #e1ff00, 186px 80.3333333333px #eeff00, -80px -324.6666666667px #00ff26, 98px 0.3333333333px #8800ff, -123px -23.6666666667px #d5ff00, 136px -253.6666666667px #4000ff, -82px -380.6666666667px #00ff15, -99px -209.6666666667px #00ff22, -231px -216.6666666667px #00ff5e, 204px -27.6666666667px #00fffb, -160px 62.3333333333px #5900ff, 214px -232.6666666667px #cc00ff, 117px -327.6666666667px #ffae00, -81px -95.6666666667px #00ff44, -202px -111.6666666667px #04ff00, 35px -113.6666666667px #1eff00, 4px -342.6666666667px #ff00f2, -30px -24.6666666667px #59ff00, -55px -186.6666666667px #4dff00, 114px 71.3333333333px #cc00ff, -6px -151.6666666667px #b7ff00, 243px 43.3333333333px #ccff00, -87px -359.6666666667px #00ffa6, 232px -199.6666666667px #0095ff, 113px -178.6666666667px #51ff00, 237px -71.6666666667px #ff0048, 25px -242.6666666667px deepskyblue, 197px -251.6666666667px #d0ff00, -192px -76.6666666667px #ff8000, -223px -349.6666666667px #0d00ff, -150px -395.6666666667px #8000ff, -192px -406.6666666667px #0062ff, -74px -272.6666666667px #ff00c8, 126px -409.6666666667px #ff001e, -171px 27.3333333333px #ff00d9, 57px -96.6666666667px #00ff1e, -234px -391.6666666667px #00ff66, -229px -34.6666666667px #00ffbf, 173px -31.6666666667px #00ffe1, 72px -279.6666666667px #ff9900, 99px -29.6666666667px #00ff44, -223px -340.6666666667px red, -160px -350.6666666667px #00ffb7, -186px -64.6666666667px #00ff8c, -1px -354.6666666667px #c400ff, -176px -340.6666666667px #3cff00;
            }
        }
        @-ms-keyframes bang {
            to {
                box-shadow: 0px -184.6666666667px #00fff7, 69px -334.6666666667px #ffa200, 71px -311.6666666667px #ff00a2, -1px -67.6666666667px #0088ff, -195px -302.6666666667px #ffd500, 4px -315.6666666667px #e1ff00, 186px 80.3333333333px #eeff00, -80px -324.6666666667px #00ff26, 98px 0.3333333333px #8800ff, -123px -23.6666666667px #d5ff00, 136px -253.6666666667px #4000ff, -82px -380.6666666667px #00ff15, -99px -209.6666666667px #00ff22, -231px -216.6666666667px #00ff5e, 204px -27.6666666667px #00fffb, -160px 62.3333333333px #5900ff, 214px -232.6666666667px #cc00ff, 117px -327.6666666667px #ffae00, -81px -95.6666666667px #00ff44, -202px -111.6666666667px #04ff00, 35px -113.6666666667px #1eff00, 4px -342.6666666667px #ff00f2, -30px -24.6666666667px #59ff00, -55px -186.6666666667px #4dff00, 114px 71.3333333333px #cc00ff, -6px -151.6666666667px #b7ff00, 243px 43.3333333333px #ccff00, -87px -359.6666666667px #00ffa6, 232px -199.6666666667px #0095ff, 113px -178.6666666667px #51ff00, 237px -71.6666666667px #ff0048, 25px -242.6666666667px deepskyblue, 197px -251.6666666667px #d0ff00, -192px -76.6666666667px #ff8000, -223px -349.6666666667px #0d00ff, -150px -395.6666666667px #8000ff, -192px -406.6666666667px #0062ff, -74px -272.6666666667px #ff00c8, 126px -409.6666666667px #ff001e, -171px 27.3333333333px #ff00d9, 57px -96.6666666667px #00ff1e, -234px -391.6666666667px #00ff66, -229px -34.6666666667px #00ffbf, 173px -31.6666666667px #00ffe1, 72px -279.6666666667px #ff9900, 99px -29.6666666667px #00ff44, -223px -340.6666666667px red, -160px -350.6666666667px #00ffb7, -186px -64.6666666667px #00ff8c, -1px -354.6666666667px #c400ff, -176px -340.6666666667px #3cff00;
            }
        }
        @keyframes bang {
            to {
                box-shadow: 0px -184.6666666667px #00fff7, 69px -334.6666666667px #ffa200, 71px -311.6666666667px #ff00a2, -1px -67.6666666667px #0088ff, -195px -302.6666666667px #ffd500, 4px -315.6666666667px #e1ff00, 186px 80.3333333333px #eeff00, -80px -324.6666666667px #00ff26, 98px 0.3333333333px #8800ff, -123px -23.6666666667px #d5ff00, 136px -253.6666666667px #4000ff, -82px -380.6666666667px #00ff15, -99px -209.6666666667px #00ff22, -231px -216.6666666667px #00ff5e, 204px -27.6666666667px #00fffb, -160px 62.3333333333px #5900ff, 214px -232.6666666667px #cc00ff, 117px -327.6666666667px #ffae00, -81px -95.6666666667px #00ff44, -202px -111.6666666667px #04ff00, 35px -113.6666666667px #1eff00, 4px -342.6666666667px #ff00f2, -30px -24.6666666667px #59ff00, -55px -186.6666666667px #4dff00, 114px 71.3333333333px #cc00ff, -6px -151.6666666667px #b7ff00, 243px 43.3333333333px #ccff00, -87px -359.6666666667px #00ffa6, 232px -199.6666666667px #0095ff, 113px -178.6666666667px #51ff00, 237px -71.6666666667px #ff0048, 25px -242.6666666667px deepskyblue, 197px -251.6666666667px #d0ff00, -192px -76.6666666667px #ff8000, -223px -349.6666666667px #0d00ff, -150px -395.6666666667px #8000ff, -192px -406.6666666667px #0062ff, -74px -272.6666666667px #ff00c8, 126px -409.6666666667px #ff001e, -171px 27.3333333333px #ff00d9, 57px -96.6666666667px #00ff1e, -234px -391.6666666667px #00ff66, -229px -34.6666666667px #00ffbf, 173px -31.6666666667px #00ffe1, 72px -279.6666666667px #ff9900, 99px -29.6666666667px #00ff44, -223px -340.6666666667px red, -160px -350.6666666667px #00ffb7, -186px -64.6666666667px #00ff8c, -1px -354.6666666667px #c400ff, -176px -340.6666666667px #3cff00;
            }
        }
        @-webkit-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }
        @-moz-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }
        @-o-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }
        @-ms-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }
        @keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }
        @-webkit-keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
        @-moz-keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
        @-o-keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
        @-ms-keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
        @keyframes position {
            0%, 19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }
            20%, 39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }
            40%, 59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }
            60%, 79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }
            80%, 99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }
    </style>
</head>
<body>
    @php
        $lucky = \App\Admin\LuckyDraw::first();
        if(!empty($lucky)){
            $ketqua = $lucky->arr_bias_number;
        }else{
            $ketqua = [];
        }

    @endphp
{{--    <div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-12 d-flex align-items-center justify-content-center" style="height: 80px">--}}
{{--                <img class="h-100" src="/images/oshc-icon.png" alt="">--}}
{{--            </div>--}}
{{--            <div class="col-lg-12 mt-3 d-flex align-items-center justify-content-center">--}}
{{--                <p class="text-uppercase font-weight-bold h1" style="color:hotpink;">Lucky Draw</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div>
        <div class="container px-4 py-4 position-relative">
            <div class="border bg-white rounded mb-3">
                <div class="row mb-4">
                    <div class="col-md-7 d-flex flex-column justify-content-center align-items-center">
                        <div class="w-100">
                            <ul id='slideshow' class="d-flex justify-content-center mb-2" style="z-index: 1;">
                            </ul>
                        </div>
                        <div class="d-flex ">
                            <button id='again' style="z-index: 3;background-color: hotpink !important;border-color: hotpink!important;" class="btn btn-primary">Draw</button>
                            <a href="#" id="start" class="btn btn-primary ml-2" style="z-index: 3;display: none" >Start</a>
                        </div>

                    </div>
                    <div class="col-md-5 border-left pl-0">
                        <div>
                            <div style="background-color: hotpink" class="text-center py-2">
                                <h4 class="text-light text-capitalize font-weight-bold">congratulation</h4>
                            </div>
                            <ul class="list-group list-group-flush" id="listitem-con" style="overflow-y: scroll">

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card">
                <div class="card-header">
                    <p>LOTTERY CODES</p>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">List of Items <span class="text-danger">*</span></label>
                        <textarea name="listitem" id="listitem" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <a href="#" style="background-color: hotpink !important;border-color: hotpink!important;" class="btn btn-primary btn-add-config">Configure</a>

                </div>
            </div>
            <div class="pyro" style="display: none;
position: absolute;
top: 0px;
z-index: 4;
transform: translate(-50%,-50%);
left: 50%;">
                <div class="before"></div>
                <div class="after"></div>
            </div>
        </div>

    </div>


    <script>
        var currentIndex = 0
        var minimumCount = 20
        var maximumCount = 200
        var count = 0;
        var arrSpecial = {!! htmlspecialchars_decode($ketqua) !!};
        var arrSpecialRestart = arrSpecial;
        var round = 0;
        var slides;
        var is_draw;


        function checkInputValue(){
            var listitem = $('#listitem').val();
            if (listitem=='') {
                $('#again').attr('disabled', 'disabled');
            }
        }
        checkInputValue();
        function addInputConfig(){
            $('#listitem-con').html('');
            var html = ''
            var listitem = $('#listitem').val().split('\n');
            var listitemstr = $('#listitem').val();
            if (listitemstr != '') {
                for (var i = 0; i < listitem.length; i++) {
                    if(listitem[i] != ''){
                        if (i == 0) {
                            html += '<li><img class="w-100" data-id=\''+i+'\' src=\'https://via.placeholder.com/550x200/F8F8F8/&text=' + listitem[i] + '\' alt=\'' + listitem[i] + '\'></li>'
                        } else {
                            html += '<li><img class="w-100" data-id=\''+i+'\' src=\'https://via.placeholder.com/550x200/F8F8F8&text=' + listitem[i] + '\' alt=\'' + listitem[i] + '\'></li>'
                        }
                    }
                }
                $('#again').removeAttr('disabled')
            }else{
                //$('#again').attr('disabled', 'disabled');
            }

            $('#slideshow').html(html)
        }
        function nextSlide() {
            is_draw = true;
            if(is_draw == true){
                $('#again').text('Hold');
            }
            var slides = $('#slideshow').find('li');
            // move all to the right.
            slides.addClass('in');
            // move first one to current.
            $(slides[0]).removeClass().addClass('current');
            if(slides.length == 0){
                addInputConfig();
                $('#listitem-con').html('');
                return ;
            }
            // move all to the right.
            slides.addClass('in')

            // move first one to current.
            $(slides[0]).removeClass().addClass('current');

            currentIndex += 1
            if (currentIndex >= slides.length) {
                currentIndex = Math.floor(Math.random() * slides.length)
                //currentIndex = getRndBias(0,slides.length,3,1);
            }
            // move any previous 'out' slide to the right side.
            $('.out').removeClass().addClass('in')
            // move current to left.
            $('.current').removeClass().addClass('out')

            // move next one to current.
            $(slides[currentIndex]).removeClass().addClass('current')
            count += 1;
        }
        function cheat(){
            setTimeout(function (){
                if($('#slideshow li').find('[alt="'+arrSpecial[0]+'"]').length >0){
                    $('.out').removeClass().addClass('in')
                    $('.current').removeClass().addClass('out');
                    $('#slideshow li').find('[alt="'+arrSpecial[0]+'"]').parent().removeClass().addClass('current');
                }
                clearInterval(interval);
                $('#start').css('display','block');
                $('.pyro').css('display','block');
                is_draw = false;
                $('#again').text('Draw');
                $('#again').attr('disabled', 'disabled');
            },3000);
        }
        function startAction(){
            var slides = $('#slideshow').find('li');
            $('.pyro').css('display','none');
            if(slides.length == 0){
                addInputConfig();
            }
            $('#again').removeAttr('disabled');
            elementRate = $('#slideshow li.current').children().attr('alt');
            dataid= $('#slideshow li.current').children().attr('data-id');
            delete(slides.dataid);
            arrSpecial.splice(0, 1);
            html = '<li class="list-group-item text-center h4">'+elementRate+'</li>';
            $('#listitem-con').append(html);
            $('#slideshow li.current').remove();
        }



        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }
        function getRndBias(min, max, bias, influence) {
            var rnd = Math.random() * (max - min) + min,   // random in range
                mix = Math.random() * influence;           // random mixer
            return Math.floor(rnd * (1 - mix) + bias * mix);           // mix full range and bias
        }

        //var interval = setInterval(nextSlide, 120);

        $('#again').click(function (e) {
            e.preventDefault();
            if(is_draw == true){
                $('#again').attr('disabled', 'disabled');
                cheat();
            }else{
                count = 0;
                interval = setInterval(nextSlide, 120);
                slides = $('#slideshow').find('li');
            }

        });
        $('#start').click(function (e){
            e.preventDefault();
            startAction();
            $(this).css('display','none');
            console.log(is_draw);
        })
        $(document).on('click', '.btn-add-config', function (e) {
            e.preventDefault()
            addInputConfig();
            interval = setInterval(nextSlide, 120);
            $('#start').css('display','none');
        });
    </script>
</body>
</html>
