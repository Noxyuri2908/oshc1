<div class="modal fade user-information" id="modal_provider_com_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new provider commission</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('provider-com.store')}}" method="POST">
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
                <option value="{{$provider->id}}">{{$provider->name}}</option>
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
                <option value="{{$key}}">{{$value}}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Value:</label>
                <input type="text" id="amount" name="amount" class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Unit:</label>
                <select class="form-control" name="type" required>
                <option value="1">%</option>
                <option value="1">$</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Validity date:</label>
                <input type="text" value="{{date('d/m/Y')}}" id="validity_date" name="validity_date" class="form-control" placeholder="dd/mm/YYYY" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Note:</label>
                <textarea class="form-control" rows="5"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">

        <button class="btn btn-success mr-1 mb-1" type="submit">Add</button>
        <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
        <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
