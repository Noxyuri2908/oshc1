<div class="panel-body">
    <fieldset class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">Country</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="country" id="country" 
                value="{{isset($obj) ? $obj->country : old('country')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">City</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="city" id="city" 
                value="{{isset($obj) ? $obj->city : old('city')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Office</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="office" id="office" 
                value="{{isset($obj) ? $obj->office : old('office')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tel 1</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="tel_1" id="tel_1" 
                value="{{isset($obj) ? $obj->tel_1 : old('tel_1')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Tel 2</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="tel_2" id="tel_2" 
                value="{{isset($obj) ? $obj->tel_2 : old('tel_2')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Facebook</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="fb" id="fb" 
                value="{{isset($obj) ? $obj->fb : old('fb')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Contact Person</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="contact_person" id="contact_person" 
                value="{{isset($obj) ? $obj->contact_person : old('contact_person')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Note</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="note" id="note" 
                value="{{isset($obj) ? $obj->note : old('note')}}">
            </div>
        </div>
    </fieldset>
</div>