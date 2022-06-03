{{--<form id="modal-form-import" action="{{route('invoice.export.with.blade')}}" method="POST" enctype="multipart/form-data" style="text-align: right">--}}
{{--    @csrf--}}
{{--    <input class="form-control" name="apply_id_export" id="apply_id_export" value="{{$dataInvoice['apply_id']}}" type="hidden">--}}
{{--    <input class="form-control" name="type_file" id="type_file" value="{{$dataInvoice['template_id']}}" type="hidden">--}}
{{--</form>--}}
<button type="submit" class="btn btn-primary">Export</button>
