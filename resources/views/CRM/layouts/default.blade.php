<!DOCTYPE html>
<html lang="en-US" dir="ltr">
@include('CRM.partials.head')
@yield('css')
@stack('css')

<body>
{{--   <input type="hidden" id="ajax_crm_url" value="{{route('crm.dashboard')}}">--}}
<input type="hidden" id="ajax_crm_url" value="{{config('admin.ajax_crm_url')}}">
<main class="main" id="top">
{{--    @dump(session()->all())--}}
    <div class="container-fluid">
        @include('CRM.partials.navbar')
        <div class="content mt-0 mt-lg-3 mt-md-3" id="mainContent">
{{--            @include('CRM.partials.topbar')--}}
            @yield('content')

        </div>
    </div>
</main>
@include('CRM.partials.scripts')
@include('CRM.elements.modal-import')
<script>
    function convertStringCurrencyToNumber(string) {
        if (string == null || string == '') {
            string = '';
        } else {
            string = string.replace(' VND', '');
            string = string.replace(/,/g, '');
        }
        return string;
    }
    function convertNumberToCurrency(number) {
        var currency = number.toLocaleString(
            undefined, // leave undefined to use the browser's locale,
            // or use a string like 'en-US' to override it.
            {minimumFractionDigits: 2}
        );
        return currency;
    }
</script>
@yield('js')
@stack('scripts')
</body>
</html>
