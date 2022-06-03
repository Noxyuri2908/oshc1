<div class="modal fade user-information" id="modal_exchange_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit exchange rate: #{{$obj->id}}</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('exchange-rate.update', ['id'=>$obj->id])}}" method="POST">
        @method("PATCH")
        @csrf
        <div class="modal-body">
          <div class="content-information">
            <div class="row">
             <div class="col-md-3 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Month:</label>
                <select class="form-control" name="month" required>  
                  <option label=""></option>
                  @foreach(config('date-time.month') as $key=>$value)
                  <option value="{{$key}}" {{$obj->month == $key ? 'selected' : ''}}>{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3 content-table fill_content">
              <div class="form-group">
                <div class="form-group">
                  <label class="control-label">Year:</label>
                  <select class="form-control" name="year" required>  
                    <option label=""></option>
                    @foreach(config('date-time.year') as $key=>$value)
                    <option value="{{$key}}" {{$obj->year == $key ? 'selected' : ''}}>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Unit:</label>
                <select class="form-control" name="unit" required>  
                  <option label=""></option>
                  @foreach(config('myconfig.currency') as $key=>$value)
                  <option value="{{$key}}" {{$obj->unit == $key ? 'selected' : ''}}>{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Type:</label>
                <select class="form-control" name="type" required>  
                  <option label=""></option>
                  @foreach(config('myconfig.type_exchange') as $key=>$value)
                  <option value="{{$key}}" {{$obj->type == $key ? 'selected' : ''}}>{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Exchange Rate:</label>
                <input type="number" value="{{$obj->rate}}" id="rate" name="rate" class="form-control" placeholder="" required>
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