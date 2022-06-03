<div class="card">
    <form role="form" id="filter-box" autocomplete="off">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Date of policy</label>
                        <div class="d-flex">
                            <input type="text" value="{{request()->start_date}}" name="start_date" id="start_date" class="mr-2 form-control" placeholder="dd/mm/YYYY">
                            <input type="text" value="{{request()->end_date}}" name="end_date" id="end_date" class="form-control" placeholder="dd/mm/YYYY">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Agent</label>
                        <div id="inputParentGroupSelect01">
                            <select name="agent_id" class="custom-select" id="inputGroupSelect01">
                                {{--                            <option value="" selected>Choose...</option>--}}
                                {{--                            @if(!empty($agents))--}}
                                {{--                                @foreach($agents as $key=>$agent)--}}
                                {{--                                    <option value='{{$key}}' {{(request()->get('agent_id') == $key)?'selected':''}}>{{$agent}}</option>--}}
                                {{--                                @endforeach--}}
                                {{--                            @endif--}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="custom-select" id="inputGroupSelect01">
                            <option value="vi" {{request()->get('type') == 'vi'?'selected':''}}>1</option>
                            <option value="en" {{request()->get('type') == 'en'?'selected':''}}>2</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i> {{__('Apply')}} </button>
            <div class="btn btn-default btn-sm pull-left" id="btn_reset">
                <a href="{{route('reportMonthly',['date_of_policy'=>\Carbon::now()->subMonth(12)->format('d/m/Y').' to '.\Carbon::now()->format('d/m/Y')])}}"> Reset</a>
            </div>
            {{--        download_pdf--}}
            {{-- <a class="btn btn-primary" href="{{route('report.exportExcel',request()->query())}}">Export to Excel</a> --}}
            <a class="btn btn-primary" href="{{route('report.exportPdf',request()->query())}}">Export to Pdf</a>
            <a class="btn btn-primary" href="#" id="btn">Export to Excel</a>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        flatpickr('#end_date', {
            dateFormat: 'd/m/Y',
        })
        flatpickr('#start_date', {
            dateFormat: 'd/m/Y',
        })
    </script>
@endpush
