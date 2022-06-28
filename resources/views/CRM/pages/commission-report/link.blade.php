<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('CRM.partials.head')
<link href="{{asset('backend_CRM/pages/assets/css/cms.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('backend_CRM/pages/assets/css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{asset('public/backend_CRM/css/commissionReport/index.css')}}">
<body class="p-5" style="position: relative">
@if (isset($view) && $view == 'insurance')
    @include('CRM.pages.commission-report.tab-contents.insurance-report')
@else
    @include('CRM.pages.commission-report.tab-contents.oshc-report')
@endif
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>

</html>


