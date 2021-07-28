@foreach($data as $tmp)
    @php
        if(!empty($tmp->end_date)){
            if(\Carbon::parse($tmp->end_date)->diffInDays(\Carbon::now()) >= 0 && \Carbon::parse($tmp->end_date)->diffInDays(\Carbon::now()) <= 30){
                $color = 'orange';
            }elseif(\Carbon::parse($tmp->end_date)->diffInDays(\Carbon::now()) >= 31 && \Carbon::parse($tmp->end_date)->diffInDays(\Carbon::now()) <= 60 ){
                $color = 'yellow';
            }elseif(\Carbon::parse($tmp->end_date)->diffInDays(\Carbon::now()) >= 61 && \Carbon::parse($tmp->end_date)->diffInDays(\Carbon::now()) <= 90 ){
                $color = 'pink';
            }else{
                $color = '#fff';
            }
        }
        if(!empty($tmp->remind_status)){
            $remindStatus = json_decode($tmp->remind_status,true);
        }else{
            $remindStatus = null;
        }

    @endphp
    <tr class="data-customer" id="data-customer_{{$tmp->id}}" is-render='false' data-id="{{$tmp->id}}">
        <td class="align-middle" data-fixed-columns="true" data-fixed-number="1">
            <input class="ml-3 sub_chk" data-id="{{$tmp->id}}"
                   data-email="{{$tmp->registerCus() != null ? $tmp->registerCus()->email:''}}"
                   data-name="{{$tmp->registerCus() != null ? $tmp->registerCus()->first_name.' '.$tmp->registerCus()->last_name : ''}}"
                   type="checkbox" aria-label="Checkbox for tdis row"/>
        </td>
        <td class="align-middle second-col">
            <div class="dropdown">
                <button class=" btn btn-link dropdown-toggle btn-dropdown-z-index" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="overflow: unset">
                    <div class="bg-white py-2">
                        {{--                        edit_invoice--}}
                        @can('extendInvoice.edit')
                            <a class="dropdown-item customer_data_edit" data-id="{{$tmp->id}}" style="cursor: pointer" data-url_edit="{{route('ajax.customer.showData',['tab'=>'extend','id'=>$tmp->id])}}"
                               href="{{route('customer.edit',['id'=>$tmp->id,'page'=>request()->get('page')])}}">Edit</a>
                        @endcan
                        <div class="position-relative process-hover-dropdown">
                            <a class="dropdown-item nav-link dropdown-toggle btn-process-dropdown"
                               style="cursor: pointer">Process &raquo </a>
                            <ul class="submenu dropdown-menu submenu-process" style="left: 157px;top: 0;">
                                @can('commissionInvoice.edit')
                                    <li><a class="dropdown-item"
                                           href="{{route('customer.process.index',['id'=>$tmp->id,'tab'=>3,'tab_link'=>3,'page'=>(!empty(request()->get('page')))?request()->get('page'):1])}}">Commission</a>
                                    </li>
                                @endcan
                                @can('profitInvoice.edit')

                                    <li><a class="dropdown-item"
                                           href="{{route('customer.process.index',['id'=>$tmp->id,'tab'=>4,'tab_link'=>4,'page'=>(!empty(request()->get('page')))?request()->get('page'):1])}}">Profit</a>
                                    </li>
                                @endcan
                                @can('refundInvoice.edit')
                                    <li><a class="dropdown-item"
                                           href="{{route('customer.process.index',['id'=>$tmp->id,'tab'=>5,'tab_link'=>5,'page'=>(!empty(request()->get('page')))?request()->get('page'):1])}}">Refund</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                        <a class="dropdown-item export_invoice" data-id="{{$tmp->id}}" style="cursor: pointer;">Export
                            Invoice</a>
                        @can('extendInvoice.delete')
                            <a class="dropdown-item text-danger modal_delete"
                               data-action="{{route('customer.destroy',['id'=>$tmp->id])}}" href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </td>
        <td class="align-middle">{{$tmp->ref_no}}</td>
        <td class="align-middle">{{convert_date_form_db($tmp->created_at)}}</td>
        <td class="align-middle white-space-break-spaces"><a style="cursor: pointer; color: red" class="agent_info"
                                                             data-id={{$tmp->agent != null ? $tmp->agent->id : ''}}>{{$tmp->agent != null ? $tmp->agent->name : ''}}</a>
        </td>
        <td class="align-middle white-space-break-spaces">{{$tmp->agent != null ? $tmp->agent->country() : ''}}</td>
        <td class="align-middle white-space-break-spaces"><a style="cursor: pointer; color: red" class="customer_info"
                                                             data-id={{$tmp->registerCus() != null ? $tmp->registerCus()->id : ""}}>{{$tmp->registerCus() != null ? $tmp->registerCus()->first_name.' '.$tmp->registerCus()->last_name : ''}}</a>
        </td>
        <td class="align-middle">{{isset(config('myconfig.status_invoice')[$tmp->status]) ? config('myconfig.status_invoice')[$tmp->status] : ''}}</td>

        <td class="align-middle"><a style="cursor: pointer; color: red" class="agent_info"
                                    data-id={{$tmp->master != null ? $tmp->master->id : ''}}>{{$tmp->master != null ? $tmp->master->name : ''}}</a>
        </td>
        <td class="align-middle">{{isset(config('myconfig.service_country')[$tmp->service_country]) ? config('myconfig.service_country')[$tmp->service_country] : ''}}</td>
        <td class="align-middle">{{$tmp->service != null ? $tmp->service->name : ''}}</td>
        <td class="align-middle">{{isset(config('myconfig.type_invoice')[$tmp->type_invoice]) ? config('myconfig.type_invoice')[$tmp->type_invoice] : ''}}</td>
        <td class="align-middle">{{$tmp->provider != null ? $tmp->provider->name : ''}}</td>
        <td class="align-middle">{{isset(config('myconfig.policy')[$tmp->policy]) ? config('myconfig.policy')[$tmp->policy] : ''}}</td>
        <td class="align-middle">{{$tmp->no_of_adults}}</td>
        <td class="align-middle">{{$tmp->no_of_children}}</td>
        <td class="align-middle">{{isset(config('myconfig.type_visa')[$tmp->type_visa]) ? config('myconfig.type_visa')[$tmp->type_visa] : ''}}</td>
        <td class="align-middle">{{\Carbon::parse($tmp->start_date)->format('d/m/Y')}}</td>
        <td class="align-middle">{{\Carbon::parse($tmp->end_date)->format('d/m/Y')}}</td>
        <td class="align-middle"
            style="background-color:{{(!empty($color))?$color:''}}">{{\Carbon::parse($tmp->end_date)->diffInDays(\Carbon::now())}}</td>
        <td class="align-middle">{{(!empty($tmp) && !empty(\Config::get('crm.remind_status')[$tmp->remind_status]['name']))? \Config::get('crm.remind_status')[$tmp->remind_status]['name'] :'' }}</td>
        <td class="align-middle">@foreach($tmp->partners() as $partner)
                <a style="cursor: pointer; color: red" class="customer_info"
                   data-id={{$partner->id}}>{{$partner->first_name.' '.$partner->last_name}}</a><br>
            @endforeach</td>
        <td class="align-middle">@foreach($tmp->childrens() as $partner)
                <a style="cursor: pointer; color: red" class="customer_info"
                   data-id={{$partner->id}}>{{$partner->first_name.' '.$partner->last_name}}</a><br>
            @endforeach</td>
        <td class="align-middle">{{convert_price_float($tmp->net_amount)}}</td>
        <td class="align-middle">{{$tmp->promotion != null ? $tmp->promotion->code : ''}}</td>
        <td class="align-middle">{{number_format($tmp->promotion_amount)}}</td>

        <td class="align-middle">{{isset(config('myconfig.bank_fee')[$tmp->bank_fee]) ? config('myconfig.bank_fee')[$tmp->bank_fee] : ''}}</td>
        <td class="align-middle">{{convert_price_float($tmp->bank_fee_number)}}</td>
        <td class="align-middle">{{isset(config('myconfig.payment_method')[$tmp->payment_method]) ? config('myconfig.payment_method')[$tmp->payment_method] : ''}}</td>
        <td class="align-middle">{{convert_price_float($tmp->surcharge)}}</td>
        <td class="align-middle">{{convert_price_float($tmp->extra)}}</td>
        <td class="align-middle">{{convert_price_float($tmp->comm)}}</td>
        <td class="align-middle">{{convert_price_float($tmp->total)}}</td>
        <td class="align-middle">{{$tmp->staff != null ? $tmp->staff->username : ''}}</td>
        <td class="align-middle">{{$tmp->note}}</td>
        <td class="align-middle">{{(!empty(\Config::get('location_australia')[$tmp->location_australia]))?\Config::get('location_australia')[$tmp->location_australia]:''}}</td>

    </tr>
@endforeach



@push('scripts')
    {{-- @include('CRM.partials.number_currency',['ids'=>[
        ''
    ]]) --}}
    {{-- <script>
        $(document).on('click','.btn-process-dropdown',function (e){
            e.preventDefault();
            console.log($(this).next());
        })
    </script> --}}
@endpush
