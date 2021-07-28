<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('CRM.partials.head')
@yield('css')
<body>
   <input type="hidden" id="ajax_crm_url" value="{{config('admin.ajax_crm_url')}}">
  <main class="main" id="top">
    <div class="container-fluid">
      <div class="content" id="mainContents">
        @yield('content')
        {{--<div id="div_modal_contact">--}}
        {{--@include('CRM.elements.agents.modal-create-contact')--}}
        {{--</div>--}}
      </div>
    </div>
  </main>
  @include('CRM.partials.scripts')
  @include('CRM.elements.modal-import')
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
    function convertNumberToCurrency(number){
        var currency = number.toLocaleString(
        undefined, // leave undefined to use the browser's locale,
                    // or use a string like 'en-US' to override it.
        { minimumFractionDigits: 2 }
        );
        return currency;
    }
  </script>
  @yield('js')
  @stack('scripts')
</body>
</html>
