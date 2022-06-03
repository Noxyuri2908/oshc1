@if(!isset($tailieu))
<div class="modal fade" id="tailieuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="form-scan-modal" action="{{route('apply.tailieu.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="apply_id" value="{{$obj->id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="attach-modal-title">Add new document</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="data_ngaybatdau">Name</label>
            <input class="form-control" name="name" placehoder="Name of document" type="text" required>
          </div>
          <div class="form-group">
            <label for="data_ngaybatdau">Type file</label>
            <select class="form-control" name="type_file" required>
              <option label=""></option>
              @foreach(config('myconfig.type_file') as $key=>$value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="data_ngaybatdau">Note</label>
            <textarea class="form-control" name="note"></textarea>
          </div>
          <div class="form-group">
            <label for="data_ngaybatdau">File</label>
            <input type="file" name="file" class="form-control-file" required>
          </div>
        </div>
          <input type="hidden" name="action" value="" id="form-docs-action">
        <div class="modal-footer">
          <button class="btn" style="background:#9da9bb" type="button" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Upload</button>
        </div>
      </div>
    </div>
  </form>
</div>
@else
<div class="modal fade" id="tailieuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="form-scan-modal" action="{{route('apply.tailieu.update', ['id'=>$tailieu->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="apply_id" value="{{$obj->id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="attach-modal-title">Edit document</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="data_ngaybatdau">Name</label>
            <input class="form-control" name="name" value="{{$tailieu->name}}" placehoder="Name of document" type="text" required>
          </div>
          <div class="form-group">
            <label for="data_ngaybatdau">Type file</label>
            <select class="form-control" name="type_file" required>
              <option label=""></option>
              @foreach(config('myconfig.type_file') as $key=>$value)
              <option value="{{$key}}" {{$tailieu->type_file == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="data_ngaybatdau">Note</label>
            <textarea class="form-control" name="note">{{$tailieu->note}}</textarea>
          </div>
          <div class="form-group">
            <label for="data_ngaybatdau">File</label>
            <input type="file" name="file" class="form-control-file">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn" style="background:#9da9bb" type="button" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Update</button>
        </div>
      </div>
    </div>
  </form>
</div>
@endif
