<div class="modal fade" id="modalAgentsUpdateStatus" tabindex="-1" role="dialog"
     aria-labelledby="modalAgentsUpdateStatus"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-set-status">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="form-control" id="status_agent">
                        <option value=""></option>
                        @foreach(config('admin.status') as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>

    </script>
@endpush
