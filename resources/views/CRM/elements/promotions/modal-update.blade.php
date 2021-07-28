<div class="modal fade user-information" id="modal_promotion_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit promotion: {{$obj->name}}</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('promotion.update', ['id'=>$obj->id])}}" method="POST">
      @method("PATCH")
      @csrf
      <div class="modal-body">
        <div class="content-information">
          <div class="row">
            <div class="col-md-12 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Campaign:</label>
                <input type="text" id="name" name="name" value ="{{$obj->name}}" class="form-control" placeholder="Campaign" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Start date:</label>
                <input type="text" id="start_date" value ="{{$obj->start_date}}" name="start_date" class="form-control" placeholder="Start date" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">End date:</label>
                <input type="text" id="end_date"  value ="{{$obj->end_date}}" name="end_date" class="form-control" placeholder="End date" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Promotion code:</label>
                <input type="text" id="code" value ="{{$obj->code}}"  name="code" class="form-control" placeholder="Promotion code" readonly>
              </div>
            </div>
             <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Amount:</label>
                <input type="number" id="amount" value ="{{$obj->amount}}"  name="amount" class="form-control" placeholder="Amount" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Unit:</label>
                <select name="unit" id="unit" class="form-control">
                  @foreach($currencyConfig as $key=>$unit)
                    <option value="{{$key}}" {{$obj->unit == $key ?'selected':''}}>{{$unit}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12 content-table">
              <div class="form-group">
                <label class="control-label">Status:</label>
                <select class="form-control" name="status" id="status" required>
                  <option value = "1" {{$obj->status == 1 ? 'selected' : ''}}> Active</option>
                  <option value = "0" {{$obj->status == 0 ? 'selected' : ''}}> Inactive</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success mr-1 mb-1" type="submit">Update</button>
        <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
        <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  $('#unit').select2();
  $('#start_date, #end_date').flatpickr({
    allowInput:true,
    dateFormat:'d/m/Y'
  });
</script>
