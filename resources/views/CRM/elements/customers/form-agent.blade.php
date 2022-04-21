<div class="card mb-3">
    <div class="card-header">
        <div class="chevron-down-up">
            <h5 class="mb-0">Agent info</h5>
            <p class="click-down" data-id="account"><span class="fas fa-chevron-down"></span></p>
        </div>
    </div>
    <div class="card-body bg-light" data-id="accountobj">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row agent_id_select2" onmouseover="loadAgents()"
                     onchange="handleOnchangeAgent()">
                    <label class="col-sm-4" for="agent_id">Agent</label>
                    <div class="col-sm-8">
                        <select class="form-control " id="agent_id" name="agent_id" required>
                            @if(!empty($obj->agent))
                                <option value="{{$obj->agent->id}}">{{$obj->agent->name}}</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group row master_agent_select2" onmouseover="loadMasterAgents()">
                    <label class="col-sm-4" for="master_agent">Master agent</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="master_agent" name="master_agent">
                            @if(!empty($obj->agentMaster))
                                <option value="{{$obj->agentMaster->id}}">{{$obj->agentMaster->name}}</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4" for="name">GST</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="comm_gst" type="text" placeholder=""
                               value="{{!empty($gst)?$gst:''}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4" for="name">Counsellor</label>
                    <div class="col-sm-8">
                        <select name="counsellor_id" id="counsellor_id">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="form-group row">
                    <label class="col-sm-4" for="name">Agent country</label>
                    <input class="form-control col-sm-8" id="agent_country" type="text"
                           placeholder="{{(!empty($obj) && !empty($obj->agent))?$obj->agent->country():''}}" value=""
                           readonly>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4" for="name">Commission</label>
                    <input class="form-control col-sm-8" id="comm_agent" type="text" placeholder=""
                           value="{{!empty($comm)?$comm:''}}" readonly>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4" for="name">Type payment</label>
                    <select name="type_payment_agent_id" class="form-control col-sm-8" id="type_payment_agent_id">
                        <option value=""></option>
                        @if(!empty($typePaymentConfig))
                            @foreach($typePaymentConfig as $keyTypePayment=>$valueTypePayment)
                                <option
                                    value="{{$keyTypePayment}}" {{!empty($obj) && $obj->type_payment_agent_id == $keyTypePayment ?'selected':''}}>
                                    {{$valueTypePayment}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <input class="form-control col-sm-8" id="comm_type_payment" type="text" placeholder="" hidden
                           value="{{!empty($typePayment)?$typePayment:''}}" readonly>
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
<script>

    function handleOnchangeAgent() {
        $('#agent_id').on('change', function () {
            $.ajax({
                url: '{{route('agent.contact.getCounsellorByAgentId')}}',
                type: 'GET',
                data: {
                    agent_id: $(this).val()
                },
                success: function (result) {
                    var html = '<option value="">  </option>';
                    result.data.forEach(e => {
                        html += `<option value="${e.id}"> ${e.name} </option>`;
                    })
                    $('#counsellor_id').html(html);

                }
            })
        })
    }

    var loadAgentsOnMouse = true;

    function loadAgents() {
        console.log(loadAgentsOnMouse);
        if (loadAgentsOnMouse) {
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
                            console.log(e);
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
            loadAgentsOnMouse = false;
        }
    }

    var loadAgentMasterOnMouse = true;

    function loadMasterAgents() {
        if (loadAgentMasterOnMouse) {
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
            loadAgentMasterOnMouse = false;
        }
    }
</script>
@push('scripts')
    <script>

        $(document).ready(function () {

            @if(request()->get('name_agent'))
            var agent_id = {{request()->get('apply_id')}};
            var name_agent = "{{request()->get('name_agent')}}";
            $('#agent_id').append('<option value="' + agent_id + '">' + name_agent + '</option>');
            @endif


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


            $('select#agent_id').on('select2:select', function (e) {
                var data = e.params.data
                var country = data.country
                $('#agent_country').val(country)
            })

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
                            console.log(e);
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
        })

        $('#agent_id').on('change', function () {
            $.ajax({
                url: '{{route('agent.contact.getCounsellorByAgentId')}}',
                type: 'GET',
                data: {
                    agent_id: $(this).val()
                },
                success: function (result) {
                    var html = '<option value="">  </option>';
                    result.data.forEach(e => {
                        html += `<option value="${e.id}"> ${e.name} </option>`;
                    })
                    $('#counsellor_id').html(html);

                }
            })
        })


        function logs() {
            @if(request()->get('name_agent'))
            var agent_id = {{request()->get('apply_id')}};
            var name_agent = "{{request()->get('name_agent')}}";
            $('#agent_id').append('<option value="' + agent_id + '">' + name_agent + '</option>');
            @endif
        }


    </script>

@endpush
