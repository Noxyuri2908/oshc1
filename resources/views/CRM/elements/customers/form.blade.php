@if(!isset($obj))
    <form action="{{route('customer.store')}}" method="POST" role="form">
        @else
            <form action="{{route('customer.update',['id' => $obj->id])}}" method="POST" role="form">
                {{ method_field('PUT') }}
                @endif
                @csrf
                @include('CRM.elements.customers.header-form')
                @if(session('error-create-customer'))
                    <div class="alert alert-danger">
                        <strong>{{session('error-create-customer')}}</strong>
                    </div>
                @endif
                @if(session('success-create-customer'))
                    <div class="alert alert-success">
                        <strong>{{session('success-create-customer')}}</strong>
                    </div>
                @endif
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="row no-gutters">
                    <div class="col-xl-12">
                        @include('CRM.elements.customers.form-agent')
                    </div>
                    <div class="col-xl-12">
                        @include('CRM.elements.customers.form-service')
                    </div>
                     <div class="col-xl-12">
                        @include('CRM.elements.customers.form-customer-info')
                    </div>
                    <div class="col-xl-12">
                        @include('CRM.elements.customers.form-partner')
                    </div>
                    <div class="col-xl-12">
                        @include('CRM.elements.customers.form-child')
                    </div>
                    <div class="col-xl-12">
                        @include('CRM.elements.customers.form-payment')
                    </div>
                </div>
                @if (!isset($obj))
                    <button type="submit" class="dang-ky-submit">Submit</button>
                    <a href="{{route('customer.index',['page'=>(!empty(request()->get('page'))?request()->get('page'):1)])}}" class="text-decoration-none dang-ky-restart" >Close</a>

                @else

                    <button type="submit" class="dang-ky-submit">Update</button>
                    <a href="{{route('customer.index',['page'=>(!empty(request()->get('page'))?request()->get('page'):1)])}}" class="text-decoration-none dang-ky-restart" >Close</a>
                @endif
                <br>
                <br>
            </form>

    @push('scripts')
        <script>
            $(document).on('mouseover', '.open-jquery-date', function () {
                let start_date_class = $(this).hasClass('flatpickr-input');
                if (!start_date_class) {
                    $(this).flatpickr({
                        dateFormat: "d/m/Y",
                        allowInput:true
                    });
                }
            });
        </script>
    @endpush
