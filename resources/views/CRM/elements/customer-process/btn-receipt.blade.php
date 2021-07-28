
@if($type == 1)
<div class="d-flex">
    <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" data-type=2 id="btn_add_receipt">
        <span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> Add
    </button>
    <div class="total-receipt-amount">
        Total amount : {{!empty($sum_amount)?convert_price_float($sum_amount):''}}
    </div>
</div>
@elseif($type == 2)
<div class="d-flex">
    <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_save_receipt">
        <span class="far fa-save" data-fa-transform="shrink-3"></span> Save
    </button>
    <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_close_receipt">
        <span class="far fa-times-circle" data-fa-transform="shrink-3" ></span> Close
    </button>
    <div class="total-receipt-amount">
        Total amount : {{!empty($sum_amount)?convert_price_float($sum_amount):''}}
    </div>
</div>
<hr>
@include('CRM.elements.customer-process.form-receipt')
@else
<div class="d-flex">
<button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" data-type=2 id="btn_add_receipt">
	<span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> Add
</button>
<button class="btn btn-falcon-default btn-sm mr-1 mb-1 btn-del-phieuthu" type="button">
	<span class="fas fa-trash-alt btn-del" data-fa-transform="shrink-3"></span> Delete
</button>
<button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_save_receipt">
	<span class="far fa-save" data-fa-transform="shrink-3" ></span> Update
</button>
<button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_close_receipt">
	<span class="far fa-times-circle" data-fa-transform="shrink-3"  ></span> Close
</button>
<div class="total-receipt-amount">
    Total amount : {{!empty($sum_amount)?convert_price_float($sum_amount):''}}
</div>
</div>
<hr>
@include('CRM.elements.customer-process.form-receipt',['phieuthu'=>$phieuthu])
@endif
