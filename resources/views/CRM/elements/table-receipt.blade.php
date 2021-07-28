
@include('CRM.elements.receipt.filter')
<div class="card mb-3">
  <div class="card-header">
    <div class="row align-items-center">
      <div class="col">
        <h5 class="fs-0 mb-0">Receipt</h5>
      </div>
    </div>
  </div>
  <div class="card-body p-0">

    <div class="table-responsive apply-receipt">
        @include('CRM.elements.receipt.table')
    </div>
    <div class="modal fade" id="myModalReceipt" role="dialog">
        <div class="modal-dialog" style="max-width: 885px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body show-receipt">
                    @include('CRM.partials.receipt_form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-receipt" id="btn-receipt">Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="card-footer border-top">
    <div class="row">
      <div class="col">
        <div class="col-auto">
          {{(!empty($phieuthus))?$phieuthus->links():''}}
        </div>
      </div>
    </div>
  </div>
</div>

<div id="modal_agent">

</div>

<div id="modal_contact">

</div>

<div id="div_modal_comm">

</div>

<div id="div_modal_support">

</div>
{{--
<div id="modal_email">
  @include('CRM.elements.agents.modal-email')
</div>
@include('CRM.elements.agents.modal-delete')
@include('CRM.elements.agents.modal_attach')
@include('CRM.elements.agents.modal-support') --}}

<!--  modal hiển thị cột  Delete -->



<!--  modal hiển email -->
