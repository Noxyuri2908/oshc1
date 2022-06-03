<!-- Modal-->
<div class="modal fade" id="exportModalInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="modal-form-import" action="{{route('invoice.export')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Export Invoices </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select class="form-control" name="type_file" required>
              <option label=""></option>
              @foreach(config('myconfig.template_export') as $key=>$value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
          </div>
          <input class="form-control" name="apply_id_export" id="apply_id_export" value="" type="hidden">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-success" type="button" id="viewInvoice"><a href="{{route('invoice.view')}}" style="color: #fff" target="_blank">View</a></button>
        </div>
      </div>
    </form>
  </div>
</div>
@push('scripts')
    <script>

    </script>
@endpush
