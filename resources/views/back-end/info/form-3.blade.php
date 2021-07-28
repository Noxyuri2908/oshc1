<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Registered Date</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="registered_date" id="registered_date" 
                value="{{isset($tmp) ? $tmp->registered_date : old('registered_date')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Agent Code</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="agent_code" id="agent_code" 
                value="{{isset($tmp) ? $tmp->agent_code : old('agent_code')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Rating</label>
            <div class="col-sm-5">
              <select class="form-control" id="rate" name="rate">
                <option value="A" {{isset($tmp) ? ($tmp->rate == 'A' ? 'selected' : ''):  (old('rate') == 'A' ? 'selected' : '')}}>A</option>
                <option value="B" {{isset($tmp) ? ($tmp->rate == 'B' ? 'selected' : ''):  (old('rate') == 'B' ? 'selected' : '')}}>B</option>
                <option value="C" {{isset($tmp) ? ($tmp->rate == 'C' ? 'selected' : ''):  (old('rate') == 'C' ? 'selected' : '')}}>C</option>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">GST</label>
            <div class="col-sm-5">
              <select class="form-control" id="gst" name="gst">
                <option value="0" {{isset($tmp) ? ($tmp->gst == 0 ? 'selected' : ''):  (old('gst') == 0 ? 'selected' : '')}}>Not include</option>
                <option value="1" {{isset($tmp) ? ($tmp->gst == 1 ? 'selected' : ''):  (old('gst') == 1 ? 'selected' : '')}}>Include</option>
              </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Commission payment</label>
            <div class="col-sm-5">
              <select class="form-control" id="type_payment" name="type_payment">
                <option value="1" {{isset($tmp) ? ($tmp->type_payment == 1 ? 'selected' : ''):  (old('type_payment') == 1 ? 'selected' : '')}}>Deduction commision</option>
                <option value="2" {{isset($tmp) ? ($tmp->type_payment == 2 ? 'selected' : ''):  (old('type_payment') == 2 ? 'selected' : '')}}>Pay com by month</option>
              </select>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('b_status') ? 'has-error' : '' }}">
            <label class="col-sm-2 control-label">Status bussiness (*)</label>
            <div class="col-sm-5">
                <select name=b_status class="form-control">
                    <option label=""></option>
                    @foreach($status as $key=>$value)
                    <option value="{{$key}}" {{isset($tmp) ? ($tmp->status == $key ? 'selected' : ''):  (old('status') == $key  ? 'selected' : '')}}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </fieldset>
</div>