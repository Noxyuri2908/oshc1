<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <title>@yield('title')</title>
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
{{--    <link href="{{ asset('fontend/css/bootstrap.min.css') }}" rel="stylesheet">--}}
    {{-- <link href="{{ asset('fontend/css/font-awesome.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('fontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('fontend/css/custom-css.css') }}" rel="stylesheet">
    <link href="{{ asset('fontend/css/responsive.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('fontend/images/favicon/favicon-32x32.png')}}" type="image/png">
    <link rel="icon" href="{{asset('fontend/images/favicon/favicon-32x32.png')}}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.0/dist/lazyload.min.js"></script>

    <meta name="description"
          content="@yield('meta_description', 'Compare & Choose Best OSHC. Compare & choose OSHC cover that suits your needs, save you up to thousands of dollars. Compare & choose OSHC cover')"/>
    <meta name="keywords"
          content="@yield('meta_keywords', 'oshc,oshcglobal,oshcstudent,bao hiem du hoc,flywire,bupa,allianz')"/>
    <meta property="og:title"
          content="@yield('meta_title', 'Compare & Choose Best OSHC. Compare & choose OSHC cover that suits your needs, save you up to thousands of dollars. Compare & choose OSHC cover')">
    <meta property="og:site_name" content="OSHCglobal - Compare & Choose Best OSHC">
    <meta property="og:image" content="@yield('meta_image',asset('FILES/source/logo.png') )">
    <meta property="og:description"
          content="@yield('meta_description', 'Compare & Choose Best OSHC. Compare & choose OSHC cover that suits your needs, save you up to thousands of dollars. Compare & choose OSHC cover')">
</head>
