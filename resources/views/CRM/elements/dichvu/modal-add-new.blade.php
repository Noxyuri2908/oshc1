<div class="modal fade user-information" id="modal_dichvu_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new service</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('dichvu.store')}}" method="POST">
      @csrf
      <div class="modal-body">
        <div class="content-information">
          <div class="row">
            <div class="col-md-12 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
              </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Slug:</label>
                <input type="text" id="slug" name="slug" class="form-control" placeholder="Slug" required>
              </div>
            </div>
            <div class="col-md-6 content-table">
                <div class="form-group">
                    <label class="control-label">Service Id:</label>
                    <select class="form-control" name="service_id" id="service_id" required>
                    @foreach(\Config::get('admin.service_id') as $key=>$one)
                        <option value = "{{$key}}">{{$one}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Type Form:</label>
                <select name="type_form" class="form-control" required>
                  <option label=""></option>
                  @foreach(config('myconfig.type_form') as $key=>$value)
                  <option value="{{$key}}">{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
              <div class="col-md-6 content-table fill_content">
                  <div class="form-group">
                      <label class="control-label">Short name:</label>
                      <input type="text" id="viettat" name="viettat" class="form-control" required>

                  </div>
              </div>
            <div class="col-md-6 content-table fill_content">
              <div class="form-group">
                <label class="control-label">Position:</label>
                <input type="num" id="pos" name="pos" class="form-control" placeholder="Position" required>
              </div>
            </div>
            <div class="col-md-6 content-table">
              <div class="form-group">
                <label class="control-label">Status:</label>
                <select class="form-control" name="status" id="status" required>
                  <option value = "1"> Active</option>
                  <option value = "0"> Inactive</option>
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
