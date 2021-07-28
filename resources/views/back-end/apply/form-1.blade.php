<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Service</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->Service != null ? $obj->Service->name : ''}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Start date</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->start_date}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">End date</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->end_date}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">No of Adults</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->no_of_adults}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">No of Children</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->no_of_children}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Price</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->price}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-5">
                @if ($obj->status == 2)
                    <span class="label label-success">Running</span></a>
                @elseif ($obj->status == 1)
                    <span class="label label-warning">Pending</span></a>
                @elseif ($obj->status == 3)
                    <span class="label label-danger">Reject</span></a>
                @elseif ($obj->status == 0)
                    <span class="label label-danger">Incomplete</span></a>
                @endif
            </div>
        </div>
    </fieldset>
</div>