@push('css')
    <style>
        .table-appointment .select2-results .select2-results__options .select2-results__option{
            color:#000;
        }

    </style>
    @endpush
<div class="mb-3">
    <input type="text" class="form-control mr-2 w-25" id="q_filter" placeholder="Search All">
</div>

<div class="table-appointment table-div">
    <table class="">
        <thead class="">
            <tr class="first-row">
                <th class="width-50">Action</th>
                <th class="width-220">Agent</th>
                <th class="width-300">Time</th>
                <th class="width-200">Location</th>
                <th class="width-300">Attendees</th>
                <th class="width-500">Note</th>
            </tr>
            <tr class="last-row">
                <th></th>
                <th>
                    <div class="select2_select">
                        <select name="" id="agent_appointment_filter" class="form-control">
                            <option value="">Agent</option>
                            @if(!empty($agents))
                                @foreach($agents as $key=>$status)
                                    <option value="{{$key}}">{{$status}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- <input type="text" class="form-control" id="agent_appointment_filter" placeholder="User"> --}}
                </th>
                <th>
                    <div class="d-flex">
                        <input type="text" class="form-control mr-2" id="processing_date_appointment_start" value="{{date('01/m/Y')}}" placeholder="Date start">
                        <input type="text" class="form-control" id="processing_date_appointment_end" value="{{date('d/m/Y')}}" placeholder="Date end">
                    </div>
                </th>
                <th>
                    {{-- <select name="" id="issue_appointment_filter" class="form-control">
                        <option value="">Status</option>
                        @foreach(config('myconfig.issue_appointment_agent') as $key=>$status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select> --}}
                </th>
                <th>

                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="appointment-data-sale">

        </tbody>
    </table>
</div>
@push('scripts')
    <script>

        function showModelAttendees(elm)
        {
            var contentAtt = ''
            var content = elm.innerText.split(' ');
            content.forEach(function (e){
                contentAtt += e+'<br>';
            })
            var html = '';
            html += '<div class="modal fade show" role="dialog" id="model-attendees" style="display: block" onclick="hideModelAttendees()">'
            html += '<div class="modal-dialog">'
            html += '<div class="modal-content">'
            html += '<div class="modal-header">'
            html += '<button type="button" class="close" data-dismiss="modal">&times;</button>'
            html += '</div>'
            html += '<div class="modal-body">'
            html += `<p>${contentAtt}</p>`
            html += '</div>'
            html += '<div class="modal-footer">'
            html += '<button type="button" class="btn btn-default " id="close-model-attendees" onclick="hideModelAttendees()">Close</button>'
            html += '</div>'
            html += '</div>'
            html += '</div>'
            html += '</div>'
            $('#attendees').append(html);
            $('body').append('<div class="modal-backdrop fade show"></div>')
            $('body').addClass('modal-open')
        }

        function hideModelAttendees()
        {
            $('#model-attendees').remove();
            $('.modal-backdrop').remove()
            $('body').removeClass('modal-open')
        }

        var pageappointment = 1
        var lastPageappointment
        var agent_appointment_filter = ''
        var processing_date_appointment_start = ''
        var processing_date_appointment_end = ''
        var issue_appointment_filter = ''
        var person_in_charge_appointment_filter = ''
        var appointment_appointment_filter = ''
        var q_filter = ''
        var readyappointment = true
        var arrData = []

        function getappointments(page) {
            $.ajax({
                url: "{{route('event.index')}}",
                type: 'get',
                data: {
                    @if(!empty($agent_id))
                    agent_id: "{{$agent_id}}",
                    @endif
                    submit_form: 'task_sale',
                    @if(request()->get('report_end_date') && request()->get('report_start_date'))
                    processing_date_appointment_start: "{{request()->get('report_start_date')}}",
                    processing_date_appointment_end: "{{request()->get('report_end_date')}}",
                    @endif
                        @if(request()->get('filter_date_option'))
                    filter_date_option: "{{request()->get('filter_date_option')}}",
                    @endif
                },
                success: function (data) {
                    $('#appointment-data-sale').html(data.view)
                    lastPageappointment = data.last_page
                },
            })
        }

        getappointments()

        function callAjaxAppointment() {
            readyappointment = false
            pageappointment = 1
            agent_appointment_filter = $('#agent_appointment_filter').val()
            processing_date_appointment_start = $('#processing_date_appointment_start').val()
            processing_date_appointment_end = $('#processing_date_appointment_end').val()
            issue_appointment_filter = $('#issue_appointment_filter').val()
            person_in_charge_appointment_filter = $('#person_in_charge_appointment_filter').val()
            appointment_appointment_filter = $('#appointment_appointment_filter').val()
            q_filter = $('#q_filter').val()
            getappointmentsFilter(
                pageappointment,
                agent_appointment_filter,
                processing_date_appointment_start,
                processing_date_appointment_end,
                issue_appointment_filter,
                person_in_charge_appointment_filter,
                appointment_appointment_filter,
                q_filter
                , 0)
            $('#box_data_customer').scrollTop(0)
        }

        function ajaxAppointment(data) {
            if (readyappointment) {
                callAjaxAppointment()
            }
        }

        function debounce(fn, delay) {
            return args => {
                clearTimeout(fn.id)

                fn.id = setTimeout(() => {
                    fn.call(this, args)
                }, delay)
            }
        }

        const debounceAjaxAppointment = debounce(ajaxAppointment, 300)

        $(document).on('keyup', '.table-appointment .last-row input', function (e) {
            debounceAjaxAppointment(e.target.value)
        })
        $(document).on('change', '.table-appointment .last-row select', function (e) {
            debounceAjaxAppointment(e.target.value)
        })

        //$(document).on('keypress', function (e) {
        //    if (e.keyCode == 13 && readyappointment && hoverTable == 'appointment') {
        //        callAjaxAppointment()
        //    }
        //})

        function getappointmentsFilter(
            page,
            agent_appointment_filter,
            processing_date_appointment_start,
            processing_date_appointment_end,
            issue_appointment_filter,
            person_in_charge_appointment_filter,
            appointment_appointment_filter,
            q_filter,
            isAppend,
        ) {

            $.ajax({
                url: "{{route('event.index')}}",
                type: 'get',
                data: {
                    @if(!empty($agent_id))
                    agent_id: "{{$agent_id}}",
                    @endif
                    page: page,
                    agent_appointment_filter: agent_appointment_filter,
                    processing_date_appointment_start: processing_date_appointment_start,
                    processing_date_appointment_end: processing_date_appointment_end,
                    issue_appointment_filter: issue_appointment_filter,
                    person_in_charge_appointment_filter: person_in_charge_appointment_filter,
                    appointment_appointment_filter: appointment_appointment_filter,
                    q_filter: q_filter,
                    submit_form: 'task_sale',
                },
                success: function (data) {
                    if (isAppend == 0) {
                        $('#appointment-data-sale').html(data.view)
                    }
                    // else if(isAppend == 1){
                    //     $('#appointment-data-sale').append(data.view);
                    // }
                    lastPageappointment = data.last_page
                },
                complete: function () {
                    readyappointment = true
                },
            })
        }

        $('.table-appointment').scroll(function (e) {
            if (readyappointment && Math.round($(this).scrollTop() + $(this)
                .innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 80) {
                readyappointment = false
                if (pageappointment < lastPageappointment) {
                    pageappointment++
                    getappointmentsFilter(
                        pageappointment,
                        agent_appointment_filter,
                        processing_date_appointment_start,
                        processing_date_appointment_end,
                        issue_appointment_filter,
                        person_in_charge_appointment_filter,
                        appointment_appointment_filter,
                        1)
                } else {
                    readyappointment = true
                }
            }
        })

        function deleteAllFilterappointments() {
            getappointments(1)
            $('#agent_appointment_filter').val('')
            $('#processing_date_appointment_start').val('')
            $('#processing_date_appointment_end').val('')
            $('#issue_appointment_filter').val('')
            $('#person_in_charge_appointment_filter').val('')
            $('#appointment_appointment_filter').val('')
            $('#box_data_customer').scrollTop(0)
        }

        $('#delete_all_appointment_fillter').on('click', function (e) {
            e.preventDefault()
            deleteAllFilterappointments()
        })

        //crud

        //end curd
    </script>
    @include('CRM.partials.choose_date_onchange_call_function',[
        'idElementInputFlatpick'=>[
            'processing_date_appointment_start',
            'processing_date_appointment_end'
        ],
        'functionNameCall'=>'debounceAjaxAppointment'
    ])
    <script>
        $(document).on('mouseover', '.edit-appointment-agent', function (e) {
            e.preventDefault()
            var element = this
            $(element).fancybox({
                'width': 1200,
                'height': 900,
                'type': 'iframe',
                'autoScale': false,
                'autoSize': false,
                helpers: {
                    title: {
                        type: 'float',
                    },
                },
                afterClose: function () {
                    debounceAjaxAppointment()
                },
            })
        })
        $('#agent_appointment_filter').select2({
            dropdownParent: $('.select2_select'),
            ajax: {
                url: '{{route('agent.getAgentSelect')}}',
                type: 'GET',
                quietMillis: 10000,
                dataType: 'json',
                data: function (term) {
                    var query = {
                        name: term.term,
                    }
                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'

                    var results = [];
                    data.forEach(e => {
                        results.push({
                            id: e.id,
                            text: e.name
                        });
                    });
                    return {
                        results: results
                    };
                }
            },
        })




    </script>
@endpush
