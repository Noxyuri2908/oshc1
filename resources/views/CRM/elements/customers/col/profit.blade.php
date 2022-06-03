@push('css')
    <style>
        .first-row-head th {
            position: sticky;
            left: 0;
        }
        .table-main-customer thead.profit-thead .first-row {
            top: 0px;
        }

        .table-main-customer thead.profit-thead .last-row {
            top: 25px;
        }

        .table-main-customer thead.profit-thead .first-row th:first-child,
        .table-main-customer thead.profit-thead .last-row th:first-child {
            left: 0;
            z-index: 2;
        }

        .table-main-customer thead.profit-thead .first-row th:nth-child(2),
        .table-main-customer thead.profit-thead .last-row th:nth-child(2) {
            left: 40px;
            z-index: 3;
        }

        .table-main-customer thead.profit-thead .first-row th:nth-child(3),
        .table-main-customer thead.profit-thead .last-row th:nth-child(3) {
            left: 90px;
            z-index: 2;
        }

        .table-main-customer thead.profit-thead .first-row th:nth-child(4),
        .table-main-customer thead.profit-thead .last-row th:nth-child(4) {
            left: 190px;
            z-index: 2;
        }

        .table-main-customer thead.profit-thead .first-row th:nth-child(5),
        .table-main-customer thead.profit-thead .last-row th:nth-child(5) {
            left: 290px;
            z-index: 2;
        }

        .table-main-customer thead.profit-thead .first-row th:nth-child(6),
        .table-main-customer thead.profit-thead .last-row th:nth-child(6) {
            left: 390px;
            z-index: 2;
        }

        .table-main-customer thead.profit-thead .first-row th:nth-child(7),
        .table-main-customer thead.profit-thead .last-row th:nth-child(7) {
            left: 510px;
            z-index: 2;
        }

        .table-main-customer tbody tr.data-profit td:nth-child(1) {
            left: 0;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-profit td:nth-child(2) {
            left: 40px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-profit td:nth-child(3) {
            left: 90px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-profit td:nth-child(4) {
            left: 190px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-profit td:nth-child(5) {
            left: 290px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-profit td:nth-child(6) {
            left: 390px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr.data-profit td:nth-child(7) {
            left: 510px;
            z-index: 1;
            background-color: #fff;
        }
        thead.profit-thead .last-row th {
            position: -webkit-sticky;
            position: sticky;
            background: #eae7e7;
            color: #fff;
        }
    </style>
@endpush

<col class="width-40"/>
<col class="width-50"/>
<col class="width-100"/>
<col class="width-100"/>
<col class="width-100"/>
<col class="width-120"/>
<col class="width-120"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-120"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-200"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-120"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-120"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>
<col class="width-170"/>

<thead class="bg-200 text-900 thead-dark profit-thead">
    <tr class="first-row-head">
        <th class="align-middle" colspan="17"></th>
        <th class="align-middle text-center" colspan="9" scope="colgroup" style="background-color: #bfffff;color:#000">
            Revenue
        </th>
        <th class="align-middle text-center" colspan="8" scope="colgroup" style="background-color: #bfbfff;color:#000">
            Annalink received
        </th>
        <th class="align-middle text-center" colspan="12" scope="colgroup" style="background-color: #fffe98;color:#000">
            commission for agent
        </th>
        <th class="align-middle text-center" colspan="6" scope="colgroup" style="background-color: #ffbfff;color:#000">
            Commission from Provider
        </th>
        <th class="align-middle text-center" colspan="10" scope="colgroup" style="background-color: #81d881;color:#000">
            Pay for provider
        </th>
    </tr>
    <tr class="first-row">
        <th class="align-middle fixed-side">
            <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table"/>
        </th>
        <th class="align-middle fixed-side">Action</th>
        <th class="align-middle fixed-side">Ref No.</th>
        <th class="align-middle fixed-side width-200">Agent</th>
        <th class="align-middle fixed-side">Country</th>
        <th class="align-middle fixed-side">Register</th>
        <th class="align-middle fixed-side">Provider</th>
        <th class="align-middle width-80">Status</th>
        <th class="align-middle ">Policy Number</th>
        <th class="align-middle ">Type of Service</th>
        <th class="align-middle ">Type of visa</th>
        <th class="align-middle ">Policy</th>
        <th class="align-middle ">Start Date</th>
        <th class="align-middle ">End Date</th>
        <th class="align-middle ">Visa status</th>
        <th class="align-middle width-80">Months</th>
        <th class="align-middle width-80">Year</th>

        <!-- Profit 1 -->
        <th>Profit $</th>
        <th>Extra fee ($)</th>
        <th>Revenue from service</th>
        <th>Revenue from Ex rate (VND)</th>
        <th>Profit VND</th>
        <th>Bank fee (VND)</th>
        <th class="width-80">GST</th>
        <th>Profit status</th>
        <th>Com payment status</th>
        <!-- Profit 1 -->

        <!-- Annalink received -->
        <th class="width-110">Gross amount</th>
        <th class="width-90">Promotion ($)</th>
        <th class="width-80">Surcharge fee</th>
        <th class="width-100">Discount</th>
        <th>Total amount ($)</th>
        <th class="width-80">Exchange rate</th>
        <th>Total amount receive</th>
        <th>Difference ($)</th>
        <!-- Annalink received -->

        <!-- Pay commission for User/Cousellor -->
        <th>Commission rate</th>
        <th class="width-80">Bonus %</th>
        <th>Amount com</th>
        <th class="width-80">+/- ($)</th>
        <th>Total amount com ($)</th>
        <th>Exchange rate</th>
        <th>+ / - VND</th>
        <th>Amount VND</th>
        <th>Date of payment</th>
        <th>GST Status</th>
        <th>Issue Date</th>
        <th>Note</th>
        <!-- Pay commission for User/Cousellor -->

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
        <th class="width-80">Bank fee</th>
        <th class="width-110">Total amount</th>
        <th>Exchange rate</th>
        <th>Total amount VND</th>
        <th class="width-125">Provider</th>
        <th>Payment note</th>
        <th>Date of payment</th>
        <th>Bank account</th>
        <!-- Profit 1 -->

    </tr>
    @include('CRM.elements.customers.filter.profit')
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
            'profit_money',
            'extra_fee',
            'revenue_from_service',
            'revenue_from_ex_rate',
            'profit_vnd',
            'bank_fee_vnd',
            'gst',
            'net_amount',
            'promotion_amount',
            'extra',
            'total_amount',
            'difference',
            'pay_agent_total_amount',
            'commission_rate',
            'bonus',
            'amount_com',
            'deduction',
            'total_amount_com',
            'exchange_rate',
            'vnd',
            'amount_vnd',
            'date_of_payment',
            'gst_status',
            'amount',
            'exchange_rate_comm',
            'total_amount_comm',
            'date_of_receipt',
            'note',
            'pay_provider_paid',
            'pay_provider_amount',
            'extend_fee',
            'pay_provider_bank_fee',
            'pay_provider_total_amount',
            'pay_provider_exchange_rate',
            'pay_provider_total_VN',
            'provider_name',
            'date_of_payment_pay'
        ],
        'tab'=>$tab,
                        'element_class_btn_row_edit'=>'profit_data_edit',
        'element_id_row_edit'=>'data-profit'
    ])
    <script>
        $('#country_id_filter').select2();
    </script>
@endpush
