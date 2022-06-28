@extends('CRM.layouts.default')

@section('title')
    Approved Com Report
    @parent
@stop

@section('css-report')
    <link rel="stylesheet" href="{{asset('public/backend_CRM/css/commissionReport/index.css')}}">
@stop
@section('content')
    <div class="card" style="border-bottom: 2px solid #ccc;">

    </div>

    <!--  table data approve com  -->
    <div class="card">
        <div class="card-body" style="overflow-x: auto">
            <div class="text-primary py-3 d-flex justify-content-between">
                <div>
                    <div class="d-inline-flex flex-center"><span class="text-sans-serif"><img
                                style="width: 180px;max-width: 100%;" src="/images/ee420406b20f4951101e.jpg" alt=""></span>
                    </div>
                    <p class="table-name">Preview approved Report</p>
                    <p class="table-description">Date: Start date @if(isset($fromDate)){{ $fromDate }}@endif - End date @if(isset($toDate)){{ $toDate }}@endif</p>
                </div>
            </div>
            <table style="width: 1433px" class="oshc-table-content">
                <thead>
                <tr>
                    <th class="width-100 text-center f-13">Service</th>
                    <th class="width-70 text-center f-13">Full name</th>
                    <th class="width-150 text-center f-13">Provider</th>
                    <th class="width-50 text-center f-13">Policy No</th>
                    <th class="width-50 text-center f-13">Adults</th>
                    <th class="width-210 text-center f-13">Children</th>
                    <th class="width-50 text-center f-13">Start date</th>
                    <th class="width-100 text-center f-13">End date</th>
                    <th class="width-110 text-center f-13">Gross amount</th>
                    <th class="width-110 text-center f-13">Com %</th>
                    <th class="width-110 text-center f-13">Commission $ (Excluded GST)</th>
                    <th class="width-100 text-center f-13">GST</th>
                    <th class="width-110 text-center f-13">Commission $ (Included GST)</th>
                    <th class="width-150 text-center f-13">Bonus $</th>
                    <th class="width-150 text-center f-13">+/- $</th>
                    <th class="width-70 text-center f-13">Recall com</th>
                    <th class="width-70 text-center f-13">Total $</th>
                    <th class="width-210 text-center f-13">Date of policy</th>
                    <th class="width-50 text-center f-13">Commission VND</th>
                    <th class="width-70 text-center f-13">Total VND</th>
                    <th class="width-70 text-center f-13">Com status</th>
                    <th class="width-70 text-center f-13">Visa status</th>
                    <th class="width-70 text-center f-13">Date of payment</th>
                    <th class="width-70 text-center f-13">Exchange rate</th>
                    <th class="width-70 text-center f-13">Note</th>
                </tr>
                </thead>
                <tbody class="table table-bordered" style="background: #F9F9F9">
                @if($previewReports != null)
                @foreach ($previewReports as $previewReport)
                <tr>
                    <td>{{ $previewReport->service }}</td>
                    <td>{{ $previewReport->fullname }}</td>
                    <td>{{ $previewReport->provider }}</td>
                    <td>{{ $previewReport->policy }}</td>
                    <td>{{ $previewReport->no_of_adults }}</td>
                    <td>{{ $previewReport->no_of_children }}</td>
                    <td>{{ $previewReport->start_date }}</td>
                    <td>{{ $previewReport->end_date }}</td>
                    <td>{{ $previewReport->amount }}</td>
                    <td>{{ $previewReport->com_percent }}</td>
                    <td>{{ $previewReport->comm_exc_gst }}</td>
                    <td>{{ $previewReport->gst }}</td>
                    <td>{{ $previewReport->comm_inc_gst }}</td>
                    <td>{{ $previewReport->bonus }}</td>
                    <td>{{ $previewReport->extra }}</td>
                    <td>{{ $previewReport->recall_com }}</td>
                    <td>{{ $previewReport->total_AUD }}</td>
                    <td>{{ $previewReport->date_of_policy }}</td>
                    <td>{{ $previewReport->com }}</td>
                    <td>{{ $previewReport->total }}</td>
                    <td>{{ $previewReport->com_status }}</td>
                    <td>{{ $previewReport->visa_status }}</td>
                    <td>{{ $previewReport->date_of_payment }}</td>
                    <td>{{ $previewReport->exchange_rate }}</td>
                    <td>{{ $previewReport->note }}</td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

@stop

@push('scripts')
@endpush
