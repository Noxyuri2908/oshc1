@extends('CRM.layouts.default')

@section('title')
    Commission Report
    @parent
@stop

@section('css-report')
    <link rel="stylesheet" href="{{asset('public/backend_CRM/css/commissionReport/index.css')}}">
@stop
@section('content')
    <div class="card" style="border-bottom: 2px solid #ccc;">
        <div class="card-body " id="top-filter">
            <div class="row">
                <div class="d-flex p-3">
                    <div class="d-flex flex-column pr-15 width-180" id="agent_select_drop_down">
                        <label for="">Agent</label>
                        <select name="Agent" id="agent_select" class="selectpicker width-180 custom-border custom-h">
                            <option value="6529"
                                    @if(isset($agentId) && 6529 == $agentId)
                                    selected
                                    @endif
                            >6529</option>
                            <option value="6603"
                                    @if(isset($agentId) && 6603 == $agentId)
                                    selected
                                @endif
                            >6603</option>
                            <option value="6581"
                                    @if(isset($agentId) && 6581 == $agentId)
                                    selected
                                @endif
                            >6581</option>
                            <option value="7974"
                                    @if(isset($agentId) && 7974 == $agentId)
                                    selected
                                @endif
                            >7974</option>
                            @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" data-select2-id="{{ $agent->id }}"
                                    @if(isset($agentId) && $agent->id == $agentId)
                                    selected
                                    @endif
                            >{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-column pr-15 width-180">
                        <label for="">Combine with</label>
                        <select name="combineWith" id="combine-with" class="selectpicker custom-border custom-h">
                        </select>
                    </div>
                    <div class="d-flex flex-column pr-15 width-180">
                        <label for="">Counsellor</label>
                        <select name="counsellor" id="counsellor-by-agent" class="selectpicker custom-border custom-h">
                            <option></option>
                            @foreach($counsellors as $counsellor)
                            <option value="{{ $counsellor->id }}"
                                    @if(isset($counsellorId) && $counsellorId == $counsellor->id)
                                    selected
                                    @endif
                            >{{ $counsellor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-column pr-15 width-180">
                        <label for="">Type of report</label>
                        <select name="typeOfReport" id="typeOfReport-by-agent" class="selectpicker custom-border custom-h">
                            <option value="AUD"
                                    @if(isset($currency) && $currency == 'AUD')
                                    selected
                                    @endif
                            >Foreign currency</option>
                            <option value="VND"
                                    @if(isset($currency) && $currency == 'VND')
                                    selected
                                    @endif
                            >VND</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column pr-15 width-110">
                        <label for="">Start date</label>
                        <input type="text" id="start_date" class="custom-border custom-h"
                               @if(isset($fromDate))
                               value="{{ $fromDate }}"
                               @endif>
                    </div>
                    <div class="d-flex flex-column pr-15 width-110">
                        <label for="">End date</label>
                        <input type="text" id="end_date" class="custom-border custom-h"
                               @if(isset($toDate))
                                value="{{ $toDate }}"
                                @endif>
                    </div>
                    <div class="d-flex flex-column pr-15 width-90">
                        <button id="apply" type="submit" class="custom-css-input px-0 custom-border custom-h" style="background: #1C427A; color: white">Apply</button>
                    </div>
                    <div class="d-flex flex-column pr-15 width-90">
                        <button class="custom-css-input px-0 custom-border custom-h" id="handle-click-reset">
                            <i class="fas fa-sync-alt custom-icon m-0"></i> Reset</button>
                    </div>
                    <div class="d-flex flex-column pr-15 width-90">
                        <button class="custom-css-input px-0 custom-border custom-h" id="handle-click-reset">Show paid</button>
                    </div>
                    <div class="d-flex flex-column pr-15 width-90">
                        <button class="custom-css-input px-0 custom-border custom-h" data-toggle="modal" data-target="#apply-modal" id="handle-click-save">Save report</button>
                    </div>

                    <div class="d-flex flex-column pr-15 width-90">
                        <button type="submit" id="export-report" class="custom-css-input px-0 custom-border custom-h">Export xlsx</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  table data approve com  -->
    <div class="card">
        <div class="card-body" style="overflow-x: auto">
            <div id="tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">Report overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (isset($view) && isset($view) && $view == 'oshc') active @endif" data-toggle="tab" data-text="oshc" href="#tabs-2" role="tab">OSHC & OVHC Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (isset($view) && $view == 'insurance') active @endif" data-toggle="tab" data-text="insurance" href="#tabs-3" role="tab">Other Insurances Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Homestay Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Flywire Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">ACCI Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">PTE Report</a>
                    </li>
                </ul><!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane" id="tabs-1" role="tabpanel">
                        <p>First Panel</p>
                    </div>
                    <div class="tab-pane @if (isset($view) && $view == 'oshc' || !isset($view)) active @endif" id="tabs-2" role="tabpanel">
                        <div>
                            @yield('oshc-report')
                            @include('CRM.pages.commission-report.tab-contents.oshc-report')
                        </div>
                    </div>
                    <div class="tab-pane @if (isset($view) && $view == 'insurance') active @endif" id="tabs-3" role="tabpanel">
                        <div>
                            @yield('insurance-report')
                            @include('CRM.pages.commission-report.tab-contents.insurance-report')
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-4" role="tabpanel">
                        <p>4 Panel</p>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Modal Send mail -->
    <div class="modal-apply">
        @include('CRM.pages.commission-report.modal.apply-modal')
    </div>
    <div class="modal-history">
        @include('CRM.pages.commission-report.modal.history-modal')
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#agent_select', function () {

                alert($(this).val());
                console.log($(this).val());
            })

            $(document).on('click', '#apply', function () {
                var agentId = $('#agent_select').val();
                var fromDate = $('#start_date').val();
                var toDate = $('#end_date').val();
                var currency = $('#typeOfReport-by-agent').val();
                var counsellor = $('#counsellor-by-agent').val();
                var type = 'oshc';
                // console.log($('#tabs .active')[0].attr('data-text'));
                if ($('#tabs .active')[0].innerText == 'OSHC & OVHC Report') {
                    type = 'oshc';
                } else if ($('#tabs .active')[0].innerText == 'Other Insurances Report') {
                    type = 'insurance';
                }
                var url = "/crm/commission-report?agentId=" + agentId + "&&fromDate=" + fromDate + "&&toDate=" + toDate + '&&currency=' + currency + '&&counsellor='+ counsellor + '&&view='+ type;
                window.location.href = url;
            })

            $(document).on('click', '#export-report', function () {
                var agentId = $('#agent_select').val();
                {{--var agentId = {{ $agentId }};--}}
                var fromDate = $('#start_date').val();
                var toDate = $('#end_date').val();
                var currency = $('#typeOfReport-by-agent').val();
                var counsellor = $('#counsellor-by-agent').val();
                console.log(counsellor)
                if (currency === '') {
                    currency = 'null';
                }
                if (counsellor === '') {
                    counsellor = 'null';
                }
                window.location.href = "/crm/export/" + agentId + "/" + fromDate + "/" + toDate + "/" + currency + "/" + counsellor;
                // history.back();
                // window.location.href = document.referrer;
            })

            $(document).on('click', '.check-content', function () {
                var agentId = $('#agent_select').val();
                {{--var agentId = {{ $agentId }};--}}
                var fromDate = $('#start_date').val();
                var toDate = $('#end_date').val();
                var currency = $('#typeOfReport-by-agent').val();
                var counsellor = $('#counsellor-by-agent').val();
                if (counsellor === '') {
                    counsellor = 'null';
                }
                var status = 'off';
                var type = 'oshc';
                // console.log($('#tabs .active')[0].attr('data-text'));
                if ($('#tabs .active')[0].innerText == 'OSHC & OVHC Report') {
                    if (document.getElementById('oshcCheckbox').checked) {
                        status = 'on';
                    }
                    type = 'oshc';
                } else if ($('#tabs .active')[0].innerText == 'Other Insurances Report') {
                    if (document.getElementById('flexCheckDefault').checked) {
                        status = 'on';
                    }
                    type = 'insurance';
                }
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/crm/check-comission-report",
                    type:"POST",
                    data:{
                        agentId:agentId,
                        fromDate:fromDate,
                        toDate:toDate,
                        typeOfReport:currency,
                        counsellor:counsellor,
                        status:status,
                        type:type,
                        _token: _token
                    },
                    success:function(response){
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    },
                    error: function(error) {
                        console.log(error);
                        Swal.fire({
                            text: error.responseJSON.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            })

            $(document).on('click', '#save_report', function () {
                var agentId = $('#agent_select').val();
                {{--var agentId = {{ $agentId }};--}}
                var fromDate = $('#start_date').val();
                var toDate = $('#end_date').val();
                var currency = $('#typeOfReport-by-agent').val();
                var counsellor = $('#counsellor-by-agent').val();
                if (counsellor === '') {
                    counsellor = 'null';
                }
                var amount = 0;
                var type = 'oshc';
                // console.log($('#tabs .active')[0].attr('data-text'));
                if ($('#tabs .active')[0].innerText == 'OSHC & OVHC Report') {
                    amount = $('#amountOshc')[0].innerText;
                    type = 'oshc';
                } else if ($('#tabs .active')[0].innerText == 'Other Insurances Report') {
                    amount = $('#amountInsurance')[0].innerText;
                    type = 'insurance';
                }
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/crm/save-comission-report",
                    type:"POST",
                    data:{
                        agentId:agentId,
                        fromDate:fromDate,
                        toDate:toDate,
                        typeOfReport:currency,
                        counsellor:counsellor,
                        amount:amount,
                        type:type,
                        _token: _token
                    },
                    success:function(response){
                        console.log(response);
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    },
                    error: function(error) {
                        console.log(error);
                        Swal.fire({
                            text: error.responseJSON.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            })

            $(document).on('mouseover', '#start_date', function () {
                let date_class = $('#start_date').hasClass('flatpickr-input')
                if (!date_class) {
                    $('#start_date').flatpickr({
                        dateFormat: 'Y-m-d',
                        allowInput: true,
                    })
                }
            })

            $(document).on('mouseover', '#end_date', function () {
                let date_class = $('#end_date').hasClass('flatpickr-input')
                if (!date_class) {
                    $('#end_date').flatpickr({
                        dateFormat: 'Y-m-d',
                        allowInput: true,
                    })
                }
            })

            // handle click reset
            $(document).on('click', '#handle-click-reset', function () {
                $('#select2-agent_select-container').text('');
                $('#select2-counsellor-by-agent-container   ').text('');
                $('#top-filter input').val('');
            })

        })
    </script>
@endpush
