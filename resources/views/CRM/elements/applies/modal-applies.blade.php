@if($obj != null)
<div class="modal fade user-information" id="modal_apply_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail of Apply</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-information">
         <h3 class="name">
          {{$obj->invoice_code}}
        </h3>
        <div class="row">
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Service:</label>
              <input type="text" name="" value="{{$obj->service != null ? $obj->service->name : ''}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Start date:</label>
              <input type="text" name="" value="{{$obj->start_date}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">End date:</label>
              <input type="text" name="" value="{{$obj->end_date}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">No of adults:</label>
              <input type="text" name="" value="{{$obj->no_of_adults}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">No of children:</label>
              <input type="text" name="" value="{{$obj->no_of_children}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Price:</label>
              <input type="text" name="" value="{{number_format($obj->price)}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Payment menthod:</label>
              <input type="text" name="" value="{{$obj->menthod_payment}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Commission:</label>
              <input type="text" name="" value="{{$obj->price_comm}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Price gst:</label>
              <input type="text" name="" value="{{number_format($obj->price_gst)}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Surchage fee:</label>
              <input type="text" name="" value="{{number_format($obj->price_su)}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Total:</label>
              <input type="text" name="" value="{{number_format($obj->total)}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Agent:</label>
              <input type="text" name="" value="{{$obj->agent != null ? $obj->agent->name : ''}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Status:</label>
              <input type="text" name="" value="@php
                if($obj->status == 1) echo 'Running';
                if($obj->status == 0) echo 'Pending';
                if($obj->status == 2) echo 'Reject';
                if($obj->status == 3) echo 'Time-expired';
              @endphp
              " readonly>
            </div>
          </div>
           <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Promotion:</label>
              <input type="text" name="" value="{{$obj->promotion}}" readonly>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>

@endif
