<div class="text-primary py-3 d-flex justify-content-between">
    <div>
        <div class="d-inline-flex flex-center"><span class="text-sans-serif"><img
                    style="width: 180px;max-width: 100%;" src="/images/ee420406b20f4951101e.jpg" alt=""></span>
        </div>
        <p class="table-name">Visitor Insurance Report</p>
        <p class="table-description">Agent partner: @if(isset($agentName)) {{ $agentName }} @endif</p>
        <p class="table-description">Date: @if(isset($fromDate) && isset($toDate)){{ date_format(date_create($fromDate),"d/m/Y") }} - {{ date_format(date_create($toDate),"d/m/Y") }}@endif</p>
    </div>
    <div class="p-6">
        <div class="form-check">
            <input class="form-check-input check-content" type="checkbox"
                   @if(isset($view) && isset($status) && $view == "insurance" && $status == "on")
                   checked
                   @endif
                   id="flexCheckDefault" onclick="document.getElementById('insuranceCheckDefault').click()">
            <label class="form-check-label m-1" for="flexCheckDefault">
                Check
            </label>
        </div>
    </div>
</div>
<table class="oshc-table-content">
    <thead>
    <tr>
        @if(isset($currency) && $currency == "VND")
            <th class="width-100 text-center f-13">Service</th>
            <th class="width-70 text-center f-13">Full name</th>
            <th class="width-150 text-center f-13">Provider</th>
            <th class="width-150 text-center f-13">Policy</th>
            <th class="width-50 text-center f-13">Policy No</th>
            <th class="width-210 text-center f-13">Date of policy</th>
            <th class="width-50 text-center f-13">Start date</th>
            <th class="width-100 text-center f-13">End date</th>
            <th class="width-110 text-center f-13">Amount $</th>
            <th class="width-110 text-center f-13">Com %</th>
            <th class="width-50 text-center f-13">Commission</th>
            <th class="width-150 text-center f-13">Bonus $</th>
            <th class="width-150 text-center f-13">+/- $</th>
            <th class="width-70 text-center f-13">Recall com</th>
            <th class="width-70 text-center f-13">Total $</th>
            <th class="width-70 text-center f-13">Exchange rate</th>
            <th class="width-70 text-center f-13">Total VND</th>
            <th class="width-70 text-center f-13">Com status</th>
            <th class="width-70 text-center f-13">Visa status</th>
            <th class="width-70 text-center f-13">Date of payment</th>
            <th class="width-70 text-center f-13">Note</th>
            <th class="width-70 text-center f-13">History</th>
        @else
            <th class="width-100 text-center f-13">Service</th>
            <th class="width-70 text-center f-13">Full name</th>
            <th class="width-150 text-center f-13">Provider</th>
            <th class="width-150 text-center f-13">Policy</th>
            <th class="width-50 text-center f-13">Policy No</th>
            <th class="width-210 text-center f-13">Date of policy</th>
            <th class="width-50 text-center f-13">Start date</th>
            <th class="width-100 text-center f-13">End date</th>
            <th class="width-110 text-center f-13">Amount VND</th>
            <th class="width-110 text-center f-13">Com %</th>
            <th class="width-50 text-center f-13">Commission VND</th>
            <th class="width-150 text-center f-13">Bonus $</th>
            <th class="width-150 text-center f-13">+/- $</th>
            <th class="width-70 text-center f-13">Recall com</th>
            <th class="width-70 text-center f-13">Total VND</th>
            <th class="width-70 text-center f-13">Com status</th>
            <th class="width-70 text-center f-13">Visa status</th>
            <th class="width-70 text-center f-13">Date of payment</th>
            <th class="width-70 text-center f-13">Note</th>
            <th class="width-70 text-center f-13">History</th>
        @endif

    </tr>
    </thead>
    <tbody class="table table-bordered" style="background: #F9F9F9">
    @php
        $amountInsurance = 0;
    @endphp
    @if(isset($reports) && isset($view) && $view == 'insurance' && !empty($reports))
        @foreach($reports as $report)
            @if($report->date_of_payment == null)
                @if (isset($counsellorId) )
                @if(isset($report->customer->person_counsellor_id) && $report->customer->person_counsellor_id == $counsellorId)
                    <tr>
                        {{--                //Service--}}
                        <td>{{ $report->dichvu->name ?? '' }}</td>
                        {{--                //Full name--}}
                        @if (isset($report->customer))
                            <td>{{ $report->customer->first_name . ' ' . $report->customer->last_name }}</td>
                        @else
                            <td></td>
                        @endif
                        {{--                //Provider--}}
                        <td>{{ $report->serviceReport->name ?? '' }}</td>
                        {{--                //Cover--}}
                        @php
                            $policy = $report->policy;
                            switch ($policy) {
                            case 1:
                                $policyName = "Single";
                                break;
                            case 2:
                                $policyName = "Couple";
                                break;
                            case 3:
                                $policyName = "Family";
                                break;
                            default:
                                $policyName = "Single parent";
                            }
                        @endphp
                        <td>{{ $policyName }}</td>
                        {{--                //Policy No--}}
                        <td>{{ $report->dichvu->policy_no ?? 0 }}</td>
                        {{--                //Date of policy--}}
                        <td>{{ $report->hoahong->issue_date ?? '' }}</td>
                        {{--                //Start date--}}
                        <td>{{ $report->start_date }}</td>
                        {{--                //End date--}}
                        <td>{{ $report->end_date }}</td>
                        {{--                //Amount VND--}}
                        <td>{{ $report->total ?? 0 }}</td>
                        @php
                            $amountInsurance = $amountInsurance + $report->total;
                        @endphp
                        {{--                //Com %--}}
                        <td>{{ $report->commission->comm ?? 0 }}</td>
                        {{--                //Commission VND--}}
                        @php
                            if (isset($report->total)) {
                                $commission_VND = round($report->total * ($report->commission->comm / 100), 2);
                            } else {
                                $commission_VND = 0;
                            }
                            if(isset($report->refundHasOne->refund_amount_com_agent_gbcfa) && isset($report->refundHasOne->std_status) && $report->refundHasOne->std_status == 1) {
                                $recall = $report->refundHasOne->refund_amount_com_agent_gbcfa;
                            } else {
                                $recall = 0;
                            }
                            if(isset($report->profitHasOne->pay_agent_bonus)) {
                                $bonus = $report->profitHasOne->pay_agent_bonus;
                            } else {
                                $bonus = 0;
                            }
                            if(isset($report->profitHasOne->pay_agent_extra)) {
                                $extra = $report->profitHasOne->pay_agent_extra;
                            } else {
                                $extra = 0;
                            }
                            if ($recall == 0) {
                                $totalAUD = $commission_VND + $bonus + $extra;
                            } else {
                                $totalAUD = $commission_VND;
                            }
                        @endphp
                        <td>{{ $commission_VND }}</td>
                        {{--                Bonus $--}}
                        <td>{{ $bonus }}</td>
                        {{--                // extra--}}
                        <td>{{ $extra }}</td>
                        {{--                //Recall com--}}
                        <td>{{ $recall }}</td>
                        {{--                //Total $--}}
                        <td>{{ $totalAUD }}</td>
                        {{--               exchange rate--}}
                        @if(isset($currency) && $currency == "VND")
                        <td>{{ $report->profitHasOne->profit_exchange_rate ?? 0 }}</td>
                        <td>{{ $totalAUD * $report->profitHasOne->profit_exchange_rate }}</td>
                        @endif
                        @php
                            $com_status = '';
                            if (isset($report->hoahong->policy_status)) {
                                $policy_status = $report->hoahong->policy_status;
                                if ($policy_status == 1) {
                                    $com_status = 'Done';
                                } elseif ($policy_status == 2) {
                                    $com_status = 'Customer Bank';
                                } elseif ($policy_status == 3) {
                                    $com_status = 'Monthly deduct';
                                } elseif ($policy_status == 4) {
                                    $com_status = 'Monthly deduct - Annalink';
                                }
                            }
                            $visa_status = '';
                            if (isset($report->profitHasOne->visa_status)) {
                                $visa_statusNb = $report->profitHasOne->visa_status;
                                if ($visa_statusNb == 1) {
                                    $visa_status = 'Granted';
                                } elseif ($visa_statusNb == 2) {
                                    $visa_status = 'Not yet';
                                } elseif ($visa_statusNb == 3) {
                                    $visa_status = 'Failed / Cancelled';
                                } elseif ($visa_statusNb == 4) {
                                    $visa_status = 'Cancel';
                                }
                            }
                        @endphp

                        <td>{{ $com_status }}</td>
                        <td>{{ $visa_status }}</td>
                        <td>{{ $report->refundHasOne->refund_provider_date ?? "" }}</td>
                        <td> {{ $report->refundHasOne->note ?? "" }}</td>
                        <td data-toggle="modal" data-target="#history-modal" style="cursor: pointer">view</td>
                    </tr>
                @endif
                @else
                    <tr>
                        {{--                //Service--}}
                        <td>{{ $report->dichvu->name ?? '' }}</td>
                        {{--                //Full name--}}
                        @if (isset($report->customer))
                            <td>{{ $report->customer->first_name . ' ' . $report->customer->last_name }}</td>
                        @else
                            <td></td>
                        @endif
                        {{--                //Provider--}}
                        <td>{{ $report->serviceReport->name ?? '' }}</td>
                        {{--                //Cover--}}
                        @php
                            $policy = $report->policy;
                            switch ($policy) {
                            case 1:
                                $policyName = "Single";
                                break;
                            case 2:
                                $policyName = "Couple";
                                break;
                            case 3:
                                $policyName = "Family";
                                break;
                            default:
                                $policyName = "Single parent";
                            }
                        @endphp
                        <td>{{ $policyName }}</td>
                        {{--                //Policy No--}}
                        <td>{{ $report->dichvu->policy_no ?? 0 }}</td>
                        {{--                //Date of policy--}}
                        <td>{{ $report->hoahong->issue_date ?? '' }}</td>
                        {{--                //Start date--}}
                        <td>{{ $report->start_date }}</td>
                        {{--                //End date--}}
                        <td>{{ $report->end_date }}</td>
                        {{--                //Amount VND--}}
                        <td>{{ $report->total ?? 0 }}</td>
                        @php
                            $amountInsurance = $amountInsurance + $report->total;
                        @endphp
                        {{--                //Com %--}}
                        <td>{{ $report->commission->comm ?? 0 }}</td>
                        {{--                //Commission VND--}}
                        @php
                            if (isset($report->total)) {
                                $commission_VND = round($report->total * ($report->commission->comm / 100), 2);
                            } else {
                                $commission_VND = 0;
                            }
                            if(isset($report->refundHasOne->refund_amount_com_agent_gbcfa) && isset($report->refundHasOne->std_status) && $report->refundHasOne->std_status == 1) {
                                $recall = $report->refundHasOne->refund_amount_com_agent_gbcfa;
                            } else {
                                $recall = 0;
                            }
                            if(isset($report->profitHasOne->pay_agent_bonus)) {
                                $bonus = $report->profitHasOne->pay_agent_bonus;
                            } else {
                                $bonus = 0;
                            }
                            if(isset($report->profitHasOne->pay_agent_extra)) {
                                $extra = $report->profitHasOne->pay_agent_extra;
                            } else {
                                $extra = 0;
                            }
                            if ($recall == 0) {
                                $totalAUD = $commission_VND + $bonus + $extra;
                            } else {
                                $totalAUD = $commission_VND;
                            }
                        @endphp
                        <td>{{ $commission_VND }}</td>
                        {{--                Bonus $--}}
                        <td>{{ $bonus }}</td>
                        {{--                // extra--}}
                        <td>{{ $extra }}</td>
                        {{--                //Recall com--}}
                        <td>{{ $recall }}</td>
                        {{--                //Total $--}}
                        <td>{{ $totalAUD }}</td>
                        {{--               exchange rate--}}
                        @if(isset($currency) && $currency == "VND")
                            <td>{{ $report->profitHasOne->profit_exchange_rate ?? 0 }}</td>
                            @if(isset($report->profitHasOne->profit_exchange_rate))
                            <td>{{ $totalAUD * $report->profitHasOne->profit_exchange_rate }}</td>
                            @else
                            <td> 0 </td>
                            @endif
                        @endif
                        @php
                            $com_status = '';
                            if (isset($report->hoahong->policy_status)) {
                                $policy_status = $report->hoahong->policy_status;
                                if ($policy_status == 1) {
                                    $com_status = 'Done';
                                } elseif ($policy_status == 2) {
                                    $com_status = 'Customer Bank';
                                } elseif ($policy_status == 3) {
                                    $com_status = 'Monthly deduct';
                                } elseif ($policy_status == 4) {
                                    $com_status = 'Monthly deduct - Annalink';
                                }
                            }
                            $visa_status = '';
                            if (isset($report->profitHasOne->visa_status)) {
                                $visa_statusNb = $report->profitHasOne->visa_status;
                                if ($visa_statusNb == 1) {
                                    $visa_status = 'Granted';
                                } elseif ($visa_statusNb == 2) {
                                    $visa_status = 'Not yet';
                                } elseif ($visa_statusNb == 3) {
                                    $visa_status = 'Failed / Cancelled';
                                } elseif ($visa_statusNb == 4) {
                                    $visa_status = 'Cancel';
                                }
                            }
                        @endphp

                        <td>{{ $com_status }}</td>
                        <td>{{ $visa_status }}</td>
                        <td>{{ $report->refundHasOne->refund_provider_date ?? "" }}</td>
                        <td> {{ $report->refundHasOne->note ?? "" }}</td>
                        <td data-toggle="modal" data-target="#history-modal" style="cursor: pointer">view</td>
                    </tr>
                @endif
            @endif
        @endforeach
    @else
        <div></div>
    @endif
    </tbody>

</table>
<div id="amountInsurance" style="display: none;">{{ $amountInsurance }}</div>
