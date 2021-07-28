<div class="card mb-3">
	<div class="card-header">
		<div class="tab-form-bt tab-data-table">
			<div class="row">
				<div class="col-12">
					<div class="group-checkbox">
						<div class="row">
							@foreach(config('myconfig.status_invoice') as $key=>$value)
							<div class="col-sm-6 col-md-3 checkboxs">
								<div class="form-group">
									<input data-text="{{$value}}" type="radio" {{(!empty($obj) && $obj->status == $key) ? 'checked=true' : ''}} class="c_status" id="invoice_status" name="invoice_status" value="{{$key}}">
									<label for="">{{$value}}</label>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					@if(session('error-agent-process'))
					<div class="alert alert-danger">
						<strong>{{session('error-agent-process')}}</strong>
					</div>
					@endif
					@if(session('success-agent-process'))
					<div class="alert alert-success">
						<strong>{{session('success-agent-process')}}</strong>
					</div>
					@endif
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link {{(request()->get('tab_link') == 1 )? 'active' : ''}}" id="invoice-tab" data-toggle="tab" href="#tab-invoice" role="tab" aria-controls="tab-invoice" aria-selected="true">Invoice</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{request()->get('tab_link') == 2? 'active' : ''}}" id="receipt-tab" data-toggle="tab" href="#tab-receipt" role="tab" aria-controls="tab-receipt" aria-selected="false">Receipt</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{request()->get('tab_link') == 3 ? 'active' : ''}}" id="commission-tab" data-toggle="tab" href="#tab-Commission" role="tab" aria-controls="tab-Commission" aria-selected="false">Commission</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{request()->get('tab_link') == 4 ? 'active' : ''}}" id="profit-tab" data-toggle="tab" href="#tab-profit" role="tab" aria-controls="tab-profit" aria-selected="false">Profit</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{request()->get('tab_link') == 5 ? 'active' : ''}}" id="refund-tab" data-toggle="tab" href="#tab-refund" role="tab" aria-controls="tab-refund" aria-selected="false">Refund</a>
						</li>
						<li class="nav-item">
							<a class="nav-link  {{request()->get('tab_link') == 6  ? 'active' : ''}}" id="doc-tab" data-toggle="tab" href="#tab-doc" role="tab" aria-controls="tab-refund" aria-selected="false">Docs</a>
						</li>
						<li class="nav-item">
							<a class="nav-link {{request()->get('tab_link') == 7 ? 'active' : ''}}" id="doc-tab" data-toggle="tab" href="#tab-task" role="tab" aria-controls="tab-refund" aria-selected="false">Tasks</a>
						</li>
					</ul>
					<div class="tab-content border-x border-bottom p-3" id="myTabContent">
						<div class="tab-pane fade {{request()->get('tab_link') == 6  ? 'show active' : ''}}" id="tab-doc" role="tabpanel" aria-labelledby="doc-tab">
							<div class="form-submit clearfix tab-form-1">
								<div class="bottom-submit">
									<button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" data-type=2 id="btn_add_doc">
										<span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> Add
									</button>
								</div>
							</div>
							<div class="table-responsive" id="div_table_doc">
								@include('CRM.elements.customer-process.table-doc')
							</div>
						</div>
						<div class="tab-pane fade {{request()->get('tab_link') == 1 ? 'show active' : ''}}" id="tab-invoice" role="tabpanel" aria-labelledby="invoice-tab">
							<div class="table-responsive" id="div_table_invoice">
								@include('CRM.elements.customer-process.table-invoice')
							</div>
						</div>  <!-- end tab 1 -->
						<div class="tab-pane fade {{request()->get('tab_link') == 2 ? 'show active' : ''}}" id="tab-receipt" role="tabpanel" aria-labelledby="receipt-tab">
							<div class="form-submit clearfix tab-form-1">
								<div class="bottom-submit" id="div_btn_receipt">
									@include('CRM.elements.customer-process.btn-receipt',['type'=>1])
								</div>
							</div>  <!-- end form-->
							<div class="table-responsive" id="div_table_receipt">
								@include('CRM.elements.customer-process.table-receipt', ['phieuthus'=>$obj->phieuthus->sortByDesc('created_at')])
							</div>
						</div>
					{{--end tab 2 $phieuthu_old_exchange_rate--}}
						<div class="tab-pane fade {{request()->get('tab_link') == 3  ? 'show active' : ''}}" id="tab-Commission" role="tabpanel" aria-labelledby="commission-tab">
							<div class="form-submit clearfix tab-form-1">
								<div class="bottom-submit" id="div_btn_hh">
									@include('CRM.elements.customer-process.btn-hh')
								</div>
							</div>
						</div>
						<div class="tab-pane fade {{request()->get('tab_link') == 4 ? 'show active' : ''}}" id="tab-profit" role="tabpanel" aria-labelledby="profit-tab">
							<div class="form-submit clearfix tab-form-3">
								<div class="bottom-submit" id="div_btn_profit">
									@include('CRM.elements.customer-process.btn-profit')
								</div>
							</div>
						</div><!-- end tab 4 -->
						<div class="tab-pane fade {{request()->get('tab_link') == 5  ? 'show active' : ''}}" id="tab-refund" role="tabpanel" aria-labelledby="refund-tab">
							<div class="form-submit clearfix tab-form-3">
								<div class="bottom-submit" id="div_btn_refund">
									@include('CRM.elements.customer-process.btn-refund')
								</div>
							</div>
						</div>


						<div class="tab-pane fade {{request()->get('tab_link') == 7  ? 'show active' : ''}}" id="tab-task" role="tabpanel" aria-labelledby="doc-tab">
							<div class="form-submit clearfix tab-form-1">
								<div class="bottom-submit">
									<button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_add_new_task">
										<span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> Add
									</button>
								</div>
							</div>
							@include('CRM.elements.task.modal-form',['apply'=>$obj])
							@include('CRM.elements.process.table-task')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@push('scripts')
<script>
    $(document).on('mouseover', '#phieuthu_amount', function () {
        $(this).inputmask({alias: "currency", prefix: '', digits: 2});
    })
    $(document).on('mouseover', '#receipt_net_amount', function () {
        $(this).inputmask({alias: "currency", prefix: '', digits: 2});
    })
    $(document).on('mouseover', '#phieuthu_bank_fee', function () {
        $(this).inputmask({alias: "currency", prefix: '', digits: 2});
    })

    $(document).on('mouseover', '.choose-date-form', function () {
        let start_date_class = $(this).hasClass('flatpickr-input');
        if (!start_date_class) {
            $(this).flatpickr({dateFormat: "d/m/Y"});
        }
    })

    $(document).ready(function (){
        var goss_amount = $('#gross-amount').val().replace(/,/g, '');
        var promotion = $('#promotion_annalink_receipt').val().replace(/,/g, '');
        var bank_fee = $('#bankfee_annalink_receipt').val().replace(/,/g, '');
        var discount  = $('#discount_annalink_receipt').val().replace(/,/g, '');

        var total = goss_amount - promotion - discount;
        total = total + parseFloat(bank_fee);
        $('#total-amount').val(total) // set total amount
    });
</script>
@endpush
