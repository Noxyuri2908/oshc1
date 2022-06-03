<div class="modal fade user-information" id="modal_email_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form id="invoice-mail-form" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Email/Sms</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills">
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Chon mau</a>
                    <div class="dropdown-menu">
                        @if(!empty($emailTempletes))
                            @foreach($emailTempletes as $email)
                                <a class="dropdown-item select-mail-temp" href="#" data-value="{!!$email->content!!}">{{$email->name}}</a>
                            @endforeach
                        @endif
                    </div>
                    </li>
                </ul>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Noi dung</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mail nhan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Dinh kem tep</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <textarea class="form-control" name="content_mail" id="content_mail" cols="30" rows="20"></textarea>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Stt</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody id="send-mail-data">
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <input class="form-control" type="file" id="files" name="files_send_mail[]" multiple><br><br>
                    </div>
                </div>

                {{-- <div class="content-information">
                <div class="row">
                    <div class="col-md-6 content-table">
                    <div class="form-group">
                        <label class="control-label">Type action:</label>
                        <select class="form-control" name="type_action" id="type_action">
                        <option value = "1"> Send Email</option>
                        <option value = "2"> Send SMS</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-6 content-table">
                    <div class="form-group">
                        <label class="control-label">Type content:</label>
                        <select class="form-control" name="type_content" id="type_content">
                        <option value = "1"> Template content</option>
                        <option value = "2"> Customer content</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-6 content-table template_mail" style="display: block;">
                    <div class="form-group">
                        <label class="control-label">Template content:</label>
                        <select class="form-control" name="template_id" id="template_id">
                        <option value = "1"> Template 1</option>
                        <option value = "2"> Template 2</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-12 content-table fill_content" style="display: none;">
                    <div class="form-group">
                        <label class="control-label">Subject:</label>
                        <input type="text" id="subject" name="subject" class="form-control">
                    </div>
                    </div>
                    <div class="col-md-12 content-table fill_content" style="display: none;">
                    <div class="form-group">
                        <label class="control-label">Content:</label>
                        <textarea name="content" id="content" class="form-control my-editor" rows="5"></textarea>
                    </div>
                    </div>
                </div>
                </div> --}}

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary mr-1 mb-1 submit_mail" type="submit">Send</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>
@push('scripts')
<script>
    CKEDITOR.replace('content_mail', {
        filebrowserBrowseUrl: "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
        filebrowserUploadUrl: "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
        filebrowserImageBrowseUrl: "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
    });
    $(document).on('click', '.remove-email', function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    })
    $(document).on('click','.select-mail-temp',function(e){
        e.preventDefault();
        let _html = $(this).data('value');
        CKEDITOR.instances['content_mail'].setData(_html);
    })
</script>
@endpush
