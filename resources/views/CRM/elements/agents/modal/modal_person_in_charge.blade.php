<div class="modal fade" id="modalAgentPersonCharge" tabindex="-1" role="dialog" aria-labelledby="modalAgentPersonCharge"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-set-person-in-charge">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Person In Charge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="form-control" id="staff_id_person_in_charge">
                        <option value=""></option>
                        @foreach($admins as $idAdmin=>$admin)
                            <option value="{{$idAdmin}}">{{$admin}}</option>
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
