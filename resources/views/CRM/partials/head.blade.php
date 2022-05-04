<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180"
          href="{{asset('backend_CRM/pages/assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32"
          href="{{asset('backend_CRM/pages/assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16"
          href="{{asset('backend_CRM/pages/assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend_CRM/pages/assets/img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{asset('backend_CRM/pages/assets/img/favicons/manifest.json')}}">

    <meta name="theme-color" content="#ffffff">

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900"
        rel="stylesheet">
    <link href="{{asset('backend_CRM/pages/assets/css/theme.css')}}" rel="stylesheet">
    <link href="{{asset('backend_CRM/pages/assets/lib/datatables-bs4/dataTables.bootstrap4.min.css')}}"
          rel="stylesheet">
    <link href="{{asset('backend_CRM/pages/assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.css')}}"
          rel="stylesheet">
    <link href="{{asset('backend_CRM/pages/assets/lib/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend_CRM/pages/assets/lib/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
    {{--    <link href="{{asset('backend_CRM/pages/assets/fonts/bw-modelica/BwModelicaSS01-Light.woff')}}" rel="stylesheet">--}}
    <link href="{{asset('backend_CRM/pages/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend_CRM/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('backend_CRM/js/plugins/fancybox/jquery.fancybox.css')}}"/>
    <link rel="stylesheet" href="{{asset('backend_CRM/css/summernote.min.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous"/>

</head>
