@if(session('error-list-providerCom'))
    <div class="alert alert-danger">
        <strong>{{session('error-list-providerCom')}}</strong>
    </div>
@endif
@if(session('success-list-providerCom'))
    <div class="alert alert-success">
        <strong>{{session('success-list-providerCom')}}</strong>
    </div>
@endif
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="fs-0 mb-0">PROVIDER COMMISSION</h5>
            </div>
            <div class="col-auto">
                @can('providerCom.store')
                    <a class="btn btn-falcon-primary btn-sm sxme add_new"><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span>
                        <span>New</span></a>
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
                        <th>No</th>
                        <th>Service</th>
                        <th>Provider</th>
                        <th>Country</th>
                        <th>Policy</th>
                        <th>Com</th>
                        <th>Unit</th>
                        <th>Validity date</th>
                        <th>Note</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objs as $obj)
                        @php
                            $provider = $obj->provider;
                            if($provider != null) $service = $provider->dichvu;
                            $_type = '%';
                            if($obj->type != 1) $_type = $provider->currency();
                        @endphp
                        @if($provider != null && $service != null)
                            <tr class="btn-reveal-trigger">
                                <td class="align-middle">
                                    <input class="ml-3 sub_chk" data-id="{{$obj->id}}" type="checkbox" aria-label="Checkbox for this row" />
                                </td>
                                <td class="align-middle">{{$obj->id}}</td>
                                <td class="align-middle">{{$service->name}}</td>
                                <td class="align-middle">{{$provider->name}}</td>
                                <td class="align-middle">{{$provider->countryName()}}</td>
                                <td class="align-middle">{{$obj->policyName()}}</td>
                                <td class="align-middle">{{$obj->amount}}</td>
                                <td class="align-middle">{{$_type}}</td>
                                <td class="align-middle">{{$obj->validity_date}}</td>
                                <td class="align-middle">{{$obj->note}}</td>
                                <td class="align-middle">{{$service->email}}</td>
                                <td class="align-middle">
                                    <div class="dropdown text-sans-serif">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown1" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                            <span class="fas fa-ellipsis-h fs--1"></span></button>
                                        <div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown1">
                                            <div class="bg-white py-2">
                                                @can('providerCom.edit')
                                                    <a class="dropdown-item modal_edit" data-id="{{$obj->id}}" href="#">Edit</a>
                                                @endcan
                                                <div class="dropdown-divider"></div>
                                                @can('providerCom.delete')
                                                    <a class="dropdown-item text-danger modal_delete" data-id="{{$obj->id}}" href="#!">Delete</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="div_edit_provider_com"></div>
@include('CRM.elements.provider_com.modal-add-new')
@include('CRM.elements.provider_com.modal-delete')




