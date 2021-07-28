<table class="table table-sm mb-0 table-dashboard fs--1 table-hover">
    <thead class="bg-200 text-900 thead-dark">
    <tr>
        <th>
            <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table"/>
        </th>
        <th>Country</th>
        <th>Agent</th>
        <th>Service</th>
        <th>Provider</th>
        <th>Policy</th>
        <th>Commission</th>
        <th>Unit</th>
        <th>Validity start date</th>
        <th>Type Payment</th>
        <th>GST</th>
        <th>Status</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($objs) && $objs->count() > 0)
        @foreach($objs as $obj)
            @php
                $agent = $obj->user;
                if($agent != null){
                  $country = $agent->country();
                  $provider = $obj->service;
                  if($provider != null) $service = $provider->dichvu;
                  $comm = number_format($obj->comm);
                  if($obj->donvi == 1) $comm .= '%';
                  else $comm .= '$';
                }
            @endphp
            @if($agent != null && $provider != null && $service != null)
                <tr class="btn-reveal-trigger">
                    <td class="align-middle">
                        <input class="ml-3 sub_chk" data-id="{{$obj->id}}" type="checkbox"
                               aria-label="Checkbox for this row"/>
                    </td>
                    <td class="align-middle">{{$country}}</td>
                    <td class="align-middle">{{$agent->name}}</td>
                    <td class="align-middle">{{$service->name}}</td>
                    <td class="align-middle">{{$provider->name}}</td>
                    <td class="align-middle">{{isset(config('myconfig.policy')[$obj->type]) ? config('myconfig.policy')[$obj->type] : ''}}</td>
                    <td class="align-middle">{{$comm}}</td>
                    <td class="align-middle">{{$provider->currency()}}</td>
                    <td class="align-middle">{{$obj->date}}</td>
                    <td>{{!empty($obj->type_payment) && !empty(config('myconfig.type_payment')[$obj->type_payment])?config('myconfig.type_payment')[$obj->type_payment]:''}}</td>
                    <td>{{!empty($obj->gst) && !empty(config('myconfig.gst')[$obj->gst])?config('myconfig.gst')[$obj->gst]:''}}</td>
                    <td class="align-middle">
                        @if($obj->status == 1)
                            <span class="badge badge rounded-capsule badge-soft-success">Active<span
                                    class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                        @elseif($obj->status == 0)
                            <span class="badge badge rounded-capsule badge-soft-warning">Inactive<span
                                    class="ml-1 fas fa-uncheck" data-fa-transform="shrink-2"></span></span>
                        @endif
                    </td>
                    <td class="align-middle">
                        <div class="dropdown text-sans-serif">
                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button"
                                    id="dropdown1" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true"
                                    aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                            <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown1">
                                <div class="bg-white py-2">
                                    <a class="dropdown-item modal_edit" data-id="{{$obj->id}}" href="#">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger modal_delete" data-id="{{$obj->id}}" href="#!">Delete</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endif
        @endforeach
    @else
        <tr class="btn-reveal-trigger">
            <td class="text-center" colspan="10"><b>NO DATA</b></td>
        </tr>
    @endif
    </tbody>
</table>
