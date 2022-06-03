<div class="text-primary py-3">
    <div class="d-inline-flex flex-center"><span class="text-sans-serif"><img
                style="width: 180px;max-width: 100%;" src="/images/ee420406b20f4951101e.jpg" alt=""></span>
    </div>
    <p class="table-name">OSHC & OVHC report</p>
    <p class="table-description">Agent partner: ATS HCM + ATS HN</p>
    <p class="table-description">Date: Start date 10/10/2021 - End date 09/11/2021</p>
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
        <th class="width-50 text-center f-13">Start date</th>
        <th class="width-100 text-center f-13">End date</th>
        <th class="width-110 text-center f-13">Gross amount</th>
        <th class="width-110 text-center f-13">Com %</th>
        <th class="width-50 text-center f-13">Commission(Excluded GST)</th>
        <th class="width-100 text-center f-13">GST</th>
        <th class="width-110 text-center f-13">Commission (Included GST)</th>
        <th class="width-150 text-center f-13">Bonus $</th>
        <th class="width-150 text-center f-13">+/- $</th>
        <th class="width-70 text-center f-13">Recall com</th>
        <th class="width-70 text-center f-13">Total $</th>
        <th class="width-70 text-center f-13">Total VND</th>
        <th class="width-70 text-center f-13">Visa status</th>
        <th class="width-70 text-center f-13">Payment status</th>
        <th class="width-70 text-center f-13">Date of payment</th>
        <th class="width-70 text-center f-13">Note</th>
        <th class="width-70 text-center f-13">History</th>
    </tr>
    </thead>
    <tbody class="table table-bordered" style="background: #F9F9F9">
    @if(isset($reports) && !empty($reports))
        @foreach($reports as $report)
        <tr>
            <td>Mark</td>
            <td>Otto</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td>infor</td>
            <td data-toggle="modal" data-target="#history-modal" style="cursor: pointer">view</td>
        </tr>
        @endforeach
    @else
    <div></div>
    @endif
    </tbody>

</table>
