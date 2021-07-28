@foreach($data as $tmp)
    @php
        $commission = $tmp->invoice->getCom();
        if($commission == null) $val_comm = "0%";
        else{
            $donvi = isset(config('myconfig.donvi')[$commission->donvi]) ? config('myconfig.donvi')[$commission->donvi] : '%';
            $val_comm = $commission->comm.$donvi;
        }
    @endphp
    <tr class="data-commission" id="data-commission_{{$tmp->id}}" data-id="{{$tmp->invoice->id}}">
        <td class="sticky-col">
            <input class="ml-3 sub_chk" data-id="{{$tmp->id}}" type="checkbox" aria-label="Checkbox for tdis row"/>
        </td>
        <td class="sticky-col second-col">
            <div class="dropdown text-sans-serif ">
                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-dropdown-z-index" type="button"
                        id="dropdownMenuButtonCommission" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonCommission">
                    {{-- <a class="dropdown-item invoice_info" style="cursor: pointer;" data-id="{{$tmp->invoice->id}}">View</a> --}}
                    @can('commissionInvoice.edit')
                        <a class="dropdown-item commission_data_edit" data-url_edit="{{route('ajax.customer.showData',['tab'=>'com','id'=>$tmp->id])}}"
                           href="{{route('customer.process.index',['id'=>$tmp->invoice->id,'tab'=>3,'tab_link'=>3,'page'=>request()->get('page')])}}">Edit</a>
                    @endcan

                    <a class="dropdown-item"
                       href="{{route('customer.process.index',['id'=>$tmp->invoice->id,'tab'=>1,'tab_link'=>1,'page'=>request()->get('page')])}}"
                       target="_blank">Process</a>
                    {{-- <a class="dropdown-item export_invoice" data-id="{{$tmp->invoice->id}}" style="cursor: pointer;">Export Invoice</a> --}}
                    @can('commissionInvoice.delete')
                        <a class="dropdown-item text-danger" id="on_delete_data" data-type="comm"
                           data-url="{{route('crm.hoahong.delete',['id'=>$tmp->id])}}" data-id="{{$tmp->id}}" href="#!">Delete</a>
                    @endcan
                </div>
            </div>
        </td>
        <td class="sticky-col"><a>{{$tmp->invoice->ref_no}}</a></td>
        <td class=" sticky-col white-space-break-spaces"><a style="cursor: pointer; color: red" class="agent_info"
                                                            data-id={{!empty($tmp->invoice) && !empty($tmp->invoice->agent)? $tmp->invoice->agent->id : ''}}>{{!empty($tmp->invoice) && !empty($tmp->invoice->agent)? $tmp->invoice->agent->name : ''}}</a>
        </td>
        <td class=" sticky-col white-space-break-spaces">{{!empty($tmp->invoice) && !empty($tmp->invoice->agent) ? $tmp->invoice->agent->country() : ''}}</td>
        <td class=" sticky-col white-space-break-spaces">{{!empty($tmp->invoice) &&!empty($tmp->invoice->registerCus())? $tmp->invoice->registerCus()->first_name." ".$tmp->invoice->registerCus()->last_name : ''}}</td>
        <td class=" sticky-col white-space-break-spaces">{{(!empty($tmp->invoice))?convert_price_float($tmp->invoice->net_amount):''}}</td>
        <td class="">{{(!empty($tmp->invoice))?convert_price_float($tmp->invoice->promotion_amount):''}}</td>
        <td class="">{{ !empty($tmp->invoice) && isset(config('myconfig.bank_fee')[$tmp->invoice->bank_fee])? convert_price_float($tmp->invoice->net_amount*$tmp->invoice->bank_fee) : ''}}</td>
        <td class="">{{(!empty($tmp->invoice))?convert_price_float($tmp->invoice->surcharge):''}}</td>
        <td class="">{{(!empty($tmp->invoice))?convert_price_float($tmp->invoice->total):''}}</td>
        <td class="">{{(!empty($tmp->invoice)) && !empty($tmp->invoice->provider) ? $tmp->invoice->provider->name : ''}}</td>
        <td class="">{{!empty($tmp->invoice) && isset(config('myconfig.status_invoice')[$tmp->invoice->status]) ? config('myconfig.status_invoice')[$tmp->invoice->status] : ''}}</td>
        <td class="">{{!empty($tmp->invoice) && $tmp->invoice->service != null ? $tmp->invoice->service->name : ''}}</td>
        <td class="">{{!empty($tmp->invoice) && isset(config('myconfig.service_country')[$tmp->invoice->service_country]) ? config('myconfig.service_country')[$tmp->invoice->service_country] : ''}}</td>
        <td class="">{{isset(config('myconfig.status_visa')[$tmp->visa_status]) ? config('myconfig.status_visa')[$tmp->visa_status] : ''}}</td>
        <td class="">{{$tmp->hoahong_month}}</td>
        <td class="">{{$tmp->hoahong_year}}</td>
        <td class="">{{!empty($tmp->date_payment_provider)?\Carbon::parse($tmp->date_payment_provider)->format('d/m/Y'):''}}</td>
        <td class="">{{$tmp->account_bank}}</td>
        <td class="">{{!empty($tmp->date_payment_agent)?\Carbon::parse($tmp->date_payment_agent)->format('d/m/Y'):''}}</td>
        <td class="">{{$tmp->policy_no}}</td>
        <td class="">{{$val_comm}}</td>
        <td class="">{{!empty($tmp->issue_date)?\Carbon::parse($tmp->issue_date)->format('d/m/Y'):''}}</td>
        <td class="">{{isset(config('myconfig.policy_status')[$tmp->policy_status]) ? config('myconfig.policy_status')[$tmp->policy_status] : ''}}</td>
        <td class="">{{isset(config('myconfig.payment_note_provider')[$tmp->payment_note_provider]) ? config('myconfig.payment_note_provider')[$tmp->payment_note_provider] : ''}}</td>
        <td class="">{{$tmp->extra_money}} {{isset(config('myconfig.currency')[$tmp->unit_money]) ? config('myconfig.currency')[$tmp->unit_money] : ''}}</td>
        <td class="">{{!empty($tmp->extra_time)?\Carbon::parse($tmp->extra_time)->format('d/m/Y'):''}}</td>
        <td class="">{{(!empty($tmp->invoice))?convert_price_float($tmp->invoice->phieuthus->sum('amount')):''}}</td>
        <td class="">{{$tmp->note}}</td>
        <td class="">{{$tmp->creater != null ? $tmp->creater->username : ''}}</td>
        <td class="">{{!empty($tmp->created_at)?Carbon::parse($tmp->created_at)->format('d/m/Y'):''}}</td>
    </tr>
@endforeach
