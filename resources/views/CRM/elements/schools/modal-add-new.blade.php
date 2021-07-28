<div class="modal fade user-information" id="modal_school_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new school</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('school.store')}}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="content-information">
          <div class="row">
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="" required>
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
            <div class="col-md-12 content-table fill_content">
              <div class="form-group">
                <label class="control-label">State/Region:</label>
                <input type="text" name="state" class="form-control">
              </div>
            </div>
            <div class="col-md-12 content-table fill_content">
              <div class="form-group">
                <label class="control-label">City:</label>
                <input type="text" name="city" class="form-control">
              </div>
            </div>
            <div class="col-md-12 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Note:</label>
                <textarea class="form-control" name="note"></textarea>
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