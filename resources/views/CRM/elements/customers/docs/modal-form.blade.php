@if(!isset($tailieu))
    <div class="modal fade" id="tailieuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <form id="form-scan-modal" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="apply_id" value="{{$obj->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="attach-modal-title">Add new document</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                class="font-weight-light" aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="data_ngaybatdau">Name</label>
                            <input class="form-control" name="name" id="name-docs" placehoder="Name of document"
                                   type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="data_ngaybatdau">Type file</label>
                            <input class="form-control" name="type_file" id="docs_type_file" placehoder="Type file"
                                   type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="data_ngaybatdau">Note</label>
                            <textarea id="note-docs-file" class="form-control" name="note"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="data_ngaybatdau">File</label>
                            <input type="file" name="file" accept="image/gif,
                            image/jpeg,
                            image/jpg,
                            image/png,
                            application/vnd.ms-excel,
                            application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                            application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                            text/plain,
                            application/pdf" class="form-control-file" required>
                        </div>
                        @if(!empty($type) && $type == 'flywire')
                            <input type="hidden" name="type" value="flywire">
                        @endif
                    </div>
                    <input type="hidden" name="action" value="" id="form-docs-action">
                    <div class="modal-footer">
                        <button class="btn" style="background:#9da9bb" type="button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="btn-docs-upload">Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@else
    <div class="modal fade" id="tailieuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <form id="form-scan-modal" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="apply_id" value="{{$obj->id}}">
            <input type="hidden" name="tailieu_id" value="{{$tailieu->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="attach-modal-title">Edit document</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                class="font-weight-light" aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="data_ngaybatdau">Name</label>
                            <input class="form-control" name="name" value="{{$tailieu->name}}"
                                   placehoder="Name of document" type="text" id="name-docs" required>
                        </div>
                        <div class="form-group">
                            <label for="data_ngaybatdau">Type file</label>
                            <input id="docs_type_file" class="form-control" name="type_file"
                                   value="{{$tailieu->type_file}}">
                        </div>
                        <div class="form-group">
                            <label for="data_ngaybatdau">Note</label>
                            <textarea id="note-docs-file" class="form-control" name="note">{{$tailieu->note}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="data_ngaybatdau">File</label>
                            <input type="file" name="file" accept="image/gif,
                            image/jpeg,
                            image/jpg,
                            image/png,
                            application/vnd.ms-excel,
                            application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                            application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                            text/plain,
                            application/pdf" class="form-control-file">
                        </div>
                        <a href="{{$tailieu->link_download()}}" target="_blank">See file :{{$tailieu->link}}</a>
                        @if(!empty($type) && $type == 'flywire')
                            <input type="hidden" name="type" value="flywire">
                        @endif
                    </div>
                    <input type="hidden" name="action" value="" id="form-docs-action">
                    <div class="modal-footer">
                        <button class="btn" style="background:#9da9bb" type="button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="btn-docs-upload">Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endif
