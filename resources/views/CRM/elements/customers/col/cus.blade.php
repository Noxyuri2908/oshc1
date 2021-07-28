<thead class="bg-200 text-900 thead-dark customer-thead">
<tr class="first-row">
    <th class="width-40">
        <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table"/>
    </th>
    <th class="width-50">Action</th>
    <th class="width-100">Ref No</th>
    <th class="width-100">Creation date</th>
    <th class="width-100">Agent</th>
    <th class="width-100">Agent country</th>
    <th class="width-120">Register</th>
    <th class="width-100">Status</th>
    <th class="width-200">Email</th>
    <th class="width-100">Master agent</th>
    <th class="width-100">Service country</th>
    <th class="width-100">Type of service</th>
    <th class="width-100">Type of invoice</th>
    <th class="width-200">Provider</th>
    <th class="width-100">Policy</th>
    <th class="width-100">No of adults</th>
    <th class="width-100">No of children</th>
    <th class="width-100">Type of visa</th>
    <th class="width-100">Start date</th>
    <th class="width-100">End date</th>
    <th class="width-200">Net amount ($)</th>
    <th class="width-100">Promotion code</th>
    <th class="width-120">Promotion ($)</th>
    <th class="width-120">Bank fee (%)</th>
    <th class="width-120">Bank fee ($)</th>
    <th class="width-200">Payment method</th>
    <th class="width-120">Surcharge ($)</th>
    <th class="width-120">-/+ ($)</th>
    <th class="width-120">Commission ($)</th>
    <th class="width-120">Total ($)</th>
    <th class="width-120">Policy Number</th>
    <th class="width-120">Issue Date</th>
    <th class="width-170">Payment note (provider)</th>
    <th class="width-120">Months</th>
    <th class="width-120">Staff</th>
    <th class="width-500">Note</th>
    <th class="width-200">Location in AU</th>
    <th class="width-200">Destination</th>
    <th class="width-200">OSHC provider of School</th>
</tr>
@include('CRM.elements.customers.filter.cus')
</thead>
@push('scripts')
    @include('CRM.elements.customers.partials.js.script-loading',[
        'elementFilterIds'=>
        [
            'ref_no',
'created_at',
'agent_id',
'register',
'status',
'email',
'master_agent',
'service_country',
'type_service',
'type_invoice',
'provider_id',
'policy',
'type_visa',
'start_date',
'end_date',
'net_amount',
'promotion_id',
'payment_method',
'policy_number',
'issue_date',
'payment_note',
'staff_id',
'note',
'location_australia',
'country_id',
'destination',
'month'
        ],
        'tab'=>$tab,
        'element_class_btn_row_edit'=>'customer_data_edit',
        'element_id_row_edit'=>'data-customer'
    ])
@endpush
