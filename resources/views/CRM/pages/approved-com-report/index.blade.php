@extends('CRM.layouts.default')

@section('title')
    Approved Com Report
    @parent
@stop

@section('css')
    @include('CRM.partials.loading-css')
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex">
                        <div class="d-flex flex-column pr-15 width-200" id="agent_select_drop_down">
                            <label for="">Agent</label>
                            <select name="" id="agent_select" class="custom-border">
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column pr-15">
                            <label for="">Counsellor</label>
                            <select name="" class="width-120 custom-border custom-h" id="counsellor-by-agent">
                                <option value=""></option>
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
                            <input type="submit" value="Apply"
                                   class="width-75 custom-css-input custom-border custom-h">
                        </div>
                        <div class="d-flex flex-column pr-15">
                            <label for="" style="margin-bottom: 0.3rem !important;"></label>
                            <br>
                            <button
                                class="width-85 custom-css-input custom-border custom-h"><i
                                    class="fas fa-sync-alt custom-icon"></i>Reset
                            </button>
                        </div>
                        <div class="d-flex flex-column pr-15">
                            <label for="">Export as</label>
                            <input type="submit" value="Export xlsx"
                                   class="width-88 custom-css-input custom-border custom-h">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center align-items-end ">
                    <div class="text-right">
                        <input type="submit" value="Send mail" class="custom-css-action-send-mail">
                    </div>
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
                        var html = '';
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
        })
    </script>
@endpush
