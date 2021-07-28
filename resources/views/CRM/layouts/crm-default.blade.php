<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('CRM.partials.head')
<link href="{{asset('backend_CRM/pages/assets/css/cms.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('backend_CRM/pages/assets/css/jquery-ui.css')}}">
@yield('css')
<body>
<main class="main" id="top">
  <input type="hidden" id="ajax_crm_url" value="{{config('admin.ajax_crm_url')}}">
  <div class="content" id="mainContent">
  @include('CRM.partials.crm-topbar')
  @yield('content')
  </div>
</main>
@include('CRM.partials.scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    function convertStringCurrencyToNumber (string){
        if(string == null || string == ''){
            string = '';
        }else{
            string = string.replace(' VND', '');
            string = string.replace(/,/g,'');
        }
        return string;
    }
  $( function() {
    $( ".date-pk" ).datepicker({
     dateFormat: 'dd/mm/yy' });
  } );
</script>
@yield('js')
@stack('scripts')
</body>

</html>
