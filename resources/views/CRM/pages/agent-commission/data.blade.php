@if(!empty($commDatas))
    @foreach($commDatas as $obj)
        @php
            $agent = $obj->user;
            if($agent != null){
              $country = !empty($countries[$agent->country])?$countries[$agent->country]:'';
              $provider = $obj->service;
              $service = $dichvus->where('id',$obj->service_id)->pluck('name')->first();
              $commNumber = $obj->comm;
              $donvi = !empty($typeUnitConfig[$obj->donvi])?$typeUnitConfig[$obj->donvi]:'';
              $comm = $commNumber.$donvi;
            }
        @endphp
        <tr id="com_data_{{$obj->id}}">
            <td class="white-space-break-spaces">
                <input class="ml-3 sub_chk" data-id="{{$obj->id}}" type="checkbox"
                       aria-label="Checkbox for this row" />
            </td>
            <td class="white-space-break-spaces">
                <div class="dropdown text-sans-serif">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button"
                            id="dropdown1" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true"
                            aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                    <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown1">
                        <div class="bg-white py-2">
                            @can('commissionAgent.edit')
                                <a class="dropdown-item edit_comm" data-id="{{$obj->id}}" data-url="{{route('com.edit',['id'=>$obj->id])}}" href="#">Edit</a>
                            @endcan
                            <div class="dropdown-divider"></div>
                            @can('commissionAgent.delete')
                                <a class="dropdown-item text-danger delete_comm" data-id="{{$obj->id}}" data-url="{{route('com.destroy',['id'=>$obj->id])}}" href="#!">Delete</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </td>
            <td class="white-space-break-spaces">{{!empty($country)?$country:''}}</td>
            <td class="white-space-break-spaces">{{!empty($agent)?$agent->name:''}}</td>
            <td class="white-space-break-spaces">{{(!empty($service))?$service:''}}</td>
            <td class="white-space-break-spaces">{{(!empty($provider))?$provider->name:''}}</td>
            <td class="white-space-break-spaces">{{!empty($typePolicyConfig[$obj->policy]) ? $typePolicyConfig[$obj->policy] : ''}}</td>
            <td class="white-space-break-spaces">{{!empty($comm)?$comm:''}}</td>
            <td class="white-space-break-spaces">{{(!empty($provider))?$provider->currency():''}}</td>
            <td class="white-space-break-spaces">{{convert_date_form_db($obj->validity_start_date)}}</td>
            <td>{{!empty($obj->type_payment) && !empty($typePaymentConfig[$obj->type_payment])?$typePaymentConfig[$obj->type_payment]:''}}</td>
            <td>{{!empty($obj->gst) && !empty($typeGstConfig[$obj->gst])?$typeGstConfig[$obj->gst]:''}}</td>
            <td class="white-space-break-spaces">
                @if($obj->status == 1)
                    <span class="badge badge rounded-capsule badge-soft-success">Active<span
                            class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                @elseif($obj->status == 0)
                    <span class="badge badge rounded-capsule badge-soft-warning">Inactive<span
                            class="ml-1 fas fa-uncheck" data-fa-transform="shrink-2"></span></span>
                @endif
            </td>
        </tr>
    @endforeach
@else
    <tr class="btn-reveal-trigger">
        <td class="text-center" colspan="10"><b>NO DATA</b></td>
    </tr>
@endif
