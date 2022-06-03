@if(session('error-list-campain'))
  <div class="alert alert-danger">
    <strong>{{session('error-list-campain')}}</strong>
  </div>
@endif
@if(session('success-list-campain'))
  <div class="alert alert-success">
    <strong>{{session('success-list-campain')}}</strong>
  </div>
@endif
<div class="card mb-3">
  <div class="card-header">
    <div class="row align-items-center">
      <div class="col">
        <h5 class="fs-0 mb-0">CAMPAINS</h5>
      </div>
      <div class="col-auto">
          @can('campaign.store')
              <a class="btn btn-falcon-primary btn-sm sxme add_new"><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>
          @endcan
      </div>
    </div>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm mb-0 table-dashboard fs--1">
        <thead class="bg-200 text-900">
          <tr>
            <th>
              <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table" />
            </th>
            <th>Code</th>
            <th>Name</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Created by</th>
            <th>Assign for</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @can('campaign.index')
            @foreach($objs as $obj)
                <tr class="btn-reveal-trigger">
                    <td class="align-middle">
                        <input class="ml-3 sub_chk" data-id="{{$obj->id}}" type="checkbox" aria-label="Checkbox for this row" />
                    </td>
                    <td class="align-middle">{{$obj->code}}</td>
                    <td class="align-middle">{{$obj->name}}</td>
                    <td class="align-middle">{{$obj->start_date}}</td>
                    <td class="align-middle">{{$obj->end_date}}</td>
                    <td class="align-middle">{{$obj->owner != null ? $obj->owner->username : ''}}</td>
                    <td class="align-middle">{{$obj->assign != null ? $obj->assign->username : ''}}</td>
                    <td class="align-middle">
                        @if($obj->status == 1)
                            <span class="badge badge rounded-capsule badge-soft-success">Active<span class="ml-1 fas fa-check" data-fa-transform="shrink-2"></span></span>
                        @elseif($obj->status == 0)
                            <span class="badge badge rounded-capsule badge-soft-warning">Inactive<span class="ml-1 fas fa-uncheck" data-fa-transform="shrink-2"></span></span>
                        @endif
                    </td>
                    <td class="align-middle">
                        <div class="dropdown text-sans-serif">
                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown1" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                            <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown1">
                                <div class="bg-white py-2">
                                    @can('campaign.update')
                                        <a class="dropdown-item modal_edit" data-id="{{$obj->id}}" href="#">Edit</a>
                                    @endcan
                                    <div class="dropdown-divider"></div>
                                    @can('campaign.destroy')
                                        <a class="dropdown-item text-danger modal_delete" data-id="{{$obj->id}}" href="#!">Delete</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endcan
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer border-top">
    <div class="row">
      <div class="col-auto">
      {{$objs->links()}}
      </div>
    </div>
  </div>
</div>
<div id="div_edit_campain"></div>
@include('CRM.elements.campain.modal-add-new')
@include('CRM.elements.campain.modal-delete')




