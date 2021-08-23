@foreach($data as $tmp)
    @php
        $invoice = $tmp->invoice;
        $agent = $invoice->agent;
        $profit = $invoice->profit->first();
        $refund = $invoice->refund->first();
        $cus = $invoice->customers->first();
        $difference = !empty($invoice) ? $invoice->difference : '';


        $providerCom = $invoice->getProviderCom();
        if($profit != null && $agent != null && $providerCom != null && $refund != null){
        $_total_amount = !empty($invoice) ? $invoice->total : '';
        $sum_amount = $invoice->phieuthus->sum('amount');
        $sum_bank_fee =  $invoice->phieuthus->sum('bank_fee');
        $currency = $invoice->provider != null ? $invoice->provider->currency() : '';
        $phieuthu_old_exchange_rate = (!empty($invoice) && floatval($invoice->net_amount + $sum_bank_fee) != 0)?round(floatval((floatval($sum_amount)/floatval($invoice->net_amount + $sum_bank_fee))), 2):0;


        $hh = $invoice->hhs->first();
        if($hh != null){
        $payment_note = $hh->payment_note_provider;
        $text_com = null;
        if($payment_note == 1){
        $comm = $invoice->getCom();
        if($comm != null){
        $text_com =  $comm->comm;
        $donvi = $comm->donvi;
        $text_donvi = $donvi == 1 ? '%' : '$';
        }
        }

        if($payment_note == 1) $provider_com = $providerCom->textCom();
        else $provider_com = '100%';


        if($providerCom->type == 1){
        switch ($payment_note) {
        case '1':
        $re_total_amount = number_format(floatval($invoice->net_amount)*floatval($providerCom->amount)/100);
        break;
        default:
        $re_total_amount = number_format($providerCom->amount);
        break;
        }
        }else{
        $re_total_amount = number_format(floatval($invoice->net_amount));
        }
        ;
        }
        }

    @endphp

    @if($agent != null && isset($hh) && isset($comm) && $hh != null && $comm != null && $providerCom != null && $refund != null && $profit != null)
        <tr class="data-refund" id="data-refund_{{$tmp->id}}" data-id="{{$invoice->id}}">
            <td class="align-middle sticky-col">
                <input class="ml-3 sub_chk" data-id="{{$tmp->id}}" type="checkbox" aria-label="Checkbox for tdis row" />
            </td>
            <td class="align-middle sticky-col second-col">
                <div class="dropdown text-sans-serif">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fas fa-ellipsis-h fs--1"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @can('refundInvoice.edit')
                            <a class="dropdown-item refund_data_edit" data-id="{{$tmp->id}}" data-url_edit="{{route('ajax.customer.showData',['tab'=>'refund','id'=>$tmp->id])}}"
                               href="{{route('customer.process.index',['id'=>$invoice->id, 'tab'=>5,'tab_link'=>5])}}">Edit</a>
                        @endcan
                        {{-- <a class="dropdown-item" href="{{route('customer.process.index',['id'=>$invoice->id, 'tab'=>1])}}" target="_blank">Process</a> --}}
                        {{-- <div class="dropdown-divider"> </div> --}}
                        {{-- <a class="dropdown-item export_invoice" data-id="{{$invoice->id}}" style="cursor: pointer;">Export Invoice</a> --}}
                        {{-- <div class="dropdown-divider"> </div> --}}
                        @can('refundInvoice.delete')
                            <a class="dropdown-item text-danger " id="on_delete_data" data-type="refund"
                               data-url="{{route('crm.ajax.deleteRefund',['id'=>$tmp->id])}}" data-id="{{$tmp->id}}"
                               href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </td>
            <td class="align-middle sticky-col"><a>{{$invoice->ref_no}}</a></td>
            <td class="align-middle sticky-col"><a style="cursor: pointer; color: red" class="agent_info"
                                                   data-id={{$invoice->agent != null ? $invoice->agent->id : ''}}>{{$invoice->agent != null ? $invoice->agent->name : ''}}</a>
            </td>
            <td class="align-middle sticky-col">{{(!empty($tmp->invoice) && !empty($tmp->invoice->agent))?$tmp->invoice->agent->country():''}}</td>
            <td class="align-middle sticky-col">{{!empty($tmp->invoice) && $tmp->invoice->registerCus() != null ? $tmp->invoice->registerCus()->first_name." ".$tmp->invoice->registerCus()->last_name : ''}}</td>
            <td class="align-middle sticky-col">{{!empty($tmp->invoice) && $tmp->invoice->provider != null ? $tmp->invoice->provider->name : ''}}</td>
            <td class="align-middle">{{!empty($tmp->invoice) && isset(config('myconfig.status_invoice')[$tmp->invoice->status]) ? config('myconfig.status_invoice')[$tmp->invoice->status] : ''}}</td>
            <td class="align-middle">{{!empty($tmp->refund_type_of_refund_pp) ? $tmp->getTypeOfRefund() : ''}}</td>
            <td class="align-middle">{{!empty($hh)?$hh->policy_no:''}}</td>
            <td class="align-middle">{{!empty($tmp->invoice) && $tmp->invoice->service != null ? $tmp->invoice->service->name : ''}}</td>
            <td class="align-middle">{{!empty($tmp->invoice)?$tmp->invoice->visaName():''}}</td>
            <td class="align-middle">{{!empty($tmp->invoice)?$tmp->invoice->policyName():''}}</td>
            <td class="align-middle">{{!empty($tmp->invoice)?\Carbon::parse($tmp->invoice->start_date)->format('d/m/Y'):''}}</td>
            <td class="align-middle">{{!empty($tmp->invoice)?\Carbon::parse($tmp->invoice->end_date)->format('d/m/Y'):''}}</td>
            <td class="align-middle">{{(!empty($tmp->invoice) && !empty($profit) && !empty($profit->statusVisaText()))?$profit->statusVisaText():''}}</td>
            <td class="align-middle">{{(!empty($tmp->invoice) && !empty($profit))?$profit->visa_month:''}}</td>
            <td class="align-middle">{{(!empty($tmp->invoice) && !empty($profit))?$profit->visa_year:''}}</td>

            <!-- Revenue -->
                <td style="background-color: #bfffff" title="Profit 1">{{convert_price_float($profit->profit_money)}}</td>
                <td style="background-color: #bfffff" title="Profit 1">{{convert_price_float($profit->profit_extra_money)}}</td>
                <td style="background-color: #bfffff" title="Profit 1">{{convert_price_float($profit->profit_total)}}</td>
                <td style="background-color: #bfffff" title="Profit 1">{{convert_price_float($profit->profit_exchange_rate)}}</td>
                <td style="background-color: #bfffff" title="Profit 1">{{convert_price_float($profit->profit_money_VND)}}</td>
                <td style="background-color: #bfffff" title="Profit 1">{{convert_price_float($profit->profit_bankfee_VND)}}</td>
                <td style="background-color: #bfffff" title="Profit 1">{{convert_price_float($profit->gst)}}</td>
                <td style="background-color: #bfffff" title="Profit 1">{{$profit->profit_status == 1 ? 'Done' : ($profit->profit_status == 2 ? 'Refund' : '')}}</td>
                <td style="background-color: #bfffff" title="Profit 1">{{$profit->comm_status == 1 ? 'Done' : ($profit->comm_status == 2 ? 'Refund' : '')}}</td>
            <!-- Revenue -->

            <!-- Annalink received -->
                <td style="background-color: #bfbfff"
                    title="Annalink received ">{{convert_price_float($invoice->net_amount)}} {{$currency}}</td>
                <td style="background-color: #bfbfff"
                    title="Annalink received ">{{convert_price_float($invoice->promotion_amount)}} {{$currency}}</td>
                <td style="background-color: #bfbfff"
                    title="Annalink received ">{{convert_price_float($invoice->bank_fee_number + $cus->extend_fee)}} {{$currency}}</td>
                <td style="background-color: #bfbfff"
                    title="Annalink received ">{{convert_price_float($_total_amount)}} {{$currency}}</td>
                <td style="background-color: #bfbfff"
                    title="Annalink received ">{{convert_price_float($phieuthu_old_exchange_rate)}}</td>
                <td style="background-color: #bfbfff" title="Annalink received ">{{convert_price_float($sum_amount)}} VNĐ</td>
                <td style="background-color: #bfbfff" title="Annalink received ">{{convert_price_float($difference)}} VNĐ</td>
            <!-- Annalink received -->

            <!--  Commission for Agent -->
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{(!empty($comm) && !empty($text_donvi))?$comm->comm.' '.$text_donvi:''}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{$profit->pay_agent_bonus}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{convert_price_float($profit->invoice->comm)}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{convert_price_float($profit->pay_agent_deduction)}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{convert_price_float($profit->pay_agent_total_amount)}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{convert_price_float($profit->pay_agent_exchange_rate)}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{convert_price_float($profit->vnd)}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{convert_price_float($profit->pay_agent_amount_VN)}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{\Carbon::parse($profit->pay_agent_date)->format('d/m/Y')}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{$profit->gst_status_agent_profit == 1 ? 'Included' : (($profit->gst_status_agent_profit == 2) ? 'Not included ' : '')}}</td>
                <td style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">{{\Carbon::parse($profit->issue_date_com_agent)->format('d/m/Y')}}</td>
                <td class="align-middle text-overflow" style="background-color: #fffe98" title="Pay commission for Agent/Cousellor">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#note_cp_{{$profit->id}}">{{$profit->note_cp}}</a>
                    <div class="modal fade" id="note_cp_{{$profit->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Note</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="    white-space: break-spaces;">{{$profit->note_cp}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            <!--  Commission for Agent -->

            <!-- Commission received from provider -->
                <td style="background-color: #ffbfff" title="Commission received from provider">{{$provider_com}}</td>
                <td style="background-color: #ffbfff"
                    title="Commission received from provider">{{(!empty($profit))?convert_price_float($profit->re_total_amount):''}}</td>
                <td style="background-color: #ffbfff"
                    title="Commission received from provider">{{(!empty($profit))?convert_price_float($profit->exchange_rate_re_provider):''}}</td>
                <td style="background-color: #ffbfff"
                    title="Commission received from provider">{{(!empty($profit))?convert_price_float($profit->re_total_amount_vn):''}}</td>
                <td style="background-color: #ffbfff"
                    title="Commission received from provider">{{(!empty($profit))?\Carbon::parse($profit->date_of_receipt)->format('d/m/Y'):''}}</td>
                <td style="background-color: #ffbfff" title="Commission received from provider" class="text-overflow">
                <a href="" data-toggle="modal" data-target="#note_of_re_{{$profit->id}}">{{$profit->note_of_receipt}}</a>
                <div class="modal fade" id="note_of_re_{{$profit->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Note of receipt</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p style="    white-space: break-spaces;">{{$profit->note_of_receipt}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <!-- Commission received from provider -->

            <!-- Pay for provider -->
                <td style="background-color: #81d881"
                    title="Pay for provider">{{ convert_price_float($profit->pay_provider_paid) }}</td>
                <td style="background-color: #81d881"
                    title="Pay for provider">{{ convert_price_float($profit->pay_provider_amount) }} {{$currency}}</td>
                <td style="background-color: #81d881"
                    title="Pay for provider">{{ convert_price_float($cus->extend_fee) }} {{$currency}}</td>
                <td style="background-color: #81d881"
                    title="Pay for provider">{{ isset(config('myconfig.bank_fee')[$profit->pay_provider_bank_fee]) ? config('myconfig.bank_fee')[$profit->pay_provider_bank_fee] : ''}}</td>
                <td style="background-color: #81d881"
                    title="Pay for provider">{{ convert_price_float($profit->pay_provider_total_amount) }}</td>
                <td style="background-color: #81d881"
                    title="Pay for provider">{{ convert_price_float($profit->pay_provider_exchange_rate) }}</td>
                <td style="background-color: #81d881"
                    title="Pay for provider">{{ convert_price_float($profit->pay_provider_total_VN) }}</td>
                <td style="background-color: #81d881"
                    title="Pay for provider">{{ !empty($payment_note) && !empty(config('myconfig.payment_note_provider')[$payment_note]) ? config('myconfig.payment_note_provider')[$payment_note] : ''}}</td>
                <td style="background-color: #81d881"
                    title="Pay for provider">{{ !empty($profit->pay_provider_date)?\Carbon::parse($profit->pay_provider_date)->format('d/m/Y'):'' }}</td>
                <td style="background-color: #81d881" title="Pay for provider">{{ $profit->pay_provider_bank_account }}</td>
            <!-- Pay for provider -->


            <!-- Provider paid -->
                @php
                    $providerPaidAmountVND = $refund->refund_provider_amount * $refund->refund_provider_exchange_rate;
                @endphp

                <td>{{$configTypeOfRefund[$refund->refund_type_of_refund_pp]}}</td>
                <td>{{(!empty($refund))?convert_price_float($refund->refund_provider_amount):'' }}</td>
                <td>{{(!empty($refund))?convert_price_float($refund->refund_provider_exchange_rate):'' }}</td>
                <td>{{$providerPaidAmountVND != null ? convert_price_float($providerPaidAmountVND) : ''}}</td>
                <td>{{$refund != null ? \Carbon::parse($refund->refund_provider_date)->format('d/m/Y') : ''}}</td>
                <td>{{!empty(getBank($refund->refund_bank_pp)) ? getBank($refund->refund_bank_pp)->account : ''}}</td>
                <td>{{$refund != null ? $refund->commission : ''}}</td>
                <td>{{$refund != null ? $refund->refund_situation_pp : ''}}</td>
            <!-- Provider paid -->


            <!-- Pay to client -->
            <td>{{$refund != null ? $refund->std_amount : ($obj->net_amount - $obj->promotion_amount - $obj->extra)}}</td>
            <td>{{(!empty($refund))?convert_price_float($refund->std_deduction):''}}</td>
            <td>{{(!empty($refund))?convert_price_float($refund->bank_fee):''}}</td>

            <td>{{(!empty($refund))?convert_price_float($refund->total_amount_pay_back_student_refund):''}}</td>
            <td>{{convert_price_float($refund->std_exchange_rate)}}</td>
            <td>{{convert_price_float($refund->std_refund_VND)}}</td>

            <td>{{(!empty($refund))?\Carbon::parse($refund->std_date_apyment)->format('d/m/Y'):''}}</td>
            <td class="text-overflow">
                <a href="" data-toggle="modal" data-target="#std_note_{{$refund->id}}">{{$refund->std_note}}</a>
                <div class="modal fade" id="std_note_{{$refund->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Note of receipt</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p style="    white-space: break-spaces;">{{$refund->std_note}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>{{(!empty($refund))?$refund->balance:''}}</td>
            <!-- Pay to client -->

            <!-- Recall commission from agent -->
                <td>{{$comm->comm}} %</td>
                <td>{{convert_price_float($refund->refund_amount_com_agent_gbcfa)}}</td>
                <td>
                    @if(!empty($refund))
                        {{convert_price_float($refund->refund_exchange_rate_agent)}}
                    @elseif(!empty($profit))
                        {{convert_price_float($profit->pay_agent_exchange_rate)}}
                    @endif
                </td>
                <td>
                    @if(!empty($refund))
                        {{convert_price_float($refund->refund_agent_vnd)}}
                    @elseif(!empty($profit))
                        {{convert_price_float($profit->pay_agent_amount_VN)}}
                    @endif
                </td>
                <td>{{config('myconfig.status_refund_recall')[$refund->status]}}</td>
                <td  class="text-overflow">
                    <a href="" data-toggle="modal" data-target="#note_2_{{$refund->id}}">{{$refund->note2}}</a>
                    <div class="modal fade" id="note_2_{{$refund->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Note of receipt</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="    white-space: break-spaces;">{{$refund->note2}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            <!-- Recall commission from agent -->

            <!-- Revenue ajustment -->
            <td>{{ (!empty($refund))?\Carbon::parse($refund->request_date)->format('d/m/Y'):'' }}</td>
            <td>{{ isset(config('myconfig.status_refund')[$refund->std_status]) ? config('myconfig.status_refund')[$refund->std_status] : '' }}</td>
            <td>{{ (!empty($refund))?convert_price_float($refund->extra_fee):'' }}</td>
            <td>{{ (!empty($refund))?convert_price_float($refund->refund_profit_2):'' }}</td>
            <td>{{ (!empty($refund))?convert_price_float($refund->refund_profit_2_VN):'' }}</td>
            <!-- Revenue ajustment -->
        </tr>
    @endif
@endforeach
