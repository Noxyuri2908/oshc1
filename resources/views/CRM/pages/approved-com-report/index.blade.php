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
                        <button type="submit" class="custom-css-action-send-mail">Send mail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  table data approve com  -->
    <div class="card">
        <div class="card-body" style="overflow-x: auto">
            <table style="width: 1400px">
                <thead>
                <tr>
                    <th class="width-100 text-center">Action</th>
                    <th class="width-70 text-center">#Report</th>
                    <th class="width-150 text-center">Agent</th>
                    <th class="width-150 text-center">Type of report</th>
                    <th class="width-50 text-center">Month</th>
                    <th class="width-50 text-center">Year</th>
                    <th class="width-210 text-center">Period</th>
                    <th class="width-50 text-center">Report</th>
                    <th class="width-100 text-center">Amount</th>
                    <th class="width-110 text-center">Checked by</th>
                    <th class="width-110 text-center">Checked date</th>
                    <th class="width-50 text-center">Status</th>
                    <th class="width-100 text-center">Approved by</th>
                    <th class="width-110 text-center">Emailed date</th>
                    <th class="width-150 text-center">Agent request</th>
                    <th class="width-150 text-center">Final approve</th>
                    <th class="width-70 text-center">Paid date</th>
                </tr>
                </thead>
                <tbody>
                @for($i = 0; $i < 10; $i++)
                    <tr>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            <div class="d-flex justify-content-around align-items-center">
                                <i class="fas fa-trash-alt"></i>
                                <i class="fal fa-arrow-alt-to-bottom"></i>
                                <i class="fal fa-check-circle"></i>
                            </div>
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            #10001
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Annalink
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Commision report
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Oct
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            2021
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            10/10/2021- 10/11/2021
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            <i class="fal fa-file-alt"></i>
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            1000 AUD
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Hailey
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            16/11/2021
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Approved
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Richard
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            16/11/2021
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Pending
                        </td>
                        <td class="text-center" style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            Pending
                        </td>
                        <td style="background: #F9F9F9 0% 0% no-repeat padding-box;">
                            15/11/2021
                        </td>
                    </tr>
                @endfor
                </tbody>

            </table>
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
        })
    </script>
@endpush
