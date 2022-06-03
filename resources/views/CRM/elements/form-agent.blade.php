@if(!isset($obj))
    <form action="{{route('agent.store')}}" method="POST" role="form">
        @csrf
        @include('CRM.elements.agents.header-form-agent')
        @if(session('error-create-agent'))
            <div class="alert alert-danger">
                <strong>{{session('error-create-agent')}}</strong>
            </div>
        @endif
        @if(session('success-create-agent'))
            <div class="alert alert-success">
                <strong>{{session('success-create-agent')}}</strong>
            </div>
        @endif


        <div class="row no-gutters">
            <div class="col-xl-5 pr-xl-2">
                @include('CRM.elements.agents.form-account')
                @can('commissionAgent.index')
                    @include('CRM.elements.agents.commission')
                @endcan
            </div>
            <div class="col-xl-7 pl-xl-2">
                @include('CRM.elements.agents.form-info')
                @include('CRM.elements.agents.form-contact')
            </div>
            <div id="div_modal_comm"></div>
        </div>
    </form>

@else

    @if(empty($is_show))
        <form action="{{route('agent.update',['id' => $obj->id])}}" method="POST" role="form">
            @endif
            @csrf
            @include('CRM.elements.agents.header-form-agent')
            @if(session('error-edit-agent'))
                <div class="alert alert-danger">
                    <strong>{{session('error-edit-agent')}}</strong>
                </div>
            @endif
            @if(session('success-edit-agent'))
                <div class="alert alert-success">
                    <strong>{{session('success-edit-agent')}}</strong>
                </div>
            @endif


            <div class="row no-gutters">
                <div class="col-xl-6 pr-xl-2">
                    @include('CRM.elements.agents.form-account')
                    @can('commissionAgent.index')
                        @include('CRM.elements.agents.commission')
                    @endcan
                </div>
                <div class="col-xl-6 pl-xl-2">
                    @include('CRM.elements.agents.form-info')
                    @include('CRM.elements.agents.form-contact')
                </div>
                {{--<div class="col-xl-12 pl-xl-2">--}}
                {{--  @include('CRM.elements.agents.form-bussiness')--}}
                {{--</div>--}}
            </div>
        </form>

    @endif
    <div id="div_modal_contact">
        @include('CRM.elements.agents.modal-create-contact')
    </div>
    @push('scripts')
        <script>
            $('#potential_service_follow_up').select2({
                closeOnSelect: false,
            })
        </script>
    @endpush
