<div class="modal fade user-information" id="modal_bank_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new bank</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('bank.store')}}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="content-information">
          <div class="row">
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Bank name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Bank code:</label>
                <input type="text" id="code" name="code" class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Bank account:</label>
                <input type="text" id="account" name="account" class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Bank brand:</label>
                <input type="text" id="brand" name="brand" class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Account name:</label>
                <input type="text" id="account_name" name="account_name" class="form-control" placeholder="" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Country:</label>
                <select class="form-control" name="country" required>  
                  <option label=""></option>
                  @foreach(config('country.list') as $key=>$value)
                  <option value="{{$key}}">{{$value}}</option>
                  @endforeach
                </select>
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