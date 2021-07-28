<div class="modal fade user-information" id="modal_provider_com_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit provider commission</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('provider-com.update', ['id'=>$obj->id])}}" method="POST">
        @method("PATCH")
        @csrf
        <div class="modal-body">
          <div class="content-information">
            <div class="row">
              <div class="col-md-12 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Provider:</label>
                  <select class="form-control" name="provider_id" required>
                    <option label=""></option>
                    @foreach($providers as $provider)
                    <option value="{{$provider->id}}" {{$obj->provider_id == $provider->id ? 'selected' : ''}}>{{$provider->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Policy:</label>
                  <select class="form-control" name="policy" required>
                    <option label=""></option>
                    @foreach(config('myconfig.policy') as $key=>$value)
                    <option value="{{$key}}" {{$obj->policy == $key ? 'selected' : ''}}>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Value:</label>
                  <input type="number" value="{{$obj->amount}}" id="amount" name="amount" class="form-control" placeholder="" step="0.01" required>
                </div>
              </div>
              <div class="col-md-6 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Unit:</label>
                  <select class="form-control" name="type" required>
                    <option value="1" {{$obj->type == 1 ? 'selected' : ''}}>%</option>
                    <option value="2" {{$obj->type == 2 ? 'selected' : ''}}>$</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Validity date:</label>
                  <input type="text" value="{{$obj->validity_date}}" id="validity_date" name="validity_date" class="form-control" placeholder="dd/mm/YYYY" required>
                </div>
              </div>
              <div class="col-md-6 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Note:</label>
                  <textarea class="form-control" rows="5">{{$obj->note}}</textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          @can('providerCom.update')
          <button class="btn btn-success mr-1 mb-1" type="submit">Update</button>
          @endcan
          <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
          <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
