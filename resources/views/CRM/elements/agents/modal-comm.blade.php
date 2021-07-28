@if($obj != null)
@php
$comms = $obj->commission;
@endphp
@if(count($comms) >= 0)
<div class="modal fade user-information" id="modal_comm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail commission: #{{$obj->name}}</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th class="text-center" scope="col">ID</th>
                <th class="text-center" scope="col">Country</th>
                <th class="text-center" scope="col">Service</th>
                <th class="text-center" scope="col">Provider</th>
                <th class="text-center" scope="col">Policy</th>
                <th class="text-center" scope="col">Commission</th>
                <th class="text-center" scope="col">Unit</th>
                <th class="text-center" scope="col">Validity start date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($comms as $comm)
              @php
              $provider = $comm->service;
              if($provider != null) $service = $provider->dichvu;
              if($comm->donvi == 1) $comm_text = $comm->comm.'%';
              else $comm_text = $comm->comm.'$';
              @endphp
              @if($provider != null && $service != null)
              <tr>
                <td class="text-center">#{{$obj->id}}</td>
                <td class="text-center">{{$provider->countryName()}}</td>
                <td class="text-center">{{$service->name}}</td>
                <td class="text-center">{{$provider->name}}</td>
                <td class="text-center">
                  {{!empty($typePolicyConfig[$comm->policy]) ? $typePolicyConfig[$comm->policy] : ''}}
                </td>
                <td class="text-center">{{$comm_text}}</td>
                <td class="text-center">{{$provider->currency()}}</td>
                <td class="text-center">{{convert_date_form_db($comm->validity_start_date)}}</td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif
@endif
