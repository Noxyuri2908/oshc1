<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Method Payment</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="@php
                                                        if ($obj->menthod_payment == 1) echo "Telegraphic (Wire) Transfer";
                                                        elseif ($obj->menthod_payment == 2)echo "Pay by Paypal";
                                                        elseif ($obj->menthod_payment == 3) echo "Pay by Credit Card";
                                                        @endphp" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Commission (include GST)</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->price_comm}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">GST</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->prcie_gst}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Surcharge fee</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->price_su}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Total</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" value="{{$obj->total}}" readonly>
            </div>
        </div>
    </fieldset>
</div>