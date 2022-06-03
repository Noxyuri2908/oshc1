<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-2">
                <label class="form-control">SERVICE </label>
            </div>
            <div class="col-sm-2">
                <label class="form-control">POLICY </label>
            </div>
            <div class="col-sm-2">
                <label class="form-control">COMMISSION </label>
            </div>
            <div class="col-sm-2">
                <label class="form-control">END DATE </label>
            </div>
        </div>
        <input type='hidden' name="count" id="count_new" value="1">
        @if($is_admin)
            <div id="info_comm">
               @include('back-end.info.item-comm')
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <button type="button" class="btn btn-danger" id="add_comm">ADD NEW</button>
                </div>
            </div>
        @else
        <div id="info_comm">
            @foreach($user->commission as $comm)
            <div class="form-group">
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                    value="{{$comm->service != null ? $comm->service->name : ''}}" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                    value="<?php if ($comm->type == 1) echo 'Single';
                    elseif ($comm->type == 2) echo 'Couple';
                    elseif ($comm->type == 3) echo 'Family'; ?>" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                    value="{{$comm->comm}}%" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                    value="{{$comm->date}}" readonly>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </fieldset>
</div>