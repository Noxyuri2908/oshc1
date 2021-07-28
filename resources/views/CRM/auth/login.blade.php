<!DOCTYPE html>
<html lang="en-US" dir="ltr">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CMS OSHC</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('backend_CRM/pages/assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('backend_CRM/pages/assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('backend_CRM/pages/assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend_CRM/pages/assets/img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{asset('backend_CRM/pages/assets/img/favicons/manifest.json')}}">

    <meta name="theme-color" content="#ffffff">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="{{asset('backend_CRM/pages/assets/css/theme.css')}}" rel="stylesheet">
    <link href="{{asset('backend_CRM/pages/assets/lib/datatables-bs4/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend_CRM/pages/assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{asset('backend_CRM/pages/assets/lib/select2/select2.min.css')}}" rel="stylesheet">
</head>

<body>
    <main class="main" id="top">
        <div class="container">
            <div class="row flex-center minh-100vh py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <a class="d-block text-center mb-4" href="#">
                        <div class="d-inline-flex flex-center">
                            <span class="text-sans-serif font-weight-extra-bold fs-5 d-inline-block">AnnaLink CRM</span>
                        </div>
                    </a>
                <div class="card">
                    <div class="card-body p-5">
                        <div class="row text-left justify-content-between">
                            <div class="col-auto">
                                <h5> Log in</h5>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('crm.login.post') }}">
                        @csrf
                            <div class="form-group">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Enter username" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter password" autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="customCheckRemember" type="checkbox" />
                                        <label class="custom-control-label" for="customCheckRemember">Remember me</label>
                                    </div>
                                </div>
                                <!-- <div class="col-auto"><a class="fs--1" href="../authentication/forget-password.html">Forget Password?</a></div> -->
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block mt-3" type="submit" name="submit">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('CRM.auth.partials.scripts')
</body>

</html>
