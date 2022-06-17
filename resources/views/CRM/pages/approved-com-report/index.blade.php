@extends('CRM.layouts.default')

@section('title')
    Approved Com Report
    @parent
@stop

@section('css')
    @include('CRM.partials.loading-css')
@stop
@section('content')
    <div class="card" style="border-bottom: 2px solid #ccc;">
        <div class="card-body " id="top-filter">
            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex">
                        <div class="d-flex flex-column pr-15 width-200" id="agent_select_drop_down">
                            <label for="">Agent</label>
                            <select name="" id="agent_select" class="custom-border">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="d-flex flex-column pr-15">
                            <label for="">Counsellor</label>
                            <select name="" class="width-120 custom-border custom-h" id="counsellor-by-agent">
                            </select>
                        </div>
                        <div class="d-flex flex-column pr-15">
                            <label for="">Start date</label>
                            <input type="text" id="start_date" class="width-100 custom-border custom-h">
                        </div>
                        <div class="d-flex flex-column pr-15">
                            <label for="">End date</label>
                            <input type="text" id="end_date" class="width-100 custom-border custom-h">
                        </div>
                        <div class="d-flex flex-column pr-15">
                            <label for="" style="margin-bottom: 0.3rem !important;"></label>
                            <br>
                            <button type="submit"
                                    class="width-75 custom-css-input custom-border custom-h">Apply
                            </button>
                        </div>
                        <div class="d-flex flex-column pr-15">
                            <label for="" style="margin-bottom: 0.3rem !important;"></label>
                            <br>
                            <button
                                class="width-85 custom-css-input custom-border custom-h" id="handle-click-reset"><i
                                    class="fas fa-sync-alt custom-icon"></i>Reset
                            </button>
                        </div>
                        <div class="d-flex flex-column pr-15">
                            <label for="">Export as</label>
                            <button type="submit"
                                    class="width-88 custom-css-input custom-border custom-h">Export xlsx
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center align-items-end ">
                    <div class="text-right">
                        <button type="button" class="custom-css-action-send-mail" data-toggle="modal"
                                data-target="#exampleModal">Send mail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  table data approve com  -->
    <div class="card">
        <div class="card-body" style="overflow-x: auto">
            <table style="width: 1433px">
                <thead>
                <tr>
                    <th class="width-100 text-center f-13">Action</th>
                    <th class="width-70 text-center f-13">#Report</th>
                    <th class="width-150 text-center f-13">Agent</th>
                    <th class="width-150 text-center f-13">Type of report</th>
                    <th class="width-50 text-center f-13">Month</th>
                    <th class="width-50 text-center f-13">Year</th>
                    <th class="width-210 text-center f-13">Period</th>
                    <th class="width-50 text-center f-13">Report</th>
                    <th class="width-100 text-center f-13">Amount</th>
                    <th class="width-110 text-center f-13">Checked by</th>
                    <th class="width-110 text-center f-13">Checked date</th>
                    <th class="width-50 text-center f-13">Status</th>
                    <th class="width-100 text-center f-13">Approved by</th>
                    <th class="width-110 text-center f-13">Emailed date</th>
                    <th class="width-150 text-center f-13">Agent request</th>
                    <th class="width-150 text-center f-13">Final approve</th>
                    <th class="width-70 text-center f-13">Paid date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($approvedReports as $approvedReport)
                    <tr>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            <div class="d-flex justify-content-around align-items-center">
                                <i class="fas fa-trash-alt"></i>
                                <i class="fal fa-arrow-alt-to-bottom"></i>
                                <i class="fal fa-check-circle"></i>
                            </div>
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->id }}
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->user->name }}
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Commision report
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->month }}
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->year }}
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->from_date }}-{{ $approvedReport->to_date }}
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            <a href="/crm/preview-approve-com-report/{{ $approvedReport->id }}"><i class="fal fa-file-alt"></i></a>
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->amount }}
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->admin->username }}
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->checked_date }}
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Approved
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ isset($approvedReport->admin->username) ? $approvedReport->admin->username : "" }}
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->emailed_date }}
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Pending
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Pending
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            {{ $approvedReport->paid_date }}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <!-- Modal Send mail -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal mail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around">
                        <div class="categories">
                            <label for="">Categories</label>
                            <select name="category" id="category">
                                <option value=""></option>
                                @foreach($emailCategories as $key => $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="template">
                            <label for="">Email Templates</label>
                            <select name="template" id="template">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="send" disabled>Send</button>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#agent_select').select2({
                // dropdownParent: $('#agent_select_drop_down'),
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

            // handle on change
            $(document).on('change', '#agent_select', function () {
                $.ajax({
                    url: "{{route('agent.contact.getCounsellorByAgentId')}}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        agent_id: $(this).val()
                    },
                    success: function (result) {
                        var html = '<option value=""></option>';
                        $.each(result.data, function (key, value) {
                            html += `<option value="${value.id}">${value.name}</option>`
                        })
                        $('#counsellor-by-agent').append(html);
                    }
                })
            })

            $(document).on('mouseover', '#start_date', function () {
                let date_class = $('#start_date').hasClass('flatpickr-input')
                if (!date_class) {
                    $('#start_date').flatpickr({
                        dateFormat: 'd/m/Y',
                        allowInput: true,
                    })
                }
            })

            $(document).on('mouseover', '#end_date', function () {
                let date_class = $('#end_date').hasClass('flatpickr-input')
                if (!date_class) {
                    $('#end_date').flatpickr({
                        dateFormat: 'd/m/Y',
                        allowInput: true,
                    })
                }
            })

            // handle click reset
            $(document).on('click', '#handle-click-reset', function () {
                $('#top-filter select').text('');
                $('#top-filter input').val('');
            })

            // handle click category
            $(document).on('change', '#category', function () {
                var id_cat = $(this).val();
                $.ajax({
                    url: "{{route('email.email-categories.event.email-template')}}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{csrf_token()}}",
                        id_cat
                    },
                    success: function (result) {
                        var html = '<option value=""></option>';
                        $.each(result.data, function (key, value) {
                            html += `<option value="${value.id}">${value.name}</option>`
                        })
                        $('#template').append(html);
                    }
                })
            })

            // handle on click template
            $(document).on('change', '#template', function () {
                $($(this).val() > 1)
                {
                    $('#send').prop('disabled', false);
                }
            })

            // handle onclick send mail
            $(document).on('click', '#send', function () {
                var id_template = $('#template').val();
                $.ajax({
                    url: "{{route('email.send-mail')}}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{csrf_token()}}",
                        id_template
                    },
                    success: function (result) {
                        if (result.code == 200) {
                            Notiflix.Notify.success("{{session('success')}}");
                        }
                    }
                })
            })
        })
    </script>
@endpush
