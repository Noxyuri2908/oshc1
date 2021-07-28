<div class="modal fade user-information" id="modal_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail of Service</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-information">
         <h3 class="name">
          {{$obj->name}}
        </h3>
        <div class="row">
          <div class="col-md-12 content-table">
            <div class="form-group">
              <label class="control-label">Image:</label>
              <div><img src="{{$obj->image}}" style="width: 200px; height: 50px"></div>
            </div>
          </div>
          
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Price:</label>
              <input type="text" name="" value="{{$obj->price}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Price type:</label>
              <input type="text" name="" value="{{$obj->price_type == 1 ? 'Api' : 'File'}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Created at:</label>
              <input type="text" name="" value="{{$obj->created_at}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Updated at:</label>
              <input type="text" name="" value="{{$obj->updated_at}}" readonly>
            </div>
          </div>
          <div class="col-md-6 content-table">
            <div class="form-group">
              <label class="control-label">Status:</label>
              <input type="text" name="" value="{{$obj->status == 1 ? 'Active' : 'De-active'}}" readonly>
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
