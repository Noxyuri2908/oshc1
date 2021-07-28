@foreach($data as $tmp)

<tr>
  <td class="align-middle">
    <input class="ml-3 sub_chk" data-id="{{$tmp->id}}" type="checkbox" aria-label="Checkbox for tdis row" />
  </td>
  <td class="align-middle">
      <div class="dropdown">
          <button class="btn btn-link dropdown-toggle" type="button" id="dropdownCustomerReceipt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="fas fa-ellipsis-h fs--1"></span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownCustomerReceipt">
              <div class="bg-white py-2">
                  <a class="dropdown-item invoice_info" style="cursor: pointer;" data-id="{{$tmp->id}}">View</a>
                  <a class="dropdown-item" href="#">Edit</a>
                  <a class="dropdown-item" href="{{route('customer.process.index',['id'=>$tmp->id, 'tab'=>1])}}" target="_blank">Process</a>
                  <div class="dropdown-divider"> </div>
                  <a class="dropdown-item export_invoice" data-id="{{$tmp->id}}" style="cursor: pointer;">Export Invoice</a>
                  <div class="dropdown-divider"> </div>
                  <a class="dropdown-item text-danger modal_delete" data-action="{{route('customer.destroy',['id'=>$tmp->id])}}" href="#!">Delete</a>
              </div>
          </div>
      </div>

  </td>
  <td class="align-middle"><a style="cursor: pointer; color: red" class="agent_info" data-id={{$tmp->agent != null ? $tmp->agent->id : ''}}>{{$tmp->agent != null ? $tmp->agent->name : ''}}</a></td>
  <td class="align-middle">{{$tmp->agent != null ? $tmp->agent->country() : ''}}</td>
  <td class="align-middle"><a style="cursor: pointer; color: red" class="agent_info" data-id={{$tmp->master != null ? $tmp->master->id : ''}}>{{$tmp->master != null ? $tmp->master->name : ''}}</a></td>
  <td class="align-middle">{{isset(config('myconfig.service_country')[$tmp->service_country]) ? config('myconfig.service_country')[$tmp->service_country] : ''}}</td>
  <td class="align-middle">{{$tmp->service != null ? $tmp->service->name : ''}}</td>
  <td class="align-middle">{{isset(config('myconfig.type_invoice')[$tmp->type_invoice]) ? config('myconfig.type_invoice')[$tmp->type_invoice] : ''}}</td>
  <td class="align-middle">{{$tmp->provider != null ? $tmp->provider->name : ''}}</td>
  <td class="align-middle">{{isset(config('myconfig.policy')[$tmp->policy]) ? config('myconfig.policy')[$tmp->policy] : ''}}</td>
  <td class="align-middle">{{$tmp->no_of_adults}}</td>
  <td class="align-middle">{{$tmp->no_of_children}}</td>
  <td class="align-middle">{{isset(config('myconfig.type_visa')[$tmp->type_visa]) ? config('myconfig.type_visa')[$tmp->type_visa] : ''}}</td>
  <td class="align-middle">{{$tmp->start_date}}</td>
  <td class="align-middle">{{$tmp->end_date}}</td>
  <td class="align-middle">{{$tmp->ref_no}}</td>
  <td class="align-middle">{{isset(config('myconfig.status_invoice')[$tmp->status]) ? config('myconfig.status_invoice')[$tmp->status] : ''}}</td>
  <td class="align-middle"><a style="cursor: pointer; color: red" class="customer_info" data-id={{$tmp->registerCus() != null ? $tmp->registerCus()->id : ""}}>{{$tmp->registerCus() != null ? $tmp->registerCus()->first_name.' '.$tmp->registerCus()->last_name : ''}}</a></td>
  <td class="align-middle">@foreach($tmp->partners() as $partner)
    <a style="cursor: pointer; color: red" class="customer_info" data-id={{$partner->id}}>{{$partner->first_name.' '.$partner->last_name}}</a><br>
  @endforeach</td>
  <td class="align-middle">@foreach($tmp->childrens() as $partner)
    <a style="cursor: pointer; color: red" class="customer_info" data-id={{$partner->id}}>{{$partner->first_name.' '.$partner->last_name}}</a><br>
  @endforeach</td>
  {{-- <td class="align-middle">{{$tmp->registerCus() != null ? $tmp->registerCus()->email : ''}}</td>
  <td class="align-middle">{{$tmp->registerCus() != null ? $tmp->registerCus()->place_study : ''}}</td>
  <td class="align-middle">{{$tmp->registerCus() != null ? $tmp->registerCus()->student_id : ''}}</td>
  <td class="align-middle">{{$tmp->registerCus() != null ? $tmp->registerCus()->phone : ''}}</td>
  <td class="align-middle">{{$tmp->registerCus() != null ? $tmp->registerCus()->fb : ''}}</td> --}}
  <td class="align-middle">{{number_format($tmp->net_amount)}}</td>
  <td class="align-middle">{{$tmp->promotion != null ? $tmp->promotion->code : ''}}</td>
  <td class="align-middle">{{number_format($tmp->promotion_amount)}}</td>

  <td class="align-middle">{{isset(config('myconfig.bank_fee')[$tmp->bank_fee]) ? config('myconfig.bank_fee')[$tmp->bank_fee] : ''}}</td>
  <td class="align-middle">{{isset(config('myconfig.bank_fee')[$tmp->bank_fee]) ? number_format($tmp->net_amount*$tmp->bank_fee)  : ''}}</td>
  <td class="align-middle">{{isset(config('myconfig.payment_metdod')[$tmp->payment_metdod]) ? config('myconfig.payment_metdod')[$tmp->payment_metdod] : ''}}</td>
  <td class="align-middle">{{number_format($tmp->surcharge)}}</td>
  <td class="align-middle">{{number_format($tmp->extra)}}</td>
  <td class="align-middle">{{number_format($tmp->comm)}}</td>
  <td class="align-middle">{{number_format($tmp->total)}}</td>
  <td class="align-middle">{{$tmp->staff != null ? $tmp->staff->username : ''}}</td>
  <td class="align-middle">{{$tmp->note}}</td>
    <td class="align-middle">{{(!empty(\Config::get('location_australia')[$tmp->location_australia]))?\Config::get('location_australia')[$tmp->location_australia]:''}}</td>
  <td class="align-middle">{{$tmp->created_at}}</td>
</tr>
@endforeach


{{$data->links()}}
