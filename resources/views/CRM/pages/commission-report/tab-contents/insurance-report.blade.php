<div class="text-primary py-3">
    <div class="d-inline-flex flex-center"><span class="text-sans-serif"><img
                style="width: 180px;max-width: 100%;" src="/images/ee420406b20f4951101e.jpg" alt=""></span>
    </div>
    <p class="table-name">OSHC & OVHC report</p>
    <p class="table-description">Agent partner: ATS HCM + ATS HN</p>
    <p class="table-description">Date: Start date @if(isset($fromDate)){{ $fromDate }}@endif - End date @if(isset($toDate)){{ $toDate }}@endif</p>
</div>
<table style="width: 1433px" class="oshc-table-content">
    <thead>
    <tr>
        <th class="width-100 text-center f-13">Service</th>
        <th class="width-70 text-center f-13">Full name</th>
        <th class="width-150 text-center f-13">Provider</th>
        <th class="width-150 text-center f-13">Cover</th>
        <th class="width-50 text-center f-13">Policy No</th>
        <th class="width-50 text-center f-13">Adults</th>
        <th class="width-210 text-center f-13">Children</th>
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
    </tr>
    </thead>
    <tbody class="table table-bordered" style="background: #F9F9F9">
    @if(isset($insuranceRreports) && !empty($reports))
        @foreach($insuranceRreports as $report)
            <tr>
                <td>{{ isset($report->dichvu->name) ? $report->dichvu->name : '' }}</td>
                @if (isset($report->customer))
                    <td>{{ $report->customer->first_name . ' ' . $report->customer->last_name }}</td>
                @else
                    <td></td>
                @endif

                <td>{{ isset($report->serviceReport->name) ? $report->serviceReport->name : '' }}</td>
                <td></td>
                <td>{{ isset($report->dichvu->policy_no) ? $report->dichvu->policy_no : 0 }}</td>
                <td>{{ $report->no_of_adults }}</td>
                <td>{{ $report->no_of_children }}</td>
                <td>{{ isset($report->hoahong->issue_date) ? $report->hoahong->issue_date : '' }}</td>
                <td>{{ $report->start_date }}</td>
                <td>{{ $report->end_date }}</td>
                <td>{{ isset($report->total) ? $report->total : 0 }}</td>
                <td>{{ isset($report->commission->comm) ? $report->commission->comm : 0 }}</td>
                @if (isset($report->total))
                    <td>{{ round($report->total * ($report->commission->comm / 100), 2)}}</td>
                @else
                    <td>0</td>
                @endif
                <td>{{ isset($report->profit->pay_agent_bonus) ? $report->profit->pay_agent_bonus : 0 }}</td>
                <td>{{ isset($report->profit->pay_agent_extra) ? $report->profit->pay_agent_extra : 0 }}</td>
                @if(isset($report->refund->refund_amount_com_agent_gbcfa) && isset($report->refund->std_status) && $report->refund->std_status == 1)
                <td>{{ $report->refund->refund_amount_com_agent_gbcfa }}</td>
                @else
                <td>0</td>
                @endif
                @if ($report->recall_com == 0)
                <td>{{ $report->comm_vnd + $report->bonus + $report->pay_agent_extra }}</td>
                @else
                <td>{{ $report->recall_com }}</td>
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
                    if (isset($report->profit->visa_status)) {
                        $visa_statusNb = $report->profit->visa_status;
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
                <td></td>
                <td></td>
                <td data-toggle="modal" data-target="#history-modal" style="cursor: pointer">view</td>
            </tr>
        @endforeach
    @else
        <div></div>
    @endif
    </tbody>

</table>
