<div class="text-primary py-3 d-flex justify-content-between">
    <div>
        <div class="d-inline-flex flex-center"><span class="text-sans-serif"><img
                    style="width: 180px;max-width: 100%;" src="/images/ee420406b20f4951101e.jpg" alt=""></span>
        </div>
        <p class="table-name">OSHC & OVHC report</p>
        <p class="table-description">Agent partner: @if(isset($agentName)) {{ $agentName }} @endif</p>
        <p class="table-description">Date: @if(isset($fromDate) && isset($toDate)){{ date_format(date_create($fromDate),"d/m/Y") }} - {{ date_format(date_create($toDate),"d/m/Y") }}@endif</p>
    </div>
    <div class="p-6">
        <div class="form-check">
            <input class="form-check-input check-content" type="checkbox"
                   @if(isset($view) && isset($status) && $view == "oshc" && $status == "on")
                   checked
                   @endif
                   id="oshcCheckbox" onclick="document.getElementById('oshcCheckDefault').click()">
            <label class="form-check-label m-1" for="oshcCheckbox">
                Check
            </label>
        </div>
    </div>
</div>
<table class="oshc-table-content">
    <thead>
    <tr>
        <th class="width-100 text-center f-13">Service</th>
        <th class="width-70 text-center f-13">Full name</th>
        <th class="width-150 text-center f-13">Provider</th>
        <th class="width-150 text-center f-13">Cover</th>
        <th class="width-50 text-center f-13">Policy No</th>
        <th class="width-50 text-center f-13">Adults</th>
        <th class="width-210 text-center f-13">Children</th>
        <th class="width-50 text-center f-13">Start date</th>
        <th class="width-100 text-center f-13">End date</th>
        <th class="width-110 text-center f-13">Gross amount</th>
        <th class="width-110 text-center f-13">Com %</th>
        @if(isset($currency) && $currency == 'AUD' && $gst->gst < 1 )
            <th class="width-50 text-center f-13">Commission $ (Included GST)</th>
            <th class="width-100 text-center f-13">GST</th>
            <th class="width-110 text-center f-13">Commission $ (Excluded GST)</th>

        @else
            <th class="width-110 text-center f-13">Commission $ (Excluded GST)</th>
            <th class="width-100 text-center f-13">GST</th>
            <th class="width-110 text-center f-13">Commission $ (Included GST)</th>
        @endif
        <th class="width-150 text-center f-13">Bonus $</th>
        <th class="width-150 text-center f-13">+/- $</th>
        <th class="width-70 text-center f-13">Recall com</th>
        <th class="width-70 text-center f-13">Total $</th>
        <th class="width-70 text-center f-13">Total {{ isset($currency) ? $currency: 'VND' }}</th>
        <th class="width-70 text-center f-13">Com status</th>
        <th class="width-70 text-center f-13">Visa status</th>
        <th class="width-70 text-center f-13">Date of payment</th>
        <th class="width-70 text-center f-13">Note</th>
        <th class="width-70 text-center f-13">History</th>
    </tr>
    </thead>
    <tbody class="table table-bordered" style="background: #F9F9F9">
    @php
    $amountOshc = 0;
    @endphp
    @if(isset($reports) && isset($view) && $view == 'oshc' && !empty($reports))
        @foreach($reports as $report)
            @if($report->date_of_payment == null)
            @if (isset($counsellorId) )
                @if(isset($report->customer->person_counsellor_id) && $report->customer->person_counsellor_id == $counsellorId)
                <tr>
                    <td>{{ $report->service }}</td>
                    <td>{{ $report->full_name }}</td>
                    <td>{{ $report->provider }}</td>
                    <td>{{ $report->cover }}</td>
                    <td>{{ $report->policy_no }}</td>
                    <td>{{ $report->no_of_adults }}</td>
                    <td>{{ $report->no_of_children }}</td>
                    <td>{{ $report->start_date }}</td>
                    <td>{{ $report->end_date }}</td>
                    <td>{{ $report->amount }}</td>
                    @php
                        $amountOshc = $amountOshc + $report->amount;
                    @endphp
                    <td>{{ $report->comm }}</td>
                    @if(isset($currency) && $currency == 'AUD' && $gst->gst < 1 )
                        <td>{{ $report->comm_inc_gst }}</td>
                        <td>{{ $report->gst }}</td>
                        <td>{{ $report->comm_exc_gst }}</td>
                    @else
                        <td>{{ $report->comm_exc_gst }}</td>
                        <td>{{ $report->gst }}</td>
                        <td>{{ $report->comm_inc_gst }}</td>
                    @endif
                    <td>{{ $report->bonus }}</td>
                    <td>{{ $report->pay_agent_extra }}</td>
                    <td>{{ $report->recall_com }}</td>
                    <td>{{ $report->total_amount }}</td>
                    <td>{{ $report->total_amount_AUD }}</td>
                    <td>{{ $report->comm_status }}</td>
                    <td>{{ $report->visa_status_text }}</td>
                    <td>{{ $report->date_of_payment }}</td>
                    <td>{{ $report->note }}</td>
                    <td data-toggle="modal" data-target="#history-modal" style="cursor: pointer">view</td>
                </tr>
                @endif
            @else
                <tr>
                    <td>{{ $report->service }}</td>
                    <td>{{ $report->full_name }}</td>
                    <td>{{ $report->provider }}</td>
                    <td>{{ $report->cover }}</td>
                    <td>{{ $report->policy_no }}</td>
                    <td>{{ $report->no_of_adults }}</td>
                    <td>{{ $report->no_of_children }}</td>
                    <td>{{ $report->start_date }}</td>
                    <td>{{ $report->end_date }}</td>
                    <td>{{ $report->amount }}</td>
                    @php
                        $amountOshc = $amountOshc + $report->amount;
                    @endphp
                    <td>{{ $report->comm }}</td>
                    @if(isset($currency) && $currency == 'AUD' && $gst->gst < 1 )
                        <td>{{ $report->comm_inc_gst }}</td>
                        <td>{{ $report->gst }}</td>
                        <td>{{ $report->comm_exc_gst }}</td>
                    @else
                        <td>{{ $report->comm_exc_gst }}</td>
                        <td>{{ $report->gst }}</td>
                        <td>{{ $report->comm_inc_gst }}</td>
                    @endif
                    <td>{{ $report->bonus }}</td>
                    <td>{{ $report->pay_agent_extra }}</td>
                    <td>{{ $report->recall_com }}</td>
                    <td>{{ $report->total_amount }}</td>
                    <td>{{ $report->total_amount_AUD }}</td>
                    <td>{{ $report->comm_status }}</td>
                    <td>{{ $report->visa_status_text }}</td>
                    <td>{{ $report->date_of_payment }}</td>
                    <td>{{ $report->note }}</td>
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
<div id="amountOshc" style="display: none;">{{ $amountOshc }}</div>

