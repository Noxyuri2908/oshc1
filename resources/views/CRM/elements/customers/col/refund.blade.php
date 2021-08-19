@push('css')
    <style>
        .first-row-head th {
            position: sticky;
            left: 0;
        }

        .table-main-customer thead.refund-thead .first-row {
            top: 0px;
        }

        .table-main-customer thead.refund-thead .last-row {
            top: 25px;
        }

        .table-main-customer thead.refund-thead .first-row th:first-child,
        .table-main-customer thead.refund-thead .last-row th:first-child {
            left: 0;
            z-index: 2;
        }

        .table-main-customer thead.refund-thead .first-row th:nth-child(2),
        .table-main-customer thead.refund-thead .last-row th:nth-child(2) {
            left: 40px;
            z-index: 3;
        }

        .table-main-customer thead.refund-thead .first-row th:nth-child(3),
        .table-main-customer thead.refund-thead .last-row th:nth-child(3) {
            left: 90px;
            z-index: 2;
        }

        .table-main-customer thead.refund-thead .first-row th:nth-child(4),
        .table-main-customer thead.refund-thead .last-row th:nth-child(4) {
            left: 190px;
            z-index: 2;
        }

        .table-main-customer thead.refund-thead .first-row th:nth-child(5),
        .table-main-customer thead.refund-thead .last-row th:nth-child(5) {
            left: 290px;
            z-index: 2;
        }

        .table-main-customer thead.refund-thead .first-row th:nth-child(6),
        .table-main-customer thead.refund-thead .last-row th:nth-child(6) {
            left: 390px;
            z-index: 2;
        }

        .table-main-customer thead.refund-thead .first-row th:nth-child(7),
        .table-main-customer thead.refund-thead .last-row th:nth-child(7) {
            left: 510px;
            z-index: 2;
        }

        .table-main-customer tbody tr.data-refund td:nth-child(1) {
            left: 0;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-refund td:nth-child(2) {
            left: 40px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-refund td:nth-child(3) {
            left: 90px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-refund td:nth-child(4) {
            left: 190px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-refund td:nth-child(5) {
            left: 290px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-refund td:nth-child(6) {
            left: 390px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-refund td:nth-child(7) {
            left: 510px;
            z-index: 1;
            background-color: #fff;
        }

        thead.refund-thead .last-row th {
            position: -webkit-sticky;
            position: sticky;
            background: #eae7e7;
            color: #fff;
        }
    </style>
@endpush
<col class="width-40" />
<col class="width-50" />
<col class="width-100" />
<col class="width-100" />
<col class="width-100" />
<col class="width-120" />
<col class="width-120" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-120" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-120" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-120" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<col class="width-170" />
<thead class="bg-200 text-900 thead-dark refund-thead">
    <tr class="first-row-head">
        <td class="align-middle" colspan="18"></td>
        <th class="align-middle text-center" colspan="9" scope="colgroup" style="background-color: #bfffff;color:#000">Revenue</th>
        <th class="align-middle text-center" colspan="7" scope="colgroup" style="background-color: #bfbfff;color:#000">Annalink received</th>
        <th class="align-middle text-center" colspan="12" scope="colgroup" style="background-color: #fffe98;color:#000">Commission for Agent</th>
        <th class="align-middle text-center" colspan="6" scope="colgroup" style="background-color: #ffbfff;color:#000">Commission received from provider</th>
        <th class="align-middle text-center" colspan="10" scope="colgroup" style="background-color: #81d881;color:#000">Pay for provider</th>
        <th class="align-middle text-center" colspan="8" scope="colgroup" style="background-color: #ccc;color:#000">Received from provider</th>
        <th class="align-middle text-center" colspan="9" scope="colgroup" style="background-color: #fcd703;color:#000">Pay to client</th>
        <th class="align-middle text-center" colspan="6" scope="colgroup" style="background-color: rgb(216, 208, 208);color:#000">Recall commission from agent</th>
        <th class="align-middle text-center" colspan="5" scope="colgroup" style="background-color: #e7d989;color:#000">Revenue ajustment</th>
    </tr>
    <tr class="first-row">
        <th>
            <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table" />
        </th>
        <th>Action</th>
        <th>Ref No.</th>
        <th>Agent</th>


        <th class="align-middle fixed-side">Country</th>
        <th class="align-middle fixed-side">register</th>
        <th class="align-middle fixed-side">Provider</th>
        <th class="align-middle ">Status</th>
        <th class="align-middle ">Type of Refund</th>
        <th class="align-middle ">Policy Number</th>
        <th class="align-middle ">Type of Service</th>
        <th class="align-middle ">Type of visa</th>
        <th class="align-middle ">Policy</th>
        <th class="align-middle ">Start Date</th>
        <th class="align-middle ">End Date</th>
        <th class="align-middle ">Visa status</th>
        <th class="align-middle ">Months</th>
        <th class="align-middle ">Year</th>

        <!-- Revenue -->
        <th>Profit $</th>
        <th>Extra fee ($)</th>
        <th>Revenue from service</th>
        <th>Revenue from Ex rate (VND)</th>
        <th>Profit VND</th>
        <th>Bank fee (VND)</th>
        <th>GST</th>
        <th>Profit status</th>
        <th>Commission payment status</th>
        <!-- Revenue -->

        <!-- Annalink received -->
        <th>Gross amount</th>
        <th>Promotion ($)</th>
        <th>Surcharge fee</th>
        <th>Total amount ($)</th>
        <th>Exchange rate</th>
        <th>Total amount VND</th>
        <th>Difference</th>
        <!-- Annalink received -->

        <!--  Commission for Agent -->
        <th>Commission rate</th>
        <th>Bonus %</th>
        <th>Amount com</th>
        <th>+/- ($)</th>
        <th>Total amount com ($)</th>
        <th>Exchange rate</th>
        <th>+/- VND</th>
        <th>Amount VNĐ</th>
        <th>Date of payment</th>
        <th>GST Status</th>
        <th>Issue date</th>
        <th>Note</th>
        <!--  Commission for Agent -->

        <!-- Commission received from provider -->
        <th>% Commission received</th>
        <th>Amount ($)</th>
        <th>Exchange rate</th>
        <th>Total amount (vnd)</th>
        <th>Date of receipt</th>
        <th>Note</th>
        <!-- Commission received from provider -->


        <!-- Pay for provider -->
        <th>% Paid</th>
        <th>Amount</th>
        <th>Extend fee</th>
        <th>Bank fee</th>
        <th>Total amount</th>
        <th>Exchange rate</th>
        <th>Total amount VND</th>
        <th>Payment note</th>
        <th>Date of payment</th>
        <th>Bank account</th>


        <!-- Received from provider -->
        <th>Type of refund</th>
        <th>Amount</th>
        <th>Exchange rate</th>
        <th>Amount (VND)</th>
        <th>Paid date</th>
        <th>Bank</th>
        <th>Commission</th>
        <th>Situation</th>
        <!-- Received from provider -->

        <!-- Pay to client -->
        <th>Amount</th>
        <th>Deduction ($)</th>
        <th>Bank fee ($)</th>
        <th>Total amount ($)</th>
        <th>Exchange rate</th>
        <th>Amount VND</th>
        <th>Date of payment</th>
        <th>Note</th>
        <th>Balance</th>
        <!-- Pay to client -->

        <!-- Recall commission from agent -->
        <th>% com</th>
        <th>Amount com</th>
        <th>Exchange rate</th>
        <th>Amount VND</th>
        <th>Status</th>
        <th>Note</th>
        <!-- Recall commission from agent -->

        <!-- Revenue ajustment -->
        <th>Request date</th>
        <th>Status refund</th>
        <th>Extra fee</th>
        <th>Profit VND</th>
        <th>Profit VND</th>
        <!-- Revenue ajustment -->
    </tr>
    @include('CRM.elements.customers.filter.refund')
</thead>
@push('scripts')
    @include('CRM.elements.customers.partials.js.script-loading',[
        'elementFilterIds'=>
        [
            'ref_no',
            'agent_id',
            'country_id',
            'register',
            'provider_id',
            'status',
            'policy_no',
            'type_service',
            'type_visa',
            'policy',
            'start_date',
            'end_date',
            'visa_status',
            'visa_month',
            'visa_year',
            'profit_status',
            'commission_payment_status',
            'payment_note_provider',
            'date_payment',
            'bank_account',
            'pay_agent_date',
            'date_of_receipt',
            'note_of_receipt',
            'refund_provider_date',
            'std_date_apyment',
            'std_note',
            'note2',
            'request_date',
            'std_status'
        ],
        'tab'=>$tab,
        'element_class_btn_row_edit'=>'refund_data_edit',
        'element_id_row_edit'=>'data-refund'
    ])
@endpush
