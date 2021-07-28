@if(session('error-list-bank'))
<div class="alert alert-danger">
	<strong>{{session('error-list-bank')}}</strong>
</div>
@endif
@if(session('success-list-bank'))
<div class="alert alert-success">
	<strong>{{session('success-list-bank')}}</strong>
</div>
@endif
<div class="card mb-3">
	<div class="card-header">
		<div class="row align-items-center">
			<div class="col">
				<h5 class="fs-0 mb-0">BANK ACCOUNTS</h5>
			</div>
			<div class="col-auto">
				<a class="btn btn-falcon-primary btn-sm sxme add_new"><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>
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
						<th>Bank name</th>
						<th>Bank code</th>
						<th>Bank account</th>
						<th>Bank brand</th>
						<th>Account name</th>
						<th>Created by</th>
						<th>Creation date</th>
						<th>Updated by</th>
						<th>Updation date</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($objs as $obj)
					<tr class="btn-reveal-trigger">
						<td class="align-middle">
							<input class="ml-3 sub_chk" data-id="{{$obj->id}}" type="checkbox" aria-label="Checkbox for this row" />
						</td>
						<td class="align-middle">{{$obj->id}}</td>
						<td class="align-middle">{{$obj->name}}</td>
						<td class="align-middle">{{$obj->code}}</td>
						<td class="align-middle">{{$obj->account}}</td>
						<td class="align-middle">{{$obj->brand}}</td>
						<td class="align-middle">{{$obj->countryName()}}</td>
						<td class="align-middle">{{$obj->account_name}}</td>
						<td class="align-middle">{{$obj->staffCreate != null ? $obj->staffCreate->username : ''}}</td>
						<td class="align-middle">{{$obj->created_at}}</td>
						<td class="align-middle">{{$obj->staffUpdate != null ? $obj->staffUpdate->username : ''}}</td>
						<td class="align-middle">{{$obj->updated_at}}</td>
						<td class="align-middle">
							<div class="dropdown text-sans-serif">
								<button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal mr-3" type="button" id="dropdown1" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
								<div class="dropdown-menu dropdown-menu-right border py-0" aria-labelledby="dropdown1">
									<div class="bg-white py-2">
										<a class="dropdown-item modal_edit" data-id="{{$obj->id}}" href="#">Edit</a>
										<div class="dropdown-divider"> </div>
										<a class="dropdown-item text-danger modal_delete" data-id="{{$obj->id}}" href="#!">Delete</a>
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
</div>
<div id="div_edit_bank"></div>
@include('CRM.elements.banks.modal-add-new')
@include('CRM.elements.banks.modal-delete')




