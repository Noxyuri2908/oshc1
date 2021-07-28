<table class="table table-md mb-0 table-dashboard fs--1 tab-data-receipt">
    <thead class="bg-200 text-900">
    <tr>
        <th class="status">Action</th>
        <th class="status">Number</th>
        <th class="status">Date of receipt</th>
        <th class="status">Description</th>
        <th class="status">Payer</th>
        <th class="status">Receiver</th>
        <th class="status">Amount</th>
        <th class="status">Unit</th>
        <th class="status">Type of receipt</th>
        <th class="status">Net amount</th>
        <th class="status">Bank fee</th>
        <th class="status">Exchange rate</th>
        <th class="status">Creation date</th>
        <th class="status">Created by</th>
        <th class="status">Edited by</th>
        <th class="status">Edition date</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($phieuthus))
        @php
            $sum_amount = $phieuthus->sum('amount');
            $sum_bank_fee = $phieuthus->sum('bank_fee');
        @endphp
        @foreach($phieuthus as $tmp)
            @php
                    $invoice = $tmp->invoice;
                    $agent = $invoice->agent;
                    $resCus = $invoice->registerCus();
                    $totalInvoice = round(floatval(floatval($invoice->total) - floatval($invoice->bank_fee_number)),2);
            @endphp
                <tr class="edit_phieuthu" data-id="{{$tmp->id}}">
                    <td>
                        <div class="dropdown">
                            <button class=" btn btn-link dropdown-toggle" type="button"
                                    id="dropdownApplyReceipt{{$tmp->id}}"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fas fa-ellipsis-h fs--1"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownApplyReceipt{{$tmp->id}}">
                                <div class="bg-white py-2">
                                    @can('customerReceipt.edit')
                                        <a class="dropdown-item edit-receipt-customer" data-toggle="modal"
                                           data-target="#myModalReceipt" data-id="{{$tmp->id}}"
                                           data-apply_id="{{(!empty($getApply))?$getApply->id:''}}" href="#">Edit</a>
                                    @endcan
                                    @can('customerReceipt.delete')
                                        <a class="dropdown-item text-danger delete-receipt-customer"
                                           data-id="{{$tmp->id}}"
                                           data-apply_id="{{(!empty($getApply))?$getApply->id:''}}" href="#!">Delete</a>
                                    @endcan

                                </div>
                            </div>
                        </div>
                    </td>
                    <td>{{$tmp->code}}</td>
                    <td>{{convert_date_form_db($tmp->date_receipt)}}</td>
                    <td>{{$tmp->note}}</td>
                    <td>{{$tmp->payer}}</td>
                    <td>{{$tmp->creater != null ? $tmp->creater->username : ''}}</td>
                    <td>{{convert_price_float($tmp->amount)}}</td>
                    <td>{{isset(config('myconfig.currency')[$tmp->current_id]) ? config('myconfig.currency')[$tmp->current_id] : ''}}</td>
                    <td>{{isset(config('myconfig.type_receipt')[$tmp->type]) ? config('myconfig.type_receipt')[$tmp->type] : ''}}</td>
                    <td>{{convert_price_float($tmp->receipt_net_amount)}}</td>
                    <td>{{convert_price_float($tmp->bank_fee)}}</td>
{{--                    <td>{{convert_price_float(round($sum_amount/($totalInvoice+ $tmp->bank_fee), 2))}}</td>--}}
                    <td>{{$tmp->exchange_rate}}</td>
                    <td>{{convert_date_form_db($tmp->created_at)}}</td>
                    <td>{{$tmp->creater != null ? $tmp->creater->username : ''}}</td>
                    <td>{{$tmp->updater != null ? $tmp->updater->username : ''}}</td>
                    <td>{{convert_date_form_db($tmp->updated_at)}}</td>
                </tr>
        @endforeach
    @else
        <tr>
            <td colspan="16">No data !</td>
        </tr>
    @endif
    </tbody>
</table>
