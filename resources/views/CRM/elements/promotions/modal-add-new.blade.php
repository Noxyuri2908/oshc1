<div class="modal fade user-information" id="modal_promotion_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new promotion</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="{{route('promotion.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="content-information">
                        <div class="row">
                            <div class="col-md-12 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Campaign:</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Campaign" required>
                                </div>
                            </div>
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Start date:</label>
                                    <input type="text" id="start_date" name="start_date" autocomplete="off" class="form-control" placeholder="Start date" required>
                                </div>
                            </div>
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">End date:</label>
                                    <input type="text" id="end_date" autocomplete="off" name="end_date" class="form-control" placeholder="End date" required>
                                </div>
                            </div>
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Promotion code:</label>
                                    <input type="text" id="code" name="code" class="form-control" placeholder="Promotion code" required>
                                </div>
                            </div>
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Amount:</label>
                                    <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount" required>
                                </div>
                            </div>
                            <div class="col-md-6 content-table fill_content">
                                <div class="form-group " id="unit_select_parent">
                                    <label class="control-label">Unit:</label>
                                    <select name="unit" id="unit" class="form-control">
                                        @foreach($currencyConfig as $key=>$unit)
                                            <option value="{{$key}}">{{$unit}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 content-table">
                                <div class="form-group">
                                    <label class="control-label">Status:</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="1"> Active</option>
                                        <option value="0"> Inactive</option>
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
@push('scripts')
    <script>
        $('#unit').select2({
            dropdownParent:$('#unit_select_parent')
        });
        $('#start_date, #end_date').flatpickr({
            allowInput:true,
            dateFormat:'d/m/Y'
        });
    </script>
@endpush
