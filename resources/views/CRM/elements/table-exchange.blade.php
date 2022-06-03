@if(session('error-list-exchange'))
<div class="alert alert-danger">
	<strong>{{session('error-list-exchange')}}</strong>
</div>
@endif
@if(session('success-list-exchange'))
<div class="alert alert-success">
	<strong>{{session('success-list-exchange')}}</strong>
</div>
@endif
@include('CRM.elements.exchanges.fillter')
<div class="card mb-3">
	<div class="card-header">
		<div class="row align-items-center">
			<div class="col">
				<h5 class="fs-0 mb-0">EXCHANGE RATE</h5>
			</div>
			<div class="col-auto">
				@can('exchangeRate.store')
                    <a class="btn btn-falcon-primary btn-sm sxme add_new"><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>
                    <a class="btn btn-falcon-warning btn-sm sxme export"><span class="fas fa-file-export mr-1" data-fa-transform="shrink-3"></span> <span>Export</span></a>
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
						<th>Month</th>
						<th>Year</th>
						<th>Unit</th>
						<th>Exchange rate</th>
                        <th>Type</th>
                        <th>Quarter</th>
                        <th>Unit to AUD</th>
                        <th>AUD to VND</th>
						<th>Created by</th>
						<th>Creation date</th>
						<th>Updated by</th>
						<th>Updation date</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="tbody_exchange_rate">
					@can('exchangeRate.index')
                        @include('CRM.elements.exchanges.table')
                    @endcan
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="div_exchange_form"></div>
{{-- @include('CRM.elements.exchanges.modal-add-new') --}}
@include('CRM.elements.exchanges.modal-delete')




