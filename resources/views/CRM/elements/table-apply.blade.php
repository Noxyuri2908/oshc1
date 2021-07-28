@if(session('error-list-apply'))
  <div class="alert alert-danger">
    <strong>{{session('error-list-apply')}}</strong>
  </div>
@endif
@if(session('success-list-apply'))
  <div class="alert alert-success">
    <strong>{{session('success-list-apply')}}</strong>
  </div>
@endif
<div class="card mb-3">
  <div class="card-header">
    <div class="row align-items-center">
      <div class="col">
        <h5 class="fs-0 mb-0">APPLIES</h5>
      </div>
      <div class="col-auto">
        <a class="btn btn-falcon-default btn-sm sxme" href="{{route('get-a-quote.get')}}" target="blank"><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>
        <a class="btn btn-falcon-default btn-sm cutum-frm-hide sxme" type="button"><span class="fas fa-filter mr-1" data-fa-transform="shrink-3"></span><span>Filter</span></a>
      </div>
    </div>
  </div>
  @include('CRM.elements.applies.search-form')
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm mb-0 table-dashboard fs--1">
        <thead class="bg-200 text-900">
          <tr>
            <th>
              <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table" />
            </th>
            <th>Service</th>
            <th>Agent</th>
            <th>Invoice code</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Total</th>
            <th>Customers</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($applies as $apply)
            <tr class="btn-reveal-trigger">
              <td class="align-middle">
                <input class="ml-3 sub_chk" data-id="{{$apply->id}}" type="checkbox" aria-label="Checkbox for this row" />
              </td>
              <th class="align-middle"><a style="cursor: pointer; color: blue" class="service_info" data-id="{{$apply->service_id}}">{{$apply->service != null ? $apply->service->name : ''}}</a></th>
              <td class="align-middle"><a style="cursor: pointer; color: blue" class="agent_info" data-id="{{$apply->user_id}}">{{$apply->user != null ? $apply->user->name : ''}}</a></td>
              <td class="align-middle"><a style="cursor: pointer; color: blue" class="apply_info" data-id="{{$apply->id}}">{{$apply->invoice_code}}</a></td>
              <td class="align-middle">{{$apply->start_date}}</td>
              <td class="align-middle">{{$apply->end_date}}</td>
              <td class="align-middle">{{number_format($apply->total)}}</td>
              <td class="align-middle">@php
                $customers = $apply->customers()->get();
                $count = 1;
                foreach($customers as $cus){
                  echo  $count.": ".'<a class="customer_info" data-id="'.$cus->id.'" href="#!">'.$cus->first_name." ".$cus->last_name.'</a><br/>';
                  $count ++;
                }
              @endphp</td>
              <td class="align-middle">
                @if($apply->status == 1)
                <span class="badge badge rounded-capsule badge-soft-success">Running<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                @elseif($apply->status == 0)
                <span class="badge badge rounded-capsule badge-soft-warning">Pending<span class="ml-1 fas fa-uncheck" data-fa-transform="shrink-2"></span></span>
                @elseif($apply->status == 2)
                <span class="badge badge rounded-capsule badge-soft-default">Reject<span class="ml-1 fas fa-uncheck" data-fa-transform="shrink-2"></span></span>
                @elseif($apply->status == 3)
                <span class="badge badge rounded-capsule badge-soft-danger">Time-expired<span class="ml-1 fas fa-uncheck" data-fa-transform="shrink-2"></span></span>
                @endif
              </td>
              <td class="align-middle">
                <div class="dropdown text-sans-serif">
                  <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown1" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown1">
                    <div class="bg-white py-2">
                      <a class="dropdown-item apply_info" href="#!" data-id="{{$apply->id}}">View</a>
                      <a class="dropdown-item" href="#">Edit</a>
                      <div class="dropdown-divider"> </div>
                      <a class="dropdown-item text-danger modal_delete" data-id="{{$apply->id}}" href="#!">Delete</a>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer border-top">
    <div class="row">
      <div class="col">
        <p class="mb-0 fs--1"><a class="font-weight-semi-bold" href="#">View all<span class="fas fa-angle-right ml-1" data-fa-transform="down-1"></a></p>
      </div>
      <div class="col-auto">
      {{$applies->links()}}
      </div>
    </div>
  </div>
</div>
<div id="div_service_info"></div>
<div id="modal_agent"></div>
<div id="div_apply_info"></div>
<div id="div_custom_info"></div>
@include('CRM.elements.applies.modal-delete')




