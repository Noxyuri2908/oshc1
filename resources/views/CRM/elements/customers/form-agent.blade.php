<div class="card mb-3">
    <div class="card-header">
        <div class="chevron-down-up">
            <h5 class="mb-0">Agent info</h5>
            <p class="click-down" data-id="account"><span class="fas fa-chevron-down"></span></p>
        </div>
    </div>
    <div class="card-body bg-light" data-id="account">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group agent_id_select2">
                    <label for="agent_id">Agent</label>
                    <select class="form-control" id="agent_id" name="agent_id" required onmouseover="callAgentCustomerForm()">
                    </select>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">Agent country</label>
                    <input class="form-control" id="agent_country" type="text" placeholder="{{(!empty($obj) && !empty($obj->agent))?$obj->agent->country():''}}" value="" readonly>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group master_agent_select2">
                    <label for="master_agent">Master agent</label>
                    <select class="form-control" id="master_agent" name="master_agent" onmouseover="callMasterAgentCustomerForm()">
                    </select>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">Commission</label>
                    <input class="form-control" id="comm_agent" type="text" placeholder="" value="{{!empty($comm)?$comm:''}}" readonly>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">GST</label>
                    {{--<select name="gst_agent_id" class="form-control" id="gst_agent_id">--}}
                    {{--    <option value=""></option>--}}
                    {{--    @foreach($gstConfig as $keyGst=>$valueGst)--}}
                    {{--        <option value="{{$keyGst}}" {{!empty($obj) && $obj->gst_agent_id == $keyGst ?'selected':''}}>--}}
                    {{--            {{$valueGst}}--}}
                    {{--        </option>--}}
                    {{--    @endforeach--}}
                    {{--</select>--}}
                    <input class="form-control" id="comm_gst" type="text" placeholder="" value="{{!empty($gst)?$gst:''}}" readonly>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">Type payment</label>
                    <select name="type_payment_agent_id" class="form-control" id="type_payment_agent_id">
                        <option value=""></option>
                        @foreach($typePaymentConfig as $keyTypePayment=>$valueTypePayment)
                            <option value="{{$keyTypePayment}}" {{!empty($obj) && $obj->type_payment_agent_id == $keyTypePayment ?'selected':''}}>
                                {{$valueTypePayment}}
                            </option>
                        @endforeach
                    </select>
                    {{--<input class="form-control" id="comm_type_payment" type="text" placeholder="" value="{{!empty($typePayment)?$typePayment:''}}" readonly>--}}
                </div>
            </div>
            <!-- HIDDEN DATA -->
            <input type="hidden" id="data_comm_agent" value="{{!empty($comm)?$comm:''}}">
            <input type="hidden" id="data_unit_comm_agent" value="1">
            <input type="hidden" id="data_gst_agent" value="{{!empty($gst)?$gst:''}}">
            <input type="hidden" id="data_type_payment_agent" value="{{!empty($typePayment)?$typePayment:''}}">
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#master_agent').select2({
            dropdownParent: $('.master_agent_select2'),
            ajax: {
                url: '{{route('agent.getAgentSelect')}}',
                type: 'GET',
                quietMillis: 10000,
                dataType: 'json',
                data: function (term) {
                    var query = {
                        name: term.term,
                    }
                    return query
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'

                    var results = []
                    data.forEach(e => {
                        results.push({
                            id: e.id,
                            text: e.name,
                        })
                    })
                    return {
                        results: results,
                    }
                },
            },
        })
            @if(!empty($obj))
        var optionMaster = new Option('{{!empty($obj->agentMaster)?$obj->agentMaster->name:null}}', '{{$obj->master_agent}}', true, true)
        $('#master_agent').append(optionMaster).trigger('change')
        @endif

        $('#agent_id').select2({
            dropdownParent: $('.agent_id_select2'),
            ajax: {
                url: '{{route('agent.getAgentSelect')}}',
                type: 'GET',
                quietMillis: 10000,
                dataType: 'json',
                data: function (term) {
                    var query = {
                        name: term.term,
                    }
                    return query
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'

                    var results = []
                    data.forEach(e => {
                        results.push({
                            id: e.id,
                            text: e.name,
                            country: e.country,
                        })
                    })
                    return {
                        results: results,
                    }
                },
            },
        })
            @if(!empty($obj))
        var option = new Option('{{(!empty($obj->agent))?$obj->agent->name:''}}', '{{$obj->agent_id}}', true, true)
        $('#agent_id').append(option).trigger('change')
        @endif
        $('select#agent_id').on('select2:select', function (e) {
            var data = e.params.data
            var country = data.country
            $('#agent_country').val(country)
        })

    </script>

@endpush
