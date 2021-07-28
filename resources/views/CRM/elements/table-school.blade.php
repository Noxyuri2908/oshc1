@if(session('error-list-school'))
<div class="alert alert-danger">
	<strong>{{session('error-list-school')}}</strong>
</div>
@endif
@if(session('success-list-school'))
<div class="alert alert-success">
	<strong>{{session('success-list-school')}}</strong>
</div>
@endif
@include('CRM.elements.schools.fillter')
<div class="card mb-3">
	<div class="card-header">
		<div class="row align-items-center">
			<div class="col">
				<h5 class="fs-0 mb-0">SCHOOLS</h5>
			</div>
			<div class="col-auto">
				<a class="btn btn-falcon-primary btn-sm sxme add_new"><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>
				<a class="btn btn-falcon-info btn-sm sxme import"><span class="fas fa-file-import" data-fa-transform="shrink-3"></span> <span>Import</span></a>
				<a class="btn btn-falcon-warning btn-sm sxme export"><span class="fas fa-file-export mr-1" data-fa-transform="shrink-3"></span> <span>Export</span></a>
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
						<th>Name</th>
						<th>Country</th>
						<th>Created by</th>
						<th>Creation date</th>
						<th>Updated by</th>
						<th>Updation date</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="tbody_school">
					@include('CRM.elements.schools.table')
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="div_edit_school"></div>
@include('CRM.elements.schools.modal-add-new')
@include('CRM.elements.schools.modal-delete')




