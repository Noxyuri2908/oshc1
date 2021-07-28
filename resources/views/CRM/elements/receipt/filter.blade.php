<div class="card">
    <form role="form" id="filter-box" autocomplete="off">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Number Invoice</label>
                <input type="text" value="{{request()->number_invoice}}" name="number_invoice" class="form-control" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Created At</label>
                <input type="text" value="{{request()->created_at}}" name="created_at" id="filter_create_at" class="form-control" placeholder="dd/mm/YYYY">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i> {{__('Apply')}} </button>
        <div class="btn btn-default btn-sm pull-left" id="btn_reset">
            <a href="{{ url()->current() }}"> Reset</a>
        </div>
    </div>
    </form>
</div>
@push('scripts')
<script>
    flatpickr("#filter_create_at", {
        mode: "range",
        dateFormat: "d/m/Y",
    });

</script>
@endpush
