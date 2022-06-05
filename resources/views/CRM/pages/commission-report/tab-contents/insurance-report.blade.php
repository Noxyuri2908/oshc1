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
    @if(strpos(URL::current(), 'create-insurance-report') !== false)
    @if(isset($reports) && !empty($reports))
        @foreach($reports as $report)
            <tr>
                <td>{{ isset($report->dichvu->name) ? $report->dichvu->name : '' }}</td>
                <td>{{ isset($report->customer->first_name) ? $report->customer->first_name : '' }} {{ isset($report->customer->last_name) ? $report->customer->last_name : '' }}</td>
                <td>{{ isset($report->serviceReport->name) ? $report->serviceReport->name : '' }}</td>
                <td></td>
                <td>{{ isset($report->dichvu->policy_no) ? $report->dichvu->policy_no : '' }}</td>
                <td>{{ $report->no_of_adults }}</td>
                <td>{{ $report->no_of_children }}</td>
                <td>{{ isset($report->hoahong->issue_date) ? $report->hoahong->issue_date : '' }}</td>
                <td>{{ $report->start_date }}</td>
                <td>{{ $report->end_date }}</td>
                <td>{{ isset($report->total) ? $report->total : 0 }}</td>
                <td>{{ $report->comm_percent }}</td>
                <td>{{ $report->comm_vnd }}</td>
                <td>{{ $report->bonus }}</td>
                <td>{{ $report->pay_agent_extra }}</td>
                <td>{{ $report->recall_com }}</td>
                <td>{{ $report->total_VND }}</td>
                <td>{{ $report->comm_status }}</td>
                <td>{{ $report->visa_status }}</td>
                <td>{{ $report->date_of_payment }}</td>
                <td>{{ $report->note }}</td>
                <td data-toggle="modal" data-target="#history-modal" style="cursor: pointer">view</td>
            </tr>
        @endforeach
    @else
        <div></div>
    @endif
    @endif
    </tbody>

</table>
